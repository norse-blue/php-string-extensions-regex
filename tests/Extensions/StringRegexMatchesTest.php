<?php

namespace NorseBlue\StringExtensions\Regex\Tests\Extensions;

use Exception;
use NorseBlue\ScalarObjects\Facades\StringFacade as Str;
use NorseBlue\StringExtensions\Regex\Exceptions\RegexMatchException;
use NorseBlue\StringExtensions\Regex\Tests\TestCase;

class StringRegexMatchesTest extends TestCase
{
    /** @test */
    public function string_matches()
    {
        $this->assertEquals([], Str::regexMatches('ac', '/de/'));
        $this->assertEquals(['a'], Str::regexMatches('ac', '/a/'));
        $this->assertEquals([], Str::regexMatches('ac', '/a$/'));
        $this->assertEquals(['ac', 'a', '', 'c'], Str::regexMatches('ac', '/(a)(b)*(c)/'));
        $this->assertEquals(['ac', 'a', null, 'c'], Str::regexMatches('ac', '/(a)(b)*(c)/', PREG_UNMATCHED_AS_NULL));

        $this->assertEquals(['abcde', 'ab', 'name' => 'ab'], Str::regexMatches('abcde', '/(?<name>ab)cde/'));
    }

    /** @test */
    public function string_matches_throws_exception_when_there_is_a_preg_error()
    {
        try {
            Str::regexMatches('hello', '/.*/hello');
        } catch (Exception $e) {
            $this->assertInstanceOf(RegexMatchException::class, $e);
            /** @var RegexMatchException $e */
            $this->assertEquals(1, $e->getPregErrorCode());
            $this->assertEquals('PREG_INTERNAL_ERROR', $e->getPregErrorName());

            return;
        }

        $this->fail(RegexMatchException::class . ' was not thrown.');
    }
}
