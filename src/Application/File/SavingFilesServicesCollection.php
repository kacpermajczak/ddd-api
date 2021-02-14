<?php
declare(strict_types=1);

namespace App\Application\File;

interface SavingFilesServicesCollection
{
    /**
     * @return SavingFileService[]
     */
    public function getServices(): array;
};
