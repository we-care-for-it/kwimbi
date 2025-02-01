<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    @if($getRecord()->gps_imei)
    <iframe width="100%" height="200" src="https://maps.google.com/maps?q={{$getRecord()->GpsDataLatestLocation->lat}}, {{$getRecord()->GpsDataLatestLocation->lng}}&output=embed"></iframe>
    @else
        <center>Geen GPS tracker gekoppeld</center>
    @endif
</x-dynamic-component>
