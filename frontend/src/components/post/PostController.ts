import PostFetcher from "../../api/PostFetcher.js";
import PostLikeListener from "./PostLikeListener.js";
import PostView from "./PostView.js";

/**
 * The class PostController represents a controller component that handles the views of posts.
 */
class PostController implements PostLikeListener {

    /** 
     * Post fetching component.
     */
    private readonly postApiFetcher: PostFetcher;

    /** 
     * View of the post to handle.
     */
    private readonly postView: PostView;

    /**
     * Default constructor of the class PostController.
     * @param postView View of the post.
     */
    public constructor(postView: PostView){
        this.postView = postView;
        this.postApiFetcher = new PostFetcher();

        this.init();
    }

    /** 
     * Handles the liking of a post.
     */
    public async like(): Promise<void> {
        const postId = this.postView.getId();
        if (!postId) return;

        const isPostLiked = this.postView.isLiked();

        if (isPostLiked){
            await this.postApiFetcher.unlike(postId);
            this.postView.unlike();
        }

        else {
            await this.postApiFetcher.like(postId);
            this.postView.like();
        }
    }

    /** 
     * Initializes the basic behavior of the controller.
     */
    private init(): void {
        this.postView.setLikeListener(this);
    }
}

export default PostController;