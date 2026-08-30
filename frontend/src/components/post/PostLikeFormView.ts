import EventType from "../../core/events/EventType.js";
import PostLikeListener from "./PostLikeListener.js";

class PostLikeFormView {
    private readonly formContainer: HTMLElement;
    private readonly likeButtonIcon: HTMLElement|null;
    private readonly likeCounter: HTMLElement|null;

    private listener: PostLikeListener|null;

    public constructor(formContainer: HTMLElement){
        this.formContainer = formContainer;

        this.likeButtonIcon = formContainer.querySelector('[data-action = "like-button"]');
        this.likeCounter = formContainer.querySelector('[data-role = "like-counter"]');

        this.listener = null;
    }

    public setListener(listener: PostLikeListener): void {
        this.listener = listener;

        this.formContainer.addEventListener(EventType.SUBMIT, event => {
            event.preventDefault();
            this.listener?.like();
        })
    }

    public like(): void {
        this.incrementLike();
        this.fillLikeIcon();
    }

    public unlike(): void {
        this.decreaseLikeCounter();
        this.unfillLikeIcon();
    }

    private incrementLike(): void {
        const likesCountStr: string = this.likeCounter?.innerText ?? '0';
        const likesCountNumber = Number(likesCountStr) + 1;

        if (this.likeCounter != null)
            this.likeCounter.innerText = likesCountNumber.toString();
    }

    private decreaseLikeCounter(): void {
        const likesCountStr: string = this.likeCounter?.innerText ?? '0';
        let likesCountNumber = Number(likesCountStr);
            
        if (this.likeCounter != null && likesCountNumber > 0){
            likesCountNumber -= 1;
            this.likeCounter.innerText = likesCountNumber.toString();
        }
    }

    private fillLikeIcon(): void {
        if (this.likeButtonIcon == null) return;

        this.likeButtonIcon.style.setProperty('fill', 'var(--primary)');
        this.likeButtonIcon.style.setProperty('stroke', 'var(--primary)');
        
    }

    private unfillLikeIcon(): void {
        if (this.likeButtonIcon == null) return;
        
        this.likeButtonIcon.style.setProperty('fill', 'none');
        this.likeButtonIcon.style.setProperty('stroke', 'var(--text-primary)');
    }
}

export default PostLikeFormView;