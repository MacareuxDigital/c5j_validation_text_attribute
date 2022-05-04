<?php
defined('C5_EXECUTE') or die('Access Denied.');
/** @var \Concrete\Core\Form\Service\Form $form */
?>
<fieldset>
    <legend><?php echo t('Text Options')?></legend>

    <div class="form-group">

        <?php echo $form->label('akTextPlaceholder', t('Placeholder Text'))?>

        <?php echo $form->text('akTextPlaceholder', isset($akTextPlaceholder) ? $akTextPlaceholder : '')?>
    </div>

    <div class="form-group">

        <?php echo $form->label('akRegexRule', t('Regex Rule'))?>

        <?php echo $form->text('akRegexRule', isset($akRegexRule) ? $akRegexRule : '', ['placeholder' => '/^[a-zA-Z0-9]+$/'])?>
    </div>

    <div class="form-group">

        <?php echo $form->label('akErrorMessage', t('Error Message'))?>

        <?php echo $form->text('akErrorMessage', isset($akErrorMessage) ? $akErrorMessage : '')?>
    </div>

</fieldset>