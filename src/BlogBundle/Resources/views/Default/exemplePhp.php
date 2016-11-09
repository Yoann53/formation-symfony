








<?php echo $post ?>
<?php echo $autor ?>

<?php

if($autor == 'Yoann') {
	echo $post;
} else if ($autor == 'Jessica') {
	echo "<p>l'auteur est Jessica</p>";
} else {
	echo "<p>l'auteur n'est pas Yoann mais" . $autor . "</p>";
}

$date->format('Y/m/d H:i:s');

foreach($comments as $comment){
	echo $comment[0].' '.$comment[1] . ' ' . $comment[1]['age'];
}