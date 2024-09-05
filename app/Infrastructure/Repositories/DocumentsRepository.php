<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Interfaces\Repositories\IDocumentsRepository;
use App\Infrastructure\Database\Models\Category;
use App\Infrastructure\Database\Models\Document;
use Illuminate\Support\Facades\Log;

class DocumentsRepository implements IDocumentsRepository
{
    private Document $document;
    private Category $category;

    /**
     * @param Document $document
     * @param Category $category
     */
    public function __construct(Document $document, Category $category)
    {
        $this->document = $document;
        $this->category = $category;
    }

    /**
     * @param array $data
     * @return Document
     */
    public function store(array $data): Document
    {
        try {
            $category = $this->category->where('name', '=', $data['categoria'])->firstOrFail();

            $documents = [
                'category_id' => $category->id,
                'title' => $data['titulo'],
                'contents' => $data['conteúdo']
            ];
            return $this->document->create($documents);
        } catch (\Throwable $e) {
            Log::error('DocumentsRepository::store', ['error' => $e->getMessage()]);
            throw new \Exception();
        }
    }
}
