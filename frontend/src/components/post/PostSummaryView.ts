import PostLikeFormView from "./PostLikeFormView.js";
import PostLikeListener from "./PostLikeListener.js";
import PostView from './PostView.js';


class PostSummaryView implements PostView {
    private readonly rootContainer: HTMLElement;
    private readonly likeFormView: PostLikeFormView|null;

    public constructor(rootContainer: HTMLElement){
        this.rootContainer = rootContainer;

        this.likeFormView = this.initLikeFormView();
    }

    public setLikeListener(listener: PostLikeListener): void {
        this.likeFormView?.setListener(listener);
    }

    public like(): void {
        this.likeFormView?.like();
    }

    public unlike(): void {
        this.likeFormView?.unlike();
    }

    private initLikeFormView(): PostLikeFormView|null {
        const likeForm: HTMLElement|null = this.rootContainer.querySelector('[data-component = "like-form"]');

        return (likeForm != null) ? new PostLikeFormView(likeForm) : null;
    }
}

export default PostSummaryView;