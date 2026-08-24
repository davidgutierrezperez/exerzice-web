<?php 

namespace Controllers\Action\Auth;

use Api\Fetching\RegisterFetcher;
use Application\Mapper\Auth\RegisterRequestMapper;
use Infrastructure\Http\HttpRequest;
use Infrastructure\Http\RouteRedirector;
use Infrastructure\Resolver\Auth\RegisterResolverError;
use Infrastructure\Resolver\Auth\RegisterResponseResolver;
use Infrastructure\Resolver\ResolveResult;

final class RegisterController {

    private readonly RegisterFetcher $fetcher;

    public function __construct(){
        $this->fetcher = new RegisterFetcher();
    }

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

    private function handleUnsuccesfulRegister(ResolveResult $registerResult): void {
        $errors = $registerResult->getErrors();
        if (!$errors) return;

        if (in_array(RegisterResolverError::USER_ALREADY_REGISTERED, $errors, true))
            RouteRedirector::redirect('/login');
    }
}