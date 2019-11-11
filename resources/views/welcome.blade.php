<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <body>
        <ul>
            @foreach($result as $item)
                <li>Magnitude: {{ $item['properties']['mag'] }}</li>
                <li>Place: {{ $item['properties']['place'] }}</li>
                <li>Time: {{ $item['properties']['time'] }}</li>
                <br>
            @endforeach
        </ul>
    </body>
</html>
