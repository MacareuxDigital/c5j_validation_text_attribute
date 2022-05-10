<?php

namespace C5j\C5jValidationTextAttribute\MigrationTool\Batch\Formatter\AttributeKey;

use PortlandLabs\Concrete5\MigrationTool\Batch\Formatter\AttributeKey\AbstractFormatter;

defined('C5_EXECUTE') or die('Access Denied.');

class ValidationTextFormatter extends AbstractFormatter
{
    public function getBatchTreeNodeJsonObject()
    {
        /** @var \C5j\C5jValidationTextAttribute\MigrationTool\Entity\Import\AttributeKey\ValidationTextAttributeKey $key */
        $key = $this->key;

        $nodes = [];

        $node = new \stdClass();
        $node->title = t('Place Holder');
        $node->itemvalue = $key->getPlaceholder();
        $nodes[] = $node;

        $node = new \stdClass();
        $node->title = t('Regex Rule');
        $node->itemvalue = $key->getRegexRule();
        $nodes[] = $node;

	    $node = new \stdClass();
	    $node->title = t('Error Message');
	    $node->itemvalue = $key->getErrorMessage();
	    $nodes[] = $node;

        return $this->deliverTreeNodeDataJsonObject($nodes);
    }
}
