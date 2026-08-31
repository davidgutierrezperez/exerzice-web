import HttpMethod from "./HttpMethod.js";

/**
 * The class HttpFetchingRequest represents a request for HTTP fetching.
 */
class HttpFetchingRequest {

    /**
     * HTTP method of the request.
     * @var HttpMethod
     */
    private readonly method: HttpMethod;

    /**
     * Route of the query itself.
     * @var string
     */
    private readonly query: string;

    /**
     * Parameters of the request.
     */
    private readonly params: Record<string, any>;

    /**
     * Default constructor of the class HttpFetchingRequest.
     * @param method HTTP method of the request.
     * @param query  Route of the query itself.
     * @param params Parameters of the request.
     */
    public constructor(method: HttpMethod, query: string, params: Record<string, any> = []){
        this.method = method;
        this.query = query;
        this.params = params;
    }

    /**
     * Returns the method of the request.
     * @return HttpMethod HTTP method.
     */ 
    public getMethod(): HttpMethod {
        return this.method;
    }

    /**
     * Returns the query of the request.
     * @return string
     */ 
    public getQuery(): string {
        return this.query;
    }

    /**
     * Returns the parameters of the request.
     * @return Record<string, any>.
     */ 
    public getParams(): Record<string, any> {
        return this.params;
    }
}

// Exports the class HttpFetchingRequest.
export default HttpFetchingRequest;