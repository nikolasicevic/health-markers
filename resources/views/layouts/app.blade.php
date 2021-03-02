<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') | {{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">
        
        <!-- JS -->
        <script type="text/javascript" src="/js/app.js"></script>
    </head>
    <body>
        @include('includes.header')

        <main>
            @if(session()->has('message') && session()->has('status'))
                <div class="alert alert-{{ session()->get('status') }} alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $error }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @endif
            
            @yield('content')
        </main>
    </body>
</html>


