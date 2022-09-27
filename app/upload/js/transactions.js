
let image_file_list = [];

//#######################################################################
// Função de leitura da imagem
// Mas o projeto prevê muitas imagens
// Vamos ler apenas o path e o nome do arquivo e armazenar
function readURL(input, id) {
    let tumb_div = document.querySelector("#tumbnails");
    let tumb_image = null;
    for (let i=0; i<input.files.length; i++) {
        tumb_image = document.createElement("img");
        tumb_image.setAttribute("id", "tumb" + i);
        tumb_image.style.height = "20mm";
        const reader = new FileReader();
        reader.onload = function (e) {
            $('#tumb' + i)
                .attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[i]);

        // Criar o disposição para exibição das imagens
        let row_tumb = document.createElement("div");
        row_tumb.className = "row justify-content-between align-items-center border";
        let col_tumb_msg = document.createElement("div");
        col_tumb_msg.className = "col";
        col_tumb_msg.innerHTML = filename_msg;
        let col_tumb_filename = document.createElement("div");
        col_tumb_filename.className = "col";
        col_tumb_filename.innerHTML = input.files[i].name;

        let col_tumb_image = document.createElement("div");
        col_tumb_image.className = "col-auto";

        row_tumb.append(col_tumb_msg);
        row_tumb.append(col_tumb_filename);
        row_tumb.append(tumb_image);
        tumb_div.append(row_tumb);
    }

}

//##############################################################################
// Scripts para depois que o form for carregado
//##############################################################################
$(document).ready(function() {

    //#########################################################################
    // Salva inserido os dados em banco de dados
    // Quando usuário clicar em salvar será feito todos os passo abaixo
    //#########################################################################
    $('#sample_data_confirm').click(function() {
        let sample_name = document.getElementById("sample_name");

        // verify field empty
        if (!shakeDOM(sample_name)) return false;
        alert("confirm");
    });
})


