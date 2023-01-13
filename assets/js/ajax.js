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

// Monta um modal de edição a partir do admin clicado
function displayModalAdmin(username, id) {
    let adminField = document.getElementById("admin-usr");
    let button = document.getElementById("btn");
    adminField.value = username;
    button.value = id;
}

function deleteAdmin(btnId) {
    const ADMIN_ID = btnId;

    $.ajax({
        type: "POST",
        url: "/Sistema Monitoria/requests/delete-adm.php",
        data: {
            'id': ADMIN_ID
        }
    }).done(() => {
        alert("Administrador excluído do banco de dados!");
        location.reload();
    }).fail(() => {
        alert("Erro ao excluir :/");
    });
}


function requestRelantionshipManagers() {
    const WRAPPER = document.querySelector(".wrapper");
    const BTN = document.getElementById("btnSearchCurrent");
    $(".card-text").empty();

    $.ajax({
        type: "POST",
        url: '/Sistema Monitoria/requests/card-managers.php',
    }).done(function (result) {
        WRAPPER.classList.remove("d-none");
        BTN.style.display = "none";
        if (result == "" || result == null) {
            $(".card-text").append("Erro inseperado :/");
            $(".sendAll").addClass("d-none");
        } else {
            $(".card-text").append(result);
            $(".sendAll").removeClass("d-none");
        }
    }).fail(function () {
        alert('Não existem monitores cadastrados :/');
    });
}