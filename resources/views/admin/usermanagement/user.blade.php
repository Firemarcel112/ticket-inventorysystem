@section("user")
    <div class="mb-8">
        <div class="sm:grid sm:grid-cols-2 p-2">
            <div class="flex items-center">
                <div class="mr-[10px] bg-main dark:bg-green-200 p-2 md:p-6 text-2xl text-black dark:text-white h-[40px] w-[40px] flex justify-center items-center font-bolder rounded-full">{{ substr($user['username'], 0, 1) }}</div>
                <div>
                    <p class="inline-block text-xl sm:text-2xl lg:text-3xl font-bold">{{ $user["username"]  }}</p>
                </div>
            </div>
            <div class="mt-2 flex sm:mt-0 sm:ml-auto">
                <div class="grid grid-cols-2 gap-4 md:gap-4 lg:gap-8 h-full items-center">
                    <div class="w-24 md:w-28 lg:w-36 h-10">
                        {{-- TODO ADD id into route as Parameter $user["id]--}}
                        <a href="{{ route("admin.useredit", [$user['username']]) }}" class="w-full h-full p-0.5 flex items-center justify-center text-xl font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-orange-600 to-orange-300 hover:text-white dark:text-white">
                            <span class="w-full h-full text-base md:text-xl flex justify-center items-center transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                Bearbeiten
                            </span>
                        </a>
                    </div>
                    @if($user["username"] != "Administrator")
                        <div class="w-24 md:w-28 lg:w-36 h-10">
                            <a onclick="return confirm('Sind Sie sicher dass sie {{ $user["username"] }} löschen möchten')" href="{{ route("userdelete", [$user["id"]]) }}" class="w-full h-full p-0.5 flex items-center justify-center text-xl font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-600 to-red-300 hover:text-white dark:text-white">
                                <span class="w-full h-full text-base md:text-xl flex justify-center items-center transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    Löschen
                                </span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
