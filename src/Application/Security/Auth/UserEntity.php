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

    /**
     * User's avatar URL.
     * @var ?string
     */
    private readonly ?string $avatarUrl;

    /**
     * User's verification status.
     * @var bool
     */
    private readonly bool $verified;

    /**
     * Default constructor of the class UserEntity.
     * @param UuidInterface $id User's ID.
     * @param string $name User's name.
     * @param ?string $avatarUrl User's avatar URL.
     * @param bool $verified User's verification status.
     */
    public function __construct(UuidInterface $id, string $name, ?string $avatarUrl, bool $verified){
        $this->id = $id;
        $this->name = $name;
        $this->avatarUrl = $avatarUrl;
        $this->verified = $verified;
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
     * Returns the user's avatar URL.
     * @return string|null
     */ 
    public function getAvatarUrl(): ?string {
        return $this->avatarUrl;
    }

    

    /**
     * Returns the user's verification status.
     * @return bool True if the user is verified and false if otherwise.
     */ 
    public function getVerified(): bool {
        return $this->verified;
    }
}

