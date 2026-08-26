<?php 

namespace Controllers\View;

use Twig;
use Override;

final class PostViewController extends BaseViewController {


    public function __construct(Twig\Environment $twig){
        parent::__construct($twig);
    }

    public function create(): void {
        echo $this->twig->render('pages/posts/create-post.twig');
    }
}