import PostController from "./PostController.js";
import PostSummaryView from "./PostSummaryView.js";
import PostView from './PostView.js';

const postContainer: HTMLElement|null = document.querySelector('[data-component = "post-summary"]');
const postView: PostView|null = (postContainer != null) ? new PostSummaryView(postContainer) : null;

if (postView != null){
    const postController: PostController = new PostController(postView);
}