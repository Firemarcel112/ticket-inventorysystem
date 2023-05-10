                        @extends('layout.app')

@section('content')

    <div class="inventoryDboardWrapper">
        <div class="w-full px- h-fit pb-[40px]">
            <x-dashboard-navigation
                headline="{{ $pageTitle }}"
                searchPlaceholder="Kategorien suchen"
                createRoute="ticket.categories.create"
                createTitle="Kategorie erstellen"
            ></x-dashboard-navigation>
            @empty(!$categories)
                <div class="overflow-x-auto">
                    <div class="customTableWrapper">
                        <table class="w-full" role="table">
                            <thead role="rowgroup">
                                <tr role="row">
                                    <th role="cell">Name</th>
                                    <th role="cell">Aktionen</th>
                                </tr>
                            </thead>
                            <tbody role="rowgroup">
                                @foreach($categories as $category)
                                    <tr role="row">
                                        <td role="cell" data-label="Name"><span>{{ $category->name }}</span></td>
                                        <td role="cell" data-label="Aktionen">
                                            <div class="actionsDiv">
                                                @if(Rights::checkIfAnyRights(['ticketaccess', 'modifyticketcategories']))
                                                    <a tooltip="Bearbeiten" flow="left" href="{{ route("ticket.categories.edit", $category->id) }}" title="bearbeiten">
                                                        @include("component.icon.edit")
                                                    </a>
                                                @endif
                                                @if(Rights::checkIfAnyRights(['ticketaccess', 'deleteticketcategories']))
                                                    <button tooltip="Löschen" flow="left" form="delete{{ $category['id'] }}" onclick="return confirm('Sind Sie sicher dass sie Kategorie {{ $category->name }} löschen möchten')" title="löschen">
                                                        @include("component.icon.delete")
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach($categories as $content)
                                    <div class="hidden">
                                        @if(Rights::checkIfAnyRights(['ticketaccess', 'deleteticketcategories']))
                                            <form id="delete{{ $content->id }}" action="{{ route('ticketcategories.destroy', $content->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            @endempty

        </div>
    </div>

@endsection
