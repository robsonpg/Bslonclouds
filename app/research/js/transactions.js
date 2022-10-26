
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

    $('#btn_research_delete_confirm').click( function () {
        // Apaga a pesquisa através de um endpoint
        let research_id = document.getElementById("delete_uid");
        let delete_str = research_id.innerText;

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

//###########################################################################
// Faz download da pesquisa
function downloadResearch(uid_text) {

    let download_str = uid_text;

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
                alert(response.toString());
                if (response.toString() === '0') {
                    const link = document.createElement("a");
                    link.href = "system/app/research/" + uid_text + ".zip";
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

