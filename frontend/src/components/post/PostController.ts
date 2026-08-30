import PostLikeListener from "./PostLikeListener.js";
import PostView from "./PostView.js";

class PostController implements PostLikeListener {
    private readonly postView: PostView;

    public constructor(postView: PostView){
        this.postView = postView;

        this.init();
    }

    public like(): void {
        this.postView.like();
    }

    private init(): void {
        this.postView.setLikeListener(this);
    }
}

export default PostController;