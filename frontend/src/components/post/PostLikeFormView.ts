import EventType from "../../core/events/EventType.js";
import PostLikeListener from "./PostLikeListener.js";

/** 
 * The class PostLikeFormView represents the view of a form to like a post.
 */
class PostLikeFormView {

    /** 
     * Container of the form.
     */
    private readonly formContainer: HTMLElement;

    /**
     * Icon of the liking button.
     */
    private readonly likeButtonIcon: HTMLElement|null;

    /** 
     * Counter of likes.
     */
    private readonly likeCounter: HTMLElement|null;

    /** 
     * Liking status.
     */
    private liked: boolean;

    /** 
     * Listener that handles the action of liking a post.
     */
    private listener: PostLikeListener|null;

    /** 
     * Default constructor of the class PostLikeFormView.
     * @param formContainer Main container of the form.
     */
    public constructor(formContainer: HTMLElement){
        this.formContainer = formContainer;

        this.likeButtonIcon = formContainer.querySelector('[data-action = "like-button"]');
        this.likeCounter = formContainer.querySelector('[data-role = "like-counter"]');
        this.liked = this.resolvePostLikeStatus();

        console.log("LIKE STATUS: " + this.liked);

        this.listener = null;
    }

    /** 
     * Sets the listener to handle the liking of a post.
     * @param listener Listener to handle the liking of the post.
     */
    public setListener(listener: PostLikeListener): void {
        this.listener = listener;

        this.formContainer.addEventListener(EventType.SUBMIT, event => {
            event.preventDefault();
            this.listener?.like();
        });
    }

    /**
     * Checks if the post is already liked.
     * @returns True if the post is already liked and false if otherwise.
     */
    public isLiked(): boolean {
        return this.liked;
    }

    /**
     * Changes the UI of the post to represent that it has been liked.
     */
    public like(): void {
        this.incrementLike();
        this.fillLikeIcon();

        this.liked = true;
    }

    /**
     * Changes the UI of the post to represent that it has been unliked.
     */
    public unlike(): void {
        this.decreaseLikeCounter();
        this.unfillLikeIcon();

        this.liked = false;
    }

    /** 
     * Increments the likes counter.
     */
    private incrementLike(): void {
        const likesCountStr: string = this.likeCounter?.innerText ?? '0';
        const likesCountNumber = Number(likesCountStr) + 1;

        if (this.likeCounter != null)
            this.likeCounter.innerText = likesCountNumber.toString();
    }

    /** 
     * Decreses the likes counter.
     */
    private decreaseLikeCounter(): void {
        const likesCountStr: string = this.likeCounter?.innerText ?? '0';
        let likesCountNumber = Number(likesCountStr);
            
        if (this.likeCounter != null && likesCountNumber > 0){
            likesCountNumber -= 1;
            this.likeCounter.innerText = likesCountNumber.toString();
        }
    }

    /** 
     * Fills the likes icon.
     */
    private fillLikeIcon(): void {
        if (this.likeButtonIcon == null) return;

        this.likeButtonIcon.style.setProperty('fill', 'var(--primary)');
        this.likeButtonIcon.style.setProperty('stroke', 'var(--primary)');
        
    }

    /** 
     * Unfills the likes icon.
     */
    private unfillLikeIcon(): void {
        if (this.likeButtonIcon == null) return;
        
        this.likeButtonIcon.style.setProperty('fill', 'none');
        this.likeButtonIcon.style.setProperty('stroke', 'var(--text-primary)');
    }

    /** 
     * Resolves the liking status.
     * @returns True if the post has been liked and false if otherwise.
     */
    private resolvePostLikeStatus(): boolean {
        const likeValue: string|null = this.formContainer.getAttribute('data-value');
        if (likeValue == null)
            return false;
        
        return likeValue === '1';
    }
}

// Exports the class PostLikeFormView.
export default PostLikeFormView;