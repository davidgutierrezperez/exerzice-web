import HttpFetchingRequest from "./HttpFetchingRequest.js";
import HttpMethod from './HttpMethod';
import RouteRedirector from "./RouteRedirector.js";

class HttpFetcher {
    public static async fetch(request: HttpFetchingRequest): Promise<Response> {
        const fetchingOptions = this.buildFetchingOptions(request.getMethod());

        const response = await fetch(request.getQuery(), fetchingOptions);
        this.checkResponse(response);

        return response;
    }

    private static buildFetchingOptions(method: HttpMethod): Record<any, any> {
        const requestOptions = {
            method: method.valueOf(),
            credentials: 'same-origin'
        };

        return requestOptions;
    }

    private static checkResponse(response: Response): void {
        if (response.redirected)
            RouteRedirector.redirect('/login');
    }
}

export default HttpFetcher;