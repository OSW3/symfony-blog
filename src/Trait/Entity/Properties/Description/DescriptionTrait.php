<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Description;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use OSW3\Blog\Trait\Entity\Properties\Description\DescriptionMethodsTrait;

trait DescriptionTrait
{
    use DescriptionAttributesTrait;
    use DescriptionMethodsTrait;
    
    #[Groups(self::DESCRIPTION_SERIALIZER_GROUP)]
    #[ORM\Column(
        name: self::DESCRIPTION_ATTRIBUTE_NAME, 
        type: self::DESCRIPTION_ATTRIBUTE_TYPE, 
        nullable: false
    )]
    private string $description;
}