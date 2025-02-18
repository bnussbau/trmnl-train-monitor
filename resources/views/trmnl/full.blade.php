<x-trmnl::view>
    <x-trmnl::layout>
        <x-trmnl::table>
            <thead>
            <tr>
                <th>
                    <x-trmnl::title>Abfahrt</x-trmnl::title>
                </th>
                <th>
                    <x-trmnl::title>Aktuell</x-trmnl::title>
                </th>
                <th>
                    <x-trmnl::title>Zug</x-trmnl::title>
                </th>
                <th>
                    <x-trmnl::title>Ziel</x-trmnl::title>
                </th>
                <th>
                    <x-trmnl::title>Steig</x-trmnl::title>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($journeys as $journey)
                <tr>
                    <td>
                        <x-trmnl::label>{{ $journey->departure_time_planned }}</x-trmnl::label>
                    </td>
                    @if($journey->cancelled)
                        <td>
                            <x-trmnl::label variant="inverted">{{ $journey->status }}</x-trmnl::label>
                        </td>
                    @else
                        <td>
                            <x-trmnl::label>{{ $journey->departure_time_est }}</x-trmnl::label>
                        </td>
                    @endif
                    <td>
                        <x-trmnl::label
                            variant="{{ $journey->cancelled ? 'gray-out' : '' }}">{{ $journey->train_number }}</x-trmnl::label>
                    </td>
                    <td>
                        <x-trmnl::label
                            variant="{{ $journey->cancelled ? 'gray-out' : '' }}">{{ $journey->destination_station }}</x-trmnl::label>
                    </td>
                    <td>
                        <x-trmnl::label
                            variant="{{ $journey->cancelled ? 'gray-out' : '' }}">{{ $journey->track }}</x-trmnl::label>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </x-trmnl::table>
    </x-trmnl::layout>
    <x-trmnl::title-bar title="{{config('services.oebb.station_name')}}" image="oebb_logo.svg"
                        instance="aktualisiert: {{now()}}"/>
</x-trmnl::view>
