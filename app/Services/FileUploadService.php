<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Animal;
use Illuminate\Http\UploadedFile;

class FileUploadService
{
    public function storeAnimalPedigree(Animal|int $animalOrId, ?UploadedFile $file): ?string
    {
        if ($file === null) {
            return null;
        }

        $animalId = match (true) {
            is_int($animalOrId) => $animalOrId,
            default => $animalOrId->id,
        };

        $fileExt = $file->guessClientExtension() ?? 'pdf';
        return $file->storeAs(
            $this->getAnimalPath($animalId),
            sprintf('pedigree.%s', $fileExt),
        );
    }

    private function getAnimalPath(int $id): string
    {
        return sprintf('animals/%d', $id);
    }
}
