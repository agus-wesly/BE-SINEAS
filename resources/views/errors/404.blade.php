{{-- @extends('errors::minimal') --}}

{{-- @section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Jangan Nakal Yah !!!')) --}}




{{-- @php
    $serverIp = getHostByName(getHostName());
@endphp --}}

{{-- <br>
<br>
<h3>IP Address Device : {{ request()->ip() }}</h3>
<h3>IP Address Internet : {{ request()->server('SERVER_ADDR') }} {{ $serverIp }}</h3> --}}
<!DOCTYPE html>
<html>
<head>
    <title>Error 404</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #ff0000;
            animation: growText 5s forwards;
        }

        @keyframes growText {
            0% {
                font-size: 24px;
            }
            100% {
                font-size: 100px;
            }
        }
    </style>
</head>
<body>
    <h1>
        <span style="font-size: 60px;">404</span> | JANGAN NAKAL YAH !!! TAK JEWER KUPINGMU
        <span style="font-size: 60px;">😠</span>
    </h1>
</body>
</html>

