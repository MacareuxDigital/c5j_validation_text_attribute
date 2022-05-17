<?php

namespace C5j\C5jValidationTextAttribute\MigrationTool\Importer\CIF\Attribute\Key;

use C5j\C5jValidationTextAttribute\MigrationTool\Entity\Import\AttributeKey\ValidationTextAttributeKey;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\AttributeKey\AttributeKey;
use PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Attribute\Key\ImporterInterface;

defined('C5_EXECUTE') or die('Access Denied.');

class ValidationTextImporter implements ImporterInterface
{
    public function getEntity()
    {
        return new ValidationTextAttributeKey();
    }

    /**
     * @param ValidationTextAttributeKey $key
     * @param \SimpleXMLElement $element
     */
    public function loadFromXml(AttributeKey $key, \SimpleXMLElement $element)
    {
        $key->setPlaceholder((string) $element->type['akTextPlaceholder']);
        $key->setRegexRule((string) $element->type['akRegexRule']);
        $key->setErrorMessage((string) $element->type['akErrorMessage']);
    }
}
