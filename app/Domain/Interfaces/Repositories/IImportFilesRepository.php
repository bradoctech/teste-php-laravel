<?php

namespace App\Domain\Interfaces\Repositories;

use App\Infrastructure\Database\Models\ImportedFile;
use Illuminate\Database\Eloquent\Collection;

interface IImportFilesRepository
{
    public function list(): Collection;

    public function store(array $data): ImportedFile;

    public function update(array $data): bool;

    public function listErrors(): Collection;
}
