$(document).ready(function() {
    $('.modifier-boutton').click(function(event) {
        event.preventDefault();
        var id = $(this).data('id'); // Récupérer l'ID de la ligne
        $.ajax({
            url: "/modifier/" + id,
            type: "POST",
            data: { id: id },
            success: function(response) {
                console.log("Champ mis à jour avec succès");
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors de la mise à jour du champ");
            }
        });
    });
});
