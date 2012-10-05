
<?php

	require 'config.php';

	function _CreateCard() {

			//~ Trello
			//~ .post("cards", { name: "Foo", desc: "Bar", idList:"..."})
			//~ .done(function(card) { alert(card.id) })

	}

	function _FormCreate() {

		echo '<form action="index.php" method="post">';
		echo '<textarea id="payload" name="payload" class="element textarea medium"></textarea>';

		echo '<br />
                    <input type="submit" />
                    </form>';

	}

	function _PayloadGet() {

		global $payload;

		if (!empty($_POST["payload"])) {

			$payload = json_decode($_POST["payload"], true);

			echo '<br/><br/>';
			echo $payload['head_commit']['message'];
			echo '<br/><br/>';

			echo '<pre>';
			echo print_r($payload);
			echo '</pre>';

		} else {

			$payload = "";

		}
	}



?>