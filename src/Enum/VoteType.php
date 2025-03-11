<?php
namespace OSW3\Blog\Enum;

use OSW3\Blog\Trait\Enum\EnumTrait;

enum VoteType: int
{
    use EnumTrait;
    
    /**
     * Positive vote
     * 
     * @var int
     */
    case UPVOTE = 1;

    /**
     * Negative vote
     * 
     * @var int
     */
    case DOWNVOTE = -1;
}
