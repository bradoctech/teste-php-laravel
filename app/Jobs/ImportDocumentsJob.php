<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportDocumentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $documentData;

    /**
     * Create a new job instance.
     * 
     * @param array $documentData
     */
    public function __construct(array $documentData)
    {
        $this->documentData = $documentData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Obtém ou cria a categoria
        $category = Category::firstOrCreate(['name' => $this->documentData['categoria']]);

        // Cria o documento
        Document::create([
            'category_id' => $category->id,
            'title' => $this->documentData['titulo'],
            'contents' => $this->documentData['conteúdo'],
        ]);
    }
}
