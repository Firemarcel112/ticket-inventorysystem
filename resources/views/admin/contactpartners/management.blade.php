@extends("layout.app")

@section("content")
    <div id="benutzerverwaltungHeader" class="mt-4 sm:mt-12 md:mt-16 mb-4 ml-3">
        <x-dashboard-navigation
            headline="{{ $pageTitle }}"
            searchPlaceholder="Ansprechpartner suchen"
            createRoute="admin.contactcreate"
            createTitle="Ansprechpartner erstellen"
        ></x-dashboard-navigation>
    </div>


    <div id="gruppenverwaltungMain" class="mb-16 ml-3 pl-8 bg-gray-300 dark:bg-slate-800 min-h-[500px] p-2 lg:p-4 w-[95%] sm:w-full">
        @empty(!$contactPartners)
            @foreach($contactPartners as $user)
                <div class="mb-8">
                    <div class="block sm:flex sm:flex-wrap">
                        <div class="flex items-center w-[100%] sm:w-[80%]">
                            <div class="rounded-full w-12 h-12 bg-cover mr-4" style="background-image: url( {{ asset($user->imagepath) }})"></div>
                            <p class="block text-xl sm:text-2xl lg:text-3xl font-bold break-all max-w-[70%] sm:max-w-[85%]">{{ $user->firstname  }} {{ $user->lastname }}</p>
                        </div>
                        <div class="mt-2 flex sm:mt-0 sm:ml-auto">
                            @if(Rights::checkIfAnyRights(['isadmin']))
                                <td class="z-20">
                                    <div class=" gap-2 lg:gap-8 h-full py-1 items-center flex justify-center">
                                        <a tooltip="Bearbeiten" flow="left" href="{{ route("admin.contactedit", $user->id) }}" title="bearbeiten">
                                            @include("component.icon.edit")
                                        </a>
                                        <form action="{{ route('contactpartners.destroy', $user->id) }}" method="POST"  class="h-[32px]">
                                            @csrf
                                            @method('DELETE')
                                            <button tooltip="Löschen" flow="left" onclick="return confirm('Sind Sie sicher dass sie {{ $user->firstname }} löschen möchten')"
                                                    title="löschen">
                                                @include("component.icon.delete")
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif

                        </div>
                    </div>
                </div>

            @endforeach

        @endempty
    </div>
@endsection
