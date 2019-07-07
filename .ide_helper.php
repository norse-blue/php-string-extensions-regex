<?php

namespace {

    exit("This file should not be included, only analyzed by your IDE.");
}

namespace NorseBlue\ScalarObjects\Types {

    if (false) {

        /**
         * @method array regexMatches(string|self $pattern, int|IntType $flags = 0)
         * @method BoolType regexPatternMatch(string|self|array $patterns)
         * @method self regexQuote(string|self $delimiter = '#')
         * @method self regexReplace(string|StringType|array<string|StringType> $pattern, string|StringType|array<string|StringType> $replacement, int|IntType $limit = -1)
         *
         * @see \NorseBlue\ScalarObjects\Extensions\String\StringRegexMatchesExtension
         * @see \NorseBlue\ScalarObjects\Extensions\String\StringRegexPatternMatchExtension
         * @see \NorseBlue\ScalarObjects\Extensions\String\StringRegexQuoteExtension
         * @see \NorseBlue\ScalarObjects\Extensions\String\StringRegexReplaceExtension
         */
        class StringType
        {
        }
    }
}

namespace NorseBlue\ScalarObjects\Facades {

    use NorseBlue\ScalarObjects\Types\BoolType;
    use NorseBlue\ScalarObjects\Types\IntType;
    use NorseBlue\ScalarObjects\Types\StringType;

    if (false) {

        /**
         * @method static array regexMatches(string|StringType $value, string|StringType $pattern, int|IntType $flags = 0)
         * @method static BoolType regexPatternMatch(string|StringType $value, string|StringType|array $patterns)
         * @method static StringType regexQuote(string|StringType $value, string|StringType $delimiter = '#')
         * @method static StringType regexReplace(string|StringType $value, string|StringType|array<string|StringType> $pattern, string|StringType|array<string|StringType> $replacement, int|IntType $limit = -1)
         */
        class StringFacade
        {
        }
    }
}
