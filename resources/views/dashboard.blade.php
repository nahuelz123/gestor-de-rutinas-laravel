<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chat con IA') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto py-8">
                        <h1 class="text-2xl font-bold mb-4">Chat con IA</h1>

                        <div id="chat-window" class="bg-gray-100 dark:bg-gray-700 p-4 mb-4 rounded shadow max-h-80 overflow-y-auto">
                            <!-- Aquí se mostrarán los mensajes -->
                        </div>

                        <form id="chat-form" method="POST" action="{{ route('chat.send') }}">
                            @csrf
                            <input type="text" name="message" placeholder="Escribe tu mensaje aquí..." required
                                class="border border-gray-300 dark:border-gray-600 rounded p-2 w-full mb-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">
                                Enviar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chatWindow = document.getElementById('chat-window');
        const chatForm = document.getElementById('chat-form');

        chatForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(chatForm);
            const message = formData.get('message');

            // Agrega el mensaje del usuario al chat
            chatWindow.innerHTML += `<p class="text-blue-600 font-semibold">Tú: ${message}</p>`;

            try {
                const response = await fetch(chatForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Muestra la respuesta de la IA
                    chatWindow.innerHTML += `<p class="text-green-600">IA: ${data.reply}</p>`;
                } else {
                    chatWindow.innerHTML += `<p class="text-red-600">Error: ${data.error}</p>`;
                }

                // Desplaza hacia abajo el chat para ver el último mensaje
                chatWindow.scrollTop = chatWindow.scrollHeight;

            } catch (error) {
                console.error('Error:', error);
                chatWindow.innerHTML += `<p class="text-red-600">Error al enviar el mensaje.</p>`;
            }
        });
    </script>
</x-app-layout>
