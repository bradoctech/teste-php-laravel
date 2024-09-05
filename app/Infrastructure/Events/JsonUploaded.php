<?php

namespace App\Infrastructure\Events;

use App\Infrastructure\Database\Models\ImportedFile;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JsonUploaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private ImportedFile $importedFile;

    /**
     * Create a new event instance.
     */
    public function __construct(ImportedFile $importedFile)
    {
        $this->importedFile = $importedFile;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }

    /**
     * @return ImportedFile
     */
    public function getImportedFile(): ImportedFile
    {
        return $this->importedFile;
    }
}
