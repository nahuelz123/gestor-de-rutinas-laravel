<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Lista de Recetas') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-4 text-green-600 dark:text-green-400">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Formulario de búsqueda -->
                    <form method="GET" action="{{ route('recipes.index') }}" class="mb-4">
                        <input type="text" name="title" placeholder="Buscar Receta"
                            value="{{ request('title') }}" class="border border-gray-300 rounded p-2 mr-2 text-black">
                        <button type="submit"
                            class="ml-2 inline-flex items-center px-4 py-2 border text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none">
                            Buscar
                        </button>
                    </form>

                    @if (auth()->user()->role === 'coach' || auth()->user()->role === 'admin')
                        <a href="{{ route('recipes.create') }}" class="text-blue-500 underline">Subir Receta</a>
                    @endif

                    <!-- Lista de Ejercicios en Tarjetas -->
                    <div class="flex flex-col gap-6 mt-4">
                        @foreach ($recipes as $recipe)
                            <div class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow p-4 max-w-full">
                                <h3 class="text-lg font-bold mb-2">{{ $recipe->title }}</h3>
                                <p class="descripcion mb-4">{{ $recipe->description }}</p>
                                <a href="{{ route('recipes.show', $recipe->id) }}" class="text-green-500 hover:text-green-700 hover:underline">
                                    Ver Receta
                                </a>

                                @if (auth()->user()->role === 'coach' || auth()->user()->role === 'admin')
                                    <div class="mt-4 flex justify-between">
                                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="text-blue-500 underline">Editar</a>
                                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 underline">Eliminar</button>
                                        </form>
                                        
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estilos -->
    <style>
        /* Estilo para limitar la descripción con puntos suspensivos */
        .descripcion {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100%;
            display: block;
        }

        /* Estilo para asegurar que las tarjetas no sobresalgan de la pantalla */
        .card-container {
            max-width: 100%;
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</x-app-layout>
