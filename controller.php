<?php

namespace Concrete\Package\C5jValidationTextAttribute;

use C5j\C5jValidationTextAttribute\MigrationTool\Importer\CIF\Attribute\Key\Manager as AttributeKeyManager;
use Concrete\Core\Attribute\Category\CategoryService;
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
            /** @var CategoryService $service */
            $service = $this->app->make(CategoryService::class);
            $collectionCategory = $service->getByHandle('collection');
            if ($collectionCategory) {
                $collectionCategory->getController()->associateAttributeKeyType($type);
            }
            $userCategory = $service->getByHandle('user');
            if ($userCategory) {
                $userCategory->getController()->associateAttributeKeyType($type);
            }
            $fileCategory = $service->getByHandle('file');
            if ($fileCategory) {
                $fileCategory->getController()->associateAttributeKeyType($type);
            }
            $siteCategory = $service->getByHandle('site');
            if ($siteCategory) {
                $siteCategory->getController()->associateAttributeKeyType($type);
            }
            $eventCategory = $service->getByHandle('event');
            if ($eventCategory) {
                $eventCategory->getController()->associateAttributeKeyType($type);
            }
            $expressCategory = $service->getByHandle('express');
            if ($expressCategory) {
                $expressCategory->getController()->associateAttributeKeyType($type);
            }
        }
    }

    public function on_start()
    {
        $migration_tool_pkg = \Concrete\Core\Package\Package::getByHandle('migration_tool');
        if ($migration_tool_pkg !== null) {
            $this->app->bindshared('migration/manager/import/attribute/key', function ($app) {
                return new AttributeKeyManager($app);
            });
        }
    }
}
