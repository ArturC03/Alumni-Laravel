<div
    x-data="{ visible: false }"
    x-init="visible = window.scrollY > 0"
    x-on:scroll.window="visible = window.scrollY > 0"
    x-show="visible"
    x-transition
    class="fixed bottom-4 right-4 {{ $class }} shadow-md z-50 cursor-pointer opacity-90 hover:opacity-100 transition-all transform hover:scale-110 ease-in-out duration-300"
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    role="button"
    aria-label="Voltar ao topo">
    {{ $slot }}
</div>
