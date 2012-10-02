
<?php

	require 'config.php';
	include 'trello/Trello.php';
	include 'trello/TrelloClient.php';
	include 'trello/TrelloBoard.php';

	function _TrelloAuth() {

		global $key, $secret, $url;

		$url_auth = 'https://trello.com/1/authorize';
		$param = 'board/506ac35636fa37ae13919ff8?key=' .$key;

	}




?>