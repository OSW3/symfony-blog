<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Name;

trait NameMethodsTrait
{
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
}