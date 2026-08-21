<?php 

namespace Infrastructure\Session;

/**
 * The class SessionManager represents an infrastructure component that handles 
 * the data of the current session.
 */
final class SessionManager {

    /**
     * Returns the value of certain data stored in the current session.
     * @param string $key Data key identification.
     * @return mixed
     */
    public static function get(string $key): mixed {
        return $_SESSION[$key] ?? null;
    }

    /**
     * Adds new data to the current session.
     * @param string $key Key identification of the data.
     * @param mixed $value Value of the data.
     * @return void
     */
    public static function set(string $key, mixed $value): void {
        if (!self::isActive())
            self::start();
        
        $_SESSION[$key] = $value;
    }

    /**
     * Starts a new session.
     * @return void
     */
    public static function start(): void {
        session_start();
    }

    /**
     * Ends the current session.
     * @return void
     */
    public static function end(): void {
        session_unset();
        session_destroy();
    }

    /**
     * Checks if there is an active session.
     * @return bool True if there is an active session and false if otherwise.
     */
    public static function isActive(): bool {
        return session_status() === PHP_SESSION_ACTIVE;
    }
}
