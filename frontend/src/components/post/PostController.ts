import PostFetcher from "../../api/PostFetcher.js";
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
        const postId: string|null = this.postView.getId();
        if (!postId) return;

        const response = await this.postApiFetcher.like(postId);
        const statusCode = response.status;
        const data = response.json;
        
        this.postView.like();
    }

    private init(): void {
        this.postView.setLikeListener(this);
    }
}

export default PostController;