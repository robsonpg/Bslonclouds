
const HENE_LASER_TYPE = "1";
const DIODE_LASER_TYPE = "2";
const OTHER_LASER_TYPE = "3";
const CONFIG_BACKSCATTERING = "1";
const CONFIG_FOWARDSCATTERING = "2";

const PERMISSION_PUBLIC = "1";
const PERMISSION_PRIVATE = "2";

let images_properties = [];
let image_info_list = [];

let OBJECT_IMAGE_INDEX = 0;
let FILE_NAME = 1;
let IMAGE_TIMESTAMP = 2;
let IMAGE_WIDTH = 3;
let IMAGE_HEIGTH = 4;


//#######################################################################
// Função de leitura da imagem
// Mas o projeto prevê muitas imagens
// Vamos ler apenas o path e o nome do arquivo e armazenar
function readURL(input, id) {
    let main_width = 0;
    let main_height = 0;
    image_info_list = [];

    let btn_send = document.getElementById("btn_send_modal");
    let btn_select = document.getElementById("btn_get_files");
    btn_select.value = msg_loading;
    btn_select.disabled = true;

    //#################################################################
    // Analisar nomes das imagens, devem ser somente números
    for (let i=0; i<input.files.length; i++) {
        // pega o primeiro nome
        //
        //######################################################
        //
        // Vamos desativar a verificação dos nomes na primeira edição
        //
        // let main_name = input.files[i].name.split(".");
        // if (isNaN(main_name[0])) {
        //     alert("Invalid file name");
        //     return;
        // }
    }

    let tumb_div = document.querySelector("#tumbnails");
    tumb_div.innerHTML = "";
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
                // Determna o tamanho padrão
                if (i === 0) {
                    main_width = image_main.width;
                    main_height = image_main.height;
                }
                // access image size here
                image_info_list[i][IMAGE_WIDTH] = image_main.width;
                image_info_list[i][IMAGE_HEIGTH] = image_main.height;
                let tumb_msg = document.querySelector("#image_info" + i);
                // Retirado algoritmo de laranja porque a leitura não é sequencial
                // #####################################################################
                // if ((image_main.width !== main_width) || (image_main.height !== main_height)) {
                //     alert(i);
                //     tumb_msg.innerHTML = tumb_msg.innerHTML + "<a style='color: orange'>" + image_size + "<b>" + this.width + "x" +
                //         this.height + "</b></a>";
                // } else {
                    tumb_msg.innerHTML = tumb_msg.innerHTML + image_size + "<b>" + this.width + "x" +
                        this.height + "</b>";
                    if (i === (input.files.length - 1)) {
                        btn_send.disabled = false;
                        btn_send.value = msg_upload_images;
                        btn_select.disabled = false;
                        btn_select.value = msg_select_images;
                    }
                // }
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
        col_tumb_image.append(tumb_image);

        let col_tumb_remove = document.createElement("div");
        col_tumb_remove.className = "col-2";
        // let btn_remove = document.createElement("a");
        // btn_remove.className = "btn btn-info";
        // btn_remove.setAttribute("id", "image_remove_" + i);
        // btn_remove.onclick = removeImage(btn_remove);
        // btn_remove.innerHTML = "<a style='color: white'>" + btn_remove_text + "</a>";
        // //<a id="sample_data_confirm" className="btn btn-primary delete" href="#"><?=lang("BTN_ACCEPT")?></a>
        // col_tumb_remove.append(btn_remove);

        row_tumb.append(col_tumb_msg);
        row_tumb.append(col_tumb_filename);
        row_tumb.append(col_tumb_image);
        row_tumb.append(col_tumb_remove);
        tumb_div.append(row_tumb);

        //#####################################################
        // Guarda as informações colhidas sobre o arquivo
        image_info_list.push([input.files[i], input.files[i].name, input.files[i].lastModified, 0, 0]);

        // if ((image_info_list.length > 0) && (images_properties.length > 0)) {
        //     let btn_send = document.getElementById("btn_send_modal");
        //     btn_send.disabled = false;
        // }

    }

}

