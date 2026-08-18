<?php

namespace Controllers;
use Twig;

class BaseController {
    /**
     * Twig environment to load Twig files.
     * @var Twig\Environment 
     */
    protected Twig\Environment $twig;

    /**
     * Default constructor of all controllers. Loads the
     * Twig environment
     * @param Twig\Environment $twig
     */
    public function __construct(Twig\Environment $twig){
        $this->twig = $twig;
    }
}

?>