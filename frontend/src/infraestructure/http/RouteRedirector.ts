class RouteRedirector {
    public static redirect(url: string): void {
        window.location.href = url;
    }
}

export default RouteRedirector;