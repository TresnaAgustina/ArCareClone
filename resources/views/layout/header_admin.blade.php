<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/199bad1da3.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>{{$title}}</title>
</head>
<body class="bg-[#F8F8F8]">
   <div class="flex h-screen overflow-hidden">
       @include('component.navigation.admin.sidebar')
    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
        @include('component.navigation.admin.navigation_bar')
        <main class="p-5">
            @yield('content')
        </main>
    </div>
   </div>
</body>
</html>