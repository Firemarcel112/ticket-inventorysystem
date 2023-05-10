@extends("layout.app")

@section("content")

    <div class="inventoryDboardWrapper">
        <div class="w-full px- h-fit pb-[40px]">
            <x-dashboard-navigation
                headline="{{ $pageTitle }}"
                searchPlaceholder="Personen suchen"
                createRoute="admin.usercreate"
                createTitle="Person erstellen"
            ></x-dashboard-navigation>
            <div>

                @empty(!$users)
                    <div class="overflow-x-auto">
                        <div class="customTableWrapper">
                            <table class="w-full" role="table">
                                <thead role="rowgroup">
                                <tr role="row">
                                    <th role="cell">Benutzername</th>
                                    <th role="cell">Email</th>
                                    <th role="cell">Aktionen</th>
                                </tr>
                                </thead>
                                <tbody role="rowgroup">
                                    @foreach($users as $user)
                                        <tr role="row">
                                            <td role="cell" data-label="Benutzername"><a href="{{ route("inventory.people.show", $user->id) }}" class="adminDashboardHyperLinks">{{ $user['username'] }}</a></td>
                                            <td role="cell" data-label="Email"><span>{{ $user['email'] }}</span></td>
                                            <td role="cell" data-label="Aktionen">
                                            @if(Rights::checkIfAnyRights(['isadmin']))
                                                <div class="actionsDiv">
                                                    <a tooltip="Bearbeiten" flow="left" href="{{ route("admin.useredit", $user->id) }}" title="bearbeiten">
                                                        @include("component.icon.edit")
                                                    </a>

                                                    @if(!in_array($user["id"], Config::SUPERUSERS))
                                                        <button tooltip="Löschen" flow="left" form="delete{{ $user->id }}" onclick="return confirm('Sind Sie sicher dass sie {{ $user->username }} löschen möchten')" title="löschen">
                                                            @include("component.icon.delete")
                                                        </button>
                                                    @endif
                                                </div>
                                            @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach($users as $content)
                                        @if(!in_array($user["id"], Config::SUPERUSERS))
                                            <div class="hidden">
                                                @if(Rights::checkIfAnyRights(['fullaccess', 'deleteasset']))
                                                    <form id="delete{{ $content->id }}" action="{{ route('users.destroy', $content->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                @endempty

            </div>

        </div>
    </div>

@endsection
