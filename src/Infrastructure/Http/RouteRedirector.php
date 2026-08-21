<?php 

namespace Infrastructure\Http;

final class RouteRedirector {
    public static function redirect(string $location): void {
        header('Location: ' . $location);
        exit;
    }
}

