
<?php

	require 'config/config.php';
        
        $commits = array();
        $cards = array();
        
        function _PostCommentToCard() {
            global $cards;
            
            echo '<script>';
            foreach ($cards as $card) {
                echo 'TrelloCardComment("' .$card['id']. '", "' .$card['text']. '");';
            }
            echo '</script>';
        }

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
            $i = 0;
            foreach ($payload['commits'] as $commit) {
                $commits[$i]['message'] = $commit['message'];
                $commits[$i]['id'] = $commit['id'];
                $commits[$i]['url'] = $commit['url'];
//              array_push($commits, $commit['message']);
                $i++;
            }
            
//            echo '<pre>';
//            echo print_r($commits);
//            echo '</pre>';
            
        }
        
        function _FillCardsArrayWithCommitMessages() {
            
            global $commits, $cards;
            $i = 0;
            foreach ($commits as $commit) {
                $pattern = '/.*card\s(\d+)\s\-\s(.*)/';
                $string = $commit['message'];
                
                if (preg_match($pattern, $string)) {
//                    echo 'true<br/>';-
                    $cardid = preg_replace($pattern, '$1', $string);
                    $cardtext = preg_replace($pattern, '$2', $string);
                    $cards[$i]['id'] = $cardid;
                    $cards[$i]['text'] = $cardtext. ' / ' .$commit['id']. ' / ' .$commit['url'];
//                    $cards[$i]['action'] = "";
                    $i++;
                } 
            }
            
            echo '<pre>';
            echo print_r($cards);
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