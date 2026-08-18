<?php

namespace Controllers;

use Twig;
use Api\ApiFetcher;
use Api\ApiUrl;
use Api\PostFetcher;
use Api\SpaceFetcher;

class HomeController extends BaseController {

    private readonly PostFetcher $postFetcher;
    private readonly SpaceFetcher $spaceFetcher;

    public function __construct(Twig\Environment $twig){
        parent::__construct($twig);

        $this->postFetcher = new PostFetcher();
        $this->spaceFetcher = new SpaceFetcher();
    }

    public function index(): void {
        $postsResponse = $this->postFetcher->fetchByCreator('3057cc52-0d8c-4ae2-a6d9-4b3b036906e0');
        $spacesResponse = $this->spaceFetcher->fetchByLocation('almeria');

        $posts = $postsResponse->getValue();
        $spaces = $spacesResponse->getValue();

        echo $this->twig->render('index.twig', ['posts' => $posts, 'spaces' => $spaces]);
    }
}

?>