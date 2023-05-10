@extends('layout.app')

@section('content')
    <div id="logs">

        <h1 class="mb-8">Logs | Administration</h1>

        @foreach($logs as $log)
            @php $created = Time::formatDate($log['created_at'], 'd.m.Y | H:i') . ' Uhr'; @endphp
            <p class="text-xl my-2">Benutzer {{ $log['username'] }} hat {{ $log['action'] }}: {{ $log['object'] }}.{{ $log['tablename'] }} {{ $created }}</p>
            <hr class="my-5">
        @endforeach
        @if($logs->hasPages())
            <div class="pagination flex items-center">
                <a>{{ $logs->links() }}</a>
            </div>
        @endif

    </div>
@endsection
