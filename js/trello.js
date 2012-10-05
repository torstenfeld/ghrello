
function TrelloAuthorize() {
    
    updateLoggedIn();
    
    Trello.authorize({
        type: "popup",
        persist: true,
        success: onAuthorize,
        error: "",
        name: "Ghrello",
        scope: {read:true, write:true, account:false},
        expiration: "never"
    });
}

function TrelloDeauthorize() {
    Trello.deauthorize();
    updateLoggedIn();
    
    
}

var onAuthorize = function() {
    updateLoggedIn();
    $("#output").empty();

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

};

var updateLoggedIn = function() {
    var isLoggedIn = Trello.authorized();
    $("#loggedout").toggle(!isLoggedIn);
    $("#loggedin").toggle(isLoggedIn);
};

Trello.authorize({
    interactive:false,
    success: onAuthorize
});