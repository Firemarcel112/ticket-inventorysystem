<label for="{{ $inputName }}"
       @if($setRequired == 1 || $setRequired)
           class="requiredInput"
        @endif
>{{ $label }}</label>

<textarea
        class="{{ $customClasses }}"
        name="{{ $inputName }}"
        id="{{ $inputName }}"
        placeholder="{{ $placeholder }}"
        @if($setRequired == 1 || $setRequired)
            required
        @endif
>{{ $value }}
</textarea>
@isset($subText)
    <small class="subTextInput">{{ $subText }}</small>
@endisset