//##############################################################################
// Scripts para depois que o form for carregado
//##############################################################################
$(document).ready(function() {

    //#########################################################################
    // Não permite espaços na identificação da amostra
    $('#sample_id').on('keypress', function(e) {
        if (e.which === 32){
            //console.log('Space Detected');
            return false;
        }
    });

    $('#btn_prop_modal').click( function () {
       let i;
        // Limpa o modal
        let sample_id = document.getElementById("sample_id");
        sample_id.value = "";
        let sample_name = document.getElementById("sample_name");
        sample_name.value = "";
        let sample_frames = document.getElementById("sample_frames");
        sample_frames.value = "";
        let radio_config = document.getElementsByName("sample_config");
        for(i = 0; i<radio_config.length; i++)
            radio_config[i].checked = false;
        let laser_type = document.getElementsByName("sample_laser_type");
        for(i = 0; i<laser_type.length; i++)
            laser_type[i].checked = false;
        let sample_wavelength = document.getElementById("sample_wavelength");
        sample_wavelength.value = "";
        let sample_other = document.getElementById("other_laser_type");
        sample_other.value = "";
        sample_other.disabled = true;

        // let permission = document.getElementsByName("sample_permission");
        // for(i = 0; i<permission.length; i++)
        //     permission[i].checked = false;
        let sample_pub = document.getElementById("research_public_id");
        sample_pub.value = "";

        let cover_img = document.getElementById("cover_image");
        // Para que a imagem seja carregada no formato correto
        toDataURL('img/default.bmp', function(dataUrl) {
            cover_img.src = dataUrl;
        })
        //cover_img.src = "img/default.bmp";
    });
})

function toDataURL(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        var reader = new FileReader();
        reader.onloadend = function() {
            callback(reader.result);
        }
        reader.readAsDataURL(xhr.response);
    };
    xhr.open('GET', url);
    xhr.responseType = 'blob';
    xhr.send();
}


function enableOtherType() {
    let value = document.querySelector('input[name="sample_laser_type"]:checked').value;
    if (value === OTHER_LASER_TYPE) {
        document.getElementById("other_laser_type").disabled = false;
    } else {
        document.getElementById("other_laser_type").disabled = true;
        document.getElementById("other_laser_type").value = "";
    }
}

//############################################################################
// Abre modal das propiedades com os valores preenchidos
function showPropertiesModal() {
    //document.getElementById('sample_id').removeAttribute("disabled");
    let sample_unique_id = document.getElementById("sample_id");
    sample_unique_id.value = images_properties[0];
    let sample_name = document.getElementById("sample_name");
    sample_name.value = images_properties[1];
    let sample_frames = document.getElementById("sample_frames");
    sample_frames.value = images_properties[2];

    let checked = images_properties[3];
    if (checked === CONFIG_BACKSCATTERING) {
        document.getElementById("sample_config1").checked = true;
    } else {
        document.getElementById("sample_config2").checked = true;
    }

    checked = images_properties[4];
    if (checked === HENE_LASER_TYPE) {
        document.getElementById("sample_laser_type1").checked = true;
    } else {
        if (checked === DIODE_LASER_TYPE) {
            document.getElementById("sample_laser_type2").checked = true;
        } else {
            document.getElementById("sample_laser_type3").checked = true;
            document.getElementById("other_laser_type").value = images_properties[5];
        }
    }
    // let radio_config = document.getElementsByName("sample_config");
    // for(i = 0; i<radio_config.length; i++)
    //     radio_config[i].checked = false;
    // let laser_type = document.getElementsByName("sample_laser_type");
    // for(i = 0; i<laser_type.length; i++)
    //     laser_type[i].checked = false;

    let sample_wavelength = document.getElementById("sample_wavelength");
    sample_wavelength.value = images_properties[6];

    checked = images_properties[7];
    // Sempre permitir publico
    document.getElementById("sample_permission1").checked = true;
    // if (checked === PERMISSION_PUBLIC) {
    //     document.getElementById("sample_permission1").checked = true;
    // } else {
    //     if (checked === PERMISSION_PRIVATE) {
    //         document.getElementById("sample_permission2").checked = true;
    //     }
    // }

    let sample_pub = document.getElementById("research_public_id");
    sample_pub.value = images_properties[8];
    // Exibe o modal
    $('#properties-modal').modal('show');
}


