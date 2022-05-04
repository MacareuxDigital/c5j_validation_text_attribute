<?php

namespace Concrete\Package\C5jValidationTextAttribute\Attribute\ValidationText;

use C5j\C5jValidationTextAttribute\Entity\ValidateTextSettings;
use Concrete\Core\Attribute\Controller as AttributeController;
use Concrete\Core\Attribute\FontAwesomeIconFormatter;
use Concrete\Core\Entity\Attribute\Value\Value\TextValue;
use Concrete\Core\Error\ErrorList\Error\Error;
use Concrete\Core\Error\ErrorList\Error\FieldNotPresentError;
use Concrete\Core\Error\ErrorList\Field\AttributeField;
use Concrete\Core\Validator\String\RegexValidator;

class Controller extends AttributeController
{
    protected $helpers = ['form'];

    protected $searchIndexFieldDefinition = [
        'type' => 'text',
        'options' => ['default' => null, 'notnull' => false],
    ];

    public function type_form()
    {
        $this->load();
    }

    public function form()
    {
        $this->load();
        $value = null;
        if (is_object($this->attributeValue)) {
            $value = $this->app->make('helper/text')->entities($this->getAttributeValue()->getValue());
        }
        $this->set('value', $value);
    }

    public function getAttributeKeySettingsClass()
    {
        return ValidateTextSettings::class;
    }

    public function saveKey($data)
    {
        /**
         * @var ValidateTextSettings
         */
        $type = $this->getAttributeKeySettings();
        $data += [
            'akTextPlaceholder' => null,
            'akRegexRule' => null,
            'akErrorMessage' => null,
        ];
        $akTextPlaceholder = $data['akTextPlaceholder'];
        $akRegexRule = $data['akRegexRule'];
        $akErrorMessage = $data['akErrorMessage'];

        $type->setPlaceholder($akTextPlaceholder);
        $type->setRegexRule($akRegexRule);
        $type->setErrorMessage($akErrorMessage);

        return $type;
    }

    public function getIconFormatter()
    {
        return new FontAwesomeIconFormatter('file-text');
    }

    public function validateForm($data)
    {
        if (!$data['value']) {
            return new FieldNotPresentError(new AttributeField($this->getAttributeKey()));
        }

        $ak = $this->getAttributeKey();

        if (is_object($ak)) {
            $type = $ak->getAttributeKeySettings();
            /**
             * @var ValidateTextSettings
             */
            if ($type->getRegexRule()) {
                $pattern = $type->getRegexRule();

                $validator = $this->app->make(RegexValidator::class, ['pattern' => $pattern]);
                $e = $this->app->make('error');

                if ($type->getErrorMessage()) {
                    $akErrorMessage = $type->getErrorMessage();
                    $validator->setErrorString(1, $akErrorMessage);
                }

                if (!$validator->isValid($data['value'], $e)) {
                    return new Error($e->toText(), new AttributeField($this->getAttributeKey()));
                }
            }
        }

        return true;
    }

    public function getAttributeValueClass()
    {
        return TextValue::class;
    }

    public function createAttributeValue($value)
    {
        $av = new TextValue();
        $av->setValue($value);

        return $av;
    }

    public function createAttributeValueFromRequest()
    {
        $data = $this->post();
        if ($data['value']) {
            $ak = $this->getAttributeKey();
            if (is_object($ak)) {
                $e = $this->app->make('error');
                $type = $ak->getAttributeKeySettings();
                /**
                 * @var ValidateTextSettings
                 */
                $pattern = $type->getRegexRule();
                $validator = $this->app->make(RegexValidator::class, ['pattern' => $pattern]);
                if (!$validator->isValid($data['value'], $e)) {
                    return $this->createAttributeValue(null);
                }
            }

            return $this->createAttributeValue($data['value']);
        }

        return $this->createAttributeValue(null);
    }

    public function validateKey($data = false)
    {
        $akRegexRule = $data['akRegexRule'];
        $e = $this->app->make('error');
        if ($akRegexRule) {
            if (!$this->validateRegex($akRegexRule)) {
                $e->add(t('You must specify valid regex format.'));
            }
        } else {
            $e->add(t('You must specify valid regex format.'));
        }

        return $e;
    }

    protected function load()
    {
        $ak = $this->getAttributeKey();
        if (!is_object($ak)) {
            return false;
        }

        $type = $ak->getAttributeKeySettings();
        /**
         * @var ValidateTextSettings
         */
        $akTextPlaceholder = $type->getPlaceholder();
        $akRegexRule = $type->getRegexRule();
        $akErrorMessage = $type->getErrorMessage();

        if ($akTextPlaceholder) {
            $this->set('akTextPlaceholder', $akTextPlaceholder);
        } else {
            $this->set('akTextPlaceholder', null);
        }

        if ($akRegexRule) {
            $this->set('akRegexRule', $akRegexRule);
        } else {
            $this->set('akRegexRule', null);
        }

        if ($akErrorMessage) {
            $this->set('akErrorMessage', $akErrorMessage);
        } else {
            $this->set('akErrorMessage', null);
        }
    }

    /**
     * Check if a given regular expression is valid.
     *
     * @param $regex
     *
     * @return bool
     */
    protected function validateRegex($regex)
    {
        // If this test returns false it means we have invalid regex
        if (@preg_match($regex, null) === false) {
            return false;
        }

        return true;
    }
}
