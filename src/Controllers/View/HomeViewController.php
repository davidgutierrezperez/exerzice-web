<?php

namespace Controllers\View;

use Twig;
use Api\Fetching\PostFetcher;
use Api\Fetching\SpaceFetcher;
use Infrastructure\Http\HttpCode;
use Infrastructure\Http\HttpResponse;
use Infrastructure\Ip\IPGeolocator;

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
        $userLocation = IPGeolocator::locate() ?? 'Almería';

        $postsResponse = $this->postFetcher->byLocation($userLocation);
        $spacesResponse = $this->spaceFetcher->fetchByLocation($userLocation);

        $posts = $postsResponse->getValue();
        $spaces = $spacesResponse->getValue();
    
        $page = $this->twig->render('pages/index.twig', ['posts' => $posts, 'spaces' => $spaces]);

        return new HttpResponse($page, HttpCode::SUCCESS);
    }
}

