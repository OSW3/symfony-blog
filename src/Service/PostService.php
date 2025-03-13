<?php 
namespace OSW3\Blog\Service;

use OSW3\Blog\Entity\Post;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use OSW3\Blog\DependencyInjection\Configuration;
use OSW3\Blog\Entity\Vote;
use OSW3\Blog\Enum\State;
use OSW3\Blog\Enum\VoteType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PostService 
{
    private array $params;
    private EntityRepository $repository;
    private Request $request;

    private array $criteria;
    
    public function __construct(
        #[Autowire(service: 'service_container')] 
        private ContainerInterface $container,
        private EntityManagerInterface $entityManager,
        private RequestStack $requestStack,
    ){
        $this->params     = $container->getParameter(Configuration::NAME);
        $this->repository = $this->entityManager->getRepository(Post::class);
        $this->request    = $requestStack->getCurrentRequest();

        $this->criteria = [
            'state' => State::PUBLISHED
        ];
    }

    public function count(): int {
        $posts = $this->repository->findBy($this->criteria);
        return count($posts);
    }

    public function getAll(): array {
        return $this->repository->findBy($this->criteria);
    }

    public function getPaged(): array {
        $criteria = $this->criteria;
        $orderBy  = null;
        $page     = $this->request->query->get('page') ?? 1;
        $limit    = $this->params['posts']['index']['per_page'];
        $offset   = ($limit * $page) - $limit;

        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function getPages(): int {
        $posts = $this->repository->findBy($this->criteria);
        $total = count($posts);
        $limit = $this->params['posts']['index']['per_page'];
        return (int) ceil($total/$limit);
    }

    public function updateOpenCounter(Post $post): void {
        $session = $this->requestStack->getSession();

        if (!$session->has('viewed_posts')) {
            $session->set('viewed_posts', []);
        }

        $viewedPosts = $session->get('viewed_posts');

        if (!in_array($post->getId()->toString(), $viewedPosts, true)) {
            $post->incrementOpenCounter();
            $this->entityManager->persist($post);
            $this->entityManager->flush();

            $viewedPosts[] = $post->getId()->toString();
            $session->set('viewed_posts', $viewedPosts);
        }
    }

    public function updateReadCounter(Post $post): void {
        $session = $this->requestStack->getSession();

        // readied 
        if (!$session->has('read_posts')) {
            $session->set('read_posts', []);
        }

        $viewedPosts = $session->get('read_posts');

        if (!in_array($post->getId()->toString(), $viewedPosts, true)) {
            $post->incrementReadCounter();
            $this->entityManager->persist($post);
            $this->entityManager->flush();

            $viewedPosts[] = $post->getId()->toString();
            $session->set('read_posts', $viewedPosts);
        }
    }

    public function addVote(Post $post, $vote): array {

        $session = $this->requestStack->getSession();

        // readied 
        if (!$session->has('voted_posts')) {
            $session->set('voted_posts', []);
        }

        $votedPosts = $session->get('voted_posts');

        if (!in_array($post->getId()->toString(), $votedPosts, true)) {
            $entity = new Vote;
            $entity->setPost($post);
            $entity->setVote($vote === 'downvote' ? VoteType::DOWNVOTE : VoteType::UPVOTE);
            $this->entityManager->persist($entity);
            $this->entityManager->flush();

            $votedPosts[] = $post->getId()->toString();
            $session->set('voted_posts', $votedPosts);
        }


        $upVotes   = 0;
        $downVotes = 0;

        foreach ($post->getVotes() as $v) {
            switch ($v->getVote()) {
                case VoteType::UPVOTE: $upVotes++; break;
                case VoteType::DOWNVOTE: $downVotes++; break;
            }
        }

        return [
            'upVotes'   => $upVotes,
            'downVotes' => $downVotes,
        ];
    }
}