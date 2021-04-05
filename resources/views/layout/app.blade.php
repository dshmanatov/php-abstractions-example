<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" value="{{ csrf_token() }}" />

    <title>Manufacturing App</title>

    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
</head>

<body>
    <div id="app"><app/></div>
    <script>window.appData = {!! json_encode($appData) !!};</script>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>

</html>
