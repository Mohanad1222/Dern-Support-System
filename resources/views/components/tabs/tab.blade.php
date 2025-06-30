@props(['route', 'text', 'isActive' => false,])

<a href="{{ route($route) }}"
   class="block px-4 py-2 rounded-lg transition {{ $isActive ? 'bg-blue-500/20 text-blue-300' : 'text-white hover:bg-white/10' }}">
   {{ $text }}
</a>
