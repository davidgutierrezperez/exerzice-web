<?php 

namespace Application\Security\Auth;

use Infrastructure\Session\SessionManager;
use Ramsey\Uuid\Uuid;
use Application\Security\Auth\UserSessionKey;

final class UserSession {
    public static function requireEntity(): ?UserEntity {
        if (!SessionManager::isActive()) SessionManager::start();

        $userId = SessionManager::get('userId');
        $userName = SessionManager::get('userName');

        if (!$userId || !$userName)
            return null;

        $normalizedUserId = Uuid::fromString($userId);
        return new UserEntity($normalizedUserId, $userName);
    }

    public static function login(UserEntity $entity){
        if (!SessionManager::isActive()) 
            SessionManager::start();

        SessionManager::set(UserSessionKey::ID->value, $entity->getId()->toString());
        SessionManager::set(UserSessionKey::NAME->value, $entity->getName());
    }

    public static function logout(): void {
        SessionManager::end();
    }

    public static function isLoggedIn(): bool {
        return self::requireEntity() != null;
    }

}

?>