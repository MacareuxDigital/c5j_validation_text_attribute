<?php
defined('C5_EXECUTE') or die('Access Denied.');
$form = Loader::helper('form');
echo $form->text(
    $this->field('value'),
    $value,
    [
        'placeholder' => h($akTextPlaceholder),
    ]
);
