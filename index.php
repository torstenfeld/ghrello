<?php

	require 'functions.php';
	require 'header.php';
        
        _FormCreate();
        
        echo '<br/><br/><br/>';
        
        _PayloadGet();
        
        echo '<br/><br/><br/>';
        
        _FillCardsArrayWithCommitMessages();
        _PostCommentToCard();

        echo '<div id="loggedout">
                <a id="connectLink" onclick="TrelloAuthorize();" href="#">Connect To Trello</a>
            </div>

            <!-- <div id="loggedin"> -->
            <div id="test">
                <div id="header">
                    Logged in to as <span id="fullName"></span> 
                    <a id="disconnect" onclick="TrelloDeauthorize();" href="#">Log Out</a>
                </div>
                
                <br/><br/>
                <!-- <script>TrelloCardComment("17", "test");</script> -->
                <div id="test"></div>
                <br/><br/>

                <div id="output">output</div>
            </div>  
            <div id="authorizationtest">
                <a id="atest" onclick="UpdateLoggedIn();">click me for auth test</a>
            </div>';

	echo '<br/><br/><br/>';



	require 'footer.php';

?>