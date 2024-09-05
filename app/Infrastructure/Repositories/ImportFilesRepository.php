<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Interfaces\Repositories\IImportFilesRepository;
use App\Infrastructure\Database\Models\FailedJobs;
use App\Infrastructure\Database\Models\ImportedFile;
use Illuminate\Database\Eloquent\Collection;

class ImportFilesRepository implements IImportFilesRepository
{

    /**
     * @var ImportedFile
     */
    private ImportedFile $importedFile;
    private FailedJobs $failedJobs;

    /**
     * @param ImportedFile $importedFile
     */
    public function __construct(ImportedFile $importedFile, FailedJobs $failedJobs)
    {
        $this->importedFile = $importedFile;
        $this->failedJobs = $failedJobs;
    }

    /**
     * @param array $data
     * @return ImportedFile
     */
    public function store(array $data): ImportedFile
    {
        return $this->importedFile->create($data);
    }

    /**
     * @param array $data
     * @return bool
     * @throws \Throwable
     */
    public function update(array $data): bool
    {
        return $this->importedFile->updateOrFail($data);
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->importedFile->get();
    }

    /**
     * @return Collection
     */
    public function listErrors(): Collection
    {
        return $this->failedJobs->get();
    }
}
