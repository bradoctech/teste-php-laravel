<?php

namespace App\Console\Commands;

use App\Jobs\ImportDocumentsJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportDocumentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:documents {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa documentos de um arquivo JSON para o banco de dados.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $filePath = $this->argument('file');
        $absolutePath = Storage::path($filePath);

        $this->info("Path being checked: {$absolutePath}");

        if (!Storage::exists($filePath)) {
            $this->error("Arquivo {$filePath} não encontrado.");
            return;
        }

        $jsonData = Storage::get($filePath);
        $data = json_decode($jsonData, true);

        if (!isset($data['documentos']) || !is_array($data['documentos'])) {
            $this->error("Formato do arquivo inválido.");
            return;
        }

        foreach ($data['documentos'] as $document) {
            ImportDocumentsJob::dispatch($document);
        }

        $this->info("Importação iniciada. Os documentos estão sendo processados em segundo plano.");
    }
}
