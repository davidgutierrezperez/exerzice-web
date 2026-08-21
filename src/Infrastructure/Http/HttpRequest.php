<?php 

namespace Infrastructure\Http;

/**
 * The class HttpRequest represents a generic HTTP request.
 */
final class HttpRequest {

    /**
     * Body of the request.
     * @var array
     */
    private readonly array $body;

    /**
     * Default constructor of the class HttpRequest.
     */
    public function __construct() {
        $this->body = json_decode(file_get_contents('php://input'), true) ?? [];
    }

    /**
     * Returns a specific resource with a key.
     * @param string $key Key to obtain.
     * @return ?string String value if HTTP GET method got something 
     * with the associated key or null value if otherwise.
     */
    public function query(string $key): ?string {
        return $_GET[$key] ?? null;
    }

    /**
     * Returns a specific resource with a key.
     * @param string $key Key to obtain.
     * @return ?string String value if HTTP POST method got something 
     * with the associated key or null value if otherwise.
     */
    public function input(string $key): ?string {
        return $_POST[$key] ?? null;
    }

    /**
     * Returns the body of the request.
     * @return array Array object with all the content of the requests.
     */
    public function body(): array {
        return $this->body;
    }

    /**
     * Returns a value from the JSON body.
     */
    public function value(string $key): mixed {
        return $this->body[$key] ?? null;
    }
}

?>   