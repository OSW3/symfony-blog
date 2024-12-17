<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Color\Nullable;

use Doctrine\ORM\Mapping as ORM;
use OSW3\Blog\Trait\Entity\Properties\Color\ColorAttributesTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use OSW3\Blog\Trait\Entity\Properties\Color\ColorMethodsTrait;

trait ColorTrait
{
    use ColorAttributesTrait;
    use ColorMethodsTrait;

    #[Groups(self::COLOR_SERIALIZER_GROUP)]
    #[ORM\Column(
        name: self::COLOR_ATTRIBUTE_NAME, 
        type: self::COLOR_ATTRIBUTE_TYPE, 
        length: self::COLOR_ATTRIBUTE_LENGTH, 
        options: self::COLOR_ATTRIBUTE_OPTIONS,
        nullable: true
    )]
    private string $color;
}