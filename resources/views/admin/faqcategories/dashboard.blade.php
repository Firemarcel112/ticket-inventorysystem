@extends("layout.app")

@section("content")

    <x-dashboard-navigation
        headline="{{ $pageTitle }}"
        searchPlaceholder="FAQ Kategorie suchen"
        createRoute="admin.faqcategories.create"
        createTitle="Kategorie Erstellen"
    ></x-dashboard-navigation>
    @empty(!$categories)
        <div class="overflow-x-auto">
            <div class="customTableWrapper">
                <table class="w-full" role="table">
                    <thead role="rowgroup">
                    <tr role="row">
                        <th role="cell">Kategorie</th>
                        <th role="cell">Aktionen</th>
                    </tr>
                    </thead>
                    <tbody role="rowgroup">
                        @foreach($categories as $category)
                            <tr role="row">
                                <td role="cell" data-label="Kategorie"><span>{{ $category['name'] }}</span></td>
                                @if(Rights::checkIfAnyRights(['isadmin', 'managefaq']))
                                    <td role="cell" data-label="Aktionen">
                                        <div class="actionsDiv">
                                            <a tooltip="Bearbeiten" flow="left" href="{{ route("admin.faqcategories.edit", ["id" => $category["id"]]) }}" title="bearbeiten">
                                                @include("component.icon.edit")
                                            </a>
                                            <button tooltip="Löschen" flow="left" form="delete{{ $category['id'] }}" onclick="return confirm('Sind Sie sicher dass sie die Kategorie: {{ $category["name"] }} löschen möchten')" title="löschen">
                                                @include("component.icon.delete")
                                            </button>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        @foreach($categories as $content)
                            <div class="hidden">
                                @if(Rights::checkIfAnyRights(['isadmin', 'managefaq']))
                                    <form id="delete{{ $content->id }}" action="{{ route('faqcategories.destroy', $content->id) }}" method="post">
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
    @endif


@endsection
