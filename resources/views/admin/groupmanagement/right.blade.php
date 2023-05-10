@isset($hasRight)
    <div>
        <div class="flex bg-gray-100 dark:bg-slate-600 dark:text-white text-black leading-8 px-2 py-1 dark:border-white border-black border-b-[1px]">
            <div class="w-[50%]">
                <label for="isadmin">{{ $label }}</label>
            </div>
            <div class="w-[25%] flex items-center flex items-center">
                <input type="radio" name="{{ $right }}" value='GRANT' @if($hasRight === 'GRANT') checked @endif class="w-[24px] h-[24px] mx-auto">
            </div>
            <div class="w-[25%] flex items-center">
                <input type="radio" name="{{ $right }}" value="DENY" @if($hasRight === 'DENY') checked @endif class="w-[24px] h-[24px] mx-auto ">
            </div>
        </div>
    </div>
@else
    <div>
        <div class="flex bg-gray-100 dark:bg-slate-600 dark:text-white text-black leading-8 px-2 py-1 dark:border-white border-black border-b-[1px]">
            <div class="w-[50%]">
                <label for="isadmin">{{ $label }}</label>
            </div>
            <div class="w-[25%] flex items-center flex items-center">
                <input type="radio" name="{{ $right }}" value="GRANT"
                class="w-[24px] h-[24px] mx-auto">
            </div>
            <div class="w-[25%] flex items-center">
                <input type="radio" name="{{ $right }}" value="DENY" checked
                       class="w-[24px] h-[24px] mx-auto ">
            </div>
        </div>
    </div>
@endisset
