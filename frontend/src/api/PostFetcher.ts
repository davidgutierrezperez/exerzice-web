import HttpFetcher from "../infraestructure/http/HttpFetcher.js";
import HttpFetchingRequest from "../infraestructure/http/HttpFetchingRequest.js";
import HttpMethod from "../infraestructure/http/HttpMethod.js";

/**
 * The class PostFetcher represents a specific fetching component to like and unlike posts.
 */
class PostFetcher {

    /**
     * Base URL to fetch data related to posts.
     */
    private static readonly BASE_URL: string = '/post/';

    /**
     * Like posts parameter.
     */
    private static readonly LIKE_PARAMETER: string = '/like';

    /**
     * Unlike posts parameter.
     */
    private static readonly UNLIKE_PARAMETER: string = '/unlike';

    /**
     * Fetches liking to a post.
     * @param id ID of the post.
     * @returns HTTP response.
     */
    public like(id: string): Promise<Response> {
        const query: string = PostFetcher.BASE_URL + id + PostFetcher.LIKE_PARAMETER;
        const fetchingRequest: HttpFetchingRequest = new HttpFetchingRequest(HttpMethod.POST, query);

        return HttpFetcher.fetch(fetchingRequest);
    }

    /**
     * Fetches unliking to a post.
     * @param id ID of the post.
     * @returns HTTP response.
     */
    public unlike(id: string): Promise<Response> {
        const query: string = PostFetcher.BASE_URL + id + PostFetcher.UNLIKE_PARAMETER;
        const fetchingRequest: HttpFetchingRequest = new HttpFetchingRequest(HttpMethod.POST, query);

        return HttpFetcher.fetch(fetchingRequest);
    }

}

export default PostFetcher;