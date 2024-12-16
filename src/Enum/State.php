<?php 
namespace OSW3\Blog\Enum;

use OSW3\Blog\Trait\Enum\EnumTrait;

enum State: string 
{
    use EnumTrait;

    case DRAFT = 'draft';
}