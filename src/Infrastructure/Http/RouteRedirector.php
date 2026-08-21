<?php 

namespace Infrastructure\Http;

/**
 * The class RouteRedirector represents a HTTP component for route redirecting.
 */
final class RouteRedirector {

    /**
     * Redirects the user to another page.
     * @param string $location Location of the page.
     * @return void
     */
    public static function redirect(string $location): void {
        header('Location: ' . $location);
        exit;
    }
}

