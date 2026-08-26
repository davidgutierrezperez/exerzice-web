<?php 

namespace Controllers\View;

use Api\Fetching\PostFetcher;
use Api\Fetching\UserFetcher;
use Application\Security\Auth\UserSession;
use Controllers\View\BaseViewController;
use Infrastructure\Http\RouteRedirector;
use Twig;

/**
 * The class ProfileViewController represents a controller component for the view of a user's profile.
 */
final class ProfileViewController extends BaseViewController {

    /**
     * Posts' fetching component.
     * @var PostFetcher
     */
    private readonly PostFetcher $postFetcher;

    /**
     * Users' fetching component.
     * @var UserFetcher
     */
    private readonly UserFetcher $userFetcher;

    /**
     * Default constructor of the class ProfileViewController.
     * @param Twig\Environment $twig Twig environment for rendering pages.
     */
    public function __construct(Twig\Environment $twig){
        parent::__construct($twig);

        $this->userFetcher = new UserFetcher();
        $this->postFetcher = new PostFetcher();
    }

    /**
     * Displays the profile page of a user identified by its ID.
     * @param string $id ID of the user.
     * @return void
     */
    public function profile(string $id): void {
        if ($this->isLoggedUserProfile($id))
            RouteRedirector::redirect('/me');

        $userData = $this->getUserData($id);
        $posts = $this->getUserPosts($id);

        echo $this->twig->render('pages/media/media.twig', 
                                [ 'media' => $userData,
                                  'posts' => $posts]);
    }

    /**
     * Displays the profile page of the current logged user.
     * @return void
     */
    public function me(): void {
        $userEntity = UserSession::requireEntity();
        $userId = $userEntity->getId()->toString();

        $userData = $this->getLoggedUserData();
        $posts = $this->getUserPosts($userId);

        echo $this->twig->render('pages/media/media.twig', 
                                [ 'media' => $userData,
                                  'posts' => $posts]);
    }

    /**
     * Checks if the profile to be displayed is the same as the profile of the 
     * current logged user.
     * @param string $id User's ID.
     * @return bool True if the profile to be displayed is the same as the profile of the 
     * current logged user and false if otherwise.
     */
    private function isLoggedUserProfile(string $id): bool {
        $userEntity = UserSession::requireEntity();
        if (!$userEntity) 
            return false;

        $userId = $userEntity->getId()->toString();
        return strcmp($userId, $id) == 0;
    }

    /**
     * Obtains the data about the user's profile.
     * @param string $id ID of the user's profile.
     * @return array Array that contains the data about the user.
     */
    private function getUserData(string $id): array {
        $userDataResponse = $this->userFetcher->byId($id);
        $userData = $userDataResponse->getValue();

        return $userData;
    }

    /**
     * Obtains the data about the current logged user's profile.
     * @return array Array that contains the data about the user.
     */
    private function getLoggedUserData(): array {
        $userDataResponse = $this->userFetcher->loggedUser();
        $userData = $userDataResponse->getValue();

        return $userData;
    }

    /**
     * Obtains the posts created by the user.
     * @param string $userId User's ID.
     * @return array Array that contains the information about the posts created by the user.
     */
    private function getUserPosts(string $userId): array {
        $postsDataResponse = $this->postFetcher->fetchByCreator($userId);
        return $postsDataResponse->getValue();
    }
}