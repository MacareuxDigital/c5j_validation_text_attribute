<?php

namespace C5j\C5jValidationTextAttribute\MigrationTool\Publisher\AttributeKey;

use C5j\C5jValidationTextAttribute\Entity\ValidateTextSettings;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\AttributeKey\AttributeKey;
use PortlandLabs\Concrete5\MigrationTool\Publisher\AttributeKey\AbstractPublisher;

defined('C5_EXECUTE') or die('Access Denied.');

class ValidationTextPublisher extends AbstractPublisher
{
    public function publish(AttributeKey $source, $destination)
    {
        $settings = new ValidateTextSettings();
        $settings->setPlaceholder($source->getPlaceholder());
        $settings->setRegexRule($source->getRegexRule());
        $settings->setErrorMessage($source->getErrorMessage());

        return $this->publishAttribute($source, $settings, $destination);
    }
}
