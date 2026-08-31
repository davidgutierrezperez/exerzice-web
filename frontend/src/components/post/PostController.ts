import PostFetcher from "../../api/PostFetcher.js";
import RouteRedirector from "../../infraestructure/http/RouteRedirector.js";
import PostLikeListener from "./PostLikeListener.js";
import PostView from "./PostView.js";

class PostController implements PostLikeListener {
    private readonly postApiFetcher: PostFetcher;
    private readonly postView: PostView;

    public constructor(postView: PostView){
        this.postView = postView;
        this.postApiFetcher = new PostFetcher();

        this.init();
    }

    public async like(): Promise<void> {
        const postId = this.postView.getId();
        if (!postId) return;

        const isPostLiked = this.postView.isLiked();

        if (isPostLiked){
            console.log("AQUIIIIIIIIII");
            await this.postApiFetcher.unlike(postId);
            this.postView.unlike();
        }
        else {
            await this.postApiFetcher.like(postId);
            this.postView.like();
        }
    }

    private init(): void {
        this.postView.setLikeListener(this);
    }
}

export default PostController;