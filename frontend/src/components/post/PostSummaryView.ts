import PostLikeFormView from "./PostLikeFormView.js";
import PostLikeListener from "./PostLikeListener.js";
import PostView from './PostView.js';


class PostSummaryView implements PostView {
    private readonly rootContainer: HTMLElement;
    private readonly likeFormView: PostLikeFormView|null;
    private readonly id: string|null;
    private liked: boolean;

    public constructor(rootContainer: HTMLElement){
        this.rootContainer = rootContainer;

        this.id = this.queryId();
        this.likeFormView = this.initLikeFormView();
        this.liked = false;
    }

    public getId(): string|null {
        return this.id;
    }

    public setLikeListener(listener: PostLikeListener): void {
        this.likeFormView?.setListener(listener);
    }

    public isLiked(): boolean {
        return this.liked;
    }

    public like(): void {
        this.likeFormView?.like();
        this.liked = true;
    }

    public unlike(): void {
        this.likeFormView?.unlike();
        this.liked = false;
    }

    private queryId(): string|null {
        return this.rootContainer.getAttribute('data-component-id');
    }

    private initLikeFormView(): PostLikeFormView|null {
        const likeForm: HTMLElement|null = this.rootContainer.querySelector('[data-component = "like-form"]');

        return (likeForm != null) ? new PostLikeFormView(likeForm) : null;
    }
}

export default PostSummaryView;