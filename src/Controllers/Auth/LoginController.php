<?php

namespace Controllers\Auth;

use Api\Fetching\LoginFetcher;
use Controllers\BaseController;
use Infrastructure\Http\HttpCode;
use Infrastructure\Http\HttpRequest;
use Twig;

/**
 * The class LoginController represents a controller component that handles the login of users.
 */
final class LoginController extends BaseController {

    private readonly LoginFetcher $fetcher;

    /**
     * Default constructor of the class LoginController.
     * @param Twig\Environment $twig Twig environment.
     */
    public function __construct(Twig\Environment $twig) {
        parent::__construct($twig);

        $this->fetcher = new LoginFetcher();
    }

    /**
     * Renders the login page.
     * @return void
     */
    public function index(): void {
        echo $this->twig->render('pages/auth/login.twig');
    }

    public function login(): void {
        $httpRequest = new HttpRequest();

        $authToken = $httpRequest->input('credential');
        $response = $this->fetcher->fetchLogin($authToken);

        $value = $response->getValue();

        error_log("VALUE OF RESPONSE: " . print_r($value, true));

        if ($response->getCode() == HttpCode::SUCCESS){
            error_log("EXITO");
        } else error_log("FRACASO");
    }  
}

?>