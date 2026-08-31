import PostController from "./PostController.js";
import PostSummaryView from "./PostSummaryView.js";
import PostView from './PostView.js';

// Obtain the containers of the posts.
const postsContainers: NodeListOf<HTMLElement> = document.querySelectorAll('[data-component = "post-summary"]');

// Initializes the views of the posts.
let postsViews: Array<PostView> = [];

// Obtain the view of each post.
for (const postContainer of postsContainers){
    const postView: PostView|null = (postContainer != null) ? new PostSummaryView(postContainer) : null;

    if (postView != null)
        postsViews.push(postView);
}

// Create a controller for each post view.
for (const postView of postsViews){
    const postController: PostController = new PostController(postView);
}