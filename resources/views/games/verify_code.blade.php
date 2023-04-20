<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

                <!-- Fonts -->
                <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @if ($type == 'update')
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="  position: absolute; top: 30%; left: 50%; transform: translate(-50%, -50%); font-size:2em;">
                {{ __('Codigo de Actualizacion') }}
            </h2>
        @else
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="  position: absolute; top: 30%; left: 50%; transform: translate(-50%, -50%); font-size:2em;">
                {{ __('Codigo de Eliminacion') }}
            </h2>
        @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" style="  position: absolute; top: 40%; left: 50%; transform: translate(-50%, -50%);">
                    @if ($type == 'update')
                        <form method="POST" action="{{ route('token_update_sent') }}">
                            @csrf
                            <div>
                                <x-text-input id="upd_token" class="textview" type="text" name="upd_token" :value="old('upd_token')" required autofocus/>
                                <x-input-error :messages="$errors->get('upd_token')" class="mt-2" />
                            </div>
                            <button class="button">Aceptar</button>
                        </form>
                    @else
                        
                    <form method="POST" action="{{ route('token_destroy_sent') }}">
                        @csrf
                        <div>
                            <x-text-input id="delete_token" class="textview" type="text" name="delete_token" :value="old('delete_token')" required autofocus/>
                            <x-input-error :messages="$errors->get('delete_token')" class="mt-2" />
                        </div>
                        <button class="button">Aceptar</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<style>
    .button {
      transition-duration: 0.4s;
      border-radius: 12px;
      font-size: 20px;
      margin-top:8.5px;
      position: absolute; top: 110%; left: 50%; transform: translate(-50%, -50%);
      background-color: white;
      color: black;
      border: 4px solid black; 
      padding: 14px 40px;
    }
    
    .textview{
        width: 10em !important;
        height: 3em !important;
        background-color: transparent;
        text-align: center;
        font-size: 30px;
        font-family:Arial, Helvetica, sans-serif;
        margin-top: 4em;
        color: white;
    }
    
    .button:hover {
      background-color: transparent;
      border: 2px solid white; 
      color: white;
    }
    </style>