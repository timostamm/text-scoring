<?php

namespace TS\TextScoring;


class DefaultTextScorerFactory implements TextScorerFactory
{

	public function createTextScorer(array $criteria): TextScorer
	{
		return new TextScorer($criteria);
	}

}

