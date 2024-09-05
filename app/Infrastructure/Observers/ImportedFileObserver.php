<?php

namespace App\Infrastructure\Observers;


use App\Infrastructure\Database\Models\ImportedFile;
use App\Infrastructure\Events\JsonUploaded;

class ImportedFileObserver
{
    /**
     * Handle the ImportedFile "created" event.
     */
    public function created(ImportedFile $importedFile): void
    {
        JsonUploaded::dispatch($importedFile);
    }

    /**
     * Handle the ImportedFile "updated" event.
     */
    public function updated(ImportedFile $importedFile): void
    {
        //
    }

    /**
     * Handle the ImportedFile "deleted" event.
     */
    public function deleted(ImportedFile $importedFile): void
    {
        //
    }

    /**
     * Handle the ImportedFile "restored" event.
     */
    public function restored(ImportedFile $importedFile): void
    {
        //
    }

    /**
     * Handle the ImportedFile "force deleted" event.
     */
    public function forceDeleted(ImportedFile $importedFile): void
    {
        //
    }
}
