<?php 
namespace OSW3\Blog\Trait\Entity;

use OSW3\Blog\Enum\VoteType;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait VoteTrait 
{
    // ID's
    // --

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    // INFOS
    // --

    /**
     * Like or dislike
     * 
     * @var VoteType
     */
    #[ORM\Column(name: "`vote`", type: Types::SMALLINT, nullable: false, enumType: VoteType::class)]
    private ?VoteType $vote = null;


    // DATES
    // --

    /**
     * The creation datetime
     * 
     * @var \DateTimeImmutable
     */
    #[ORM\Column(name: "`datetime_create`", type: Types::DATETIME_IMMUTABLE, nullable: false)]
    private ?\DateTimeImmutable $createAt = null;


    
    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setVote(VoteType $vote): static
    {
        $this->vote = $vote;

        return $this;
    }
    public function getVote(): ?VoteType
    {
        return $this->vote;
    }

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
}