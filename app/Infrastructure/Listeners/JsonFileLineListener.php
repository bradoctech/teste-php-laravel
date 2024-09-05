<?php

namespace App\Infrastructure\Listeners;

use App\Domain\Interfaces\Services\IImportFileService;
use App\Infrastructure\Events\JsonUploaded;

class JsonFileLineListener
{
    private IImportFileService $importFileService;

    /**
     * Create the event listener.
     */
    public function __construct(IImportFileService $importFileService)
    {
        //
        $this->importFileService = $importFileService;
    }

    /**
     * Handle the event.
     */
    public function handle(JsonUploaded $event): void
    {
        $this->importFileService->readFileJson($event->getImportedFile());

    }
}
