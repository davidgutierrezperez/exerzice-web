<?php

namespace Controllers\View\Auth;

use Controllers\View\BaseViewController;
use Twig;

/**
 * The class RegisterViewController represents a controller component that handles the register of users.
 */
final class RegisterViewController extends BaseViewController {

    /**
     * Default constructor of the class RegisterViewController.
     * @param Twig\Environment $twig Twig environment.
     */
    public function __construct(Twig\Environment $twig) {
        parent::__construct($twig);
    }

    /**
     * Renders the register page.
     * @return void
     */
    public function index(): void {
        echo $this->twig->render('pages/auth/register.twig');
    }
}

