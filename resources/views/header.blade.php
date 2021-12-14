<header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
    <div
        class="
              container
              flex
              items-center
              justify-between
              h-full
              px-6
              mx-auto
              text-pink-500
            ">
        <div class="">
            <a href="{{ url('/') }}" class="mr-3 text-lg font-semibold text-pink-500">Dashboard</a>
            <a href="{{ route('listAccounts') }}" class="mr-3 font-semibold text-pink-500">Contas</a>
        </div>
        <div>
            <button
                class="
                        rounded-full
                        focus:shadow-outline-purple focus:outline-none
                      "
                @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account" aria-haspopup="true">
                <b>{{ Auth::user()->name }}</b>
            </button>
            <template x-if="isProfileMenuOpen">
                <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu"
                    class="
                          absolute
                          right-0
                          w-56
                          p-2
                          mt-2
                          space-y-2
                          text-gray-600
                          bg-white
                          border border-gray-100
                          rounded-md
                          shadow-md
                          dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700
                        "
                    aria-label="submenu">
                    <li class="flex">
                        <a class="
                              inline-flex
                              items-end
                              w-full
                              px-2
                              py-1
                              text-sm
                              font-semibold
                              transition-colors
                              duration-150
                              rounded-md
                              hover:bg-gray-100 hover:text-gray-800
                              dark:hover:bg-gray-800 dark:hover:text-gray-200
                            "
                            href="{{ route('logout') }}">
                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            <span>Log out</span>
                        </a>
                    </li>
                </ul>
            </template>
        </div>
    </div>
</header>
