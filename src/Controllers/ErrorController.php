<?php

namespace Controllers;

use Controllers\View\BaseViewController;
use Infrastructure\Http\ErrorRouteType;

class ErrorController extends BaseViewController {

    /**
     * Handles the errors encountered while navigation through the app.
     * @param ErrorRouteType $error Error encountered.
     * @return void
     */
    public function error(ErrorRouteType $error): void {
        switch ($error){
            // Page not found.
            case ErrorRouteType::NOT_FOUND:
                $this->notFound();
                break;

            // Page not accesible by the user.
            case ErrorRouteType::FORBIDDEN:
                $this->forbidden();
                break;
            case ErrorRouteType::UNKNOWN:
                $this->uups();
            // Default error.
            default:
                $this->notFound();
                break;
        }
    }

    /**
     * Renders the 404 error page.
     * @return void
     */
    public function notFound(): void {
        echo $this->twig->render('errors/not_found.twig');
    }

    /**
     * Renders the 403 error page.
     * @return void
     */
    public function forbidden(): void {
        echo $this->twig->render('errors/forbidden.twig');
    }

    public function uups(): void {
        echo $this->twig->render('errors/uups.twig');
    }
}

