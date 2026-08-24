<?php 

namespace Controllers\Action\Auth;

use Api\Fetching\LoginFetcher;
use Application\Security\Auth\UserSession;
use Infrastructure\Http\HttpRequest;
use Infrastructure\Http\RouteRedirector;
use Infrastructure\Resolver\Auth\LoginResolverError;
use Infrastructure\Resolver\Auth\LoginResponseResolver;
use Infrastructure\Resolver\ResolveResult;

/**
 * The class LoginViewController represents a controller component that handles the login of users.
 */
final class LoginController {

    /**
     * API fetcher component for logging users. 
     * @var LoginFetcher
     */
    private readonly LoginFetcher $fetcher;

    /**
     * Default constructor of the class LoginController.
     */
    public function __construct(){
        $this->fetcher = new LoginFetcher();
    }

    /**
     * Handles the logging of a user.
     * @return void
     */
    public function login(): void {
        $httpRequest = new HttpRequest();
        $authToken = $httpRequest->input('credential');

        $this->loginWithCredential($authToken);
    }

    /**
     * Handles the login of a user with a certain authentication token.
     * @param string $authToken User's authentication token.
     * @return void
     */
    public function loginWithCredential(string $authToken): void {
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