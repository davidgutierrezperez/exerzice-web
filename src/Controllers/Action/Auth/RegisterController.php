<?php 

namespace Controllers\Action\Auth;

use Api\Fetching\RegisterFetcher;
use Application\Mapper\Auth\RegisterRequestMapper;
use Infrastructure\Http\HttpRequest;
use Infrastructure\Http\RouteRedirector;
use Infrastructure\Resolver\Auth\RegisterResolverError;
use Infrastructure\Resolver\Auth\RegisterResponseResolver;
use Infrastructure\Resolver\ResolveResult;

/**
 * The class RegisterController represents a action controller for registering new users.
 */
final class RegisterController {

    /**
     * API fetcher component for registering users.
     * @var RegisterFetcher
     */
    private readonly RegisterFetcher $fetcher;

    /**
     * Default constructor of the class RegisterController.
     */
    public function __construct(){
        $this->fetcher = new RegisterFetcher();
    }

    /**
     * Registers a new user.
     * @return void
     */
    public function register(): void {
        $httpRequest = new HttpRequest();
        $registerRequest = new RegisterRequestMapper()->map($httpRequest);

        $response = $this->fetcher->register($registerRequest);
        $responseResolve = new RegisterResponseResolver()->resolve($response);

        if (!$responseResolve->isSuccess())
            $this->handleUnsuccesfulRegister($responseResolve);

        $authToken = $registerRequest->getAuthToken();
        new LoginController()->loginWithCredential($authToken);
    }

    /**
     * Handles a unsuccesful registering process.
     * @param ResolveResult $registerResult Result of the response resolving process.
     * @return void
     */
    private function handleUnsuccesfulRegister(ResolveResult $registerResult): void {
        $errors = $registerResult->getErrors();
        if (!$errors) return;

        if (in_array(RegisterResolverError::USER_ALREADY_REGISTERED, $errors, true))
            RouteRedirector::redirect('/login');
    }
}