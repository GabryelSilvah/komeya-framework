<?php
namespace Komeya\core\annotetions;
use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Repository
{
    public function __construct(public string $nameModel) {}
}
