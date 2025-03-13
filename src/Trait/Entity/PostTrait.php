<?php 
namespace OSW3\Blog\Trait\Entity;

use OSW3\Blog\Enum\State;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use OSW3\Blog\Trait\Entity\Properties\Id\UuidTrait;
use OSW3\Blog\Trait\Entity\Properties\Slug\SlugTrait;
use OSW3\Blog\Trait\Entity\Properties\Title\TitleTrait;

trait PostTrait 
{
    // ID's
    // --

    use UuidTrait;

    const SLUG_ATTRIBUTES = [
        'properties' => ['title'],
        'length' => 255
    ];
    use SlugTrait;


    // INFOS
    // --

    const TITLE_ATTRIBUTES = [
        'length' => 255
    ];
    use TitleTrait;

    #[ORM\Column(name: "`excerpt`", type: Types::STRING, length: 255, nullable: true)]
    private ?string $excerpt = null;

    #[ORM\Column(name: "`content`", type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(name: "`content_text`", type: Types::TEXT, nullable: true)]
    private ?string $contentText = null;


    // WORKFLOW
    // --

    #[ORM\Column(name: "`state`", type: Types::STRING, enumType: State::class, nullable: false, columnDefinition: "enum('draft','in_review','approved','scheduled','published','updated','archived','deleted','erased','rejected','flagged','pending_changes')")]
    private State $state = State::DRAFT;


    // BOOLEAN FLAGS
    // --

    #[ORM\Column(name: "`is_comment_allowed`", type: Types::BOOLEAN, nullable: false)]
    private ?bool $isCommentAllowed = true;


    // DATES
    // --

    #[ORM\Column(name: "`datetime_create`", type: Types::DATETIME_IMMUTABLE, nullable: false)]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\Column(name: "`datetime_update`", type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updateAt = null;

    #[ORM\Column(name: "`datetime_publish`", type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $publishAt = null;

    #[ORM\Column(name: "`reading_time`", type: Types::INTEGER, nullable: false)]
    private int $readingTime = 0;


    // COUNTERS
    // --

    #[ORM\Column(name: "`counter_open`", type: Types::INTEGER, nullable: false)]
    private int $openCounter = 0;

    #[ORM\Column(name: "`counter_read`", type: Types::INTEGER, nullable: false)]
    private int $readCounter = 0;

    #[ORM\Column(name: "`counter_upvote`", type: Types::INTEGER, nullable: false)]
    private int $upvoteCounter = 0;

    #[ORM\Column(name: "`counter_downvote`", type: Types::INTEGER, nullable: false)]
    private int $downvoteCounter = 0;

    #[ORM\Column(name: "`counter_words`", type: Types::INTEGER, nullable: false)]
    private int $wordsCounter = 0;

    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =



    // INFOS
    // --

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

    #[ORM\PrePersist]
    public function setContentText(): static
    {
        $this->contentText = strip_tags($this->content);

        // Set Words count
        preg_match_all('/\p{L}+/u', $this->contentText, $matches);
        $this->wordsCounter = count($matches[0]);

        // Ste reading time
        $wordsPerMinute = 200;
        $this->readingTime = ceil($this->wordsCounter / $wordsPerMinute);

        return $this;
    }
    public function getContentText(): ?string
    {
        return $this->contentText;
    }


    // WORKFLOW
    // --

    public function getState(): State
    {
        return $this->state;
    }
    public function setState(State $state): static
    {
        $this->state = $state;

        return $this;
    }


    // BOOLEAN FLAGS
    // --

    public function isCommentAllowed(): ?bool
    {
        return $this->isCommentAllowed;
    }
    public function setCommentAllowed(bool $isCommentAllowed): static
    {
        $this->isCommentAllowed = $isCommentAllowed;

        return $this;
    }


    // DATES
    // --

    #[ORM\PrePersist]
    public function setCreateAt(): static
    {
        $this->createAt = new \DateTimeImmutable;

        return $this;
    }
    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    #[ORM\PrePersist]
    public function setUpdateAt(): static
    {
        $this->updateAt = new \DateTime;

        return $this;
    }
    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setPublishAt(): static
    {
        $this->publishAt = new \DateTime;

        return $this;
    }
    public function getPublishAt(): ?\DateTimeInterface
    {
        return $this->publishAt;
    }

    public function getReadingTime(): int
    {
        return $this->readingTime;
    }


    // COUNTERS
    // --

    public function getOpenCounter(): int
    {
        return $this->openCounter;
    }
    public function incrementOpenCounter(): static
    {
        $this->openCounter++;

        return $this;
    }

    public function getReadCounter(): int
    {
        return $this->readCounter;
    }
    public function incrementReadCounter(): static
    {
        $this->readCounter++;

        return $this;
    }

    public function getUpvoteCounter(): int
    {
        return $this->upvoteCounter;
    }
    public function setUpvoteCounter(int $upvoteCounter): static
    {
        $this->upvoteCounter = $upvoteCounter;

        return $this;
    }

    public function getDownvoteCounter(): int
    {
        return $this->downvoteCounter;
    }
    public function setDownvoteCounter(int $downvoteCounter): static
    {
        $this->downvoteCounter = $downvoteCounter;

        return $this;
    }

    public function getWordsCounter(): int
    {
        return $this->wordsCounter;
    }
}