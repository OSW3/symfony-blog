<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Title;

use Doctrine\DBAL\Types\Types;

trait TitleAttributesTrait
{
    const TITLE_SERIALIZER_GROUP = "title";
    const TITLE_ATTRIBUTE_NAME   = "title";
    const TITLE_ATTRIBUTE_TYPE   = Types::STRING;
}