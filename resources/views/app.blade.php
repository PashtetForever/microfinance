@if(env('APP_ENV') == 'local')
    <!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@latest/css/materialdesignicons.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body>
<div id="app"></div>
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
@else
    @php
        $client = new GuzzleHttp\Client();
        $header = $client->get(env('APP_SITE_DOMAIN') . '/bitrix/header.php');

        echo $header->getBody()->getContents();
    @endphp
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 1140px !important;
            padding: 0;
        }
    </style>
    <div id="app"></div>
    <script src="{{asset(mix('/js/app.js'))}}"></script>
    @php
        $client = new GuzzleHttp\Client();
        $footer = $client->get(env('APP_SITE_DOMAIN') . '/bitrix/footer.php');
        echo $footer->getBody()->getContents();
    @endphp
@endif
