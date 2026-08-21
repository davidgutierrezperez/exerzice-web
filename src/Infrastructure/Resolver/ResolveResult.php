<?php 

namespace Infrastructure\Resolver;

/**
 * The class ResolveResult represents the result of a resolving process.
 */
final class ResolveResult {

    /**
     * Errors found while resolving.
     * @var array
     */
    private readonly array $errors;

    /**
     * Value of the resolving.
     * @var mixed
     */
    private readonly mixed $value;

    /**
     * Default constructor of the class ResolveResult.
     * @param mixed $value Value of the resolving.
     * @param array $errors Errors found while resolving.
     */
    public function __construct(mixed $value, array $errors){
        $this->value = $value;
        $this->errors = $errors;
    }

    /**
     * Checks if the resolving was successful.
     * @return bool True if there are no errors and false if otherwise.
     */
    public function isSuccess(): bool {
        return empty($this->errors);
    }

    /**
     * Returns the errors found while resolving.
     * @return array
     */
    public function getErrors(): array {
        return $this->errors;
    }

    /**
     * Value of the resolving.
     * @return mixed
     */
    public function value(): mixed {
        return $this->value;
    }
}