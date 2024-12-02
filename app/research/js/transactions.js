
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

//##############################################################################
// Scripts para depois que o form for carregado
//##############################################################################
$(document).ready(function() {

    //#####################################################
    // Apaga a pesquisa
    $('#btn_research_delete_confirm').click( function () {
        // Apaga a pesquisa através de um endpoint
        let research_id = document.getElementById("delete_uid");
        let delete_str = research_id.innerText;
        research_id.innerHTML = "<b>" + msg_deleting + ": " + delete_str + "...</b>"
        // Desabilitar botão de apagar e cancelar
        let delete_btn = document.getElementById("btn_research_delete_confirm");
        delete_btn.className = "btn btn-primary disabled";
        let cancel_btn = document.getElementById("cancel_delete");
        cancel_btn.className = "btn btn-primary disabled";

        let ajaxRequest = $.ajax({
            type: 'POST',
            url: 'delete_research.php',
            dataType: "text",
            //async: true,
            data: delete_str,
            processData: false,
            contentType: false,
            success: function (response) {
                //location.reload();
                if (response.includes('')) {
                    // Apagou
                    $('#delete-modal').modal('hide');
                    delete_btn.className = "btn btn-primary";
                    cancel_btn.className = "btn btn-primary";
                    location.reload();
                } else {
                    alert("Fail to delete in database.");
                    //messages_place.innerText = response.toString();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Error: " + textStatus + " - " + errorThrown);
                console.log(textStatus, errorThrown);
            }
        });
    });

    //####################################################
    // Aceita a pesquisa
    $('#btn_research_accept_confirm').click( function () {
        // Apaga a pesquisa através de um endpoint
        let research_id = document.getElementById("accept_uid");
        let accept_str = research_id.innerText;
        research_id.innerHTML = "<b>" + msg_accepting + ": " + accept_str + "...</b>"

        let ajaxRequest = $.ajax({
            type: 'POST',
            url: 'accept_research.php',
            dataType: "text",
            //async: true,
            data: accept_str,
            processData: false,
            contentType: false,
            success: function (response) {
                //location.reload();
                if (response.includes('')) {
                    // Aceitou
                    $('#accept-modal').modal('hide');
                    location.reload();
                } else {
                    alert("Fail to accept in database.");
                    //messages_place.innerText = response.toString();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Error: " + textStatus + " - " + errorThrown);
                console.log(textStatus, errorThrown);
            }
        });
    });
})


//############################################################################
// Abre modal das propiedades com os valores preenchidos
function deleteResearch(uid_text) {
     let delete_unique_id = document.getElementById("delete_uid");
    delete_unique_id.innerHTML = "<b>" + uid_text + "</b>";
    // sample_unique_id.value = images_properties[0];
    // let sample_name = document.getElementById("sample_name");
    // sample_name.value = images_properties[1];
    // let sample_frames = document.getElementById("sample_frames");
    // sample_frames.value = images_properties[2];

    // Exibe o modal
    $('#delete-modal').modal('show');
}

//############################################################################
// Abre modal das propiedades com os valores preenchidos
function editResearch(uid_text) {
    //alert(uid_text);
    // Pega a pesquisa
    let selected_research = null;
    for (let idx=0; idx<public_researchers.length; idx++) {
        if (public_researchers[idx]["bsl_sample_data_unique_id"] === uid_text) {
            selected_research = public_researchers[idx];
;
        }
    }

    let sample_unique_id = document.getElementById("sample_id");
    sample_unique_id.value = selected_research["bsl_sample_data_unique_id"];
    sample_unique_id.setAttribute('disabled', '');
    let sample_help_id = document.getElementById("unique_id_help");
    sample_help_id.innerHTML = msg_cannot_change;

    let sample_name = document.getElementById("sample_name");
    sample_name.value = selected_research["bsl_sample_data_name"]
    let sample_frames = document.getElementById("sample_frames");
    sample_frames.value = selected_research["bsl_sample_data_frame_rate"];

    let checked = selected_research["bsl_sample_data_configuration_type"];
    if (checked === CONFIG_BACKSCATTERING) {
        document.getElementById("sample_config1").checked = true;
    } else {
        document.getElementById("sample_config2").checked = true;
    }

    checked = selected_research["bsl_sample_data_laser_type"];
    if (checked === HENE_LASER_TYPE) {
        document.getElementById("sample_laser_type1").checked = true;
    } else {
        if (checked === DIODE_LASER_TYPE) {
            document.getElementById("sample_laser_type2").checked = true;
        } else {
            document.getElementById("sample_laser_type3").checked = true;
            document.getElementById("other_laser_type").value =
                selected_research["bsl_sample_data_other_laser_type"];
        }
    }
    let sample_wavelength = document.getElementById("sample_wavelength");
    sample_wavelength.value = selected_research["bsl_sample_data_laser_wavelength"];

    checked = selected_research["bsl_sample_data_permission"];
    // Sempre público agora
    document.getElementById("sample_permission1").checked = true;
    // if (checked.toString() === PERMISSION_PUBLIC) {
    //     document.getElementById("sample_permission1").checked = true;
    // } else {
    //     if (checked.toString() === PERMISSION_PRIVATE) {
    //         document.getElementById("sample_permission2").checked = true;
    //     }
    // }

    let sample_pub = document.getElementById("research_public_id");
    sample_pub.value = selected_research["bsl_sample_data_published_DOI_URL"];

    //############################
    // Cover
    let img_cover = document.getElementById("cover_image");
    img_cover.src = "data:image/bmp;base64," + selected_research["bsl_sample_data_cover_image"];

    let sample_obs = document.getElementById("research_observation");
    sample_obs.value = selected_research["bsl_sample_data_obs"];

    // Exibe o modal
    $('#properties-modal').modal('show');
}

//###########################################################################
// Faz download da pesquisa
function downloadResearch(uid_text) {

    let download_str = uid_text;
    // Abrir modal de processamento
    $('#processing-images-modal').modal('show');

    let ajaxRequest = $.ajax({
        type: 'POST',
        url: 'download_image.php',
        dataType: "text",
        //async: true,
        data: download_str,
        processData: false,
        contentType: false,
        success: function (response) {
            //location.reload();
            if (response.includes('')) {
                // Apagou
                //location.reload();
                // Faz split
                //alert(response.toString());
                $('#processing-images-modal').modal('hide');
                if (parseInt(response) === 0) {
                    const link = document.createElement("a");
                    link.href = "./" + uid_text + ".zip";
                    //link.download =  uid_text + ".zip";
                    link.click();
                }
            } else {
                alert("Fail to get in database.");
                //messages_place.innerText = response.toString();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("Error: " + textStatus + " - " + errorThrown);
            console.log(textStatus, errorThrown);
        }
    });
}

//############################################################################
// Abre modal de aceitação da pesquisa
function acceptResearch(uid_text) {
    let accept_unique_id = document.getElementById("accept_uid");
    accept_unique_id.innerHTML = "<b>" + uid_text + "</b>";
    // sample_unique_id.value = images_properties[0];
    // let sample_name = document.getElementById("sample_name");
    // sample_name.value = images_properties[1];
    // let sample_frames = document.getElementById("sample_frames");
    // sample_frames.value = images_properties[2];

    // Exibe o modal
    $('#accept-modal').modal('show');
}

//############################################################################
// Abre modal de renomear a pesquisa
function renameResearch(uid_text) {
    let rename_unique_id = document.getElementById("rename_uid");
    rename_unique_id.innerHTML = "<b>" + uid_text + "</b>";
    let unique_id = document.getElementById("sample_id");
    unique_id.value = "";
    // sample_unique_id.value = images_properties[0];
    // let sample_name = document.getElementById("sample_name");
    // sample_name.value = images_properties[1];
    // let sample_frames = document.getElementById("sample_frames");
    // sample_frames.value = images_properties[2];

    // Exibe o modal
    $('#rename-modal').modal('show');
}


