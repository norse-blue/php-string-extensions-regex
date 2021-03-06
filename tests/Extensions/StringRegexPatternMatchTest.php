<?php

namespace NorseBlue\StringExtensions\Regex\Tests\Extensions;

use NorseBlue\ScalarObjects\Facades\StringFacade as Str;
use NorseBlue\ScalarObjects\Types\StringType;
use NorseBlue\StringExtensions\Regex\Tests\TestCase;

class StringRegexPatternMatchTest extends TestCase
{
    /** @test */
    public function string_regex_pattern_match()
    {
        $this->assertTrue(Str::regexPatternMatch('/', '/')->value);
        $this->assertFalse(Str::regexPatternMatch('/', ' /')->value);
        $this->assertFalse(Str::regexPatternMatch('/a', '/')->value);
        $this->assertTrue(Str::regexPatternMatch('foo/bar/baz', 'foo/*')->value);

        $this->assertTrue(Str::regexPatternMatch('App\Class@method', '*@*')->value);
        $this->assertTrue(Str::regexPatternMatch('app\Class@', '*@*')->value);
        $this->assertTrue(Str::regexPatternMatch('@method', '*@*')->value);

        // is case sensitive
        $this->assertFalse(Str::regexPatternMatch('foo/bar/baz', '*BAZ*')->value);
        $this->assertFalse(Str::regexPatternMatch('foo/bar/baz', '*FOO*')->value);
        $this->assertFalse(Str::regexPatternMatch('a', 'A')->value);

        // Accepts array of patterns
        $this->assertTrue(Str::regexPatternMatch('a/', ['a*', 'b*'])->value);
        $this->assertTrue(Str::regexPatternMatch('b/', ['a*', 'b*'])->value);
        $this->assertFalse(Str::regexPatternMatch('f/', ['a*', 'b*'])->value);

        $this->assertTrue(Str::regexPatternMatch('blah/baz/foo', '*/foo')->value);

        $valueObject = new StringType('foo/bar/baz');
        $patternObject = new StringType('foo/*');

        $this->assertTrue(Str::regexPatternMatch($valueObject, 'foo/bar/baz')->value);
        $this->assertTrue(Str::regexPatternMatch($valueObject, $patternObject)->value);

        //empty patterns
        $this->assertFalse(Str::regexPatternMatch('test', [])->value);
    }
}
