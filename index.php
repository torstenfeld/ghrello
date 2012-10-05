<?php

	require 'functions.php';
	require 'header.php';

        echo '<div id="loggedout">
                <a id="connectLink" onclick="TrelloAuthorize();" href="#">Connect To Trello</a>
            </div>

            <div id="loggedin">
                <div id="header">
                    Logged in to as <span id="fullName"></span> 
                    <a id="disconnect" onclick="TrelloDeauthorize();" href="#">Log Out</a>
                </div>

                <div id="output"></div>
            </div>  ';

	echo '<br/><br/><br/>';



	//~ $file=fopen("payload.txt","w+") or exit("Unable to open file!");



	require 'footer.php';

?>