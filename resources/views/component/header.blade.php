
@section("searchbar")
    <div class="bg-white rounded flex items-center w-full max-w-xl mr-4 p-2 shadow-sm border border-gray-200">
        <button class="outline-none focus:outline-none">
            <svg class="w-5 text-gray-600 h-5 cursor-pointer" fill="none" stroke-linecap="round" stroke-linejoin="round"
                 stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>
        <input type="search" name="" id="" placeholder="Search"
               class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent"/>
    </div>
@endsection

<header>

    <div class="header--logo">
        <a href="{{ route("index") }}">
            <img src="{{ asset('secure_dnt/logo.png') }}" alt="Logo der {{ Config::COMPANYNAME }}">
            <span>{{ Config::COMPANYNAME }}</span>
        </a>
    </div>

    <div class="header--user">
        @guest
            <a href="{{ route("login") }}" class="header--login">Anmelden</a>
        @endguest
        @auth
                @if(Rights::checkIfAnyRights(['accesslicense']))
                    <div class="relative notificationMenu" onclick="openMenu('notification')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="bell" viewBox="0 0 24 24" fill="none"
                             stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>

                        @php $results = Notification::notificationBell() @endphp
                        @if(count($results) >= 1)
                            <span class="notificationCount">{{ count($results) }}@if(count($results) < $results[0]['totalLicenses'])
                                    <span class="text-[12px] relative bottom-2">+</span>
                                @endif</span>
                            <div id="notification" class="notification hidden flex flex-col p-2">
                                <div class="flex justify-between text-lg dark:text-white text-black font-bold">
                                    <span>Lizenzname</span>
                                    <span>Läuft ab in</span>
                                </div>
                                @foreach($results as $result)
                                    <div class="flex justify-between">
                                        <a class="text-base"
                                           href="{{ route("inventory.license.show", $result["id"]) }}">{{ $result['name'] }}</a>
                                        @if($result['expiredTime'] <= 0)
                                            <span class="text-red-600">Abgelaufen</span>
                                        @else
                                            <span class="dark:text-white text-black">
                                                {{ floor($result['expiredTime']) }} {{ $result['expiredTime'] == 1 ? 'Tag' : 'Tagen' }}
                                            </span>
                                        @endif
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                <div class="profileIcon">
                    <span>{{ substr(Auth::user()->username, "0", "1") }}</span>
                </div>
                <a href="{{ route("user.settings", Auth::user()->id) }}" class="user">
                    <span class="username">{{ Auth::user()->username }}</span>
                </a>
        @endauth
    </div>
</header>

