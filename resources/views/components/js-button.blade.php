<button @empty(!$disabled) disabled="{{ $disabled }}" @endempty @empty(!$id) id="{{ $id }}" @endempty class="{{ $parameters }} btn group bg-gradient-to-br from-{{ $color1 }} to-{{ $color2 }}">
    <span @empty(!$confirm) onclick="return confirm('{!! $confirm !!}')" @endempty class="w-full group-hover:bg-opacity-0">{!! $content !!}</span>
</button>
