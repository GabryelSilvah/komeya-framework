<?php
namespace Komeya\core\annotetions;
use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Query
{
    public function __construct(public string $querySQL) {}
}
