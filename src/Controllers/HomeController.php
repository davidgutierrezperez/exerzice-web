<?php

namespace Controllers;

class HomeController extends BaseController {

    public function index(): void {
        echo $this->twig->render('index.twig');
    }
}

?>