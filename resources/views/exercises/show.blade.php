 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $exercise->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold">Descripción</h3>
                    <p>{{ $exercise->description }}</p>

                    @if ($exercise->video_url)
                        <h3 class="mt-4 text-lg font-bold">Video Tutorial</h3>
                        <div class="responsive-video">
                            <iframe src="{{ $exercise->video_url }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    @else
                        <p>No hay video disponible para este ejercicio.</p>
                    @endif

                    <h3 class="mt-4 text-lg font-bold">Tips</h3>
                    <p>{{ $exercise->tips ?? 'No hay tips disponibles.' }}</p>

                    @if (auth()->user()->role === 'coach' || auth()->user()->role === 'admin')
                        <a href="{{ route('exercises.edit', $exercise->id) }}" class="btn btn-primary">Editar Ejercicio</a>
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
