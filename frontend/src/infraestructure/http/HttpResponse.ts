import HttpCode from "./HttpCode.js";

/**
 * The class HttpResponse represents a response component for the HTTP protocol.
 */
class HttpResponse {
    /**
     * Value data of the response.
     * @var any
     */
    private readonly data: any;

    /**
     * HTTP response status code.
     * @var HttpCode
     */
    private readonly code: HttpCode;

    /**
     * Default constructor of the class HttpResponse.
     * @param data Value data of the response.
     * @param code HTTP response status code.
     */
    public constructor(data: any, code: HttpCode){
        this.data = data;
        this.code = code;
    }

    /**
     * Returns the value data of the response.
     * @returns any
     */ 
    public getData(): any {
        return this.data;
    }

    /**
     * Returns the HTTP code of the response.
     * @return HttpCode 
     */ 
    public getStatus(): HttpCode {
        return this.code;
    }
}

// Exports the class HttpResponse.
export default HttpResponse;