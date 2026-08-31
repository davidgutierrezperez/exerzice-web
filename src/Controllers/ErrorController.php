<?php

namespace Controllers;

use Controllers\View\BaseViewController;
use Infrastructure\Http\ErrorRouteType;
use Infrastructure\Http\HttpCode;
use Infrastructure\Http\HttpResponse;

class ErrorController extends BaseViewController {

    /**
     * Handles the errors encountered while navigation through the app.
     * @param ErrorRouteType $error Error encountered.
     * @return HttpResponse HTTP response.
     */
    public function error(ErrorRouteType $error): HttpResponse {
        switch ($error){
            // Page not found.
            case ErrorRouteType::NOT_FOUND:
                return $this->notFound();
            // Page not accesible by the user.
            case ErrorRouteType::FORBIDDEN:
                return $this->forbidden();
            case ErrorRouteType::UNKNOWN:
                return $this->uups();
            // Default error.
            default:
                return $this->notFound();
        }
    }

    /**
     * Renders the 404 error page.
     * @return HttpResponse
     */
    public function notFound(): HttpResponse {
        $page = $this->twig->render('pages/errors/not_found.twig');
        return new HttpResponse($page, HttpCode::NOT_FOUND);
    }

    /**
     * Renders the 403 error page.
     * @return HttpResponse
     */
    public function forbidden(): HttpResponse{
        $page = $this->twig->render('pages/errors/forbidden.twig');
        return new HttpResponse($page, HttpCode::FORBIDDEN);
    }

    public function uups(): HttpResponse {
        $page = $this->twig->render('pages/errors/uups.twig');
        return new HttpResponse($page, HttpCode::BAD_REQUEST);
    }
}

