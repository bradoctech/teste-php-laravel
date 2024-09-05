<?php

namespace App\Domain\Interfaces\Repositories;

use App\Infrastructure\Database\Models\Document;

interface IDocumentsRepository
{
    public function store(array $data): Document;
}
