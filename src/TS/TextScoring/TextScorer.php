<?php

namespace TS\TextScoring;


// TODO KeywordOrGroup -> scored nur eines der keywords (alternative: alias)
// TODO KeywordAndGroup -> scored nur, wenn alle keywords treffen

class TextScorer
{

	private $criteria;

	private $lastDetails = null;

	public function __construct(array $criteria)
	{
		$this->criteria = $criteria;
		foreach ($this->criteria as $crit) {
			if (! $crit instanceof TextScoreCriterium) {
				throw new \InvalidArgumentException();
			}
		}
	}

	public function score(string $text): float
	{
		$r = $this->scoreDetails($text);
		return $r['score'];
	}

	public function scoreDetails(string $text): array
	{
		$result = [
			'score' => 0,
			'criteria' => []
		];
		foreach ($this->criteria as $crit) {
			if ($crit instanceof TextScoreKeyword) {
				$r = $this->scoreKeyword($crit, $text);
				if ($r['score'] != 0) {
					$result['criteria'][] = $r;
					$result['score'] += $r['score'];
				}
			} else {
				throw new \Exception('unsupported criterium');
			}
		}
		$this->lastDetails = $result;
		return $result;
	}

	public function getLastScoreDetails(): array
	{
		if ($this->lastDetails == null) {
			throw new \OutOfRangeException();
		}
		return $this->lastDetails;
	}

	protected function scoreKeyword(TextScoreKeyword $keyword, string $text): array
	{
		$result = [
			'keyword' => $keyword->text,
			'score' => 0,
			'hitcount' => 0
		];
		$pos = $this->strpos($text, $keyword->text, $keyword->caseSensitive);
		if ($pos === - 1) {
			return $result;
		}
		$result['score'] = $keyword->value;
		$result['hitcount'] += 1;
		if ($keyword->ignoreMultiple) {
			return $result;
		}
		while ($pos >= 0) {
			$pos = $this->strpos($text, $keyword->text, $keyword->caseSensitive, $pos + 1);
			if ($pos >= 0) {
				$result['score'] += $keyword->value;
				$result['hitcount'] += 1;
			}
		}
		return $result;
	}

	protected function strpos(string $haystack, string $needle, bool $caseSensitive, $offset = 0): int
	{
		$p = $caseSensitive ? strpos($haystack, $needle, $offset) : stripos($haystack, $needle, $offset);
		return is_int($p) ? $p : - 1;
	}

}

