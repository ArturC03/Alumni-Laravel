<div>
    <div class="flex justify-between items-center bg-white dark:bg-secondary-500 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-all duration-200">
        <livewire:author-info :author="$user" />
        <div class="px-6 py-4">
            <livewire:follow-button :user="$user" />
        </div>
    </div>
</div>
