@extends("layout.app")

@section("content")

    <div id="benutzerverwaltungHeader" class="mt-4 ml-3 sm:mt-12 md:mt-16 mb-4">
        <x-dashboard-navigation
            headline="{{ $pageTitle }}"
            searchPlaceholder="Account suchen"
            createRoute="admin.usercreate"
            createTitle="Account erstellen"
            csv="1"
        ></x-dashboard-navigation>

    </div>


    <div id="benutzerverwaltungMain" class=" ml-3 mb-16 pl-8 bg-gray-300 dark:bg-slate-800 min-h-[500px] p-2 lg:p-4 w-[95%] sm:w-full">

        @foreach($users as $user)
            <div class="mb-8">
                <div class="block sm:flex sm:flex-wrap">
                    <div class="flex items-center w-[100%] sm:w-[80%]">
                        <div class="mr-[10px] bg-main dark:bg-green-200 p-2 md:p-6 text-2xl text-black h-[40px] w-[40px] flex justify-center items-center font-bolder rounded-full">{{ substr($user->username, 0, 1) }}</div>
                        <p class="inline-block text-xl sm:text-2xl lg:text-3xl font-bold break-all max-w-[70%] sm:max-w-[85%]">{{ $user->username  }}</p>
                    </div>
                    <div class="mt-2 flex sm:mt-0 sm:ml-auto">
                        @if(Rights::checkIfAnyRights(['isadmin']))
                            <td class="z-20">
                                <div class=" gap-2 lg:gap-8 h-full py-1 items-center flex justify-center">
                                    <a tooltip="Bearbeiten" flow="left" href="{{ route("admin.useredit", $user->id) }}" title="bearbeiten">
                                        @include("component.icon.edit")
                                    </a>
                                    @if(!in_array($user["id"], Config::SUPERUSERS))
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="h-[32px]">
                                            @csrf
                                            @method('DELETE')
                                            <button tooltip="Löschen" flow="left" onclick="return confirm('Sind Sie sicher dass sie {{ $user->username }} löschen möchten')"
                                               title="löschen">
                                                @include("component.icon.delete")
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
