
<?php

	require 'config.php';
        
        $commits = array();

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
        
        function _GetAllCommitsFromPayload() {
            
            global $payload, $commits;
            
            foreach ($payload['commits'] as $commit) {
                array_push($commits, $commit['message']);
            }
            
            echo '<pre>';
            echo print_r($commits);
            echo '</pre>';
            
        }

	function _PayloadGet() {

		global $payload, $gh_project;
                

		if (!empty($_POST["payload"])) {
                    
                        $payload = json_decode($_POST["payload"], true);

                        $gh_commit_message = $payload['head_commit']['message'];
                        $gh_project = $payload['repository']['name'];
                        
//			echo '<br/><br/>';
//			echo $gh_commit_message. '<br/>';
//                        echo $gh_project;
//			echo '<br/><br/>';
//
//			echo '<pre>';
//			echo print_r($payload);
//			echo '</pre>';
                        
                        _GetAllCommitsFromPayload();

		} else {

			$payload = "";

		}
	}



?>