import HttpCode from "./HttpCode.js";

class HttpResponse {
    private readonly data: any;
    private readonly code: HttpCode;

    public constructor(data: any, code: HttpCode){
        this.data = data;
        this.code = code;
    }

    public getData(): any {
        return this.data;
    }

    public getStatus(): HttpCode {
        return this.code;
    }
}

export default HttpResponse;