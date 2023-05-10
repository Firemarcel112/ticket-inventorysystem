@extends("layout.app")

@section("content")
    <h1 class="mb-12">{{ $pageTitle }}</h1>
    <div class="w-full mx-auto lg:mx-0 sm:w-[500px] sm:grid sm:grid-cols-2 sm:gap-2 sm:gap-16 mb-8">
        <div class="mb-6 w-52 h-fit p-6 bg-cyan-500 mx-auto">
            <p class="font-bold text-2xl text-white dark:text-white">{{ $countAssets }}</p>
            <p class="font-bold text-2xl text-white dark:text-white">Gegenstände</p>
            <a class="font-bold text-xl inline-flex text-white dark:text-white"
               href="{{ route("inventory.assets.dashboard") }}">alle ansehen
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white"
                     class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                </svg>
            </a>
        </div>
        <div class="mb-6 w-52 h-fit p-6 bg-yellow-500 mx-auto">
            <p class="font-bold text-2xl text-white dark:text-white">{{ $countLicenses }}</p>
            <p class="font-bold text-2xl text-white dark:text-white">Lizenzen</p>
            <a class="font-bold text-xl inline-flex text-white dark:text-white"
               href="{{ route("inventory.license.dashboard") }}">alle ansehen
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white"
                     class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                </svg>
            </a>
        </div>
    </div>
    <div class="flex-col-reverse flex xl:flex-row w-full">
        <div class="w-full xl:w-8/12 mb-4">
            @empty(!$activities)
                <div class="overflow-x-auto">
                    <div class="customTableWrapper">
                        <table class="w-full" role="table">
                            <thead role="rowgroup">
                            <tr role="row">
                                <th role="cell">Bearbeitet</th>
                                <th role="cell">Benutzer</th>
                                <th role="cell">Aktion</th>
                                <th role="cell">Objekt</th>
                            </tr>
                            </thead>
                            <tbody role="rowgroup">
                                @foreach($activities as $activity)
                                    <tr role="row">
                                        <td role="cell" data-label="Bearbeitet"><span>{{ date_format($activity['updated_at'], "d.m.Y H:i")  }} Uhr</span></td>
                                        <td role="cell" data-label="Benutzer"><span>{{ $activity['username']  }}</span></td>
                                        <td role="cell" data-label="Aktion"><span>{{ $activity['action']  }}</span></td>
                                        <td role="cell" data-label="Objekt"><span>{{ $activity['object']  }}</span></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            @endempty
        </div>


        <div class="m-auto w-10/12 lg:w-6/12 xl:w-3/12 h-full mt-12 mb-32">
            <div id="legendLabel">
                @foreach($assetstatuses as $status)
                    <div class="flex items-center">
                        <div class="w-4 h-4 mr-4" style="background-color: {{ $status['color'] }}"></div>
                        <span class="text-black dark:text-white">{{ $status->name }}</span>
                    </div>
                @endforeach
            </div>
            <canvas id="invChart" class="w-full" aria-label="Graphic, Prozent von Status bei den Assets" role="graph"></canvas>
        </div>
    </div>

    <script src="{{ asset('chartjs/dist/chart.js') }}"></script>
    <script type="text/javascript">
        const ctx = document.getElementById('invChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    @foreach($assetstatuses as $status)
                        "{{ $status->name }}",
                    @endforeach
                ],
                datasets: [{
                    label: 'Assets % bei Status',

                    data: [
                        @foreach($assetStatusCount as $item =>$status)
                            "{{ $status->count() }}",
                        @endforeach
                    ],

                    backgroundColor: [
                        @foreach($assetstatuses as $status)
                            "{{ $status->color }}",
                        @endforeach
                    ],
                    borderColor: 'black',
                    borderWidth: 1,
                    hoverBorderWidth: 2,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false,
                    }
                }
            }
        });
    </script>
@endsection
