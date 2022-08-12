<?php

namespace Concrete\Package\C5jValidationTextAttribute;

use C5j\C5jValidationTextAttribute\MigrationTool\Importer\CIF\Attribute\Key\ValidationTextImporter;
use Concrete\Core\Attribute\Category\CategoryService;
use Concrete\Core\Package\Package;
use Concrete\Core\Package\PackageService;

class Controller extends Package
{
    protected $pkgHandle = 'c5j_validation_text_attribute';

    protected $appVersionRequired = '8.5.4';

    protected $pkgVersion = '1.0.0';

    protected $pkgAutoloaderRegistries = [
        'src/Entity' => '\C5j\C5jValidationTextAttribute\Entity',
    ];

    /**
     * {@inheritdoc}
     */
    public function getPackageAutoloaderRegistries()
    {
        $registries = parent::getPackageAutoloaderRegistries();
        if ($this->isMigrationToolInstalled()) {
            $registries['src/MigrationTool'] = '\C5j\C5jValidationTextAttribute\MigrationTool';
        }

        return $registries;
    }

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

    public function on_after_packages_start()
    {
        if ($this->isMigrationToolInstalled()) {
            $key_manager = $this->app->make('migration/manager/import/attribute/key');
            $key_manager->extend('validation_text', function () {
                return new ValidationTextImporter();
            });

            $value_manager = $this->app->make('migration/manager/import/attribute/value');
            $value_manager->extend('validation_text', function () {
                return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Value\StandardImporter();
            });
        }
    }

    private function isMigrationToolInstalled(): bool
    {
        /** @var PackageService $packageService */
        $packageService = $this->app->make(PackageService::class);
        $migrationToolPackage = $packageService->getByHandle('migration_tool');
        if ($migrationToolPackage && $migrationToolPackage->isPackageInstalled()) {
            return true;
        }

        return false;
    }
}
