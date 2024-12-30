<x-app-layout>
    <div class="max-w-4xl mx-auto my-8 px-6">
        <div class="bg-white shadow-md rounded-md p-6">
            <!-- Informações do Utilizador -->
            <div class="flex items-center">
                <img class="h-24 w-24 rounded-full object-cover border-2 border-secondary-100"
                     src="{{ $user->profile_photo_url }}"
                     alt="{{ $user->name }}">
                <div class="ml-6">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
                    <p class="text-gray-600">
                        {{ $user->nickname ? '@' . $user->nickname : '' }}
                    </p>
                </div>
            </div>

            <!-- Outras informações -->
            <div class="mt-6">
                <p class="text-gray-800">
                    <strong>Email:</strong> {{ $user->email }}
                </p>
                <p class="text-gray-800 mt-4">
                    <strong>Membro desde:</strong> {{ $user->created_at->format('d/m/Y') }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
