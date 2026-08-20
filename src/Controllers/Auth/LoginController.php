<?php

namespace Controllers\Auth;

use Controllers\BaseController;
use Twig;

/**
 * The class LoginController represents a controller component that handles the login of users.
 */
final class LoginController extends BaseController {

    /**
     * Default constructor of the class LoginController.
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
        echo $this->twig->render('pages/login.twig');
    }
}

?>