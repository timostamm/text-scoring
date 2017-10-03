<?php

namespace TS\Text\Scoring;


class TextScoreKeyword implements TextScoreCriterium
{

	public $text;

	public $caseSensitive = true;

	public $ignoreMultiple = true;

	public $value = 1;

	public function __construct(string $text, int $value, bool $caseSensitive = true, bool $ignoreMultiple = true)
	{
		$this->text = $text;
		$this->value = $value;
		$this->caseSensitive = $caseSensitive;
		$this->ignoreMultiple = $ignoreMultiple;
	}

}

