<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Color;

trait ColorMethodsTrait
{
    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }
    public function getColor(): string
    {
        return $this->color;
    }
}