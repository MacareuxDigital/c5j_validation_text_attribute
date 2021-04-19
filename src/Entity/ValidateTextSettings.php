<?php

namespace C5j\C5jValidationTextAttribute\Entity;

use Concrete\Core\Entity\Attribute\Key\Settings\Settings;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="atValidateTextSettings")
 */
class ValidateTextSettings extends Settings
{
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $akTextPlaceholder = '';

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $akRegexRule = '';

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $akErrorMessage = '';

    /**
     * @return string
     */
    public function getPlaceholder()
    {
        return $this->akTextPlaceholder;
    }

    /**
     * @param string $akTextPlaceholder
     */
    public function setPlaceholder($akTextPlaceholder)
    {
        $this->akTextPlaceholder = $akTextPlaceholder;
    }

    /**
     * @return string
     */
    public function getRegexRule()
    {
        return $this->akRegexRule;
    }

    /**
     * @param string $akRegexRule
     */
    public function setRegexRule($akRegexRule)
    {
        $this->akRegexRule = $akRegexRule;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->akErrorMessage;
    }

    /**
     * @param string $akErrorMessage
     */
    public function setErrorMessage($akErrorMessage)
    {
        $this->akErrorMessage = $akErrorMessage;
    }
}
