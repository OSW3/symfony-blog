<?php
namespace OSW3\Blog\Entity;

use OSW3\Blog\Entity\Tag;
use OSW3\Blog\Entity\Vote;
use OSW3\Blog\Entity\Category;
use Doctrine\ORM\Mapping as ORM;
use OSW3\Blog\Trait\Entity\PostTrait;
use OSW3\Blog\Repository\PostRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\HasLifecycleCallbacks()]
#[ORM\Table(name: 'blog_post')]
class Post
{
    use PostTrait;

    // RELATIONSHIP
    // --

    // ManyToOne

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children')]
    private ?self $parent = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    private ?Category $category = null;

    #[ORM\ManyToOne]
    private ?Media $illustration = null;


    // OneToMany

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
    private Collection $children;

    /**
     * @var Collection<int, Vote>
     */
    #[ORM\OneToMany(targetEntity: Vote::class, mappedBy: 'post', orphanRemoval: true)]
    private Collection $votes;


    // ManyToMany

    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: 'posts')]
    private Collection $tags;


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->votes = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }


    // RELATIONSHIP
    // --

    public function getParent(): ?self
    {
        return $this->parent;
    }
    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }
    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getIllustration(): ?Media
    {
        return $this->illustration;
    }

    public function setIllustration(?Media $illustration): static
    {
        $this->illustration = $illustration;

        return $this;
    }


    /**
     * @return Collection<int, self>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }
    public function addChild(self $child): static
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
            $child->setParent($this);
        }

        return $this;
    }
    public function removeChild(self $child): static
    {
        if ($this->children->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }
    public function addVote(Vote $vote): static
    {
        if (!$this->votes->contains($vote)) {
            $this->votes->add($vote);
            $vote->setPost($this);
        }

        return $this;
    }
    public function removeVote(Vote $vote): static
    {
        if ($this->votes->removeElement($vote)) {
            // set the owning side to null (unless already changed)
            if ($vote->getPost() === $this) {
                $vote->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }
    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addQuestion($this);
        }

        return $this;
    }
    public function removeTag(Tag $tag): static
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeQuestion($this);
        }

        return $this;
    }
}
