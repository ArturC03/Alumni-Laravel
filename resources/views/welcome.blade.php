<x-app-layout>
    <main class="mx-auto mt-8">
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Main Feed --}}
            <section class="flex-1 min-w-0">
                <div class="grid gap-6 justify-items-center">
                    <div class="px-4 w-full max-w-[30rem] lg:w-[30rem]">
                        <div class="flex space-x-4">
                            <button class="w-full rounded-md bg-primary-500 text-white">
                                <x-bladewind::icon type="outline" name="home" class="!stroke-secondary-50" />
                            </button>
                            <x-button class="w-full ">
                                <x-bladewind::icon type="outline" name="fire" />
                            </x-button>

                            <x-button class="w-full">
                                <x-bladewind::icon type="outline" name="heart" />
                            </x-button>
                        </div>
                        </div>
                    @forelse($publicacoes as $publicacao)
                    <div class="px-4 my-2 w-full max-w-[30rem] lg:w-[30rem]">
                        <livewire:publicacao-cartao :publicacao="$publicacao" />
                    </div> @empty
                    <div class="">
                        <x-bladewind::icon type="calendar" class="w-12 h-12 mx-auto text-gray-400" />
                        <p class="mt-4 text-gray-500 ">
                            Nenhuma publicação encontrada.
                        </p>
                    </div>
                    @endforelse
                </div>
            </section>
        </div>
    </main>
</x-app-layout>
