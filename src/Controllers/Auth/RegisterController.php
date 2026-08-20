<?php

namespace Controllers\Auth;

use Controllers\BaseController;
use Twig;

/**
 * The class RegisterController represents a controller component that handles the register of users.
 */
final class RegisterController extends BaseController {

    /**
     * Default constructor of the class RegisterController.
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

?>