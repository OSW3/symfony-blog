<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Description;

trait DescriptionMethodsTrait
{
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
}