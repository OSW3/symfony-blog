<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Color;

use Doctrine\DBAL\Types\Types;
trait ColorAttributesTrait
{
    const COLOR_SERIALIZER_GROUP  = "color";
    const COLOR_ATTRIBUTE_NAME    = "color";
    const COLOR_ATTRIBUTE_TYPE    = Types::STRING;
    const COLOR_ATTRIBUTE_LENGTH  = 7;
    const COLOR_ATTRIBUTE_OPTIONS = ['fixed' => true];
}