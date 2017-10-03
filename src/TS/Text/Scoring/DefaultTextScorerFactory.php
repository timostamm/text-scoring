<?php

namespace TS\Text\Scoring;


class DefaultTextScorerFactory implements TextScorerFactory
{

	public function createTextScorer(array $criteria): TextScorer
	{
		return new TextScorer($criteria);
	}

}

