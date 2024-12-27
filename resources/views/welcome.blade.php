<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://usetrmnl.com/css/latest/plugins.css">
    <link rel="stylesheet" href="https://usetrmnl.com/js/latest/plugins.js">
    <title>TRMNL</title>
</head>
<body class="environment trmnl">
<div class="screen">
    <div class="view view--full">
        <div class="layout">
            <div class="columns">
                <div class="column">
                    {{--                    <div class="markdown">--}}
                    {{--                        <span class="title">Motivational Quote</span>--}}
                    {{--                        <div class="content content--center">“I love inside jokes. I hope to be a part of one someday.”</div>--}}
                    {{--                        <span class="label label--underline">Michael Scott</span>--}}
                    {{--                    </div>--}}
                    <table class="table">
                        <thead>
{{--                        @dd($journeys)--}}
                        <tr>
                            <th><span class="title">Plan</span></th>
                            <th><span class="title">Aktuell</span></th>
                            <th><span class="title">Zug</span></th>
                            <th><span class="title">Ziel</span></th>
                            <th><span class="title">Steig</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($journeys as $journey)
                            <tr>
                                <td><span class="label">{{ $journey->departure_time_planned }}</span></td>
                                @if($journey->cancelled)
                                    <td><span class="label label--inverted">{{ $journey->status }}</span></td>
                                @else
                                    <td><span class="label">{{ $journey->departure_time_est }}</span></td>
                                @endif
                                <td><span class="label {{ $journey->cancelled ? 'label--gray-out' : '' }}">{{ $journey->train_number }}</span></td>
                                <td><span class="label {{ $journey->cancelled ? 'label--gray-out' : '' }}">{{ $journey->destination_station }}</span></td>
                                <td><span class="label {{ $journey->cancelled ? 'label--gray-out' : '' }}">{{ $journey->track }}</span></td>

                            </tr>

                        @endforeach
{{--                        <tr>--}}
{{--                            <td><span class="label">Row 1, Cell 1</span></td>--}}
{{--                            <td>--}}
{{--                                <span class="label label--inverted">Ausfall</span>--}}
{{--                                <span class="label">Row 1, Cell 2</span>--}}
{{--                            </td>--}}
{{--                            <td><span class="label">Row 1, Cell 3</span></td>--}}
{{--                            <td><span class="label">Row 1, Cell 4</span></td>--}}
{{--                            <td><span class="label">Row 1, Cell 5</span></td>--}}
{{--                        </tr>--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="title_bar">
            <img class="image" src="https://usetrmnl.com/images/plugins/trmnl--render.svg"/>
            <span class="title">OEBB Monitor</span>
            <span class="instance">Aktueller Fahrplan</span>
        </div>
    </div>
</div>
</body>
</html>
