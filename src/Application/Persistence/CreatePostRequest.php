<?php 

namespace Application\Persistence;

use Ramsey\Uuid\UuidInterface;

final class CreatePostRequest {
    private readonly string $content;

    public function __construct(string $content){
        $this->content = $content;
    }

    /**
     * Get the value of content
     */ 
    public function getContent(): string {
        return $this->content;
    }
}