import HttpFetcher from "../infraestructure/http/HttpFetcher.js";
import HttpFetchingRequest from "../infraestructure/http/HttpFetchingRequest.js";
import HttpMethod from "../infraestructure/http/HttpMethod.js";
import HttpResponse from "../infraestructure/http/HttpResponse.js";

class PostFetcher {
    private static readonly BASE_URL: string = '/post/';
    private static readonly LIKE_PARAMETER: string = '/like';

    public like(id: string): Promise<Response> {
        const query: string = PostFetcher.BASE_URL + id + PostFetcher.LIKE_PARAMETER;
        const fetchingRequest: HttpFetchingRequest = new HttpFetchingRequest(HttpMethod.POST, query);

        return HttpFetcher.fetch(fetchingRequest);
    }

}

export default PostFetcher;