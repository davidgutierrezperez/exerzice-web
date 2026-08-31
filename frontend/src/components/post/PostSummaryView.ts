import PostLikeFormView from "./PostLikeFormView.js";
import PostLikeListener from "./PostLikeListener.js";
import PostView from './PostView.js';

/** 
 * The class PostSummaryView represent the view of a summary post.
 */
class PostSummaryView implements PostView {

    /** 
     * Root container of the view.
     */
    private readonly rootContainer: HTMLElement;

    /** 
     * View of the form to like the post.
     */
    private readonly likeFormView: PostLikeFormView|null;

    /** 
     * ID of the post.
     */
    private readonly id: string|null;

    /** 
     * Default constructor of the class PostSummaryView.
     * @param rootContainer Main container of the post.
     */
    public constructor(rootContainer: HTMLElement){
        this.rootContainer = rootContainer;

        this.id = this.resolveId();
        this.likeFormView = this.initLikeFormView();
    }

    /**
     * Returns the ID of the post.
     * @returns string|null.
     */
    public getId(): string|null {
        return this.id;
    }

    /**
     * Sets a listener that handles the liking of the post.
     * @param listener Listener that handles the liking of the post.
     */
    public setLikeListener(listener: PostLikeListener): void {
        this.likeFormView?.setListener(listener);
    }

    /**
     * Checks if the post is liked by the user.
     * @returns True if the post has been liked and false if otherwise.
     */
    public isLiked(): boolean {
        if (this.likeFormView == null) 
            return false;

        return this.likeFormView.isLiked();
    }

    /** 
     * Changes the UI of the post to represents that it has been liked by the user.
     */
    public like(): void {
        this.likeFormView?.like();
    }

    /** 
     * Changes the UI of the post to represents that it has been unliked by the user.
     */
    public unlike(): void {
        this.likeFormView?.unlike();
    }

    /**
     * Resolves the ID of the post.
     * @returns string|null
     */
    private resolveId(): string|null {
        return this.rootContainer.getAttribute('data-component-id');
    }

    /** 
     * Initializes the view of the form to like the post.
     * @returns PostLikeFormView|null.
     */
    private initLikeFormView(): PostLikeFormView|null {
        const likeForm: HTMLElement|null = this.rootContainer.querySelector('[data-component = "like-form"]');

        return (likeForm != null) ? new PostLikeFormView(likeForm) : null;
    }
}

// Exports the class PostSummaryView.
export default PostSummaryView;