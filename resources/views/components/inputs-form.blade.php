@props(['method' => 'POST', 'action' => '', 'class' => '', 'enctype' => false])

@php
    $allowedMethods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];
    $method = strtoupper($method);
    $formMethod = in_array($method, ['GET', 'POST']) ? $method : 'POST';
@endphp

<form method="{{ $formMethod }}" action="{{ $action }}" {!! $enctype ? 'enctype="multipart/form-data"' : '' !!} {{ $attributes->merge(['class' => $class]) }}>
    @csrf
    
    @if(!in_array($method, ['GET', 'POST']))
        @method($method)
    @endif
    
    {{ $slot }}
</form>