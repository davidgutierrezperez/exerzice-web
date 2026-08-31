import HttpFetchingRequest from "./HttpFetchingRequest.js";
import HttpMethod from './HttpMethod';
import RouteRedirector from "./RouteRedirector.js";

/** 
 * The class HttpFetcher represents a HTTP component to fetch resources 
 * through their URL.
 */
class HttpFetcher {

    /**
     * Fetches a URL through a fetching request.
     * @param request Request to fetch a URL.
     * @returns Response object.
     */
    public static async fetch(request: HttpFetchingRequest): Promise<Response> {
        const fetchingOptions = this.buildFetchingOptions(request.getMethod());

        const response = await fetch(request.getQuery(), fetchingOptions);
        this.checkResponse(response);

        return response;
    }

    /**
     * Builds the feching options for a specific HTTP method.
     * @returns Record<any,any> object with all the options.
     */
    private static buildFetchingOptions(method: HttpMethod): Record<any, any> {
        const requestOptions = {
            method: method.valueOf(),
            credentials: 'same-origin'
        };

        return requestOptions;
    }

    /**
     * Checks a response to see if needs to be redirected.
     * @param response Response to check.
     */
    private static checkResponse(response: Response): void {
        if (response.redirected)
            RouteRedirector.redirect('/login');
    }
}

// Exports the class HttpFetcher.
export default HttpFetcher;