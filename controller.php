<?php

namespace Concrete\Package\C5jValidationTextAttribute;

use Concrete\Core\Package\Package;

class Controller extends Package
{
    protected $pkgHandle = 'c5j_validation_text_attribute';
    protected $appVersionRequired = '8.5.4';
    protected $pkgVersion = '0.1.1';
    protected $pkgAutoloaderRegistries = [
        'src' => '\C5j\C5jValidationTextAttribute',
    ];

    public function getPackageName()
    {
        return t('Validation Text Attribute');
    }

    public function getPackageDescription()
    {
        return t('Add Validation Text Attribute');
    }

    public function install()
    {
        $pkg = parent::install();
        $factory = $this->app->make('Concrete\Core\Attribute\TypeFactory');
        $type = $factory->getByHandle('validation_text');
        if (!is_object($type)) {
            $type = $factory->add('validation_text', 'Validation Text', $pkg);
            $service = $this->app->make('Concrete\Core\Attribute\Category\CategoryService');
            $category = $service->getByHandle('user')->getController();
            $category->associateAttributeKeyType($type);
        }
    }
}
