$(document).ready(function () {

    var smiles = $("#smilesChoose");
    var inputEl = $("#chatInp");
    var smilesBtn = $("#smilesBtn");
    var messages = $("div.chat-messages");

    $('div.chat-message').emotions();
    smiles.emotions();

    $("#smilesChoose span").click(function () {
        var shortCode = $.emotions.shortcode($(this).attr("title"));
        inputEl.val(inputEl.val() + " " + shortCode + " ");
        smiles.toggle();
        inputEl.focus();
    });

    $("#smilesBtn").click(function () {
        smiles.toggle();
    });

    $("#sendBtn").click(function () {
        processMessage();
    });



    /*$(document).click(function(e){
     if($("div.chat-input").find(document.activeElement).length==0){
     smiles.hide();
     }
     });*/

    inputEl.keydown(function (e) {
        if (e.keyCode == 13) {
            processMessage();
        }
    }).focus();

    function processMessage() {
        inputEl.focus();
        var txt = inputEl.val();
        inputEl.val('');

        if (txt.length < 1)
            return;

        txt = $.emotions(txt);

        messages.append('<div class="chat-message"><strong>Пётр: </strong>' + txt + '</div>');
        messages.scrollTop(messages[0].scrollHeight)
    }

});