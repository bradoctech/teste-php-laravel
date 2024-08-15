<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';
    protected $fillable = ['category_id', 'title', 'contents'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($document) {
            // Validação do tamanho máximo do campo conteúdo
            if (strlen($document->contents) > 10000) {
                throw ValidationException::withMessages(['contents' => 'O campo conteúdo não pode ter mais de 10000 caracteres.']);
            }

            // Validação do título baseado na categoria
            $category = $document->category->name;
            if ($category === 'Remessa' && !str_contains($document->title, 'semestre')) {
                throw ValidationException::withMessages(['title' => 'O título deve conter a palavra "semestre" para a categoria Remessa.']);
            }

            if ($category === 'Remessa Parcial' && !self::containsMonth($document->title)) { // Mudança aqui
                throw ValidationException::withMessages(['title' => 'O título deve conter o nome de um mês para a categoria Remessa Parcial.']);
            }
        });
    }

    private static function containsMonth(string $title)
    {
        $months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

        foreach ($months as $month) {
            if (str_contains($title, $month)) {
                return true;
            }
        }

        return false;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
