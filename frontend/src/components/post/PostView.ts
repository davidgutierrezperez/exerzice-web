import PostLikeListener from './PostLikeListener.js';

interface PostView {
    setLikeListener(listener: PostLikeListener): void;
    like(): void;
    unlike(): void;
}

export default PostView;