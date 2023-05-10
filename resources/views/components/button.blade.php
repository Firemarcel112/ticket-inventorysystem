@php
    $color = [
        'primary' => [
            'from' => 'from-blue-600',
            'to' => 'to-blue-300',
            'border' => 'border-blue-600',
            'borderH' => 'hover:border-blue-300',
        ],

        'danger' => [
            'from' => 'from-red-600',
            'to' => 'to-red-300',
            'border' => 'border-red-600',
            'borderH' => 'hover:border-red-300',
        ],

        'success' => [
            'from' => 'from-green-600',
            'to' => 'to-green-300',
            'border' => 'border-green-600',
            'borderH' => 'hover:border-green-300',
        ],
    ]
 @endphp

@empty($type)
    <button @empty(!$click) onclick="{{ $click }}" @endempty @empty(!$id) name="{{ $id }}" @endempty
    @empty(!$disabled) disabled @endempty @empty(!$id)
        id="{{ $id }}" @endempty
            class="btn border-2 {{ $color[$colorType]['border'] }} {{ $color[$colorType]['borderH'] }} group bg-gradient-to-br {{ $color[$colorType]['from'] }} {{ $color[$colorType]['to'] }}
            @empty(!$btnClasses) {{ $btnClasses }} @endempty">
        <span @empty(!$jsConfirm) onclick="return confirm('{{ $jsConfirm }}')" @endempty
        class="bg-white group-hover:bg-opacity-0 @empty(!$spanClass) {{ $spanClass }} @endempty">

            <p @empty(!$contentClass) class="{{ $contentClass }}" @endempty>{!! $content !!}</p>
        </span>
    </button>
@else
    <span @empty(!$id) id="{{ $id }}" @endempty class="@empty(!$btnClasses) {{ $btnClasses }} @endempty btn border-2 {{ $color[$colorType]['border'] }} {{ $color[$colorType]['borderH'] }} group group-hover:bg-opacity-0 bg-gradient-to-br {{ $color[$colorType]['from'] }} {{ $color[$colorType]['to'] }}"

    @empty(!$jsConfirm) onclick="return confirm('{{ $jsConfirm }}')"
    @endempty>
        <a class="bg-white group-hover:bg-opacity-0" @empty(!$link)href="{{ $link }}"@endempty>
            <span @empty(!$contentClass) class="{{ $contentClass }}" @endempty>{{ $content }}</span></a>
    </span>


@endempty

@php

       /**
        * Button
        *  colorCodes (background und hover)
        * Optionale Klassen
        * name
        * disabled
        *
        * A href link
        * colorCodes
        * optionale KLASSEN
        * name
        * javascript function
        * disabled
        */

@endphp
