<x-app-layout>
    <main class="mx-auto mt-8">
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Main Feed --}}
            <section class="flex-1 min-w-0">
                <div class="grid gap-6 justify-items-center">
                <div class="px-4 w-full max-w-[30rem] lg:w-[30rem]">
                    <div class="flex w-full gap-2">
                        <x-button href="{{route('perfis')}}" class="flex-1">
                            <x-bladewind::icon type="outline" name="magnifying-glass" />
                        </x-button>

                        <x-button href="{{route('perfis')}}" class="flex-1">
                            <x-bladewind::icon type="outline" name="magnifying-glass" />
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
