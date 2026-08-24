<?php 

namespace Application\Middleware;


/**
 * The interface Middleware represents a generic middleware component.
 */
interface Middleware {

    /**
     * Main method of the middleware.
     * @return void
     */
    function execute(): void;
}