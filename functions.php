
<?php

	require 'config/config.php';
        
//  VARIABLES        
        $commits = array();
        $cards = array();
        $config_array = array();
        $apiKey = ""; // key from test account
        $tr_boardid = ""; // trello board id
        $gh_project = ""; // name of github project
        
//  CODE ON LOAD        
        if ((_CurPageName() == "index.php")) {
            if (!_CheckConfigValues()) {
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=install.php">';
                exit();
            }
        }
        
//  FUNCTIONS        
        function _CurPageName() {
            return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
        }
        
        function _CheckConfigValues() {
            global $apiKey, $tr_boardid, $gh_project, $config_array;
            
            $config_array = parse_ini_file("config/config.ini");
            
            if ( !isset($config_array['trapikey'])
                and !isset($config_array['trboardid'])
                and !isset($config_array['ghproject'])) {
//                die("No configuration found");
                return false;
            }
            
            $apiKey = $config_array['trapikey']; // key from test account
            $tr_boardid = $config_array['trboardid']; // trello board id
            $gh_project = $config_array['ghproject']; // name of github project

//            if (empty($apiKey))
//                die("Trello API key missing in configuration.");
//            
//            if (empty($tr_boardid))
//                die("Trello board id missing in configuration.");
//            
//            if (empty($gh_project))
//                die("GitHub project name missing in configuration.");
            return true;
        }
        
        function _PostCommentToCard() {
            global $cards;
            
            echo '<script>';
            foreach ($cards as $card) {
                echo 'TrelloCardComment("' .$card['id']. '", "' .$card['text']. '");';
            }
            echo '</script>';
        }
        
        function write_ini_file($assoc_arr, $path="config/config.ini", $has_sections=FALSE) { 
            $content = ""; 
            if ($has_sections) { 
                foreach ($assoc_arr as $key=>$elem) { 
                    $content .= "[".$key."]\n"; 
                    foreach ($elem as $key2=>$elem2) { 
                        if(is_array($elem2)) 
                        { 
                            for($i=0;$i<count($elem2);$i++) 
                            { 
                                $content .= $key2."[] = \"".$elem2[$i]."\"\n"; 
                            } 
                        } 
                        else if($elem2=="") $content .= $key2." = \n"; 
                        else $content .= $key2." = \"".$elem2."\"\n"; 
                    } 
                } 
            } 
            else { 
                foreach ($assoc_arr as $key=>$elem) { 
                    if(is_array($elem)) 
                    { 
                        for($i=0;$i<count($elem);$i++) 
                        { 
                            $content .= $key."[] = \"".$elem[$i]."\"\n"; 
                        } 
                    } 
                    else if($elem=="") $content .= $key." = \n"; 
                    else $content .= $key." = \"".$elem."\"\n"; 
                } 
            } 

            if (!$handle = fopen($path, 'w')) { 
                return false; 
            } 
            if (!fwrite($handle, $content)) { 
                return false; 
            } 
            fclose($handle); 
            return true; 
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