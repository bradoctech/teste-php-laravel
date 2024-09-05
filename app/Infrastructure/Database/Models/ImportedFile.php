<?php

namespace App\Infrastructure\Database\Models;

use App\Application\Enums\Status;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $file_name
 * @property string $path
 * @property string $disk
 * @property array $status
 * @property int $imported_lines
 * @property int $lines_errors
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class ImportedFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'path',
        'disk',
        'status',
        'imported_lines',
        'lines_errors',
    ];
}
