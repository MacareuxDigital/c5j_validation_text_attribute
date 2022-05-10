<?php

namespace C5j\C5jValidationTextAttribute\MigrationTool\Entity\Import\AttributeKey;

use C5j\C5jValidationTextAttribute\MigrationTool\Batch\Formatter\AttributeKey\ValidationTextFormatter;
use C5j\C5jValidationTextAttribute\MigrationTool\Publisher\AttributeKey\ValidationTextPublisher;
use Doctrine\ORM\Mapping as ORM;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\AttributeKey\AttributeKey;

/**
 * @ORM\Entity
 * @ORM\Table(name="MigrationImportValidationTextAttributeKeys")
 */
class ValidationTextAttributeKey extends AttributeKey
{
	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $text_placeholder = '';

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $regex_rule = '';

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $error_message = '';

	/**
	 * @return string
	 */
	public function getPlaceholder()
	{
		return $this->text_placeholder;
	}

	/**
	 * @param string $text_placeholder
	 */
	public function setPlaceholder($text_placeholder)
	{
		$this->text_placeholder = $text_placeholder;
	}

	/**
	 * @return string
	 */
	public function getRegexRule()
	{
		return $this->regex_rule;
	}

	/**
	 * @param string $regex_rule
	 */
	public function setRegexRule($regex_rule)
	{
		$this->regex_rule = $regex_rule;
	}

	/**
	 * @return string
	 */
	public function getErrorMessage()
	{
		return $this->error_message;
	}

	/**
	 * @param string $error_message
	 */
	public function setErrorMessage($error_message)
	{
		$this->error_message = $error_message;
	}

    public function getType()
    {
        return 'validation_text';
    }

    public function getFormatter()
    {
        return new ValidationTextFormatter($this);
    }

    public function getTypePublisher()
    {
        return new ValidationTextPublisher();
    }
}
