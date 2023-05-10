<label for="{{ $inputName }}">{{ $label }} *</label>
<select class="w-full" id="{{ $inputName }}" name="{{ $inputName }}" required>
    @foreach($array as $content)
        @isset($hiddenOption)
            @if($hiddenOption != "")
                <option value="none" hidden selected>{{ $hiddenOption }}</option>
            @endif
        @endisset

        @isset($skipValue)
            @if(is_array($skipValue))
                @continue(in_array($content["id"],$skipValue));
            @endif
        @endisset
        @if($content["id"] == $compare)
            <option value="{{ $content["id"] }}" selected>{{ $content[$visibleValue] }} @isset($visibleValue2)
                    {{ $content[$visibleValue2] }}
                @endisset</option>
        @else
            <option value="{{ $content["id"] }}">{{ $content[$visibleValue] }} @isset($visibleValue2)
                    {{ $content[$visibleValue2] }}
                @endisset</option>
        @endif
    @endforeach
</select>

