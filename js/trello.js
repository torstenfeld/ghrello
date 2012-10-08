
isLoggedIn = "";
longCardId = "";
requestToken = "";
token = "";

function TrelloAuthorize() {
    
    if (!Trello.authorized()) {
        // interactive authorization with popup
//      requestToken = Trello.authorize({
//            type: "popup",
//            persist: true,
//            expiration: "never",
//            name: "Ghrello",
//            success: "TrelloGetCards",
//            scope: {read:true, write:true, account:false}
//        });
        
        // non-interactive authorization with redirect
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
    alert("TrelloAuthorize - token: \n" + token);
    $.post("../action.php", { trtoken: token });
//    alert(objToString(requestToken));
    
//    UpdateLoggedIn();
}

function TrelloCardComment(id, comment) {
    // API: https://trello.com/docs/gettingstarted/clientjs.html
    // card shortlink: https://trello.com/docs/api/card/index.html#post-1-cards-card-id-or-shortlink-actions-comments
    var longid = TrelloGetCardId(id);
//    alert("11: " + longid + " / " + comment);

    var test = Trello.post("cards/" + longid + "/actions/comments/?token=" + token, {
        text: comment,
        success: alert("TrelloCardComment - card comment: \nsuccess!"),
        error: alert("TrelloCardComment - card comment: \nerror!")
    });
//    alert("TrelloCardComment - test: \n" + objToString(test));
}

function TrelloGetCardId(cardid) {
    
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

function OnLoad() {
    TrelloGetCards();
}

function TrelloGetCards() {
    Trello.members.get("me", function(member){
        $("#fullName").text(member.fullName);

        var $cards = $("<div>")
            .text("Loading Cards...")
            .appendTo("#output");

        // Output a list of all of the cards that are on the board list
        var result = Trello.get("boards/" + boardid + "/cards", function(cards) {
            $cards.empty();
            $.each(cards, function(ix, card) {
                $("<a>")
                .attr({href: card.url, target: "trello"})
                .addClass("card")
                .text(card.name + " / " + card.id + " / " + card.idShort)
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
    return isLoggedIn;
}
