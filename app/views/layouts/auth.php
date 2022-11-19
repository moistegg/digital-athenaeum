<?php $base = new Component('layouts.base', ['title' => $this->title]) ?>
    <?php $navbar = new Component('navbar'); $navbar->close() ?>
    @content
<?php $base->close() ?>