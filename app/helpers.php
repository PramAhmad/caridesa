<?php

if (!function_exists('smart_route')) {
    /**
     * Generate a route URL based on current context (tenant or central)
     *
     * @param string $name Route name
     * @param array $parameters Route parameters
     * @return string
     */
    function smart_route($name, $parameters = [])
    {
        if (tenancy()->initialized) {
            return tenant_route(tenant('id'), $name, $parameters);
        }
        
        return route($name, $parameters);
    }
}