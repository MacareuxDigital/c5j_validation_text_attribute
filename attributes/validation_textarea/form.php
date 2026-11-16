<?php
defined('C5_EXECUTE') or die('Access Denied.');
/** @var \Concrete\Core\Form\Service\Form $form */
echo $form->textarea(
    $this->field('value'),
    $value,
    [
        'placeholder' => h($akTextPlaceholder),
        'rows' => 5,
    ]
);
