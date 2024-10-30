<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($recipes) ? 'Editar Receta' : 'Crear Receta' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ isset($recipes) ? route('recipes.update', $recipes->id) : route('recipes.store') }}" >
                        @csrf
                        @if(isset($recipes))
                            @method('PUT')
                        @endif

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $recipes->title ?? '') }}" required class="mt-1 block w-full">
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="description" id="description" required class="mt-1 block w-full">{{ old('description', $recipes->description ?? '') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="video_url" class="block text-sm font-medium text-gray-700">URL del Video</label>
                            <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $recipes->video_url ?? '') }}" class="mt-1 block w-full">
                        </div>

                        <div class="mt-4">
                            <label for="tips" class="block text-sm font-medium text-gray-700">Tips</label>
                            <textarea name="tips" id="tips" class="mt-1 block w-full">{{ old('tips', $recipes->tips ?? '') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="text-green-500 hover:text-green-700">{{ isset($recipes) ? 'Actualizar' : 'Crear' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    input, textarea{
        color: black
    }
</style>