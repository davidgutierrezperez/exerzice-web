import PostLikeListener from './PostLikeListener.js';

/** 
 * The interface PostView represents a generic post view.
 */
interface PostView {

    /**
     * Returns the ID of the post.
     * @returns string|null.
     */
    getId(): string|null;

    /**
     * Sets a listener that handles the liking of the post.
     * @param listener Listener that handles the liking of the post.
     */
    setLikeListener(listener: PostLikeListener): void;

    /**
     * Checks if the post is liked by the user.
     * @returns True if the post has been liked and false if otherwise.
     */
    isLiked(): boolean;

    /** 
     * Changes the UI of the post to represents that it has been liked by the user.
     */
    like(): void;

    /** 
     * Changes the UI of the post to represents that it has been unliked by the user.
     */
    unlike(): void;
}

// Exports the interface PostView.
export default PostView;