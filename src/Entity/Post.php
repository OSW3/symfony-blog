<?php

namespace OSW3\Blog\Entity;

use OSW3\Blog\Enum\State;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use OSW3\Blog\Repository\PostRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use OSW3\Blog\Trait\Entity\Properties\Id\UuidTrait;
use OSW3\Blog\Trait\Entity\Properties\Slug\SlugTrait;
use OSW3\Blog\Trait\Entity\Properties\Title\TitleTrait;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\Table(name: 'blog_post')]
class Post
{
    use UuidTrait;
    use TitleTrait;
    use SlugTrait;

    const SLUG_ATTRIBUTES = [
        'properties' => ['title'],
        'length' => 255
    ];

    const TITLE_ATTRIBUTES = [
        'length' => 255
    ];

    #[ORM\Column(name: 'excerpt', type: Types::STRING, length: 255, nullable: true)]
    private ?string $excerpt = null;

    #[ORM\Column(name: 'content', type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(name: "state", type: Types::STRING, enumType: State::class, nullable: false, columnDefinition: "enum('draft')")]
    private ?string $state = null;

    #[ORM\Column(name: "is_comment_allowed", type: Types::BOOLEAN, nullable: false)]
    private ?bool $isCommentAllowed = true;

    #[ORM\Column(name: "counter_read", type: Types::INTEGER, nullable: false)]
    private int $readCounter = 0;

    #[ORM\Column(name: "counter_like", type: Types::INTEGER, nullable: false)]
    private int $likeCounter = 0;

    #[ORM\Column(name: "counter_dislike", type: Types::INTEGER, nullable: false)]
    private int $dislikeCounter = 0;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children')]
    private ?self $parent = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
    private Collection $children;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }




    public function getExcerpt(): ?string
    {
        return $this->excerpt;
    }

    public function setExcerpt(?string $excerpt): static
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function isCommentAllowed(): ?bool
    {
        return $this->isCommentAllowed;
    }

    public function setCommentAllowed(bool $isCommentAllowed): static
    {
        $this->isCommentAllowed = $isCommentAllowed;

        return $this;
    }

    public function getReadCounter(): int
    {
        return $this->readCounter;
    }

    public function setReadCounter(int $readCounter): static
    {
        $this->readCounter = $readCounter;

        return $this;
    }

    public function getLikeCounter(): int
    {
        return $this->likeCounter;
    }
    public function setLikeCounter(int $likeCounter): static
    {
        $this->likeCounter = $likeCounter;

        return $this;
    }

    public function getDislikeCounter(): int
    {
        return $this->dislikeCounter;
    }
    public function setDislikeCounter(int $dislikeCounter): static
    {
        $this->dislikeCounter = $dislikeCounter;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

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
}
