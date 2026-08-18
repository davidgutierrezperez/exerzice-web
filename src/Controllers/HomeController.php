<?php

namespace Controllers;

use Twig;
use Api\PostFetcher;
use Api\SpaceFetcher;

/**
 * The class HomeController represents the controller component that handles the home page.
 */
class HomeController extends BaseController {

    /**
     * Posts fetcher component.
     * @var PostFetcher
     */
    private readonly PostFetcher $postFetcher;

    /**
     * Spaces fetcher component.
     * @var SpaceFetcher
     */
    private readonly SpaceFetcher $spaceFetcher;

    /**
     * Default constructor of the class HomeController.
     * @param Twig\Environment $twig Twig environment.
     */
    public function __construct(Twig\Environment $twig){
        parent::__construct($twig);

        $this->postFetcher = new PostFetcher();
        $this->spaceFetcher = new SpaceFetcher();
    }

    /**
     * Displays the index page.
     * @return void
     */
    public function index(): void {
        $postsResponse = $this->postFetcher->fetchByCreator('3057cc52-0d8c-4ae2-a6d9-4b3b036906e0');
        $spacesResponse = $this->spaceFetcher->fetchByLocation('almeria');

        $posts = $postsResponse->getValue();
        $spaces = $spacesResponse->getValue();

        echo $this->twig->render('index.twig', ['posts' => $posts, 'spaces' => $spaces]);
    }
}

?>