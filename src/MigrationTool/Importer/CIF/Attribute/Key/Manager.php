<?php

namespace C5j\C5jValidationTextAttribute\MigrationTool\Importer\CIF\Attribute\Key;

defined('C5_EXECUTE') or die('Access Denied.');

class Manager extends \Concrete\Core\Support\Manager
{
	public function __construct($app)
	{
		parent::__construct($app);
		$this->extend('boolean', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\BooleanImporter();
		});
		$this->extend('select', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\SelectImporter();
		});
		$this->extend('text', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\TextImporter();
		});
		$this->extend('textarea', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\TextAreaImporter();
		});
		$this->extend('image_file', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\ImageFileImporter();
		});
		$this->extend('topics', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\TopicsImporter();
		});
		$this->extend('rating', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\RatingImporter();
		});
		$this->extend('number', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\NumberImporter();
		});
		$this->extend('social_links', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\SocialLinksImporter();
		});
		$this->extend('date_time', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\DateTimeImporter();
		});
		$this->extend('address', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\AddressImporter();
		});

		$this->extend('url', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\TextImporter();
		});

		$this->extend('email', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\TextImporter();
		});

		$this->extend('page', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\PageImporter();
		});
		$this->extend('page_selector', function () {
			return new \PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\PageImporter();
		});
		$this->extend('validation_text', function () {
			return new \C5j\C5jValidationTextAttribute\MigrationTool\Importer\CIF\Attribute\Key\ValidationTextImporter();
		});
	}

	public function driver($driver = null)
	{
		// If a custom driver is not registered, we use unmapped
		if (!isset($this->customCreators[$driver])) {
			return new UnknownImporter();
		}

		return parent::driver($driver);
	}
}
