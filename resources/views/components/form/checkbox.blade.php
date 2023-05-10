<div class="mt-3 flex h-fit items-center gap-3">
    <input type="checkbox"
       name="{{$inputName}}"
       id="{{ $inputName  }}"
       @if(isset($value))
               @if($value)
                   checked
           @endif
       @endif
       @if(isset($setRequired))
               @if($setRequired)
                   required
           @endif
        @endif
    >
    <label for="{{ $inputName }}" style="padding-top: 0px;">{{ $label }}</label>

</div>
