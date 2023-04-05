
    $(document).ready(function() {
    $('.btn-modifier').click(function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: "{{ path('get_quiz_details') }}",
            type: 'POST',
            data: { id: id },
            success: function(response) {
                // Afficher le formulaire de modification avec les détails du quiz récupérés
                $('#form-modifier #idQuiz').val(response.idQuiz);
                $('#form-modifier #titre').val(response.titre);
                $('#form-modifier #question').val(response.question);
                $('#form-modifier #option1').val(response.option1);
                $('#form-modifier #option2').val(response.option2);
                $('#form-modifier #option3').val(response.option3);
                $('#form-modifier #option4').val(response.option4);
                $('#form-modifier #reponseCorrecte').val(response.reponseCorrecte);

                // Afficher le formulaire de modification
                $('#form-modifier').show();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
            }
        });
    });
});
