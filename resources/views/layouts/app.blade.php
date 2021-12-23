<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            @if (session('SUCCESS'))
            <div class="px-4 py-2 text-center bg-green-200 border border-green-600 text-green-600 m-4">
                {{ session('SUCCESS') }}
            </div>
            @endif
            @if (session('ERROR'))
            <div class="px-4 py-2 text-center bg-red-200 border border-red-600 text-red-600 m-4">
                {{ session('ERROR') }}
            </div>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <form id="delete-form" action="", method="POST">
                @csrf
                <input id = "method" type="hidden", name="_method" value="DELETE">
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{asset('js/app.js')}}" defer></script>
        <script>
            $(document).on("click", ".delete-row", function(e){
                e.preventDeafultl();
                let confirmStr="Are you sure?"
                if($(this).attr("data-confirm")){
                    confirmStr = $(this).attr("data-confirm");
                }
                if(confirm(confirmStr)){
                    let href = $(this).attr("href");
                ("#delete-form").attr("action", href);
                ("#delete-form").submit(); 
                }
            })

            $(document).on("click", ".complete-blog", function(e){
                e.preventDefault();
                let confirmStr = "Are you sure?"
                if($(this).attr("data-confirm")) {
                    confirmStr = $(this).attr("data-confirm");
                }

                if(confirm(confirmStr)) {
                    let href = $(this).attr("href");
                $("#method").attr("value", "PUT");
                $("#delete-form").attr("action", href);
                $("#delete-form").submit(); 
                }
                
            })
        </script>
    </body>
</html>
               
