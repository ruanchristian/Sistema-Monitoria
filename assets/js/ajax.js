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
        alert('Não existem alunos registrados :/');
    });
};

function admin(btnRef) {
    const VALUE = btnRef.value;
    const ADMIN_ID = btnRef.id;

    switch(VALUE) {
        case "delete":
            $.ajax({
                type: "POST",
                url: "/Sistema Monitoria/requests/delete-adm.php",
                data: {
                    'id': ADMIN_ID
                }
            }).done(() => {
                location.reload();
            }).fail(() => {
                alert("Erro ao excluir :/");
            });
            break;
        case "edit":
            alert("em desenvolvimento...");    
    }
}

function requestRelantionshipManagers() {
    const WRAPPER = document.querySelector(".wrapper");
    const BTN = document.getElementById("btnSearchCurrent");
    $(".card-text").empty();

    $.ajax({
        type: "POST",
        url: '/Sistema Monitoria/requests/card-managers.php',
    }).done(function(result) {
        WRAPPER.classList.remove("d-none");
        BTN.style.display = "none";
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