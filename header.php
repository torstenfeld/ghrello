<?php

	echo '<!-- header start -->
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
		<head>
			<!-- <link rel="stylesheet" type="text/css" href="http://www1.avira.com/assets/e4d83f0773718821f3e913a7349e92e0.css" /> -->
			<link rel="stylesheet" type="text/css" href="css/style.css" />
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="Robots" content="index,follow" />
			<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8" />
			<meta name="language" content="de" />
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
			<script src="https://api.trello.com/1/client.js?key=' .$apiKey. '"></script>
                        <script src="js/trello.js"></script>
                        <script>boardid = "' .$tr_boardid. '"</script>
		</head>
		<!-- header end -->';

	echo '<body class="default-template" onload="OnLoad()">
            <br/><br/><br/>';


?>