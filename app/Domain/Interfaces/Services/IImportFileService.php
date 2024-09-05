<?php

namespace App\Domain\Interfaces\Services;

use App\Application\Services\ResponseService;
use App\Infrastructure\Database\Models\ImportedFile;
use Illuminate\Http\Request;

interface IImportFileService
{
    public function list(): ResponseService;

    public function uploadFile(Request $request): ResponseService;

    public function readFileJson(ImportedFile $importedFile);

    public function processLineJson(array $line);

    public function listErrors(): ResponseService;
}
