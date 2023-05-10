@include("head", ["title" => "$pageTitle"])
<script>
    let html = document.querySelector('html');
    html.classList.remove('dark');
</script>


    <div style="padding: 5px;">
        @foreach($assets as $asset)
            <div class="qrcode" style="width: 30mm; height: 30mm; border: solid black 1mm; margin-bottom: 5px;">
                <p class="text-center text-black" style="font-size: 12px; line-height: 12px; padding-bottom: 1px">Sabine-Blindow Schule</p>
                <div class="flex justify-center">{!! DNS2D::getBarcodeHTML("https://it-assistant.de/inventarisierung/assets/info/{$asset['id']}", 'QRCODE', 2, 2) !!}</div>
                {{--            <p class="text-center text-black" style="font-size: 10px; line-height: 12px;">{{ $asset['modelName'] }} {{ $asset['manufacturerName'] }}</p>--}}
                <p class="text-center text-black" style="font-size: 12px; line-height: 14px;">{{ $asset['id'] }}</p>
            </div>


        @endforeach
    </div>

