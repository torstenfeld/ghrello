
isLoggedIn = "";
longCardId = "";
requestToken = "";
token = "";

function TrelloAuthorize() {
    
//    var authorize = Trello.authorize({
//        type: "popup",
//        persist: true,
//        success: "TrelloGetCards",
//        name: "Ghrello",
//        scope: {read:true, write:true, account:false},
//        expiration: "never"
//    });

    if (!Trello.authorized()) {
//        requestToken = Trello.authorize({
//            type: "popup",
//            persist: true,
//            expiration: "never",
//            name: "Ghrello",
//            success: "TrelloGetCards",
//            scope: {read:true, write:true, account:false}
//        });
        
        //test for redirect
        requestToken = Trello.authorize({
            type: "redirect",
            interactive: "false",
            persist: true,
            expiration: "never",
            name: "Ghrello",
            success: "TrelloGetCards",
            scope: {read:true, write:true, account:false}
        });
        
        
    }

    token = Trello.token();
//    alert("TrelloAuthorize - token: \n" + token);
//    alert(objToString(requestToken));
    
//    UpdateLoggedIn();
}

function TrelloCardComment(id, comment) {
    // API: https://trello.com/docs/gettingstarted/clientjs.html
    // card shortlink: https://trello.com/docs/api/card/index.html#post-1-cards-card-id-or-shortlink-actions-comments
    var longid = TrelloGetCardId(id);
    alert("11: " + longid + " / " + comment);

    
//    Trello.post("cards/" + longid + "/actions/comments/", {
//        text: comment,
//        success: alert("success: " + longid),
//        error: alert("error: " + longid)
//    });

//    token = Trello.token();
//    alert("TrelloCardComment - token: \n" + token);
    
    var test = Trello.post("cards/" + longid + "/actions/comments/?token=" + token, {
        text: comment,
        success: alert("TrelloCardComment - card comment: \nsuccess!"),
        error: alert("TrelloCardComment - card comment: \nerror!")
    });
    
//    alert("TrelloCardComment - test: \n" + objToString(test));
    
}

function TrelloGetCardId(cardid) {
//    /1/boards/board_id/cards/short_id
    
    Trello.get("boards/" + boardid + "/cards/" + cardid, function(card) {
        longCardId = card.id;
    });
    return longCardId;
}

function objToString (obj) {
    var str = '';
    for (var p in obj) {
        if (obj.hasOwnProperty(p)) {
            str += p + '::' + obj[p] + '\n';
        }
    }
    return str;
}

function OnError() {
    
    alert("");
}

function OnLoad() {
    
//    TrelloAuthorize();
//    isLoggedIn = UpdateLoggedIn();
//    alert(isLoggedIn);
//    if (!isLoggedIn) {
//        alert("OnLoad - not logged in");
//        TrelloAuthorize();
//        isLoggedIn = UpdateLoggedIn();
//    } else {
//        alert("OnLoad - logged in");
//    }
//    $("#output").empty();

    TrelloGetCards();
}

function TrelloGetCards() {
//    var boardid = "506ac35636fa37ae13919ff8";
    Trello.members.get("me", function(member){
        $("#fullName").text(member.fullName);

        var $cards = $("<div>")
            .text("Loading Cards...")
            .appendTo("#output");

        // Output a list of all of the cards that are on the board list
//        Trello.get("members/me/cards", function(cards) {
        var result = Trello.get("boards/" + boardid + "/cards", function(cards) {
            $cards.empty();
            $.each(cards, function(ix, card) {
                $("<a>")
                .attr({href: card.url, target: "trello"})
                .addClass("card")
                .text(card.name + " / " + card.id + " / " + card.idShort)
//                .text(card.name + " / " + card.id + " / " + TrelloGetCardId("17"))
                .appendTo($cards);
            });
        });
//        alert("result: "+ objToString(result));
    });
    
}

function TrelloDeauthorize() {
    Trello.deauthorize();
    UpdateLoggedIn();
}

function UpdateLoggedIn() {
    isLoggedIn = Trello.authorized();
//    $("#loggedout").toggle(!isLoggedIn);
//    $("#loggedout").toggle(isLoggedIn);
//    $("#loggedin").toggle(isLoggedIn);
//    alert("UpdateLoggedIn:" + isLoggedIn);
    return isLoggedIn;
}
