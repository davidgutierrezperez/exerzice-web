<?php

namespace Controllers\Auth;

use Api\Fetching\LoginFetcher;
use Application\Security\Auth\UserEntity;
use Application\Security\Auth\UserSession;
use Controllers\BaseController;
use Infrastructure\Http\HttpCode;
use Infrastructure\Http\HttpRequest;
use Infrastructure\Http\RouteRedirector;
use Infrastructure\Resolver\Auth\LoginResolverError;
use Infrastructure\Resolver\Auth\LoginResponseResolver;
use Infrastructure\Resolver\Auth\LogoutResponseResolver;
use Infrastructure\Resolver\ResolveResult;
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

    /**
     * Handles the logging of a registered user.
     * @return void
     */
    public function login(): void {
        $httpRequest = new HttpRequest();
        $authToken = $httpRequest->input('credential');

        $response = $this->fetcher->login($authToken);
        $responseResolve = new LoginResponseResolver()->resolve($response);

        if (!$responseResolve->isSuccess())
            $this->handleUnsuccessfulLogin($responseResolve);

        $userEntity = $responseResolve->value();
        UserSession::login($userEntity);

        RouteRedirector::redirect('/');
    }  

    /**
     * Logs out the user.
     * @return void
     */
    public function logout(): void {
        $this->fetcher->logout();
        UserSession::logout();

        RouteRedirector::redirect('/');
    }

    /**
     * Handles an unsuccessful logging process.
     * @param ResolveResult $result Result of a HTTP response data resolving process.
     * @return void
     */
    private function handleUnsuccessfulLogin(ResolveResult $result): void {
        $errors = $result->getErrors();
        if (!$errors) return;

        if (in_array(LoginResolverError::USER_NO_REGISTERED, $errors, true))
            RouteRedirector::redirect('/404');

        if (in_array(LoginResolverError::USER_ALREADY_LOGGED_IN, $errors, true))
            RouteRedirector::redirect('/');

        RouteRedirector::redirect('/login');
    }
}

