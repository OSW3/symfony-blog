<?php
namespace OSW3\Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use OSW3\Blog\Trait\Entity\VoteTrait;
use OSW3\Blog\Repository\VoteRepository;

#[ORM\Entity(repositoryClass: VoteRepository::class)]
#[ORM\HasLifecycleCallbacks()]
#[ORM\Table(name: 'blog_vote')]
class Vote
{
    use VoteTrait;

    #[ORM\ManyToOne(inversedBy: 'votes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $post = null;


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function getPost(): ?Post
    {
        return $this->post;
    }
    public function setPost(?Post $post): static
    {
        $this->post = $post;

        return $this;
    }
}
