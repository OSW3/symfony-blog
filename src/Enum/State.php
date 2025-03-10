<?php 
namespace OSW3\Blog\Enum;

use OSW3\Blog\Trait\Enum\EnumTrait;

enum State: string 
{
    use EnumTrait;

    /**
     * Default state, the post is being written
     * 
     * @var string
     */
    case DRAFT           = 'draft';
    
    /**
     * Awaiting review before approval
     * 
     * @var string
     */
    case IN_REVIEW       = 'in_review';
    
    /**
     * Approved but not yet published
     * 
     * @var string
     */
    case APPROVED        = 'approved';
    
    /**
     * Scheduled for future publication
     * 
     * @var string
     */
    case SCHEDULED       = 'scheduled';
    
    /**
     * Published and publicly visible
     * 
     * @var string
     */
    case PUBLISHED       = 'published';
    
    /**
     * Published but recently modified
     * 
     * @var string
     */
    case UPDATED         = 'updated';
    
    /**
     * Removed from publication but kept for reference
     * 
     * @var string
     */
    case ARCHIVED        = 'archived';
    
    /**
     * Soft deleted, can be restored
     * 
     * @var string
     */
    case DELETED         = 'deleted';
    
    /**
     * Permanently deleted, cannot be recovered
     * 
     * @var string
     */
    case ERASED          = 'erased';
    
    /**
     * Rejected after review
     * 
     * @var string
     */
    case REJECTED        = 'rejected';
    
    /**
     * Reported for moderation
     * 
     * @var string
     */
    case FLAGGED         = 'flagged';
    
    /**
     * Needs modifications before approval
     * 
     * @var string
     */
    case PENDING_CHANGES = 'pending_changes';
}