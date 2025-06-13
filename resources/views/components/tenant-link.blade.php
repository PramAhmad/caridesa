@props(['route', 'params' => []])

@php
    try {
        $url = tenancy()->initialized 
            ? tenant_route(tenant('id'), $route, $params) 
            : route($route, $params);
    } catch (\Exception $e) {
        \Log::warning("Route error: {$e->getMessage()}");
        $url = '#'; // Fallback jika route tidak ditemukan
    }
@endphp

<a href="{{ $url }}" {{ $attributes }}>
    {{ $slot }}
</a>