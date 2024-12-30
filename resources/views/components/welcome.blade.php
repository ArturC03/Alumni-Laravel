<div class="p-6 lg:p-8 bg-white dark:bg-secondary-800 dark:bg-gradient-to-bl dark:from-secondary-700/50 dark:via-transparent border-b border-secondary-200 dark:border-secondary-700">
    <x-application-logo class="block h-12 w-auto" />

    <h1 class="mt-8 text-2xl font-medium text-secondary-900 dark:text-white">
        Bem-vindo ao Alumni!
    </h1>

    <p class="mt-6 text-secondary-500 dark:text-secondary-300 leading-relaxed">Este Website é uma rede social destinada para os Alumni.</p>
</div>

<div class="bg-secondary-200 dark:bg-secondary-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div>

        <h2 class="mt-8 text-xl font-medium text-secondary-900 dark:text-white">
            Publicações
        </h2>
        <p class="mt-6 text--500 dark:text-secondary-400 leading-relaxed">Nesta aba podes ver e fazer publicações para os teus colegas verem e comentarem.</p>

    </div>

    <div>

        <h2 class="mt-8 text-xl font-medium text-secondary-900 dark:text-white">
            Notícias
        </h2>
        <p class="mt-6 text-secondary-500 dark:text-secondary-400 leading-relaxed">Aqui podes ver todas as notícias relacionadas com o ISPGAYA.</p>
    </div>

    <div>

        <h2 class="mt-8 text-xl font-medium text-secondary-900 dark:text-white">
            Eventos
        </h2>

        <p class="mt-6 text-secondary-500 dark:text-secondary-400 leading-relaxed">Através da aba de Eventos podes ver quais serão os eventos que o ISPGAYA está a preparar para os seus Alunos.</p>
    </div>

    <div class="flex justify-between align-middle">

        <h2 class=" text-xl font-medium text-secondary-900 dark:text-white">
            Bem-vindo ao Alumni!
        </h2>

        <div class="">
            <x-button class="self-right">
                <a href="{{route('profile.show')}}">Começar</a>
            </x-button>
        </div>
    </div>

</div>
