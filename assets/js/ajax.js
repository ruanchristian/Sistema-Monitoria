function ajaxRequestSelect(value) {

    var sel = $("#alunos");
    sel.empty();

    sel.removeAttr('disabled');

    $.ajax({
        type: "POST",
        url: '/Sistema Monitoria/requests/job-select.php',
        data: {
            'turma': value
        },
    }).done(function (result) {
        sel.append(result);

    }).fail(function () {
        alert('Erro :/');
    });
};

function requestRelantionshipAlunos(value) {
    const WRAPPER = document.querySelector(".wrapper");
    $(".card-text").empty();

    $.ajax({
        type: "POST",
        url: '/Sistema Monitoria/requests/card-alunos.php',
        data: {
            'turma': value
        },
    }).done(function (result) {
        WRAPPER.classList.remove("d-none");
        $(".card-text").append(result);

    }).fail(function () {
        alert('Turma não cadastrada no banco de dados :/');
    });
}