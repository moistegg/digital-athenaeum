<?php $base = new Component('layouts.base', ['title' => $this->title]) ?>
    <div class="px-5">
        <?php $navbar = new Component('navbar'); $navbar->close() ?>
        @content
    </div>
<?php $base->close() ?>