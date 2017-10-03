<?php

namespace Tests\TS\TextScoring;


use PHPUnit\Framework\TestCase;
use TS\TextScoring\TextScorer;
use TS\TextScoring\TextScoreKeyword;


class TextScorerTest extends TestCase
{

	public function testTwoKeywordsHit()
	{
		$txt = 'Volkswagen (Abkürzung VW) ist die Stammmarke der Volkswagen AG.';
		
		$vw = new TextScoreKeyword('VW', 10);
		
		$stammarke = new TextScoreKeyword('Stammmarke', 5);
		
		$scorer = new TextScorer([
			$vw,
			$stammarke
		]);
		$score = $scorer->score($txt);
		
		$this->assertEquals(15, $score);
	}

	public function testOneKeywordHit()
	{
		$txt = 'Volkswagen (Abkürzung VW) ist die Stammmarke der Volkswagen AG.';
		
		$scorer = new TextScorer([
			new TextScoreKeyword('VW', 10),
			new TextScoreKeyword('Porsche', 5)
		]);
		$score = $scorer->score($txt);
		
		$this->assertEquals(10, $score);
	}

	public function testIgnoreCase()
	{
		$txt = 'Volkswagen (Abkürzung VW) ist die Stammmarke der Volkswagen AG.';
		
		$vw = new TextScoreKeyword('VW', 10);
		$vw->caseSensitive = false;
		
		$scorer = new TextScorer([
			$vw
		]);
		$score = $scorer->score($txt);
		
		$this->assertEquals(10, $score);
	}

	public function testHonorCase()
	{
		$txt = 'Volkswagen (Abkürzung VW) ist die Stammmarke der Volkswagen AG.';
		
		$scorer = new TextScorer([
			new TextScoreKeyword('VOLKSWAGEN', 10)
		]);
		$score = $scorer->score($txt);
		
		$this->assertEquals(0, $score);
	}

	public function testDoubleKeywordHit()
	{
		$txt = 'Volkswagen (Abkürzung VW) ist die Stammmarke der Volkswagen AG.';
		
		$scorer = new TextScorer([
			new TextScoreKeyword('VW', 10)
		]);
		$score = $scorer->score($txt);
		
		$this->assertEquals(10, $score);
	}

	public function testDoubleKeywordHitMultiple()
	{
		$txt = 'Volkswagen (Abkürzung VW) ist die Stammmarke der Volkswagen AG.';
		
		$volkswagen = new TextScoreKeyword('Volkswagen', 10);
		$volkswagen->ignoreMultiple = false;
		
		$scorer = new TextScorer([
			$volkswagen
		]);
		$score = $scorer->score($txt);
		
		$this->assertEquals(20, $score);
	}

}

