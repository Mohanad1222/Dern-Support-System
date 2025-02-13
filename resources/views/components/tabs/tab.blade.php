@props(['route', 'text', 'isActive' => false,])

<a href="{{route($route)}}" class="nav-link {{ $isActive ? 'active' : '' }}">
    {{ $text }}
</a>
