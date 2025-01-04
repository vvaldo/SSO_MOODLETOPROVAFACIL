$(document).ready(function() {
    $("#confirmation-modal").dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            "Fechar": function() {
                $(this).dialog("close");
            }
        }
    });

    // Abrir o modal
    $("#confirmation-modal").dialog("open");
});