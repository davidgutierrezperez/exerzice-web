<?php

namespace Controllers\View;

use Api\ApiUrl;
use Application\Security\Auth\UserSession;
use Application\Security\Auth\UserSessionKey;
use Twig;

/**
 * Base rendering view controller component.
 */
class BaseViewController {
    
    /**
     * Twig environment to load Twig files.
     * @var Twig\Environment 
     */
    protected Twig\Environment $twig;

    /**
     * Default constructor of all controllers. Loads the
     * Twig environment
     * @param Twig\Environment $twig
     */
    public function __construct(Twig\Environment $twig){
        $this->twig = $twig;

        $this->twig->addGlobal(name: 'apiUrl', value: ApiUrl::url());
        $this->twig->addGlobal(name: 'browserApiUrl', value: ApiUrl::browserUrl());

        $userLoggedIn = UserSession::isLoggedIn();
        $this->twig->addGlobal(name: 'isLoggedIn', value: $userLoggedIn);

        if ($userLoggedIn){
            $userEntity = UserSession::requireEntity();

            $this->twig->addGlobal(name: UserSessionKey::NAME->value, value: $userEntity->getName());
            $this->twig->addGlobal(name: UserSessionKey::ID->value, value: $userEntity->getId());
            $this->twig->addGlobal(name: UserSessionKey::AVATAR_URL->value, value: $userEntity->getAvatarUrl());
        }
    }
}

