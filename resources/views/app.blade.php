<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="{{ config('app.author') }}">
    <meta name="description" content="{{ config('app.description') }}">
    <meta name="app_url" content="{{ config('app.url') }}">

    <title id="app_name">{{ config('app.name') }}</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">

    <app v-cloak></app>

    <v-notification></v-notification>

    <div class="loader" v-if="!$data">
        Loading...
    </div>

</div>

<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>