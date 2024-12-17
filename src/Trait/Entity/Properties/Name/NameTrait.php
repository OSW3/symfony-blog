<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Name;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use OSW3\Blog\Trait\Entity\Properties\Name\NameMethodsTrait;
use OSW3\Blog\Trait\Entity\Properties\Name\NameAttributesTrait;

trait NameTrait
{
    use NameAttributesTrait;
    use NameMethodsTrait;
    
    #[Groups(self::NAME_SERIALIZER_GROUP)]
    #[ORM\Column(
        name: self::NAME_ATTRIBUTE_NAME, 
        type: self::NAME_ATTRIBUTE_TYPE, 
        length: self::NAME_ATTRIBUTES['length'], 
        nullable: false
    )]
    private ?string $name = null;
}