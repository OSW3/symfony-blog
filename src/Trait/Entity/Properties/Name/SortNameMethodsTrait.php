<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Name;

trait SortNameMethodsTrait
{
    public function setSortName(string $sortName): static
    {
        $this->sortName = empty($sortName) ? $this->name : $sortName;

        return $this;
    }
    public function getSortName(): ?string
    {
        return $this->sortName;
    }
}