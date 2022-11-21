$(document).ready(function () {
    $('#datatable').DataTable({
        order: [[1, 'asc'], [2, 'asc']],
        language : {
            url: "https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json"
        }
    })
});

window.addEventListener('DOMContentLoaded', e => {

    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', e => {
            e.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
});


const changeState = (checkbox, p) => {
    let state = document.getElementById(p);
    if (checkbox.checked) {
        state.innerHTML = "F";
        state.style.color = "red";
    } else {
        state.innerHTML = "P";
        state.style.color = "black";
    }
}

function forceOp() {
    //Função que vai forçar o usuário a digitar somente números no input text.
    var e = document.getElementById("field01");
    e.value = e.value.replace(/[^0-9]/gi, "");
}

function openIng() {
    window.open("https://www.instagram.com/study_informatica_2b/", "_blank");
    console.log('redirected successfully');
}