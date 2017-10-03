PHP Text Scoring Library
========================

This Library scores an input text based on weighted keywords.

It can be used to associate a selection of interests with a bunch of keywords and evaluate the relevance of a given text. 


=== Example ===

´´´php

// We setup our keywords.
// If "VW" is present in the text, add 10 points to the score.
// If "Stammmarke" is present in the text, add 5 points to the score. 
$criteria = [
	new TextScoreKeyword('VW', 10), 
	new TextScoreKeyword('Stammmarke', 5)
];


// This is our example text. It contains both keywords, 
// so it should score 15 points.
$txt = 'Volkswagen (Abkürzung VW) ist die Stammmarke der Volkswagen AG.';
$scorer = new TextScorer($criteria);
$score = $scorer->score($txt);
print $score; // => 15
´´´
