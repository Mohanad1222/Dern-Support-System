@props(['name', 'isActive' => false])

<div id="v-pills-{{ $name }}"
     role="tabpanel"
     aria-labelledby="v-pills-{{ $name }}-tab"
     class="{{ $isActive ? 'show active' : '' }} transition duration-300 ease-in-out">
    {{ $slot }}
</div>
