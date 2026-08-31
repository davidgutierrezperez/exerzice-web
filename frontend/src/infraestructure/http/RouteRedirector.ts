/**
 * The class RouteRedirector represents a HTTP component for route redirecting.
 */
class RouteRedirector {

    /**
     * Redirects the user to another page.
     * @param url Location of the page.
     * @return void
     */
    public static redirect(url: string): void {
        window.location.href = url;
    }
}

// Exports the class RouteRedirector.
export default RouteRedirector;