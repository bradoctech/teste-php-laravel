<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Validation\ValidationException;

class DocumentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa o tamanho máximo do campo conteúdo.
     */
    public function test_conteudo_max_length_validation()
    {
        $category = Category::factory()->create(['name' => 'Remessa']);

        $longContent = str_repeat('a', 10001);

        try {
            Document::create([
                'category_id' => $category->id,
                'title' => 'Título válido com semestre',
                'contents' => $longContent,
            ]);
        } catch (ValidationException $e) {
            $this->assertTrue(true);
            return;
        }

        $this->fail('A validação para o tamanho máximo do campo "conteúdo" não foi acionada.');
    }

    /**
     * Testa a regra do título baseado na categoria.
     */
    public function test_titulo_validation_based_on_category()
    {
        $categoryRemessa = Category::factory()->create(['name' => 'Remessa']);
        $categoryRemessaParcial = Category::factory()->create(['name' => 'Remessa Parcial']);

        // Teste para "Remessa"
        $this->expectException(ValidationException::class);
        Document::create([
            'category_id' => $categoryRemessa->id,
            'title' => 'Título sem a palavra semestre',
            'contents' => 'Conteúdo válido',
        ]);

        // Teste para "Remessa Parcial"
        $this->expectException(ValidationException::class);
        Document::create([
            'category_id' => $categoryRemessaParcial->id,
            'title' => 'Título sem nome de mês',
            'contents' => 'Conteúdo válido',
        ]);
    }
}
