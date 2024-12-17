<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Name;

use Doctrine\DBAL\Types\Types;

trait NameAttributesTrait
{
    const NAME_SERIALIZER_GROUP = "name";
    const NAME_ATTRIBUTE_NAME   = "name";
    const NAME_ATTRIBUTE_TYPE   = Types::STRING;
}