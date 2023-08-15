<div x-data="{ open: false }" @click.away="open = false" class="relative ml-2">
    <button @click="open = !open"
        class="inline-flex items-center rounded-lg bg-white p-2 text-center text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-50 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-600"
        type="button">
        <i class="fa-solid fa-ellipsis-vertical"></i>
    </button>

    <div x-show="open"
        class="absolute z-50 right-0 mt-2 w-44 origin-top-right divide-y divide-gray-100 rounded-lg bg-white shadow dark:divide-gray-600 dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
            {{ $slot }}
        </ul>
    </div>
</div>
