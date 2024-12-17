<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Slug;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Attribute\Groups;
use OSW3\Blog\Trait\Entity\Properties\Slug\SlugMethodsTrait;

trait SlugTrait
{
    use SlugAttributesTrait;
    use SlugMethodsTrait;
    
    #[Groups([self::SLUG_SERIALIZER_GROUP])]
    #[ORM\Column(
        name: self::SLUG_ATTRIBUTE_NAME, 
        type: self::SLUG_ATTRIBUTE_TYPE, 
        length: self::SLUG_ATTRIBUTES['length'], 
        nullable: false
    )]
    #[Gedmo\Slug(fields: self::SLUG_ATTRIBUTES['properties'])]
    private ?string $slug = null;
}