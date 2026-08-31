<?php

namespace Controllers\View;

use Twig;
use Api\Fetching\PostFetcher;
use Api\Fetching\SpaceFetcher;
use Infrastructure\Http\HttpCode;
use Infrastructure\Http\HttpResponse;

/**
 * The class HomeViewController represents the controller component that handles the home page.
 */
class HomeViewController extends BaseViewController {

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
     * Default constructor of the class HomeViewController.
     * @param Twig\Environment $twig Twig environment.
     */
    public function __construct(Twig\Environment $twig){
        parent::__construct($twig);

        $this->postFetcher = new PostFetcher();
        $this->spaceFetcher = new SpaceFetcher();
    }

    /**
     * Displays the index page.
     * @return HttpResponse HTTP response.
     */
    public function index(): HttpResponse {
        $postsResponse = $this->postFetcher->fetchByCreator('3057cc52-0d8c-4ae2-a6d9-4b3b036906e0');
        $spacesResponse = $this->spaceFetcher->fetchByLocation('almeria');

        $posts = $postsResponse->getValue();
        $spaces = $spacesResponse->getValue();
    
        $page = $this->twig->render('pages/index.twig', ['posts' => $posts, 'spaces' => $spaces]);

        return new HttpResponse($page, HttpCode::SUCCESS);
    }
}

