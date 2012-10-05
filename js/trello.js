
var isLoggedIn;

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
    Trello.members.get("me", function(member){
        $("#fullName").text(member.fullName);

        var $cards = $("<div>")
            .text("Loading Cards...")
            .appendTo("#output");

        // Output a list of all of the cards that the member
        // is assigned to
        Trello.get("members/me/cards", function(cards) {
            $cards.empty();
            $.each(cards, function(ix, card) {
                $("<a>")
                .attr({href: card.url, target: "trello"})
                .addClass("card")
                .text(card.name)
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
