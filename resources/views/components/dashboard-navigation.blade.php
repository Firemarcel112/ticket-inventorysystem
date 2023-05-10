<div class="mt-4 sm:mt-12 md:mt-16 mb-4">
    <div class="w-full lg:flex">
        <h1 class="text-center lg:text-left inline-block text-3xl sm:text-4xl mb-2 ">{{ $headline }}</h1>
        <div class="ml-auto md:mt-0 flex gap-1 md:gap-4 items-center">
            <form class="w-full">
                <div
                    class="rounded  flex items-center w-full lg:w-full max-w-xl mr-4 p-2 shadow-sm border border-black dark:border-white bg-gray-200 dark:bg-slate-700">
                    <div class="border-r-2 border-black dark:border-white h-6 pr-2">
                        <button class="outline-none focus:outline-none w-4 md:w-6 aspect-square">
                            <svg class="w-full text-gray-600 h-full cursor-pointer stroke-black dark:stroke-white"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                    <input type="search" name="search" id="" placeholder="{{ $searchPlaceholder }}"
                    @empty(!request()->get('search')) value="{{ request()->get('search') }}" @endempty
                           class="w-full pl-3  text-sm text-green text-black dark:text-white placeholder:text-slate-900 placeholder:dark:text-gray-100 outline-none focus:outline-none bg-transparent"/>
                </div>
            </form>

            @if($qrcode)
            <button
                class="h-8 aspect-square outline outline-[1px] outline-gray-900 bg-gray-500 hover:opacity-70 transition-all"
                    title="QR-Code generieren" form="qrFORM" onclick="changeFormRoute('qrcode')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-full h-full stroke-black fill-transparent dark:stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z"/>
                </svg>
            </button>
            @endif
            @if($delete)
            <button
                class="h-8 aspect-square outline outline-[1px] outline-gray-900 bg-gray-500 hover:opacity-70 transition-all"
                    title="Objekte Löschen" form="deleteMultiple" onclick="changeFormRoute('delete')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full stroke-black fill-transparent dark:stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </button>
            @endif
            @if($csv)
                <a href="{{ route("admin.importuser") }}" title="CSV Importieren"
                class="h-8 aspect-square outline outline-[1px] outline-gray-900 bg-gray-500 hover:opacity-70 transition-all">
                    <svg stroke="currentColor" fill="currentColor" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">

                        <g id="xxx-word">

                            <path class="cls-1" d="M325,105H250a5,5,0,0,1-5-5V25a5,5,0,1,1,10,0V95h70a5,5,0,0,1,0,10Z"/>
                            <path class="cls-1" d="M325,154.83a5,5,0,0,1-5-5V102.07L247.93,30H100A20,20,0,0,0,80,50v98.17a5,5,0,0,1-10,0V50a30,30,0,0,1,30-30H250a5,5,0,0,1,3.54,1.46l75,75A5,5,0,0,1,330,100v49.83A5,5,0,0,1,325,154.83Z"/>
                            <path class="cls-1" d="M300,380H100a30,30,0,0,1-30-30V275a5,5,0,0,1,10,0v75a20,20,0,0,0,20,20H300a20,20,0,0,0,20-20V275a5,5,0,0,1,10,0v75A30,30,0,0,1,300,380Z"/>
                            <path class="cls-1" d="M275,280H125a5,5,0,1,1,0-10H275a5,5,0,0,1,0,10Z"/>
                            <path class="cls-1" d="M200,330H125a5,5,0,1,1,0-10h75a5,5,0,0,1,0,10Z"/>
                            <path class="cls-1" d="M325,280H75a30,30,0,0,1-30-30V173.17a30,30,0,0,1,30-30h.2l250,1.66a30.09,30.09,0,0,1,29.81,30V250A30,30,0,0,1,325,280ZM75,153.17a20,20,0,0,0-20,20V250a20,20,0,0,0,20,20H325a20,20,0,0,0,20-20V174.83a20.06,20.06,0,0,0-19.88-20l-250-1.66Z"/>
                            <path class="cls-1" d="M168.48,217.48l8.91,1a20.84,20.84,0,0,1-6.19,13.18q-5.33,5.18-14,5.18-7.31,0-11.86-3.67a23.43,23.43,0,0,1-7-10,37.74,37.74,0,0,1-2.46-13.87q0-12.19,5.78-19.82t15.9-7.64a18.69,18.69,0,0,1,13.2,4.88q5.27,4.88,6.64,14l-8.91.94q-2.46-12.07-10.86-12.07-5.39,0-8.38,5t-3,14.55q0,9.69,3.2,14.63t8.48,4.94a9.3,9.3,0,0,0,7.19-3.32A13.25,13.25,0,0,0,168.48,217.48Z"/>
                            <path class="cls-1" d="M179.41,223.15l9.34-2q1.68,7.93,12.89,7.93,5.12,0,7.87-2a6.07,6.07,0,0,0,2.75-5,7.09,7.09,0,0,0-1.25-4q-1.25-1.85-5.35-2.91l-10.2-2.66a25.1,25.1,0,0,1-7.73-3.11,12.15,12.15,0,0,1-4-4.9,15.54,15.54,0,0,1-1.5-6.76,14,14,0,0,1,5.31-11.46q5.31-4.32,13.59-4.32a24.86,24.86,0,0,1,12.29,3,13.56,13.56,0,0,1,6.89,8.52l-9.14,2.27q-2.11-6.05-9.84-6.05-4.49,0-6.86,1.88a5.83,5.83,0,0,0-2.36,4.77q0,4.57,7.42,6.41l9.06,2.27q8.24,2.07,11.05,6.11a15.29,15.29,0,0,1,2.81,8.93,14.7,14.7,0,0,1-5.92,12.36q-5.92,4.51-15.33,4.51a28,28,0,0,1-13.89-3.32A16.29,16.29,0,0,1,179.41,223.15Z"/>
                            <path class="cls-1" d="M250.31,236h-9.77L224.1,182.68h10.16l12.23,40.86L259,182.68h8Z"/>

                        </g>

                    </svg>
                </a>
            @endif
            @if($create)
                <a @empty(!$createRoute) href="{{ route($createRoute) }}" @endempty  @empty(!$createTitle) title="{{ $createTitle }}" @endempty
                   class="h-8 aspect-square outline outline-[1px] outline-gray-900 bg-gray-500 hover:opacity-70 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-full h-full">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                </a>
            @endif

        </div>
    </div>
</div>
