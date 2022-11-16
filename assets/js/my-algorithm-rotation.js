// Arrays contendo as relações das equipes <br><br>&#9633; dos locais de monitoramento...
const equipe1 = ['AFONSO VITO <br><br>&#9633; ANTÔNIO WALLISON', 'ARTHUR ALVES DEDEUS <br><br>&#9633; CAIO ADSON', 'ERICK JARDEL <br><br>&#9633; FRANCIELLY SIMPLICIO'];
const equipe2 = ['FRANCISCA BRUNA <br><br>&#9633; FRANCISCO RAUAN', 'HALYSON DEYVISON <br><br>&#9633; HEITOR PIMENTA', 'HIAGO LEONARDO <br><br>&#9633; JAMILE GOMES'];
const equipe3 = ['JOÃO PEDRO <br><br>&#9633; JOÃO RICARDO', 'JOSÉ LUIS ALVES <br><br>&#9633; KAIO DA SILVA PEREIRA', 'KAUAN RODRIGUES <br><br>&#9633; LIVIA CIBELLE'];
const equipe4 = ['LUIS FELIPE BATISTA <br><br>&#9633; MARIA EDUARDA BRILHANTE', 'MARIA GEOVANNA <br><br>&#9633; MARIANA PATRICIO', 'MATEUS FARIAS <br><br>&#9633; MATHEUS PEREIRA'];
const equipe5 = ['MICHEL BARBOSA <br><br>&#9633; PEDRO HENRIQUE SOUZA', 'RAYSSA OLIVEIRA <br><br>&#9633; RENATA SILVA', 'RUAN CHRISTIAN <br><br>&#9633; VICTOR HUGO'];
const dias = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta'];
var matrizEquipes = [equipe1, equipe2, equipe3, equipe4, equipe5];


function rotation(current) {
    let table = document.querySelector('.c19');
    let miniTitle = document.getElementById('cron');

    table.innerHTML = "";
    table.innerHTML = `
    <tr class="c2">
    <td class="c27" colspan="3" rowspan="1">
        <p class="c7"><span class="c5">Equipes do dia</span></p>
    </td>
    <td class="c1" colspan="1" rowspan="2">
        <p class="c7"><span class="c5">Data</span></p>
    </td>
</tr>
<tr class="c2">
    <td class="c23 c28" colspan="1" rowspan="1">
        <p class="c7"><span class="a1">Lab. Informática</span></p>
    </td>
    <td class="c6" colspan="1" rowspan="1">
        <p class="c7"><span class="a2">Lab. Línguas</span></p>
    </td>
    <td class="c6" colspan="1" rowspan="1">
        <p class="c7"><span class="a3">Biblioteca</span></p>
    </td>
</tr>`;

    let i = 0;
    let duplasIndex = 0;

    while (i < matrizEquipes.length) {

        switch (current) {
            case "s-1":
                miniTitle.innerText = "Cronograma - Semana 1";
                table.innerHTML += `
                <td class="c23" colspan="1" rowspan="1">
                <ul class="c10">
                    <li class="c3 li-bullet-0"><span class="c8">&#9633; ${matrizEquipes[i][duplasIndex++]}</span></li>
                </ul>
                <p class="c18"><span class="c8"></span></p>
            </td>
            <td class="c13" colspan="1" rowspan="1">
                <ul class="c10">
                    <li class="c3 li-bullet-0"><span class="c8">&#9633; ${matrizEquipes[i][duplasIndex++]}</span></li>
                </ul>
            </td>
            <td class="c13" colspan="1" rowspan="1">
                <ul class="c10">
                    <li class="c3 li-bullet-0"><span class="c8">&#9633; ${matrizEquipes[i][duplasIndex++]}</span></li>
                </ul>
                <p class="c21 c25"><span class="c4"></span></p>
            </td>
            <td class="c16" colspan="1" rowspan="1">
                <p class="c7"><span class="c0">${dias[i]}</span></p>
            </td>`;
                duplasIndex = 0;
                i++
                break;

            case "s-2": 
                miniTitle.innerText = "Cronograma - Semana 2";
                equipesArrayReversed = reverseArray(matrizEquipes);
                showReverse(i, table, equipesArrayReversed);
                i++;
                break;

            case "s-3":
                miniTitle.innerText = "Cronograma - Semana 3";
                table.innerHTML += `
                <td class="c23" colspan="1" rowspan="1">
                <ul class="c10">
                    <li class="c3 li-bullet-0"><span class="c8">&#9633; ${matrizEquipes[i][1]}</span></li>
                </ul>
                <p class="c18"><span class="c8"></span></p>
            </td>
            <td class="c13" colspan="1" rowspan="1">
                <ul class="c10">
                    <li class="c3 li-bullet-0"><span class="c8">&#9633; ${matrizEquipes[i][2]}</span></li>
                </ul>
            </td>
            <td class="c13" colspan="1" rowspan="1">
                <ul class="c10">
                    <li class="c3 li-bullet-0"><span class="c8">&#9633; ${matrizEquipes[i][0]}</span></li>
                </ul>
                <p class="c21 c25"><span class="c4"></span></p>
            </td>
            <td class="c16" colspan="1" rowspan="1">
                <p class="c7"><span class="c0">${dias[i]}</span></p>
            </td>`;
                duplasIndex = 0;
                i++
                break;

            default:
                table.innerHTML += "Indisponível";
                return;
        }
    }
}

function reverseArray(array) {
    var reversed = array.map(i => i).reverse();
    return reversed;
}

function showReverse(index, tableRef, matriz) {
    duplasIndex = 0;

    tableRef.innerHTML += `
                <td class="c23" colspan="1" rowspan="1">
                <ul class="c10">
                    <li class="c3 li-bullet-0"><span class="c8">&#9633; ${matriz[index][2]}</span></li>
                </ul>
                <p class="c18"><span class="c8"></span></p>
            </td>
            <td class="c13" colspan="1" rowspan="1">
                <ul class="c10">
                    <li class="c3 li-bullet-0"><span class="c8">&#9633; ${matriz[index][0]}</span></li>
                </ul>
            </td>
            <td class="c13" colspan="1" rowspan="1">
                <ul class="c10">
                    <li class="c3 li-bullet-0"><span class="c8">&#9633; ${matriz[index][1]}</span></li>
                </ul>
                <p class="c21 c25"><span class="c4"></span></p>
            </td>
            <td class="c16" colspan="1" rowspan="1">
                <p class="c7"><span class="c0">${dias[index]}</span></p>
            </td>`;
    duplasIndex = 0;
}