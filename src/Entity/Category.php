<?php
namespace OSW3\Blog\Entity;

use OSW3\Blog\Entity\Post;
use Doctrine\ORM\Mapping as ORM;
use OSW3\Blog\Trait\Entity\CategoryTrait;
use Doctrine\Common\Collections\Collection;
use OSW3\Blog\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\Table(name: 'blog_category')]
class Category
{
    use CategoryTrait;


    // RELATIONS
    // --

    // OneToMany

    /**
     * @var Collection<int, Post>
     */
    #[ORM\OneToMany(targetEntity: Post::class, mappedBy: 'category')]
    private Collection $posts;

    
    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }
    public function addQuestion(Post $question): static
    {
        if (!$this->posts->contains($question)) {
            $this->posts->add($question);
            $question->setCategory($this);
        }

        return $this;
    }
    public function removeQuestion(Post $question): static
    {
        if ($this->posts->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getCategory() === $this) {
                $question->setCategory(null);
            }
        }

        return $this;
    }
}
