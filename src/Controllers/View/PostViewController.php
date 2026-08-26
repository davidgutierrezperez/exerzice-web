<?php 

namespace Controllers\View;

use Twig;

/**
 * The class PostViewController represents a specific view controller to render posts related pages.
 */
final class PostViewController extends BaseViewController {

    /**
     * Default constructor of the class PostViewController.
     * @param Twig\Environment $twig Twig environment.
     */
    public function __construct(Twig\Environment $twig){
        parent::__construct($twig);
    }

    /**
     * Renders the page to create a new post.
     * @return void
     */
    public function create(): void {
        echo $this->twig->render('pages/posts/create-post.twig');
    }
}