<?php

namespace App\Infrastructure\Providers;

use App\Application\Services\ImportFileService;
use App\Domain\Interfaces\Repositories\ICategoriesRepository;
use App\Domain\Interfaces\Repositories\IDocumentsRepository;
use App\Domain\Interfaces\Repositories\IImportFilesRepository;
use App\Domain\Interfaces\Services\IImportFileService;
use App\Infrastructure\Database\Models\ImportedFile;
use App\Infrastructure\Observers\ImportedFileObserver;
use App\Infrastructure\Repositories\CategoriesRepository;
use App\Infrastructure\Repositories\DocumentsRepository;
use App\Infrastructure\Repositories\ImportFilesRepository;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IImportFileService::class, ImportFileService::class);
        $this->app->bind(IImportFilesRepository::class, ImportFilesRepository::class);
        $this->app->bind(IDocumentsRepository::class, DocumentsRepository::class);
        $this->app->bind(ICategoriesRepository::class, CategoriesRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Database\\Factories\\' . class_basename($modelName) . 'Factory';
        });
        Factory::guessModelNamesUsing(function ($string) {
            return 'App\\Infrastructure\\Database\\Models\\' . str_replace('Factory', '', class_basename($string));
        });

        ImportedFile::observe(ImportedFileObserver::class);

    }
}
