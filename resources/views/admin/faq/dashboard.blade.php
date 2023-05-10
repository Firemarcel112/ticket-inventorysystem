@extends("layout.app")

@section("content")

    <x-dashboard-navigation
        headline="{{ $pageTitle }}"
        searchPlaceholder="FAQ Eintrag suchen"
        createRoute="admin.faqnew"
        createTitle="FAQ erstellen"
    ></x-dashboard-navigation>

    @empty(!$categories)
        <div class="overflow-x-auto">
            <div class="customTableWrapper">
                <table class="w-full" role="table">
                    <thead role="rowgroup">
                    <tr role="row">
                        <th role="cell">Titel</th>
                        <th role="cell">Kategorie</th>
                        <th role="cell">Aktionen</th>
                    </tr>
                    </thead>
                    <tbody role="rowgroup">
                    @foreach($categories as $category)
                        @foreach($contents as $content)
                            @if($content["faq_category_id"] == $category["id"])
                                <tr>
                                    <td role="cell" data-label="Titel">{{ $content["title"] }}</td>
                                    <td role="cell" data-label="Kategorie">{{ $category["name"] }}</td>
                                    <td role="cell" data-label="Aktionen">
                                        <div class="actionsDiv">
                                            <a tooltip="Bearbeiten" flow="left" href="{{ route("admin.faqedit", ["id" => $content["id"]]) }}" title="bearbeiten">
                                                @include("component.icon.edit")
                                            </a>
                                            <button tooltip="Löschen" flow="left" form="delete{{ $content['id'] }}" onclick="return confirm('Sind Sie sicher dass sie den Eintrag: {{ $content["title"] }} löschen möchten')"  title="löschen">
                                                @include("component.icon.delete")
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                    @foreach($contents as $content)
                        <div class="hidden">
                            @if(Rights::checkIfAnyRights(['isadmin', 'managefaq']))
                                <form id="delete{{ $content->id }}" action="{{ route('faq.destroy', $content->id) }}" method="post">
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

@endsection
