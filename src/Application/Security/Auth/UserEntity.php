<?php 

namespace Application\Security\Auth;

use Ramsey\Uuid\UuidInterface;

/**
 * The class UserEntity represents a basic entity that contains information about
 * the logged user.
 */
final class UserEntity {

    /**
     * User's ID.
     * @var UuidInterface
     */
    private readonly UuidInterface $id;

    /**
     * User's name.
     * @var string
     */
    private readonly string $name;

    private readonly ?string $avatarUrl;

    /**
     * Default constructor of the class UserEntity.
     * @param UuidInterface $id User's ID.
     * @param string $name User's name.
     */
    public function __construct(UuidInterface $id, string $name, ?string $avatarUrl){
        $this->id = $id;
        $this->name = $name;
        $this->avatarUrl = $avatarUrl;
    }

    /**
     * Returns the user's ID.
     * @return UuidInterface
     */ 
    public function getId(): UuidInterface {
        return $this->id;
    }

    /**
     * Returns the user's name.
     * @return string
     */ 
    public function getName(): string {
        return $this->name;
    }

    /**
     * Get the value of avatarUrl
     */ 
    public function getAvatarUrl(): ?string {
        return $this->avatarUrl;
    }
}

?>