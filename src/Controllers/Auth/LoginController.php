<?php

namespace Controllers\Auth;

use Api\Fetching\LoginFetcher;
use Application\Security\Auth\UserEntity;
use Application\Security\Auth\UserSession;
use Controllers\BaseController;
use Infrastructure\Http\HttpCode;
use Infrastructure\Http\HttpRequest;
use Infrastructure\Http\RouteRedirector;
use Infrastructure\Resolver\Auth\LoginResponseResolver;
use Ramsey\Uuid\Uuid;
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
        $statusCode = $response->getCode();

        if ($statusCode == HttpCode::BAD_REQUEST)
            RouteRedirector::redirect('/login');

        $responseData = $response->getValue();
        $responseResolve = new LoginResponseResolver()->resolve($responseData);

        if (!$responseResolve->isSuccess())
            RouteRedirector::redirect('/login');

        $userEntity = $responseResolve->value();
        UserSession::login($userEntity);

        RouteRedirector::redirect('/');
    }  
}

