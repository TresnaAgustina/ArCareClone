<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/199bad1da3.js" crossorigin="anonymous"></script>
    <title>{{$title}}</title>
</head>
<body class="bg-[#F8F8F8]">
    @yield('content')
</body>
</html>