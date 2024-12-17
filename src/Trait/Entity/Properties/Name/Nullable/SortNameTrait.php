<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Name\Nullable;

use Doctrine\ORM\Mapping as ORM;
use OSW3\Blog\Trait\Entity\Properties\Name\SortNameMethodsTrait;
use OSW3\Blog\Trait\Entity\Properties\Name\SortNameAttributesTrait;

trait SortNameTrait
{
    use SortNameAttributesTrait;
    use SortNameMethodsTrait;

    #[ORM\Column(
        name: self::SORT_NAME_ATTRIBUTE_NAME, 
        type: self::SORT_NAME_ATTRIBUTE_TYPE, 
        length: self::NAME_ATTRIBUTES['length'], 
        nullable: true
    )]
    private ?string $sortName = null;

}