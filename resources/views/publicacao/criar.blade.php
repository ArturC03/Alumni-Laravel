<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-secondary-color-800 dark:text-secondary-color-200 leading-tight">
            {{ __('Criar Publicação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-secondary-color-700 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <form action="{{ route('publicacao.guardar') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Campo de Título -->
                    <div class="mb-4">
                        <x-label for="titulo" value="{{ __('Título') }}"/>
                        <x-input
                            id="titulo"
                            type="text"
                            class="mt-1 block w-full"
                            name="titulo"
                            :value="old('titulo')"
                            required
                            autofocus
                        />
                        <x-input-error for="titulo" class="mt-2"/>
                    </div>

                    <!-- Campo de Conteúdo -->
                    <div class="mb-4">
                        <x-label for="conteudo" value="{{ __('Conteúdo') }}"/>
                        <x-textarea
                            id="conteudo"
                            name="conteudo"
                            rows="4"
                            class="border-secondary-color-300 dark:border-secondary-color-700 dark:bg-secondary-color-900 dark:text-secondary-color-300 focus:border-primary-color-500 dark:focus:border-primary-color-600 focus:ring-primary-color-500 dark:focus:ring-primary-color-600 rounded-md shadow-sm mt-1 block w-full"
                            required
                        >{{ old('conteudo') }}</x-textarea>
                        <x-input-error for="conteudo" class="mt-2"/>
                    </div>

                    <!-- Campo de Mídia -->
                    <div class="mb-4">
                        <x-label for="midia" value="{{ __('Mídia') }}"/>
                        <input
                            id="midia"
                            type="file"
                            name="midia"
                            accept="image/*,video/*"
                            class="hidden"
                            onchange="previewMedia(event)"
                        />

                        <!-- Botão Personalizado -->
                        <label
                            for="midia"
                            class="cursor-pointer flex items-center justify-center w-full p-4 border-dashed border-2 border-secondary-color-300 dark:border-secondary-color-700 rounded-md shadow-sm bg-white dark:bg-secondary-color-900 text-secondary-color-600 dark:text-secondary-color-300 hover:bg-primary-color-200 dark:hover:bg-secondary-color-700 dark:hover:border-primary-color transition"
                        >
                            <span class="text-base font-medium">{{ __('Clique para selecionar um ficheiro') }}</span>
                        </label>

                        <!-- Pré-Visualizações -->
                        <div id="preview" class="mt-4 flex items-center justify-center"></div>
                        <x-input-error for="midia" class="mt-2"/>
                    </div>

                    <!-- Usuário Logado -->
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}"/>

                    <!-- Campo de Visibilidade -->
                    <div class="mb-4">
                        <x-label for="visibilidade_id" value="{{ __('Visibilidade') }}"/>
                        <select
                            id="visibilidade_id"
                            name="visibilidade_id"
                            class="border-secondary-color-300 dark:border-secondary-color-700 dark:bg-secondary-color-900 dark:text-secondary-color-300 focus:border-primary-color-500 dark:focus:border-primary-color-600 focus:ring-primary-color-500 dark:focus:ring-primary-color-600 rounded-md shadow-sm mt-1 block w-full"
                            required
                        >
                            <option value="">{{ __('Selecione a visibilidade') }}</option>
                            @foreach($visibilidades as $visibilidade)
                                <option
                                    value="{{ $visibilidade->id }}"
                                    {{ old('visibilidade_id') == $visibilidade->id ? 'selected' : '' }}
                                >
                                    {{ $visibilidade->nome }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="visibilidade_id" class="mt-2"/>
                    </div>

                    <!-- Botão de Enviar -->
                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __('Criar Publicação') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
        <div id="modal-content"
             class="relative bg-white p-4 rounded-md dark:bg-secondary-color-900 shadow-md max-w-3xl max-h-[90%] overflow-auto">
            <button
                onclick="closeModal()"
                class="absolute top-2 right-2 text-4 text-secondary-color-800 dark:text-secondary-color-300 hover:text-red-500"
            >
                &#10005;
            </button>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function previewMedia(event) {
            const previewContainer = document.getElementById('preview');
            const file = event.target.files[0];

            previewContainer.innerHTML = ''; // Clear Preview

            if (!file) return;

            let element;

            if (file.type.startsWith('image/')) {
                element = document.createElement('img');
                element.src = URL.createObjectURL(file);
                element.alt = 'Pré-visualização da imagem';
            } else if (file.type.startsWith('video/')) {
                element = document.createElement('video');
                element.src = URL.createObjectURL(file);
                element.controls = true;
            } else {
                const message = document.createElement('span');
                message.className = 'text-secondary-color-600 dark:text-secondary-color-300';
                message.textContent = 'Formato não suportado';
                previewContainer.appendChild(message);
                return;
            }

            element.className = 'max-w-full max-h-64 rounded-md shadow-md cursor-pointer';
            element.onclick = () => showModal(element);
            previewContainer.appendChild(element);
        }

        function showModal(element) {
            const modal = document.getElementById('modal');
            const modalContent = document.getElementById('modal-content');

            modalContent.innerHTML = `
                <button
                    onclick="closeModal()"
                    class="block text-secondary-color-800 dark:text-secondary-color-300 hover:text-red-500"
                >
                    &#10005;
                </button>
            `;

            const clone = element.cloneNode(true);
            clone.className = 'max-w-full max-h-screen rounded-md';
            modalContent.appendChild(clone);

            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Disable Scrolling
        }

        function closeModal() {
            const modal = document.getElementById('modal');
            modal.style.display = 'none';
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto'; // Enable Scrolling
        }
    </script>
</x-app-layout>
