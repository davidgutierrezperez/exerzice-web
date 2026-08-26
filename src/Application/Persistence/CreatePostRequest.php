<?php 

namespace Application\Persistence;

/**
 * The class CreatePostRequest represents a request to create a new post.
 */
final class CreatePostRequest {

    /**
     * Content of the post.
     * @var string
     */
    private readonly string $content;

    /**
     * Default constructor of the class CreatePostRequest.
     * @param string $content
     */
    public function __construct(string $content){
        $this->content = $content;
    }

    /**
     * Returns the content of the post.
     * @return string Content of the post.
     */ 
    public function getContent(): string {
        return $this->content;
    }
}