<?php

namespace NorseBlue\StringExtensions\Regex\Tests\Extensions;

use NorseBlue\ScalarObjects\Facades\StringFacade as Str;
use NorseBlue\StringExtensions\Regex\Tests\TestCase;

class StringRegexQuoteTest extends TestCase
{
    /** @test */
    public function string_matches()
    {
        $this->assertEquals('', Str::regexQuote('')->value);
        $this->assertEquals('\#\^this is a string\$\#', Str::regexQuote('#^this is a string$#')->value);
        $this->assertEquals('\#\^this is a string\$\#', Str::regexQuote('#^this is a string$#', '%')->value);
        $this->assertEquals('\%\^this is a string\$\%', Str::regexQuote('%^this is a string$%', '%')->value);
    }
}
