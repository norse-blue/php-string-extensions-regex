<?php

declare(strict_types=1);

namespace NorseBlue\StringExtensions\Regex\Exceptions;

use RuntimeException;
use Throwable;

/**
 * Exception thrown when there is a regex match error.
 */
final class RegexMatchException extends RuntimeException
{
    protected int $preg_error_code;

    protected string $preg_error_name;

    public function __construct(
        int $preg_error_code,
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->preg_error_code = $preg_error_code;
        $this->preg_error_name = $this->translatePregErrorCode($this->preg_error_code);
    }

    /**
     * Get the PCRE regex execution error code.
     */
    public function getPregErrorCode(): int
    {
        return $this->preg_error_code;
    }

    /**
     * Get the PCRE regex execution error name.
     */
    public function getPregErrorName(): string
    {
        return $this->preg_error_name;
    }

    /**
     * Translate the PCRE execution regex error code.
     */
    protected function translatePregErrorCode(int $preg_error_code): string
    {
        $pcre_constants = get_defined_constants(true)['pcre'];

        return @array_flip($pcre_constants)[$preg_error_code];
    }
}
