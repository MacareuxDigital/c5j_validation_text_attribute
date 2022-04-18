<?php

namespace Concrete\Package\C5jValidationTextAttribute;

use Concrete\Core\Package\Package;

class Controller extends Package
{
    protected $pkgHandle = 'c5j_validation_text_attribute';
    protected $appVersionRequired = '8.5.4';
    protected $pkgVersion = '0.9';
    protected $pkgAutoloaderRegistries = [
        'src' => '\C5j\C5jValidationTextAttribute',
    ];

    public function getPackageName()
    {
        return t('Macareux Validation Text Attribute');
    }

    public function getPackageDescription()
    {
        return t('Add a custom text attribute that enables validation with custom regex rules.');
    }

    public function install()
    {
        $pkg = parent::install();
        $factory = $this->app->make('Concrete\Core\Attribute\TypeFactory');
        $type = $factory->getByHandle('validation_text');
        if (!is_object($type)) {
            $type = $factory->add('validation_text', 'Validation Text', $pkg);
            $service = $this->app->make('Concrete\Core\Attribute\Category\CategoryService');
            $collectionCategory = $service->getByHandle('collection')->getController();
            if ($collectionCategory) {
                $collectionCategory->associateAttributeKeyType($type);
            }
            $userCategory = $service->getByHandle('user')->getController();
            if ($userCategory) {
                $userCategory->associateAttributeKeyType($type);
            }
            $fileCategory = $service->getByHandle('file')->getController();
            if ($fileCategory) {
                $fileCategory->associateAttributeKeyType($type);
            }
            $siteCategory = $service->getByHandle('site')->getController();
            if ($siteCategory) {
                $siteCategory->associateAttributeKeyType($type);
            }
            $eventCategory = $service->getByHandle('event')->getController();
            if ($eventCategory) {
                $eventCategory->associateAttributeKeyType($type);
            }
            $expressCategory = $service->getByHandle('express')->getController();
            if ($expressCategory) {
                $expressCategory->associateAttributeKeyType($type);
            }
        }
    }
}
