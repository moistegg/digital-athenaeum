<nav class="rounded-b-2xl bg-cover bg-bottom" style="background-image:url('https://images.unsplash.com/photo-1536965764833-5971e0abed7c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80')">
    <div class="rounded-b-2xl">
        <div class="pt-5 py-10 flex flex-col items-center space-y-10">
            <div class="w-full max-w-xl flex justify-end items-center space-x-4">
                <span class="relative z-20" x-data="{dropdown:false}" x-cloak>
                    <button class="w-8 h-8 flex-center bg-white rounded-full hover:bg-blue-200 hover:text-blue-800 transition-default" x-on:click="dropdown=!dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </button>
                    
                    <div 
                        class="bg-white shadow-xl py-4 border border-gray-200 mt-3 rounded flex flex-col right-0 absolute" 
                        style="min-width:8rem" 
                        x-show="dropdown" 
                        x-on:click.away="dropdown=false" 
                        x-transition:enter="transition ease-in-out duration-200" 
                        x-transition:enter-start="opacity-0 transform translate-y-3" 
                        x-transition:enter-end="opacity-100 transform translate-y-0" 
                        x-transition:leave="transition ease-in-out duration-100" 
                        x-transition:leave-start="opacity-100 transform translate-y-0" 
                        x-transition:leave-end="opacity-0 transform translate-y-3">
                        <span class="absolute bg-white border-t border-l border-gray-200 transform rotate-45 w-2 h-2 -top-1 right-2 pointer-events-none"></span>

                        <a href="<?=route('profile')?>" class="w-full text-xs tracking-wider text-left px-4 py-2 text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition-default whitespace-nowrap">
                            <?=auth()->getProfile->fullname?>
                        </a>

                        <?php if (auth()->role == 1): ?>
                            <a href="<?=route('setting')?>" class="w-full text-xs tracking-wider text-left px-4 py-2 text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition-default whitespace-nowrap">
                                Setting
                            </a>
                        <?php endif; ?>

                        <form method="post" action="<?= route('logout') ?>" class="w-full">
                            <button type="submit" name="logout" class="w-full text-xs tracking-wider text-left px-4 py-2 text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition-default whitespace-nowrap">
                                Sign Out
                            </button>
                        </form>
                    </div>
                </span>
            </div>

            <div>
                <p class="text-4xl font-semibold text-white tracking-wider"><?=TITLE?></p>
            </div>

            <form method="post" class="w-full max-w-xl">
                <div class="form">
                    <div class="form-input-group">
                        <input type="text" id="search" class="form-input primary pl-3 pr-12 py-3" placeholder="Search Articles, Journals, Publications etc" />
                        <span class="absolute inset-y-0 right-0 w-10 flex-center">
                            <button type="button" class="btn h-full w-full flex-center hover:bg-white rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </button>
                        </span>
                    </div>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-4 p-3 text-white">
            <a href="<?=route('')?>" class="text-center">Home</a>
            <a href="<?=route('materials')?>" class="text-center">Journals</a>
            <a href="<?=route('materials/1')?>" class="text-center">Online Books</a>
            <a href="<?=route('materials/2')?>" class="text-center">Articles</a>
        </div>
    </div>
</nav>