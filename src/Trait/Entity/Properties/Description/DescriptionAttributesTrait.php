<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Description;

use Doctrine\DBAL\Types\Types;

trait DescriptionAttributesTrait
{
    const DESCRIPTION_SERIALIZER_GROUP = "description";
    const DESCRIPTION_ATTRIBUTE_NAME   = "description";
    const DESCRIPTION_ATTRIBUTE_TYPE   = Types::TEXT;
}