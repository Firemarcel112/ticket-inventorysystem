<label for="{{ $inputName }}"
       @if($setRequired == 1 || $setRequired)
           class="requiredInput"
    @endif
>{{ $label }}</label>

<input
    class="inputTextCustom"
    name="{{ $inputName }}"
    id="{{ $inputName }}"
    type="{{ $inputType }}"
    placeholder="{{ $placeholder }}"
    value="{{ $value }}"
    @if($setRequired == 1 || $setRequired)
        required
    @endif
    @isset($patternValue)
        @if($patternValue != "")
            pattern="{{ $patternValue }}"
    @endif
    @endisset
@isset($extra)
    {{ $extra }}
    @endisset

/>

@isset($subText)
    <small class="subTextInput">{{ $subText }}</small>
@endisset
