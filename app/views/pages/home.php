<section class="mt-8 space-y-8 pb-5">
    <p class="text-2xl font-bold">Hello, <?=(auth()) ? auth()->getProfile->fullname : ''?></p>

    <div class="space-y-4">
        <p class="text-lg font-semibold">Subjects</p>

        <div x-data="{selected:null}" class="space-y-6">
            <?php foreach (SubjectGroups() as $subject_group_id => $subject_group_name): ?>
                <div>
                    <button 
                        type="button" 
                        x-on:click="selected !== <?=$subject_group_id?> ? selected = <?=$subject_group_id?> : selected = null"
                        class="w-full py-2 px-4 rounded text-left text-sm text-blue-900 bg-blue-200 hover:bg-blue-300 transition-default flex justify-between items-center">
                        <p><?=$subject_group_name?></p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                    </button>
                    <div 
                        x-show="selected == <?=$subject_group_id?>"
                        class="border border-gray-200 rounded p-4 mt-1 text-sm flex flex-col space-y-4">
                        <?php if (count($this->subjects) > 0): ?>
                            <?php $count = 0; ?>

                            <?php foreach ($this->subjects as $row): ?>
                                <?php if ($row->subject_group_id == $subject_group_id): ?>
                                    <?php $count++; ?>
                                    <a 
                                        href="<?=route('materials?subject='.$row->id)?>"
                                        class="hover:text-blue-800 transition-default">
                                        <p class="flex items-center space-x-4">
                                            <span>&bull;</span>
                                            <span><?=$row->name?></span>
                                        </p>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <?php if ($count == 0): ?>
                                <p class="text-gray-400 font-light text-xs tracking-wider">No subject available</p>
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="text-gray-400 font-light text-xs tracking-wider">No subject available</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>