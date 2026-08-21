<?php

namespace Controllers;

use Application\Security\Auth\UserSession;
use Application\Security\Auth\UserSessionKey;
use Twig;

class BaseController {
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

        $userLoggedIn = UserSession::isLoggedIn();
        $this->twig->addGlobal(name: 'isLoggedIn', value: $userLoggedIn);

        if ($userLoggedIn){
            $userEntity = UserSession::requireEntity();
            $this->twig->addGlobal(name: UserSessionKey::NAME->value, value: $userEntity->getName());
        }
    }
}

