<?php
namespace Komeya\core\exceptions;
use Exception;

class Response_jsonException extends Exception
{
    protected $details;

    public function __construct($details)
    {
        $this->details = $details;
        parent::__construct();
    }

    public function __toString(): string
    {
        return "Exception disparada. Detalhes: " . $this->details;
    }
}
