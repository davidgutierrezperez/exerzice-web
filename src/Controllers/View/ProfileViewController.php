<?php 

namespace Controllers\View;

use Api\Fetching\PostFetcher;
use Api\Fetching\UserFetcher;
use Application\Security\Auth\UserSession;
use Controllers\View\BaseViewController;
use Twig;

final class ProfileViewController extends BaseViewController {

    private readonly PostFetcher $postFetcher;
    private readonly UserFetcher $userFetcher;

    public function __construct(Twig\Environment $twig){
        parent::__construct($twig);

        $this->userFetcher = new UserFetcher();
        $this->postFetcher = new PostFetcher();
    }

    public function index(){
        $userData = $this->getUserData();
        $posts = $this->getUserPosts();

        echo $this->twig->render('pages/media/media.twig', 
                                [ 'media' => $userData,
                                  'posts' => $posts]);
    }

    private function getUserData(): array {
        $userDataResponse = $this->userFetcher->loggedUser();
        $userData = $userDataResponse->getValue();

        return $userData;
    }

    private function getUserPosts(): array {
        $userEntity = UserSession::requireEntity();
        $userId = $userEntity->getId()->toString();

        $postsDataResponse = $this->postFetcher->fetchByCreator($userId);
        return $postsDataResponse->getValue();
    }
}