<?php
namespace OSW3\Blog\Entity;

use OSW3\Blog\Entity\Post;
use Doctrine\ORM\Mapping as ORM;
use OSW3\Blog\Trait\Entity\TagTrait;
use OSW3\Blog\Repository\TagRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: TagRepository::class)]
#[ORM\Table(name: 'blog_tag')]
class Tag
{
    use TagTrait;


    // RELATIONS
    // --

    // ManyToMany

    /**
     * @var Collection<int, Post>
     */
    #[ORM\ManyToMany(targetEntity: Post::class, inversedBy: 'tags')]
    #[ORM\JoinTable(name: "blog_posts_tags_relations")]
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
        }

        return $this;
    }

    public function removeQuestion(Post $question): static
    {
        $this->posts->removeElement($question);

        return $this;
    }
}
