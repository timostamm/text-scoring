<?php

namespace TS\TextScoring;


interface TextScorerFactory
{

	function createTextScorer(array $criteria): TextScorer;

}

