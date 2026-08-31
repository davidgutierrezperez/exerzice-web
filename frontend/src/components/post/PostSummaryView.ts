import PostLikeFormView from "./PostLikeFormView.js";
import PostLikeListener from "./PostLikeListener.js";
import PostView from './PostView.js';


class PostSummaryView implements PostView {
    private readonly rootContainer: HTMLElement;
    private readonly likeFormView: PostLikeFormView|null;
    private readonly id: string|null;

    public constructor(rootContainer: HTMLElement){
        this.rootContainer = rootContainer;

        this.id = this.queryId();
        this.likeFormView = this.initLikeFormView();
    }

    public getId(): string|null {
        return this.id;
    }

    public setLikeListener(listener: PostLikeListener): void {
        this.likeFormView?.setListener(listener);
    }

    public isLiked(): boolean {
        if (this.likeFormView == null) 
            return false;

        return this.likeFormView.isLiked();
    }

    public like(): void {
        this.likeFormView?.like();
    }

    public unlike(): void {
        this.likeFormView?.unlike();
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