<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Name;

use Doctrine\ORM\Mapping as ORM;

trait SortNameTrait
{
    use SortNameAttributesTrait;
    use SortNameMethodsTrait;

    #[ORM\Column(
        name: self::SORT_NAME_ATTRIBUTE_NAME, 
        type: self::SORT_NAME_ATTRIBUTE_TYPE, 
        length: self::NAME_ATTRIBUTES['length'], 
        nullable: false
    )]
    private ?string $sortName = null;

}