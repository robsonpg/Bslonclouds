
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

    if (input.files.length > 64) {
        let error_place = document.getElementById("error_messages_place");
        error_place.innerHTML = "<div role='alert' class='alert alert-warning'>" + msg_error_loding_images + "</div>";
        setTimeout(function () {
            error_place.innerHTML = "";
        }, 5000);
    } else {
        let btn_select = document.getElementById("btn_get_files");
        btn_select.value = msg_loading;
        btn_select.disabled = true;

        let tumb_div = document.querySelector("#tumbnails");
        tumb_div.innerHTML = "";
        let tumb_image = null;
        let row_tumb = document.createElement("div");
        row_tumb.className = "row justify-content-start align-items-left border";
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
                image_main.onload = function () {
                    // Determna o tamanho padrão
                    if (i === 0) {
                        main_width = image_main.width;
                        main_height = image_main.height;
                    }
                    // access image size here
                    image_info_list[i][IMAGE_WIDTH] = image_main.width;
                    image_info_list[i][IMAGE_HEIGTH] = image_main.height;
                    if (i === (input.files.length - 1)) {
                        btn_select.disabled = false;
                        btn_select.value = msg_select_images;
                    }
                };
            }
            reader.readAsDataURL(input.files[i]);
            // Criar o disposição para exibição das imagens
            let tumb_filename = document.createElement("a");
            tumb_filename.innerHTML = '<br>' + String(i).padStart(2, '0'); //input.files[i].name;

            let col_tumb_image = document.createElement("div");
            col_tumb_image.className = "col align-items-left";
            col_tumb_image.append(tumb_image);
            col_tumb_image.append(tumb_filename);
            row_tumb.append(col_tumb_image);

            //#####################################################
            // Guarda as informações colhidas sobre o arquivo
            image_info_list.push([input.files[i], input.files[i].name, input.files[i].lastModified, 0, 0]);
        }
        tumb_div.append(row_tumb);
    }
}

function grayScale () {
    var image = document.getElementById("image");

    var canvas=document.createElement("canvas");
    var ctx=canvas.getContext("2d");

    canvas.width= image.width;
    canvas.height= image.height;

    ctx.drawImage(image,0,0);

    var imageData=ctx.getImageData(0,0, image.width, image.height);

    for (var i=0;i<imageData.data.length;i+=4) {
        var avg = (imageData.data[i]+imageData.data[i+1]+imageData.data[i+2])/3;

        imageData.data[i] = avg;
        imageData.data[i+1] = avg;
        imageData.data[i+2] = avg;

    }

    ctx.putImageData(imageData, 0, 0, 0, 0, imageData.width, imageData.height);
    document.getElementById("grayscale").appendChild(canvas);
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

        let permission = document.getElementsByName("sample_permission");
        for(i = 0; i<permission.length; i++)
            permission[i].checked = false;
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
    if (checked === PERMISSION_PUBLIC) {
        document.getElementById("sample_permission1").checked = true;
    } else {
        if (checked === PERMISSION_PRIVATE) {
            document.getElementById("sample_permission2").checked = true;
        }
    }

    let sample_pub = document.getElementById("research_public_id");
    sample_pub.value = images_properties[8];
    // Exibe o modal
    $('#properties-modal').modal('show');
}

//########################################################################
// Apaga todos os dados carregados localemte ff
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