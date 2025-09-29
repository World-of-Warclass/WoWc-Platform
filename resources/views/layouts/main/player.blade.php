<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero</title>
    <!-- Scripts -->

    @vite(['resources/css/app.css', 'resources/css/board.css', 'resources/js/app.js', 'resources/js/main-dashboard.js', 'resources/js/main-player.js'])
    @stack('scripts')

    <!-- Styles -->
    @livewireStyles

</head>

<body class="bg-gray-900 flex flex-col h-screen w-screen overflow-hidden text-gray-100">

    <header class="shadow-md w-full">
        <x-player-navigation name="{{ $name ?? 'Player' }}" :token="$token">
            <div class="bg-red-500 w-full flex justify-center border-b-2 border-black">
            <h1 class="text-center menu-title text-white text-3xl font-bold">History</h1>
            </div>
            @foreach ($allhistory as $history)
            <div class="flex border-b-2 rounded-md border-neutral-400  p-2 items-center justify-center">
                <p class="text-blue-700 border-r-2 flex border-neutral-300 w-full text-center">{{$history->character->name}} </p>
                <p class="border-r-2 flex border-neutral-300 w-full justify-center">Quizz {{$history->quiz}} </p>
                <p class="text-yellow-500 flex w-full justify-center">{{$history->score}}%</p>
            </div>
            @endforeach
        </x-player-navigation>
    </header>

    <main class="flex flex-row flex-grow relative h-full w-full max-h-full max-w-full">
        <x-main-sidebar>
            <div>
                <x-sidebar-item href="player.character" name="Personaje" icon="icon-[heroicons--user-solid]" :token="$token" />

                <x-sidebar-collapse id="quests-collapse" name="Misiones" icon="icon-[mingcute--task-2-fill]">
                    <x-slot name="items">
                        <x-sidebar-item href="player.tasks" name="Tareas" icon="icon-[icomoon-free--books]" :token="$token" />
                        <x-sidebar-item href="player.quizzes" name="Exámenes" icon="icon-[material-symbols--quiz]" :token="$token" />
                    </x-slot>
                </x-sidebar-collapse>
                
                <x-sidebar-collapse id="guild-collapse" name="Gremio" icon="icon-[material-symbols--home]">
                    <x-slot name="items">
                        <x-sidebar-item href="player.members" name="Miembros"
                            icon="icon-[heroicons--user-group-solid]" :token="$token" />
                        <x-sidebar-item href="player.groups" name="Grupo" icon="icon-[heroicons--users-solid]" :token="$token" />
                    </x-slot>
                </x-sidebar-collapse>
            </div>

            <div>
                <x-sidebar-item href="/dashboard" name="Salida" icon="icon-[material-symbols--exit-to-app]" :token="$token" />
            </div>

        </x-main-sidebar>

        @yield('content')

    </main>

</body>

</html>
