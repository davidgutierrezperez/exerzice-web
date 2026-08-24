<?php 

namespace Domain;

/**
 * The class Route represents a route/endpoint in the application.
 */
final class Route {

    /**
     * Route's handler.
     * @var mixed
     */
    private readonly mixed $handler;

    /**
     * Method to be executed by the route's handler.
     * @var string
     */
    private readonly string $handlerMethod;

    /**
     * Middlewares to execute while cheking the route.
     * @var array
     */
    private readonly array $middlewares;

    /**
     * Default constructor of the class Route.
     * @param mixed $handler Route's handler.
     * @param string $handlerMethod Method to be executed by the route's handler.
     * @param array $middlewares Middlewares to execute while cheking the route.
     */
    public function __construct(mixed $handler, string $handlerMethod, array $middlewares = []){
        $this->handler = $handler;
        $this->handlerMethod = $handlerMethod;
        $this->middlewares = $middlewares;
    }

    /**
     * Returns the handler of the route.
     * @return mixed
     */ 
    public function getHandler(): mixed {
        return $this->handler;
    }

    /**
     * Returns the method to be executed by the route's handler.
     * @param string
     */ 
    public function getHandlerMethod(): string {
        return $this->handlerMethod;
    }

    /**
     * Middlewares to be executed before checking the route.
     * @param array
     */ 
    public function getMiddlewares(): array {
        return $this->middlewares;
    }
}