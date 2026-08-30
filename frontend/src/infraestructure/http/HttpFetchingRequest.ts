import HttpMethod from "./HttpMethod.js";

class HttpFetchingRequest {
    private readonly method: HttpMethod;
    private readonly query: string;
    private readonly params: Record<string, any>;

    public constructor(method: HttpMethod, query: string, params: Record<string, any> = []){
        this.method = method;
        this.query = query;
        this.params = params;
    }

    public getMethod(): HttpMethod {
        return this.method;
    }

    public getQuery(): string {
        return this.query;
    }

    public getParams(): Record<string, any> {
        return this.params;
    }
}

export default HttpFetchingRequest;