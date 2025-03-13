<?php 
namespace OSW3\Blog\Twig\Runtime;

use Twig\Environment;
use OSW3\Blog\Entity\Post;
use OSW3\Blog\Enum\VoteType;
use OSW3\Blog\Service\BlogService;
use Twig\Extension\RuntimeExtensionInterface;

class BlogExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private BlogService $blogService,
        private Environment $environment
    ){}

    public function vote(Post $post)
    {
        $id        = $post->getId()->toString();
        $upVotes   = 0;
        $downVotes = 0;

        foreach ($post->getVotes() as $vote) {
            switch ($vote->getVote()) {
                case VoteType::UPVOTE: $upVotes++; break;
                case VoteType::DOWNVOTE: $downVotes++; break;
            }
        }

        return $this->environment->render("@Blog/vote.html.twig", [
            'id'        => $id,
            'upVotes'   => $upVotes,
            'downVotes' => $downVotes,
        ]);
    }

    public function read(Post $post)
    {
        return $this->environment->render("@Blog/read.html.twig", [
            'id' => $post->getId()->toString(),
        ]);
    }
}