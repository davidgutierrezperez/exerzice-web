/** 
 * The interface PostLikeListener represents a listener component that handles 
 * the liking of a post.
 */
interface PostLikeListener {

    /** 
     * Handles the liking of a post.
     */
    like(): void;
}

// Export the interface PostLikeListener.
export default PostLikeListener;