//#########################################################################
// Envia imagens para o servidor na nuvem
function sendImagesToServer() {
    //alert("click");
    let btn_upload = document.getElementById("btn_send_modal");
    btn_upload.disabled = true;
    $('#send-images-modal').modal('show');
    let message_place = document.getElementById("message_place");
    message_place.innerText = msg_send_images;
    let progress_bar = document.getElementById("progress_bar");
    let error_messages_place = document.getElementById("error_messages_place");
    let sample_unique_id = images_properties[0];
    let sample_name = images_properties[1];
    let sample_frame_rate = images_properties[2];
    let sample_config = images_properties[3];
    let sample_laser_type = images_properties[4];
    let other_laser_type = images_properties[5];
    let sample_wavelength = images_properties[6];
    let sample_permission = images_properties[7];
    let sample_pub = images_properties[8];
    //#########################################################
    // Imagem de capa
    let sample_cover_image = images_properties[9];
    let sample_obs = images_properties[10];
    let amount_of_images = image_info_list.length;
    let sample_owner = user_id;
    let sample_database_id = -1;
    progress_bar.style.width = "0%";

    //###################################################
    // Envia as propriedades do experimento
    // Monta o cabeçalho para todas imagens do stream
    let header = sample_unique_id + "&" + sample_name + "&" + sample_frame_rate + "&" + sample_config + "&" +
        sample_laser_type + "&" + other_laser_type + "&" + sample_wavelength + "&" + sample_permission + "&" +
        amount_of_images + "&" + sample_owner + "&" + sample_pub + "&" + sample_cover_image + "&" + sample_obs;

    let ajaxRequest = $.ajax({
        type: 'POST',
        url: 'upload_sample_data.php',
        dataType: "text",
        //async: true,
        data: header,
        processData: false,
        contentType: false,
        success: function (response) {
            //location.reload();
            //#######################################################
            // DEBUG
            //error_messages_place.innerText = response.toString();
            if (response.includes('id')) {
                //messages_place.innerHTML = response.toString();
                sample_database_id = parseInt(response.toString().split("=")[1]);
                //messages_place.innerHTML = sample_database_id;
                // Insere as imagens da maostra
                sendImages(sample_database_id);
            } else {
                error_messages_place.innerText = "Fail to insert data in database: " + response.toString();
                //error_messages_place.innerText = response.toString();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("Error: " + textStatus + " - " + errorThrown);
            console.log(textStatus, errorThrown);
        }
    });
}

//#####################################################################
// Envia as imagens para o servidor
// Obs: os envios assíncronos estão causando sobrecarga na hospedagem
//
function sendImages(sample_database_id) {
    let idx = 0;
    //###################################################
    // Loop de envio das imagens
    sendImage(sample_database_id, idx);
}

function sendImage(sample_database_id ,idx) {

    let progress_bar = document.getElementById("progress_bar");
    // Monta a linha de inserção
    const reader = new FileReader();
    //let idx = 0;
    let messages_proc_place = document.getElementById("proc_img_place");
    messages_proc_place.innerText = msg_sending + image_info_list[idx][FILE_NAME] + "...";
    reader.onload = function (e) {
        // $('#tumb' + i)
        //     .attr('src', e.target.result);
        // Cada imagem vai com sua lasgura e altura
        // A função a seguir será um código reentrante
        let image_size_date = image_info_list[idx][FILE_NAME] + "&" + sample_database_id + "&" +
            image_info_list[idx][IMAGE_TIMESTAMP] + "&" + image_info_list[idx][IMAGE_WIDTH] +
            "&" + image_info_list[idx][IMAGE_HEIGTH];
        let data = image_size_date + "&" + e.target.result;

        let ajaxRequest = $.ajax({
            type: 'POST',
            url: 'upload_image.php',
            dataType: "text",
            //async: true,
            data: data,
            processData: false,
            contentType: false,
            success: function (response) {
                //location.reload();
                if (response.includes('')) {
                    //alert("Image Sent..");
                    // Assim que o registro for salvo, vai para o registro de
                    // Dados dos seus contato
                    //window.location.href = 'reg_user_type.php';
                    let progress_value = (idx / image_info_list.length) * 100;
                    progress_bar.style.width = progress_value + "%";
                    //progress_bar.innerText = "Sending image " + (idx+1) + " of " + image_info_list.length + "...";
                    if (idx === (image_info_list.length - 1)) {
                        // Avisa que todas imagens já foram enviadas
                        progress_bar.style.width = "100%";
                        messages_proc_place.style.color = "green";
                        messages_proc_place.style.fontWeight = "900";
                        messages_proc_place.innerHTML = msg_upload_done;
                        setTimeout(function () {
                            //$('#send-images-modal').modal('hide');
                            // Limpa o formulário de envio
                            clearAllData();
                            // let btn_send = document.getElementById("btn_send_modal");
                            // btn_send.disabled = false;
                        }, 5000);
                        return;
                    }
                    // Acabou de enviar a imagem, passa para a próxima
                    idx++;
                    sendImage(sample_database_id, idx);
                } else {
                    messages_proc_place.innerText = response.toString();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Error: " + textStatus + " - " + errorThrown);
                console.log(textStatus, errorThrown);
            }
        });
    }
    reader.readAsDataURL(image_info_list[idx][OBJECT_IMAGE_INDEX]);
}

//########################################################################
// Apaga todos os dados carregados localemte
function clearAllData() {
    images_properties = [];
    image_info_list = [];
    let btn_get_files = document.getElementById("btn_get_files");
    btn_get_files.disabled = true;
    window.location.reload();
}

//########################################################################
// Futura feature de renomear aquivos
function renameFiles(input, id) {

    let a_file = input.files[0].pathname;
    const myRenamedFile = new File([a_file], '/renamed.bmp');
    const myReader = new FileReader();
    myReader.readAsDataURL(myRenamedFile);
    myReader.onload = () => console.log(myReader.result);
    alert("renamed");
}