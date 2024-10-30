<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $recipes->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold">Descripción</h3>
                    <p>{{ $recipes->description }}</p>

                    @if ($recipes->video_url)
                        <h3 class="mt-4 text-lg font-bold">Ver Receta</h3>
                        <div class="responsive-video">
                            <iframe src="{{ $recipes->video_url }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    @else
                        <p>No hay video disponible para esta receta.</p>
                    @endif

                    <h3 class="mt-4 text-lg font-bold">Tips</h3>
                    <p>{{ $recipes->tips ?? 'No hay tips disponibles.' }}</p>

                    @if (auth()->user()->role === 'coach' || auth()->user()->role === 'admin')
                        <a href="{{ route('recipes.edit', $recipes->id) }}" class="btn btn-primary">Editar receta</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .responsive-video {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 ratio */
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #000;
        }

        .responsive-video iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</x-app-layout>
