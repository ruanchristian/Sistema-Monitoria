function ajaxRequest(value) {

    var sel = $("#alunos");
    sel.empty();

    $.ajax({
        type: "POST",
        url: '/Sistema Monitoria/controller/job.php',
        data: {
            'turma': value
        },
    }).done(function (result) {
        sel.append(result);

    }).fail(function () {
        alert('Erro :/');
    });
};