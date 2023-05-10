@extends("layout.app")

@section("content")
    <div class="ml-4 sm:ml-0 mb-8">
        <div id="BearbeitenHeader" class="mt-4 sm:mt-12 md:mt-16 mb-4">
            <div class="w-full">
                <h1 class="sm:ml-2 inline-block text-xl sm:text-3xl">{{ $pageTitle }}</h1>
            </div>
        </div>

        <div id="BearbeitenMain">
            <form class="userEdit w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%]" method="post" action="{{route('usereditPost', $user->id)}}">
                @csrf
                <x-form.input
                    label="Benutzername"
                    inputName="username"
                    inputType="text"
                    placeholder="Benutzername eingeben"
                    :value="$user->username"
                    setRequired="1"
                ></x-form.input>

                <x-form.input
                    label="E-Mail"
                    inputName="email"
                    inputType="email"
                    placeholder="E-Mail eingeben"
                    :value="$user->email"
                    setRequired="1"
                ></x-form.input>

                <label for="password">Passwort</label>
                <div class="relative">
                    <div class="absolute right-2 top-3 pr-0 cursor-pointer w-8 h-8" onclick="togglePW('password', 'svgPW')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"  class="w-8 h-8">
                            <path class="stroke-black dark:stroke-white dark:fill-white" id="svgPW" d="M11 44q-1.25 0-2.125-.875T8 41V19.3q0-1.25.875-2.125T11 16.3h3.5v-4.8q0-3.95 2.775-6.725Q20.05 2 24 2q3.95 0 6.725 2.775Q33.5 7.55 33.5 11.5v4.8H37q1.25 0 2.125.875T40 19.3V41q0 1.25-.875 2.125T37 44Zm0-3h26V19.3H11V41Zm13-7q1.6 0 2.725-1.1t1.125-2.65q0-1.5-1.125-2.725T24 26.3q-1.6 0-2.725 1.225T20.15 30.25q0 1.55 1.125 2.65Q22.4 34 24 34Zm-6.5-17.7h13v-4.8q0-2.7-1.9-4.6Q26.7 5 24 5q-2.7 0-4.6 1.9-1.9 1.9-1.9 4.6ZM11 41V19.3 41Z"/>
                        </svg>
                    </div>
                    <input name="password" id="password" type="password" class="w-full" placeholder="Passwort eingeben" />
                </div>
                <label for="password_confirmation">Passwort bestätigen</label>
                <div class="relative">
                    <div class="absolute right-2 top-3 pr-0 cursor-pointer w-8 h-8" onclick="togglePW('password_confirmation', 'svgPWRepeat')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"  class="w-8 h-8">
                            <path class="stroke-black dark:stroke-white dark:fill-white" id="svgPWRepeat" d="M11 44q-1.25 0-2.125-.875T8 41V19.3q0-1.25.875-2.125T11 16.3h3.5v-4.8q0-3.95 2.775-6.725Q20.05 2 24 2q3.95 0 6.725 2.775Q33.5 7.55 33.5 11.5v4.8H37q1.25 0 2.125.875T40 19.3V41q0 1.25-.875 2.125T37 44Zm0-3h26V19.3H11V41Zm13-7q1.6 0 2.725-1.1t1.125-2.65q0-1.5-1.125-2.725T24 26.3q-1.6 0-2.725 1.225T20.15 30.25q0 1.55 1.125 2.65Q22.4 34 24 34Zm-6.5-17.7h13v-4.8q0-2.7-1.9-4.6Q26.7 5 24 5q-2.7 0-4.6 1.9-1.9 1.9-1.9 4.6ZM11 41V19.3 41Z"/>
                        </svg>
                    </div>
                    <input name="password_confirmation" id="password_confirmation" type="password" class="w-full" placeholder="Passwort eingeben" />
                </div>

                <x-form.select
                    label="Gruppe zuweisen"
                    inputName="groupAdd"
                    :compare="NULL"
                    :array="$existsGroups"
                    visibleValue="gruppe"
                    hiddenOption="Wählen Sie eine Gruppe"
                ></x-form.select>

                <x-form.select
                    label="Gruppe entfernen"
                    inputName="groupRemove"
                    :compare="NULL"
                    :array="$groups"
                    visibleValue="gruppe"
                    hiddenOption="Wählen Sie eine Gruppe"
                    :skipValue="Config::NONREMOVABLEGROUPS"
                ></x-form.select>

                <div class="flex gap-4 md:gap-12 mt-4 w-full">
                    <x-button content="Speichern" colorType="success"></x-button>
                    <x-button type="1" :link="route('admin.usermanagement')" content="Abbrechen" colorType="danger"></x-button>
                </div>

            </form>
        </div>
    </div>
@endsection
