<?php

namespace Validation\Rules;

use Validation\AbstractRule;

class Length extends AbstractRule {

	protected $min = 0;

	protected $max = 0;

	protected $length = 0;

	public function __construct($range = '0,0') {
		list($min, $max) = explode(',', $range);

		$this->setRange($min, $max);
	}

	public function setRange($min, $max = 0) {
		$this->min = (int) $min;
		$this->max = (int) $max;
	}

	public function withRange($min, $max = 0) {
		$this->setRange($min, $max);

		return $this;
	}

	public function isValid() {
		$value = $this->getValue();

		$length = strlen($value);

		if($this->max > 0 && $length > $this->max) {
			return false;
		}

		if($length < $this->min) {
			return false;
		}

		return true;
	}

	public function getMessage() {
		return '%s need to be more than '.$this->min.' characters and less than '.$this->max.' characters';
	}

}
