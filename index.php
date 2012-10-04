
<?php

	require 'functions.php';
	require 'header.php';

	$h = NEW TrelloClient($username, $apiKey);
	//~ $test = $h->getMember();
	$test = $h->listBoardCards('506b1cbc632aaf5560154a80');

	echo '<pre>';
	echo print_r($test);
	echo '</pre>';

	//~ echo '<form action="index.php" method="post">';
	//~ echo '<textarea id="payload" name="payload" class="element textarea medium"></textarea>';

	//~ echo '<br />
		//~ <input type="submit" />
		//~ </form>';

	//~ echo '<br/><br/><br/>';

	//~ if (!empty($_POST["payload"])) {

		//~ $payload = json_decode($_POST["payload"], true);

		//~ echo '<br/><br/>';
		//~ echo $payload['head_commit']['message'];
		//~ echo '<br/><br/>';

		//~ echo '<pre>';
		//~ echo print_r($payload);
		//~ echo '</pre>';

	//~ } else {

		//~ $payload = "";

	//~ }

	//~ $file=fopen("payload.txt","w+") or exit("Unable to open file!");



	require 'footer.php';

?>