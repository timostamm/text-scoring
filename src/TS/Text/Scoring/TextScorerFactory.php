<?php

namespace TS\Text\Scoring;


interface TextScorerFactory
{

	function createTextScorer(array $criteria): TextScorer;

}

