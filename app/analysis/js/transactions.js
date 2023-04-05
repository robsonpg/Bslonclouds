
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
        let canvas_image = null;
        let row_tumb = document.createElement("div");
        row_tumb.className = "row justify-content-start align-items-left border";
        for (let i=0; i<input.files.length; i++) {
            tumb_image = document.createElement("img");
            tumb_image.setAttribute("id", "tumb" + i);
            tumb_image.style.height = "20mm";
            //tumb_image.style.display = "none";
            canvas_image = document.createElement('canvas');
            canvas_image.setAttribute("id", "cvs" + i);
            canvas_image.style.display = "none";
            const reader = new FileReader();
            reader.onload = async function (e) {
                $('#tumb' + i)
                    .attr('src', e.target.result);
                //#########################################################################
                // Essa função abaixo é assincrona e será executada após a função principal
                let img_cvs = document.getElementById('tumb' + i);
                img_cvs.onload = function () {
                    // Determna o tamanho padrão
                    if (i === 0) {
                        main_width = img_cvs.naturalWidth;
                        main_height = img_cvs.naturalHeight;
                        let cvs = document.getElementById("graphavd_cvs");
                        cvs.setAttribute("height", main_height);
                        cvs.setAttribute("width",  main_width);
                    }
                    image_info_list[i][IMAGE_WIDTH] = main_width;
                    image_info_list[i][IMAGE_HEIGTH] = main_height;
                    if (i === (input.files.length - 1)) {
                        btn_select.disabled = false;
                        btn_select.value = msg_select_images;
                        // Acabou de carregar as imagens, fazer anális
                        setTimeout(function() {
                            startImageAnalyse();
                        }, 2000);
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
            col_tumb_image.append(canvas_image);
            col_tumb_image.append(tumb_filename);
            row_tumb.append(col_tumb_image);

            //#####################################################
            // Guarda as informações colhidas sobre o arquivo
            image_info_list.push([input.files[i], input.files[i].name, input.files[i].lastModified, 0, 0]);
        }
        tumb_div.append(row_tumb);
        makeHeatBar();
        $('#graphavd-modal').modal('show');
    }
}

function makeHeatBar() {
    let heatbar = document.getElementById("heatmap");
    let multi_factor = 4;
    let red, green, blue;
    for (let idx = 0; idx < 256; idx++) {
        if(idx < 64){
            red = 0;
            green = idx * multi_factor;
            blue = 255;
        } else {
            if(idx < 128){
                red = 0;
                green = 255;
                blue = (255 - (idx - 64) * multi_factor);
            } else {
                if(idx < 192){
                    red = (idx - 128) * multi_factor;
                    green = 255;
                    blue = 0;
                } else {
                    red = 255;
                    green = (255 - (idx - 192) * multi_factor);
                    blue = 0;
                }
            }
        }
        heatbar.getContext('2d').fillStyle = "rgba("+ red + "," + green + ", " + blue + ", 1)";
        heatbar.getContext('2d').fillRect(0, 256 - idx, 20, 1);
        heatbar.getContext('2d').fillStyle = "black";
        heatbar.getContext('2d').font = "normal 14px Sans-Serif";
        heatbar.getContext('2d').fillText("0", 30, 255,30);
        heatbar.getContext('2d').fillText("128", 30, 128);
        heatbar.getContext('2d').fillText("255", 30, 14);
    }
}

//#########################################################################################
// Copia as imagens para canvas relativos para ocorrer a manipulação
function copyImagesToCanvas() {
    for (let idx = 0; idx < image_info_list.length; idx++) {
        let img_cvs = document.getElementById('tumb' + idx);
        let cvs_cvs = document.getElementById('cvs' + idx);
        cvs_cvs.setAttribute("height", image_info_list[idx][IMAGE_HEIGTH]);
        cvs_cvs.setAttribute("width", image_info_list[idx][IMAGE_WIDTH]);
        cvs_cvs.getContext('2d', {willReadFrequently: true}).drawImage(img_cvs, 0, 0, image_info_list[idx][IMAGE_WIDTH], image_info_list[idx][IMAGE_HEIGTH]);
    }
}

//####################################################################################
// Faz análise das imagens quanto ao tamanho de cada uma e seu profundidade de cores
function startImageAnalyse(){
    /// image_info_list contém os detalhes de cada imagem carregada
    // Vamos basear na resolução da primeira imagem para comparar as outras
    let img_width = image_info_list[0][IMAGE_WIDTH];
    let img_heigth = image_info_list[0][IMAGE_HEIGTH];
    // Analisando as dimensões
    for (let idx = 0; idx < image_info_list.length; idx++) {
        //alert("Fix: " + img_width + " Img: " + image_info_list[idx][IMAGE_WIDTH]);
        if ((image_info_list[idx][IMAGE_WIDTH] !== img_width) ||
            (image_info_list[idx][IMAGE_HEIGTH] !== img_heigth)) {
            // Avisar que o conjunto de imagens tem tamanhos diferentes
            document.getElementById("image_name").innerText = image_info_list[idx][FILE_NAME];
            $('#sizeerror-modal').modal('show');
            return;
        }
    }
    // Analisando as cores
    for (let idx = 0; idx < image_info_list.length; idx++) {
        let flag_color = false;
        let img = document.getElementById("tumb" + idx);
        let canvas = document.createElement('canvas');
        canvas.width = img.width;
        canvas.height = img.height;
        //alert("w: " + canvas.width + "h: " + canvas.height)
        canvas.getContext('2d', {willReadFrequently: true}).drawImage(img, 0, 0, img.width, img.height);
        let imageData = canvas.getContext('2d', {willReadFrequently: true}).getImageData(0,0, img.width, img.height);
        for (let color_idx = 0; color_idx < imageData.data.length; color_idx += 4) {
            // cor 1
            let color1 = imageData.data[color_idx];
            let color2 = imageData.data[color_idx + 1];
            let color3 = imageData.data[color_idx + 2];
            //alert("c1: " + color1 + " c2: " + color2 + " c3: " + color3)
            // Se for diferente
            if ((color1 !== color2) || (color1 !== color3) || (color2 !== color3)) {
                // Não é grayscale
                flag_color = true;
                //alert("Não");
            }
        }
        if (flag_color) {
            document.getElementById("image_name_color").innerText = image_info_list[idx][FILE_NAME];
            $('#colorerror-modal').modal('show');
            return;
        }
    }
    // Copia imagens para os elementos de canvas buffers
    copyImagesToCanvas();
    // Calcula o GraphAVD
    CalcShowGraphAVD();
}

//############################################################################
// Retorna um pixel da imagem passada
function getImagePixel(x, y, cvs) {
    let ret = cvs.getContext('2d', {willReadFrequently: true}).getImageData(x, y, 1, 1).data;
    ret = ret[0];
    return ret;
}

let avd_matrix = null;
let backup_canvas = null;
//#######################################################################################
// Calcula a imagem AVD
// LEMBRAR QUE IMAGEM NA MEMÓRIA ESTÁ EM 4 BYTES
//#######################################################################################
function CalcShowGraphAVD() {
    // Exibe modal para tratamento do calculo
    $('#graphavd-modal').modal('show');
    // Criando a imagem baseada na matrix AVD
    let canvas = document.getElementById('graphavd_cvs');
    backup_canvas = document.createElement('canvas');
    canvas.setAttribute("width", image_info_list[0][IMAGE_WIDTH] + "px");
    canvas.setAttribute("height", image_info_list[0][IMAGE_HEIGTH] + "px");
    backup_canvas.setAttribute("width", image_info_list[0][IMAGE_WIDTH] + "px");
    backup_canvas.setAttribute("height", image_info_list[0][IMAGE_HEIGTH] + "px");
    let context_cvs = canvas.getContext('2d', {willReadFrequently: true});
    context_cvs.canvas.width = image_info_list[0][IMAGE_WIDTH];
    context_cvs.canvas.height = image_info_list[0][IMAGE_HEIGTH];
    // Criar matrix 2D com os AVD de pixels
    avd_matrix = new Array(image_info_list[0][IMAGE_WIDTH]);
    for (let i = 0; i < avd_matrix.length; i++) {
        avd_matrix[i] = new Array(image_info_list[0][IMAGE_HEIGTH]);
    }
    for (let heigth_idx = 0; heigth_idx < image_info_list[0][IMAGE_HEIGTH]; heigth_idx++) {
        for (let width_idx = 0; width_idx < image_info_list[0][IMAGE_WIDTH]; width_idx++) {
            avd_matrix[width_idx][heigth_idx] = 0;
        }
    }
    //console.log(avd_matrix[0].length);
    //console.log(avd_matrix.length);
    let n_images = 19;
    if (image_info_list.length < 19)
        n_images = image_info_list.length - 1;
    for (let idx = 0; idx < n_images; idx++) {
        let cvs1 = document.getElementById("cvs" + idx);
        let cvs2 = document.getElementById("cvs" + (idx + 1));
        for (let heigth_idx = 0; heigth_idx < image_info_list[idx][IMAGE_HEIGTH]; heigth_idx++) {
            for (let width_idx = 0; width_idx < image_info_list[idx][IMAGE_WIDTH]; width_idx++) {
                let pix1 = getImagePixel(width_idx, heigth_idx, cvs1);
                let pix2 = getImagePixel(width_idx, heigth_idx, cvs2);
                avd_matrix[width_idx][heigth_idx] = (Math.abs(pix1 - pix2) + avd_matrix[width_idx][heigth_idx]);
            }
        }
        console.log("Imagem: " + idx);
    }
    let red = 0;
    let green = 0;
    let blue = 0;
    let multi_factor = 4;
    for (let heigth_idx = 0; heigth_idx < image_info_list[0][IMAGE_HEIGTH]; heigth_idx++) {
        for (let width_idx = 0; width_idx < image_info_list[0][IMAGE_WIDTH]; width_idx++) {
            //avd_matrix[width_idx][heigth_idx] = avd_matrix[width_idx][heigth_idx]/(image_info_list.length - 2);
            // Calcula a "cor"
            if(avd_matrix[width_idx][heigth_idx] < 64){
                red = 0;
                green = (avd_matrix[width_idx][heigth_idx] * multi_factor);
                blue = 255;
            } else {
                if(avd_matrix[width_idx][heigth_idx] < 128){
                    red = 0;
                    green = 255;
                    blue = (255 - (avd_matrix[width_idx][heigth_idx]-64) * multi_factor);
                } else {
                    if(avd_matrix[width_idx][heigth_idx] < 192){
                        red = ((avd_matrix[width_idx][heigth_idx]-128) * multi_factor);
                        green = 255;
                        blue = 0;
                    } else {
                        red = 255;
                        green = (255 - (avd_matrix[width_idx][heigth_idx]-192) * multi_factor);
                        blue = 0;
                    }
                }
            }
            context_cvs.fillStyle = "rgba("+ red + "," + green + ", " + blue + ", 1)";
            context_cvs.fillRect(width_idx, heigth_idx, 1, 1);
        }
    }
    // Faz um backup da imagem
    backup_canvas.getContext('2d', {willReadFrequently: true}).drawImage(canvas, 0, 0);
    //img_avd.src = canvas.toDataURL();
    //alert("Exibir");
    //;; exibir image!!!!
    colorPicker();
    const title_msg  = document.getElementById("title_msg");
    title_msg.innerHTML = "Images Processed";
    // loop para 200 pontos com variância de 20
    for (let idx = 0; idx < 200; idx++) {
        // gerar pontos no x
        let xvalue = gaussianRandom(0, 20);
        let yvalue = gaussianRandom(0, 20);
        gaussian_points_x.push(xvalue);
        gaussian_points_y.push(yvalue);
    }
}

//###############################################################################
// Distribuição normal entre 0 e 1
// Academia na veia!!! kkkkkkkk Transformação Box-Muller!!
// Standard Normal variate using Box-Muller transform.
function gaussianRandom(mean=0, stdev=1) {
    let u = 1 - Math.random(); // Converting [0,1) to (0,1]
    let v = Math.random();
    let z = Math.sqrt( -2.0 * Math.log( u ) ) * Math.cos( 2.0 * Math.PI * v );
    // Transform to the desired mean and standard deviation:
    return z * stdev + mean;
}

//##############################################################################
// Array da curva gaussiana
let gaussian_points_x = [];
let gaussian_points_y = [];

//###############################################################################
// Ativa os eventos de busca de ponto e cor da imagem
function colorPicker() {
    const canvas = document.getElementById("graphavd_cvs");
    const ctx = canvas.getContext("2d", {willReadFrequently: true});
    const hoveredColor = document.getElementById("hovered-color");
    const selectedColor = document.getElementById("selected-color");

    function pick(event, destination) {
        const bounding = canvas.getBoundingClientRect();
        const x = event.clientX - bounding.left;
        const y = event.clientY - bounding.top;
        const pixel = ctx.getImageData(x, y, 1, 1);
        const data = pixel.data;

        const rgba = `rgba(${data[0]}, ${data[1]}, ${data[2]}, ${data[3] / 255})`;
        destination.style.background = rgba;
        //destination.textContent = rgba;
        // restaura a imagem
        canvas.getContext('2d', {willReadFrequently: true}).drawImage(backup_canvas, 0, 0);
        // Gerar array de pontos na forma gaussiana

        // loop para 200 pontos com variância de 20
        for (let idx = 0; idx < 200; idx++) {
            // gerar pontos no x
            let xvalue = gaussian_points_x[idx];
            let yvalue = gaussian_points_y[idx];
            // Plotar na imagem
            ctx.fillStyle = "rgba(28, 28, 28, 1)";
            ctx.fillRect(xvalue + x, yvalue + y, 2, 2);
        }
        return rgba;
    }

    canvas.addEventListener("mousemove", (event) => pick(event, hoveredColor));
    canvas.addEventListener("click", (event) => pick(event, selectedColor));
}

//###############################################################################
// Transforma uma imagem em escala de cinzas
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

    $('#ok_error').click( function () {
        clearAllData();
    });
    $('#ok_error_color').click( function () {
        clearAllData();
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