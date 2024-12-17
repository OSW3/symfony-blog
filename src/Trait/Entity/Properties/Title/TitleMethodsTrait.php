<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Title;

trait TitleMethodsTrait
{
    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }
    public function getTitle(): ?string
    {
        return $this->title;
    }
}