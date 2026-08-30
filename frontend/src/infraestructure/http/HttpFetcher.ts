import HttpFetchingRequest from "./HttpFetchingRequest.js";
import HttpResponse from "./HttpResponse.js";
import HttpMethod from './HttpMethod';

class HttpFetcher {
    public static async fetch(request: HttpFetchingRequest): Promise<Response> {
        const fetchingOptions = this.buildFetchingOptions(request.getMethod());

        const response = await fetch(request.getQuery(), fetchingOptions);
        return response;
    }

    private static buildFetchingOptions(method: HttpMethod): Record<any, any> {
        const headers = new Headers();
        headers.set('Content-Type', 'application/json');

        const requestOptions = {
            method: method.valueOf(),
            headers: headers
        };

        return requestOptions;
    }
}

export default HttpFetcher;