<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Title;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use OSW3\Blog\Trait\Entity\Properties\Title\TitleMethodsTrait;
use OSW3\Blog\Trait\Entity\Properties\Title\TitleAttributesTrait;

trait TitleTrait
{
    use TitleAttributesTrait;
    use TitleMethodsTrait;
    
    #[Groups(self::TITLE_SERIALIZER_GROUP)]
    #[ORM\Column(
        name: self::TITLE_ATTRIBUTE_NAME, 
        type: self::TITLE_ATTRIBUTE_TYPE, 
        length: self::TITLE_ATTRIBUTES['length'], 
        nullable: false
    )]
    private ?string $title = null;
}