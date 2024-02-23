<!--resources/views/traffic_light.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Traffic Light App</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <div class="top-row">
        <div class="traffic-light-container">
            <div id="traffic-light" style="flex-direction: column;">
                <div class="light-container">
                    <div id="red" class="light"></div>
                </div>
                <div class="light-container">
                    <div id="yellow" class="light"></div>
                </div>
                <div class="light-container">
                    <div id="green" class="light"></div>
                </div>
            </div>
        </div>
        <div class="button-container">
            <button id="forward-button">Вперед</button>
        </div>
    </div>
    <div class="log-table-container">
        <table id="log-table">
            <thead>
            <tr>
                <th>Сообщение</th>
                <th>Время</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->message }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
