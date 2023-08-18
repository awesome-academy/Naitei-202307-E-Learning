<div>
    <div class="mt-10 bg-white">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white lg:text-2xl">
                {{ __('Discussion') .' (' . $comments->count() . ')' }}</h2>
        </div>

        <form class="mb-6" wire:submit.prevent="addComment">
            <div class="mb-4 rounded-lg rounded-t-lg border border-gray-200 bg-white px-4 py-2">
                <textarea id="comment" rows="4" wire:model="newComment"
                    class="w-full border-0 px-0 text-sm text-gray-900 focus:outline-none focus:ring-0 dark:bg-gray-800"
                    placeholder="{{ __('Write a comment...') }}"></textarea>
                @error('newComment')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <button
                class="rounded-2xl bg-gradient-to-r from-green-400 to-blue-400 px-3 py-2 text-center font-bold text-white hover:from-green-300 hover:to-blue-300">
                {{ __('Post Comment') }}
            </button>
        </form>
        @foreach ($comments as $comment)
            <article class="mb-6 rounded-lg bg-white text-base dark:bg-gray-900">
                <footer class="mb-2 flex items-center justify-between">
                    <div class="flex items-center">
                        <p class="mr-3 inline-flex items-center text-sm text-gray-900 dark:text-white">
                            <img class="mr-2 h-6 w-6 rounded-full" src="{{ asset('images/avt.png') }}"
                                alt="avatar">{{ $comment->user->name }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $comment->updated_at->format('Y-m-d') }}
                        </p>
                    </div>
                    <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                        class="inline-flex items-center rounded-lg bg-white p-2 text-center text-sm font-medium text-gray-400 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        type="button">
                        <svg class="h-5 w-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                            </path>
                        </svg>
                    </button>

                    <div id="dropdownComment1"
                        class="z-10 hidden w-36 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownMenuIconHorizontalButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    {{ __('Edit') }}</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    {{ __('Remove') }}</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    {{ __('Report') }}</a>
                            </li>
                        </ul>
                    </div>
                </footer>
                <p class="text-gray-500 dark:text-gray-400">
                    {{ $comment->content }}
                </p>
            </article>
        @endforeach
    </div>
</div>
