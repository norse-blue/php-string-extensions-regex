<?php

declare(strict_types=1);

namespace NorseBlue\StringExtensions\Regex\Extensions;

use NorseBlue\ExtensibleObjects\Contracts\ExtensionMethod;
use NorseBlue\ScalarObjects\Types\IntType;
use NorseBlue\ScalarObjects\Types\StringType;
use NorseBlue\StringExtensions\Regex\Exceptions\RegexMatchException;

final class StringRegexMatchesExtension extends StringType implements ExtensionMethod
{
    /**
     * @return callable(string|StringType $pattern, int|IntType $flags = 0): array
     */
    public function __invoke(): callable
    {
        /**
         * Match the string to a regex pattern.
         *
         * @param string|StringType $pattern
         * @param int|IntType $flags
         *
         * @throws \NorseBlue\StringExtensions\Regex\Exceptions\RegexMatchException
         *
         * @see https://www.php.net/manual/en/function.preg-match.php
         */
        return function ($pattern, $flags = 0): array {
            $pattern = self::unwrap($pattern);

            if (@preg_match($pattern, $this->value, $matches, IntType::unwrap($flags)) === false) {
                throw new RegexMatchException(
                    preg_last_error(),
                    'An error occurred while trying to get the string regex matches.'
                );
            }

            return $matches;
        };
    }
}
