<?php

namespace App\Helpers;

class PageLayout
{
    private static function getLayoutsFromDirectory(): array
    {
        $layouts = [];
        $files = glob(resource_path('views/filament/layouts/*.blade.php'));

        foreach ($files as $file) {
            $name = basename($file, '.blade.php');
            $layouts[$name] = $name;
        }

        return $layouts;
    }
}
