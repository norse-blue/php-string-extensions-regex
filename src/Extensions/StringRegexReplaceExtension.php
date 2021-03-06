<?php

declare(strict_types=1);

namespace NorseBlue\StringExtensions\Regex\Extensions;

use NorseBlue\ExtensibleObjects\Contracts\ExtensionMethod;
use NorseBlue\ScalarObjects\Types\IntType;
use NorseBlue\ScalarObjects\Types\StringType;
use NorseBlue\StringExtensions\Regex\Exceptions\RegexMatchException;
use function NorseBlue\ScalarObjects\Functions\string;

final class StringRegexReplaceExtension extends StringType implements ExtensionMethod
{
    /**
     * @return callable(string|StringType|array<string|StringType> $pattern, string|StringType|array<string|StringType>
     *     $replacement, int|IntType $limit = -1): StringType
     */
    public function __invoke(): callable
    {
        /**
         * Perform a regular expression search and replace.
         *
         * @param string|StringType|array<string|StringType> $pattern
         * @param string|StringType|array<string|StringType> $replacement
         * @param int|IntType $limit
         *
         * @see https://www.php.net/manual/en/function.preg-replace.php
         */
        return function ($pattern, $replacement, $limit = -1): StringType {
            $pattern = self::unwrap($pattern);
            $replacement = self::unwrap($replacement);
            $limit = IntType::unwrap($limit);

            $replaced = @preg_replace($pattern, $replacement, $this->value, $limit);
            if ($replaced === null) {
                // @codeCoverageIgnoreStart
                throw new RegexMatchException(
                    preg_last_error(),
                    'An error occurred while trying to replace the values.'
                );
                // @codeCoverageIgnoreEnd
            }

            return string($replaced);
        };
    }
}
