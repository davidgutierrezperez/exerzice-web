<?php 

namespace Application\Middleware;

use Application\Security\EmptyRequestException;
use Infrastructure\Http\HttpRequest;
use Override;

/**
 * The class RequestBodyMiddleware represents a specific middleware component to check
 * if the body of a HTTP request is empty.
 */
final class RequestBodyMiddleware implements Middleware {
    
    #[Override]
    /**
     * Checks if the body of a HTTP request is empty.
     * @throws EmptyRequestException
     * @return void
     */
    public function execute(): void {
        $httpRequest = new HttpRequest();

        if (empty($httpRequest->body()))
            throw new EmptyRequestException();
    }
}