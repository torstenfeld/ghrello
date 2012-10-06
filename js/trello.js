
var isLoggedIn;
var longCardId;

function TrelloAuthorize() {
    
    Trello.authorize({
        type: "popup",
        persist: true,
        success: "TrelloGetCards",
        error: "",
        name: "Ghrello",
        scope: {read:true, write:true, account:false},
        expiration: "never"
    });
    
    UpdateLoggedIn();
}

function TrelloCardComment(id, comment) {
    // API: https://trello.com/docs/gettingstarted/clientjs.html
    // card shortlink: https://trello.com/docs/api/card/index.html#post-1-cards-card-id-or-shortlink-actions-comments
    comment2 = "test2";
    var longid = TrelloGetCardId(id);
//    alert("2: " + comment2);
    alert("test3");
//    alert("2: " + longid + "\n" + String(comment));
    
//    Trello.post("cards/" + id + "/actions/comments/",
//        text: comment,
//        success: "",
//        error: ""
//    });
    
}

function TrelloGetCardId(cardid) {
//    /1/boards/board_id/cards/short_id
    Trello.get("boards/" + boardid + "/cards/" + cardid, function(card) {
        alert("1: " + String(card.id));
        longCardId = card.id;
        alert("2: " + longCardId);
    });
    alert(longCardId);
//    alert(card.id);
//    return longid;
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
    
    TrelloAuthorize();
    isLoggedIn = UpdateLoggedIn();
//    alert("OnLoad");
//    if (!isLoggedIn) {
//        alert("OnLoad - not logged in");
//        TrelloAuthorize();
//        isLoggedIn = UpdateLoggedIn();
//    } else {
//        alert("OnLoad - logged in");
//    }
    $("#output").empty();

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
        Trello.get("boards/" + boardid + "/cards", function(cards) {
            $cards.empty();
            $.each(cards, function(ix, card) {
                $("<a>")
                .attr({href: card.url, target: "trello"})
                .addClass("card")
                .text(card.name + " / " + card.id)
//                .text(card.name + " / " + card.id + " / " + TrelloGetCardId("17"))
                .appendTo($cards);
            });
        });
    });
    
}

function TrelloDeauthorize() {
    Trello.deauthorize();
    UpdateLoggedIn();
}

function UpdateLoggedIn() {
    isLoggedIn = Trello.authorized();
    $("#loggedout").toggle(!isLoggedIn);
//    $("#loggedout").toggle(isLoggedIn);
    $("#loggedin").toggle(isLoggedIn);
//    alert("UpdateLoggedIn:" + isLoggedIn);
    return isLoggedIn;
}
