<?php

namespace Controllers\View\Auth;

use Controllers\View\BaseViewController;
use Twig;

/**
 * The class LoginViewController represents a controller component that handles the login VIEW of users.
 */
final class LoginViewController extends BaseViewController {

    /**
     * Default constructor of the class LoginViewController.
     * @param Twig\Environment $twig Twig environment.
     */
    public function __construct(Twig\Environment $twig) {
        parent::__construct($twig);
    }

    /**
     * Renders the login page.
     * @return void
     */
    public function index(): void {
        echo $this->twig->render('pages/auth/login.twig');
    }
}

