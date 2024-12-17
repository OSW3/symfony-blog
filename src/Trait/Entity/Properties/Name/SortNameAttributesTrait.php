<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Name;

use Doctrine\DBAL\Types\Types;

trait SortNameAttributesTrait
{
    const SORT_NAME_ATTRIBUTE_NAME   = "name_sort";
    const SORT_NAME_ATTRIBUTE_TYPE   = Types::STRING;
}