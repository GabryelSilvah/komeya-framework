<?php
namespace Komeya\core\annotetions;
use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Entity
{
    function __construct() {}
}
