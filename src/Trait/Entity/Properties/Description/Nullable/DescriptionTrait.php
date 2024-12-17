<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Description\Nullable;

use Doctrine\ORM\Mapping as ORM;
use OSW3\Blog\Trait\Entity\Properties\Description\DescriptionAttributesTrait;
use OSW3\Blog\Trait\Entity\Properties\Description\DescriptionMethodsTrait;
use Symfony\Component\Serializer\Annotation\Groups;

trait DescriptionTrait
{
    use DescriptionAttributesTrait;
    use DescriptionMethodsTrait;

    #[Groups(self::DESCRIPTION_SERIALIZER_GROUP)]
    #[ORM\Column(
        name: self::DESCRIPTION_ATTRIBUTE_NAME, 
        type: self::DESCRIPTION_ATTRIBUTE_TYPE, 
        nullable: true
    )]
    private ?string $description = null;
}