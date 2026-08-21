<?php 

namespace Application\Security\Auth;

use Infrastructure\Session\SessionManager;
use Ramsey\Uuid\Uuid;
use Application\Security\Auth\UserSessionKey;

/**
 * The class UserSession represents a session of a logged user.
 */
final class UserSession {

    /**
     * Requires the information about the logged user.
     * @return UserEntity|null User entity object.
     */
    public static function requireEntity(): ?UserEntity {
        if (!SessionManager::isActive()) SessionManager::start();

        $userId = SessionManager::get('userId');
        $userName = SessionManager::get('userName');

        if (!$userId || !$userName)
            return null;

        $normalizedUserId = Uuid::fromString($userId);
        return new UserEntity($normalizedUserId, $userName);
    }

    /**
     * Logs the user in.
     * @param UserEntity $entity User's data.
     * @return void
     */
    public static function login(UserEntity $entity): void {
        if (!SessionManager::isActive()) 
            SessionManager::start();

        SessionManager::set(UserSessionKey::ID->value, $entity->getId()->toString());
        SessionManager::set(UserSessionKey::NAME->value, $entity->getName());
    }

    /**
     * Logges the user out.
     * @return void
     */
    public static function logout(): void {
        SessionManager::end();
    }

    /**
     * Checks if the user is logged in.
     * @return bool True if the user is logged in and false if otherwise.
     */
    public static function isLoggedIn(): bool {
        return self::requireEntity() != null;
    }

}

?>