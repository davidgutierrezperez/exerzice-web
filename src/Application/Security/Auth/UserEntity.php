<?php 

namespace Application\Security\Auth;

use Ramsey\Uuid\UuidInterface;

final class UserEntity {

    private readonly UuidInterface $id;
    private readonly string $name;

    public function __construct(UuidInterface $id, string $name){
        $this->id = $id;
        $this->name = $name;
    }

    

    /**
     * Get the value of id
     */ 
    public function getId(): UuidInterface {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName(): string {
        return $this->name;
    }
}

?>