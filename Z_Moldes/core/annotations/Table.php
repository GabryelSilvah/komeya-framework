<?php

namespace Komeya\core\annotetions;

use Attribute;


#[Attribute(Attribute::TARGET_CLASS)]
class Table
{
    function __construct(public string $nameTable = "") {}
}
