<?php 

namespace Controllers\View;

use Api\Fetching\PostFetcher;
use Infrastructure\Http\HttpCode;
use Infrastructure\Http\HttpRequest;
use Infrastructure\Http\HttpResponse;
use Twig;

/**
 * The class PostViewController represents a specific view controller to render posts related pages.
 */
final class PostViewController extends BaseViewController {

    /**
     * Posts fetching component.
     * @var PostFetcher
     */
    private readonly PostFetcher $postFetcher;

    /**
     * Default constructor of the class PostViewController.
     * @param Twig\Environment $twig Twig environment.
     */
    public function __construct(Twig\Environment $twig){
        parent::__construct($twig);

        $this->postFetcher = new PostFetcher();
    }

    /**
     * Displays the specific page of a post.
     * @param string $id ID of the post.
     * @return HttpResponse HTTP response.
     */
    public function index(string $id): HttpResponse {
        $postFetchRespose = $this->postFetcher->byId($id);
        $post = $postFetchRespose->getValue();

        $page = $this->twig->render('pages/posts/post.twig', ['post' => $post]);
        return new HttpResponse($page, HttpCode::SUCCESS);
    }

    /**
     * Renders the page to create a new post.
     * @return HttpResponse HTTP response.
     */
    public function create(): HttpResponse {
        $page = $this->twig->render('pages/posts/create-post.twig');
        return new HttpResponse($page, HttpCode::SUCCESS);
    }
}