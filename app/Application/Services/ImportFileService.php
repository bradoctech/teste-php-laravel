<?php

namespace App\Application\Services;

use App\Application\Enums\Status;
use App\Domain\Interfaces\Repositories\IImportFilesRepository;
use App\Domain\Interfaces\Services\IImportFileService;
use App\Infrastructure\Database\Models\ImportedFile;
use App\Infrastructure\Jobs\ProcessJsonLineJob;
use Illuminate\Http\Request;
use Log;
use Storage;
use Str;

class ImportFileService implements IImportFileService
{

    private IImportFilesRepository $filesRepository;
    private string $disk = 'local';
    private string $path = 'imported_files';

    /**
     * @param IImportFilesRepository $filesRepository
     */
    public function __construct(IImportFilesRepository $filesRepository)
    {
        $this->filesRepository = $filesRepository;
    }

    /**
     * @param Request $request
     * @return ResponseService
     */
    public function uploadFile(Request $request): ResponseService
    {
        $fileName = Storage::disk($this->getDisk())
            ->putFile(
                $this->getPath(),
                $request->file('formFile')
            );

        $model = $this->filesRepository->store(
            [
                'file_name' => basename($fileName),
                'path' => $this->getPath(),
                'disk' => $this->getDisk()
            ]
        );
        return new ResponseService($model);
    }

    /**
     * @param ImportedFile $importedFile
     * @return array
     */
    public function readFileJson(ImportedFile $importedFile): array
    {
        try {
            $importedFile->saveOrFail(['status' => Status::PROCESSING->value]);

            $path = Storage::disk($this->getDisk())->path($this->getPath() . DIRECTORY_SEPARATOR . $importedFile->file_name);
            $jsonString = file_get_contents($path);
            $oneLineJson = Str::of($jsonString)->replace(["\n", "\r", "\t"], '')->toString();
            $jsonLines = json_decode($oneLineJson, true);

            $this->readJson($jsonLines);

            $importedFile->saveOrFail(
                [
                    'status' => Status::SUCCESS->value,
                    'imported_lines' => count($jsonLines)
                ]
            );
            return $jsonLines;

        } catch (\Throwable $e) {
            $importedFile->save(['status' => Status::ERROR->value]);
            Log::error('ImportFileService::readFileJson', ['error' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * @return void
     */
    public function readJson(array $jsonLines): void
    {
        foreach ($jsonLines['documentos'] as $line) {
            $this->processLineJson($line);
        }
    }


    /**
     * @param array $line
     * @return void
     */
    public function processLineJson(array $line): void
    {
        ProcessJsonLineJob::dispatch($line);
    }

    /**
     * @return ResponseService
     */
    public function list(): ResponseService
    {
        try {
            $result = $this->filesRepository->list();

            return new ResponseService($result);
        } catch (\Throwable $e) {
            return new ResponseService($e->getMessage(), false);
        }
    }

    /**
     * @return ResponseService
     */
    public function listErrors(): ResponseService
    {
        try {
            $result = $this->filesRepository->listErrors();

            return new ResponseService($result);
        } catch (\Throwable $e) {
            return new ResponseService($e->getMessage(), false);
        }
    }

    /**
     * @return string
     */
    public function getDisk(): string
    {
        return $this->disk;
    }

    /**
     * @param string $disk
     * @return ImportFileService
     */
    public function setDisk(string $disk): ImportFileService
    {
        $this->disk = $disk;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return ImportFileService
     */
    public function setPath(string $path): ImportFileService
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param string $fileName
     * @return string|null
     */
    public function getFile(string $fileName): ?string
    {
        if ($this->getPath()){
            $fullPath = $this->getPath() . DIRECTORY_SEPARATOR . $fileName;
        }
        else{
            $fullPath = $fileName;
        }
        return Storage::disk($this->getDisk())->get($fullPath);
    }
}
