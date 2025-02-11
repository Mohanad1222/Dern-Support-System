@props(['name', 'text', 'isActive' => false,])

<button class="nav-link {{ $isActive ? 'active' : '' }}" id="v-pills-{{$name}}-tab"
        data-bs-toggle="pill" data-bs-target="#v-pills-{{$name}}" type="button"
        role="tab" aria-controls="v-pills-{{$name}}" aria-selected="{{ $isActive ? 'true' : 'false' }}">
    {{ $text }}
</button>
