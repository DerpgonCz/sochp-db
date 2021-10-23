<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Laravel\Scout\Searchable;

class ScoutImportAllCommand extends Command
{
    protected $signature = 'scout:import:all';

    protected $description = 'Imports all models into the search index';

    public function handle(): int
    {
        // https://stackoverflow.com/a/60310985
        $models = collect(File::files(app_path('Models')))
            ->map(function ($file) {
                $path = $file->getRelativePathName();

                return sprintf(
                    '\%sModels\%s',
                    Container::getInstance()->getNamespace(),
                    strtr(substr($path, 0, strrpos($path, '.')), '/', '\\')
                );
            })
            ->filter(function ($class) {
                if (class_exists($class)) {
                    $reflection = new \ReflectionClass($class);
                    return $reflection->isSubclassOf(Model::class)
                        && !$reflection->isAbstract()
                        && array_key_exists(Searchable::class, $reflection->getTraits());
                }

                return false;
            });

        foreach ($models as $model) {
            Artisan::call('scout:import', ['model' => $model]);
            $this->line(Artisan::output());
        }

        return 0;
    }
}
