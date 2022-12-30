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

function requestRelantionshipManagers() {
    const WRAPPER = document.querySelector(".wrapper");
    $(".card-text").empty();

    $.ajax({
        type: "POST",
        url: '/Sistema Monitoria/requests/card-managers.php',
    }).done(function(result) {
        WRAPPER.classList.remove("d-none");
        if (result == "" || result == null){
             $(".card-text").append("Erro 1337 :/");
             $(".sendAll").addClass("d-none");
        } else {
             $(".card-text").append(result);
             $(".sendAll").removeClass("d-none");
        }
    }).fail(function() {
        alert('Não existem monitores cadastrados :/');
    });
}