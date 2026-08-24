<?php 

namespace Application\Persistence\Auth;

/**
 * The class RegisterRequest represents a request to register a new user.
 */
final class RegisterRequest {

    /**
     * User's authentication token.
     * @var 
     */
    private readonly ?string $authToken;

    /**
     * User's location.
     * @var 
     */
    private readonly ?string $location;

    /**
     * Default constructor of the class RegisterRequest.
     * @param mixed $authToken User's authentication token.
     * @param mixed $location User's location.
     */
    public function __construct(?string $authToken, ?string $location){
        $this->authToken = $authToken;
        $this->location = $location;
    }

    /**
     * Returns the user's authentication token.
     * @return string|null
     */ 
    public function getAuthToken(): ?string {
        return $this->authToken;
    }

    /**
     * Returns the user's location.
     * @return string|null
     */ 
    public function getLocation(): ?string {
        return $this->location;
    }
}

?>