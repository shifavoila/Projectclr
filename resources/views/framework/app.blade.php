<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.7.0/build/styles/default.min.css">
<script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.7.0/build/highlight.min.js"></script>
<!-- and it's easy to individually load additional languages -->
<script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.7.0/build/languages/go.min.js"></script>
<script>hljs.highlightAll();</script>

</head>
<body class="bg-gray-100">
    <header class="bg-blue-900">
        <nav class="flex space-x-2 justify-between py-3 px-16">
            <a class="text-white font-bold py-2 text-xl" href="{{ route('post.index') }}">CodeCLR</a>  
            
            <form class="inline-flex grid grid-cols-5" role="search">
                <input class="col-span-4 border border-gray-300" type="search" placeholder="Search" aria-label="Search" style="width: 30vw;">
                <button class="text-white  bg-blue-500 px-2 col-span-1" type="submit">Search</button>
            </form>

            <div class="inline-flex">
              <a class="bg-red-500 text-white rounded py-2 px-3 hover:bg-red-600 mx-2" href="{{ route('post.index') }}">Home</a>
              @guest
              <a class="bg-red-500 text-white rounded py-2 px-3 hover:bg-red-600 mx-2" href="{{ route('login') }}">Login</a>
              @else
              <a class="bg-red-500 text-white rounded py-2 px-3 hover:bg-red-600 mx-2" href="{{ route('post.create') }}">Create</a>
              <form action="{{ route('logout') }}" method="POST" class="mt-0">
                <button type="submit" class="bg-red-500 text-white rounded py-2.5 px-3 hover:bg-red-600 mx-2">Logout</button>
                @csrf
              </form>
              @endguest              
            </div>
        </nav>
    </header>
    
    <main class="h-full p-5 bg-white mx-16 my-10 mb-10 border border-gray-300 shadow-xl rounded">
        @auth
        <div>
            <span class="bg-yellow-200 px-2 py-1 rounded mb-4">User Name : {{ Auth::user()->name }}</span>
            
            <span class="bg-yellow-200 px-2 py-1 rounded my-4">Role : {{ Auth::user()->role }}</span>
            <br>
            
        </div>
        
        <br>
        @endauth

        @yield('content')
    </main>

    <footer class="mt-auto w-full bg-blue-900 px-18 pt-4 pb-2 text-center">
        <div class="text-center mt-auto">
            <a href="#" class="text-white">Terms</a> |
            <a href="#" class="text-white">Conditions</a> |
            <a href="#" class="text-white">Privacy Policy</a>
        </div>
        <div class="text-center text-white my-2">© Copyrights VoilaCode.</div>
    </footer>
</body>
</html>