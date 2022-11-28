<section class="mt-8 space-y-8">
    <div class="flex items-center space-x-4">
        <p class="text-2xl font-bold"><?=$this->page_title?></p>
    </div>

    <div>
        <iframe src="<?=storage('materials/'.$this->materials->material)?>" class="w-full h-screen rounded-lg"></iframe>
    </div>
</section>