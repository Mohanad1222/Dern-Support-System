@props(['name', 'isActive' => false])

<div class="tab-pane fade {{ $isActive ? 'show active' : '' }}" id="v-pills-{{$name}}" 
     role="tabpanel" aria-labelledby="v-pills-{{$name}}-tab">
    {{$slot}}
</div>
