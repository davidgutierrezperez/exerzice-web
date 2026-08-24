<?php 

namespace Application\Persistence\Auth;

final class RegisterRequest {
    private readonly ?string $authToken;
    private readonly ?string $location;

    public function __construct(?string $authToken, ?string $location){
        $this->authToken = $authToken;
        $this->location = $location;
    }

    

    /**
     * Get the value of authToken
     */ 
    public function getAuthToken(): ?string {
        return $this->authToken;
    }

    /**
     * Get the value of location
     */ 
    public function getLocation(): ?string {
        return $this->location;
    }
}

?>