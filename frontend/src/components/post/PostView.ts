import PostLikeListener from './PostLikeListener.js';

interface PostView {
    getId(): string|null;
    setLikeListener(listener: PostLikeListener): void;
    isLiked(): boolean;
    like(): void;
    unlike(): void;
}

export default PostView;