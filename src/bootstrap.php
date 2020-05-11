<?php

declare(strict_types=1);

namespace NorseBlue\StringExtensions\Regex;

use NorseBlue\ScalarObjects\Types\StringType;
use Symfony\Component\Finder\Finder;
use function NorseBlue\ScalarObjects\path_merge;

/**
 * @codeCoverageIgnore
 */
(static function (): void {
    $extensions_path = path_merge(__DIR__, 'Extensions');
    $extensions = array_keys(
        iterator_to_array(
            Finder::create()
                ->in($extensions_path)
                ->name('String*Extension.php')
                ->files()
        )
    );

    foreach ($extensions as $path) {
        $pattern = '%^' . path_merge($extensions_path, 'String') . '(.+)Extension\.php$%';
        $name = preg_replace($pattern, '\1', $path);

        $extension = path_merge(
            'NorseBlue\StringExtensions\Regex',
            [
                'Extensions',
                "String{$name}Extension",
            ],
            '\\'
        );

        StringType::registerExtensionMethod(lcfirst($name), $extension);
    }
})();
