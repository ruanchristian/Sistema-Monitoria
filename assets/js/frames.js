$(document).ready(function () {
    rotation('s-1');
    $('#datatable').DataTable({
        columnDefs: [
            {orderable: false, targets: 'theader'}
        ],
        order: [[2, 'asc']],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json",
            searchPlaceholder: "Buscar alunos..."
        }
    })
});

$(function() {
    $("#dialog").dialog({
        draggable: false,
        resizable: false,
        modal: true,
        hide: "fade",
        buttons: {
        Ok: function() {
          $(this).dialog("close");
        }
      }
    });
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

$('#btnSearchCurrent').click(() => {
    $('#modalSpin').modal('show');
    setTimeout(function () {
        $('#modalSpin').modal('hide');
        console.log('Procurando...');
    }, 1500);
});

$('.sendAll').click(() => {
    $('#passConfirm').modal('show');
});

const body = document.querySelector(".c26");

$('#pdfDownload').click(() => {
    console.log(body);
    $('#modalSpin').modal('show');
    setTimeout(function () {
        $('#modalSpin').modal('hide');
        let options = {
            margin: 1,
            filename: 'Cronograma.pdf',
            image: {
                type: 'png'
            },
            html2canvas: {
                scale: 2,
                scrollY: 0
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };
        html2pdf().set(options).from(body).save();
    }, 600);
});

const display = (value) => {
    const ROW = document.getElementById('ocorrenciaRow');
    
    if(value != "Observa????o") {
        ROW.classList.remove('d-none');
    } else {
        $("#turma").val("x");
        $('#alunos').attr('disabled', 'disabled');
        $('#alunos').append('<option disabled selected>Escolha primeiro a turma</option>');
        ROW.classList.add('d-none');
    }
}

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
    //Fun????o que vai for??ar o usu??rio a digitar somente n??meros no input text.
    var e = document.getElementById("field01");
    e.value = e.value.replace(/[^0-9]/gi, "");
}