<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ImportedFileTest extends TestCase
{

    private string $path = 'data';
    private string $disk = 'data';
    private string $fileName = 'test.json';
    private array $file;

    protected function setUp(): void
    {
        $contents = file_get_contents("storage/$this->path/$this->fileName");
        $this->file = json_decode($contents, true);

        parent::setUp();
    }


    public function test_max_content_field_size(): void
    {
        $this->assertIsArray($this->file);
        $this->assertArrayHasKey('documentos', $this->file);

        foreach ($this->file['documentos'] as $documento) {
            $this->assertArrayHasKey('categoria', $documento);
            $this->assertArrayHasKey('titulo', $documento);
            $this->assertArrayHasKey('conteúdo', $documento);

            $this->validatedMaxContentFieldSize($documento['conteúdo']);

            $this->validatedContentFix($documento['categoria'], $documento['titulo']);
        }
    }

    public function test_content_fix(): void
    {
        foreach ($this->file['documentos'] as $documento) {
            $this->validatedContentFix($documento['categoria'], $documento['titulo']);
        }
    }

    private function validatedMaxContentFieldSize(string $content, int $size = 50)
    {
        if (strlen($content) > $size) {
            $this->fail("O campo conteúdo excede $size caracteres.");
        }

        $this->assertTrue(true);
    }

    private function validatedContentFix(string $category, string $title)
    {
        if ($category == 'Remessa' && !str_contains($title, 'semestre')) {
            $this->fail("Registro inválido semestre não encontrado!");
        } elseif ($category == 'Remessa Parcial' && !str_contains($title, 'Janeiro')) {
            $this->fail("Registro inválido, falta meses");
        }

        $this->assertTrue(true);
    }
}
