
const HENE_LASER_TYPE = "1";
const DIODE_LASER_TYPE = "2";
const OTHER_LASER_TYPE = "3";

let image_file_list = [];
let image_info_list = [];


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

            //#########################################################################
            // Essa função abaixo é assincrona e será executada após a função principal
            let image_main = new Image();
            image_main.src = e.target.result;
            image_main.onload = function() {
                // access image size here
                image_info_list[i][2] = this.width;
                image_info_list[i][3] = this.height;
                let tumb_msg = document.querySelector("#image_info" + i);
                tumb_msg.innerHTML = tumb_msg.innerHTML + image_size + "<b>" + this.width + "x" +
                    this.height + "</b>";
            };
        }
        reader.readAsDataURL(input.files[i]);

        // Criar o disposição para exibição das imagens
        let row_tumb = document.createElement("div");
        row_tumb.className = "row justify-content-between align-items-center border";
        let col_tumb_msg = document.createElement("div");
        col_tumb_msg.className = "col";
        col_tumb_msg.setAttribute("id", "image_info" + i);

        var imagedate = new Date(input.files[i].lastModified);
        col_tumb_msg.innerHTML = image_date + "<b>" + imagedate.toLocaleString() + "</b>";

        let col_tumb_filename = document.createElement("div");
        col_tumb_filename.className = "col-2";
        col_tumb_filename.innerHTML = filename_msg + "<b>" + input.files[i].name + "</b>";

        let col_tumb_image = document.createElement("div");
        col_tumb_image.className = "col-2";

        row_tumb.append(col_tumb_msg);
        row_tumb.append(col_tumb_filename);
        row_tumb.append(tumb_image);
        tumb_div.append(row_tumb);

        //#####################################################
        // Guarda as informações colhidas sobre o arquivo
        image_info_list.push([input.files[i].name, input.files[i].lastModified, 0, 0]);
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
        let sample_frames = document.getElementById("sample_frames");
        let sample_config = document.querySelector('input[name="sample_config"]:checked');
        let sample_laser_type = document.getElementById("sample_laser_type");
        let sample_wavelength = document.getElementById("sample_wavelength");


        // verify field empty
        if (!shakeDOM(sample_name)) return false;
        if (!shakeDOM(sample_frames)) return false;
        if (sample_config === null) {
            let sample_config_label = document.getElementById("sample_config_label");
            sample_config_label.style.borderColor = "red";
            sample_config_label.className = "col shake";
            sample_config_label.addEventListener("webkitAnimationEnd", function endEdit() {
                sample_config_label.style.borderColor = "#A9A9A9";
                sample_config_label.className = "col";
            });
            return false;
        }
        if (!shakeDOM(sample_laser_type)) return false;
        if (!shakeDOM(sample_wavelength)) return false;

        //###################################################################
        // Salva os dados para inserir no banco de dados
        alert("confirm");
    });
})

function enableOtherType() {
    let value = document.querySelector('input[name="sample_laser_type"]:checked').value;
    if (value === OTHER_LASER_TYPE) {
        document.getElementById("other_laser_type").disabled = false;
    } else {
        document.getElementById("other_laser_type").disabled = true;
        document.getElementById("other_laser_type").value = "";
    }
}


