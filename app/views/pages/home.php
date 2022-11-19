<section class="p-10">
    <p class="text-2xl font-bold">Welcome back, <?=auth()->getProfile->fullname?></p>

    <div>
        <p>Subjects</p>

        <div x-data="{selected:null}">
            <div>
                <button type="button" x-on:click="selected !== 0 ? selected = 0 : selected = null">Accordion item 1</button>
                <div x-show="selected == 0">
                    This is made with Alpine JS and Tailwind CSS
                </div>
            </div>

            <div>
                <button type="button" x-on:click="selected !== 1 ? selected = 1 : selected = null">Accordion item 2</button>
                <div x-show="selected == 1">
                    This is made with Alpine JS and Tailwind CSS
                </div>
            </div>
        </div>
    </div>
</section>