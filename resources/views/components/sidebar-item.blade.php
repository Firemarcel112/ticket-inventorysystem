@if($dropdown != 2)

    <li @if($dropdown != 1) class="navItem" @endif>
        <a href="{{ route($route) }}" class="@if($dropdown == 1)navLinkDropdown @else navLink @endif
        @empty(!request()->route()){{ request()->route()->getName() == $route ? 'active' : '' }}  @endempty">
            <span class="iconBox">
                <img src="{{ asset("images/icon/$icon.svg") }}" alt="{{ $icon }} Icon" class="icon">
            </span>
            <p class="navText">{{ $name }}</p>

        </a>
    </li>

@else

    <a class="cursor-pointer navLink" onclick="openMenu('{{ $menuID }}')">
                    <span class="iconBox">
                        <img class="icon" src="{{ asset("images/icon/$icon.svg") }}" alt="{{ $icon }} Icon">
                    </span>
        <p class="navText">{{ $name }} <img class="inline ml-1 w-4 h-4" src="{{ asset("images/icon/arrow.svg") }}"
                                            alt="arrow Icon">
        </p>
    </a>
@endif

@php
    /*
     * dropdown default = Normale Ansicht im Menü
     * dropdown 1 = DropdownItem
     * dropdown 2 = DropdownMenüpunkt
     * */
@endphp
