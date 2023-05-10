@if($dropdown == 0)
    <li class="navItem">
        <a href="{{ route("$route") }}" class="navLink {{ request()->routeIs("$route") ? "active" : "" }}">
                        <span class="iconBox">
                            <img class="icon" src="{{ asset("images/icon/$icon.svg") }}" alt="{{ $icon }} Icon">
                        </span>
            <p class="navText">{{ $name }}</p>
        </a>
    </li>
@endif

@if($dropdown == 1)
    <li>
        <a href="{{ route("$route") }}" class="navLinkDropdown {{ request()->routeIs("$route") ? "active" : "" }}">
                        <span class="iconBox">
                            <img class="icon" src="{{ asset("images/icon/$icon.svg") }}" alt="{{ $icon }} Icon">
                        </span>
            <p class="navText">{{ $name }}</p>
        </a>
    </li>
@endif

@if($dropdown == 2)
    <a class="cursor-pointer navLink" onclick="openMenu('{{ $menuID }}')">
                    <span class="iconBox">
                        <img class="icon" src="{{ asset("images/icon/$icon.svg") }}" alt="{{ $icon }} Icon">
                    </span>
        <p class="navText">{{ $name }} <img class="inline ml-1 w-4 h-4" src="{{ asset("images/icon/arrow.svg") }}" alt="arrow Icon">
        </p>
    </a>
@endif