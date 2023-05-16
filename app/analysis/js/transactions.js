
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


function successCallback(result) {
    console.log("It succeeded with " + result);
}

function failureCallback(error) {
    console.log("It failed with " + error);
}

//#######################################################################
// Função de leitura da imagem
// Mas o projeto prevê muitas imagens
// Vamos ler apenas o path e o nome do arquivo e armazenar
function readURL(input, id) {
    let main_width = 0;
    let main_height = 0;
    image_info_list = [];
    images_properties = [];
    let modalErrorSize = document.getElementById('sizeerror-modal')
    modalErrorSize.addEventListener('hidden.bs.modal', function (event) {
        clearAllData();
    })
    let modalColorSize = document.getElementById('colorerror-modal')
    modalColorSize.addEventListener('hidden.bs.modal', function (event) {
        clearAllData();
    })
    let count = 0;
    if (input.files.length > 64) {
        let error_place = document.getElementById("error_messages_place");
        error_place.innerHTML = "<div role='alert' class='alert alert-warning'>" + msg_error_loding_images + "</div>";
        setTimeout(function () {
            error_place.innerHTML = "";
        }, 5000);
    } else {
        //$('#graphavd-modal').modal('show');
        let btn_select = document.getElementById("btn_get_files");
        btn_select.value = msg_loading;
        btn_select.disabled = true;

        let img_count = document.getElementById("image_number");
        if (input.files.length > 10)
            img_count.innerText = "10";
        else
            img_count.innerText = String(input.files.length);

        let tumb_div = document.querySelector("#tumbnails");
        tumb_div.innerHTML = "";
        let tumb_image = null;
        let canvas_image = null;
        let row_tumb = document.createElement("div");
        row_tumb.className = "row justify-content-start align-items-left border";
        for (let i=0; i<input.files.length; i++)
        {
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
                img_cvs.onload = await function () {
                    // Determna o tamanho padrão
                    if ((img_cvs.naturalWidth > 0) && (img_cvs.naturalHeight > 0)) {
                    //if (i === 0) {
                        main_width = img_cvs.naturalWidth;
                        main_height = img_cvs.naturalHeight;
                        let cvs = document.getElementById("graphavd_cvs");
                        cvs.setAttribute("height", main_height);
                        cvs.setAttribute("width",  main_width);
                    }
                    image_info_list[i][IMAGE_WIDTH] = main_width;
                    image_info_list[i][IMAGE_HEIGTH] = main_height;
                    count++;
                    if (i === (input.files.length - 1)) {
                        if (img_cvs.complete) {
                            btn_select.disabled = false;
                            btn_select.value = msg_select_images;
                            let btn_start = document.getElementById("btn_start_avd");
                            btn_start.className = "btn btn-primary";
                            //alert("Imagens carregadas");
                            // Acabou de carregar as imagens, fazer anális
                            startImageAnalyse();
                            // setTimeout(function(){
                            //     $('#imagesloaded-modal').modal('show');
                            //     startImageAnalyse();
                            // }, 5000);
                        }
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
        //$('#graphavd-modal').modal('show');
    }
}

//#########################################################################################
// Copia as imagens para canvas relativos para ocorrer a manipulação
function copyImagesToCanvas() {
    try {
        let main_width = 0;
        let main_height = 0;
        for (let idx = 0; idx < image_info_list.length; idx++) {
            let img_cvs = document.getElementById('tumb' + idx);
            let cvs_cvs = document.getElementById('cvs' + idx);
            cvs_cvs.setAttribute("height", image_info_list[idx][IMAGE_HEIGTH]);
            cvs_cvs.setAttribute("width", image_info_list[idx][IMAGE_WIDTH]);
            cvs_cvs.getContext('2d', {willReadFrequently: true}).drawImage(img_cvs, 0, 0, image_info_list[idx][IMAGE_WIDTH], image_info_list[idx][IMAGE_HEIGTH]);
            // Find width and height of the images
            if (img_cvs.naturalWidth > main_width) main_width = img_cvs.naturalWidth;
            if (img_cvs.naturalHeight > main_height) main_height = img_cvs.naturalHeight;
        }
        let flg_error = false;
        let image_name = "";
        for (let idx = 0; idx < image_info_list.length; idx++) {
            let img_cvs = document.getElementById('tumb' + idx);
            if ((img_cvs.naturalWidth !== main_width) || (img_cvs.naturalHeight !== main_height)) {
                flg_error = true;
                image_name = image_info_list[idx][FILE_NAME];
            }
        }
        if (flg_error) {
            document.getElementById("image_name").innerText = image_name;
            $('#sizeerror-modal').modal('show');
        } else {
            $('#imagesloaded-modal').modal('show');
        }
    } catch (error) {
        $('#cacheerror-modal').modal('show');
    }
}

//####################################################################################
// Faz análise das imagens quanto ao tamanho de cada uma e seu profundidade de cores
function startImageAnalyse(){
    // let btn_start = document.getElementById("btn_start_avd");
    // btn_start.className = "btn btn-primary";
    //btn_start.innerText = msg_analysing;
    /// image_info_list contém os detalhes de cada imagem carregada
    // Vamos basear na resolução da primeira imagem para comparar as outras
    // let img_width = image_info_list[0][IMAGE_WIDTH];
    // let img_heigth = image_info_list[0][IMAGE_HEIGTH];
    // Analisando as dimensões
    // for (let idx = 0; idx < image_info_list.length; idx++) {
    //     //alert("Fix: " + img_width + " Img: " + image_info_list[idx][IMAGE_WIDTH]);
    //     if ((image_info_list[idx][IMAGE_WIDTH] !== img_width) ||
    //         (image_info_list[idx][IMAGE_HEIGTH] !== img_heigth)) {
    //         // Avisar que o conjunto de imagens tem tamanhos diferentes
    //         document.getElementById("image_name").innerText = image_info_list[idx][FILE_NAME];
    //         $('#sizeerror-modal').modal('show');
    //         return;
    //     }
    // }
    // Analisando as cores
    try {
        for (let idx = 0; idx < image_info_list.length; idx++) {
            let flag_color = false;
            let img = document.getElementById("tumb" + idx);
            let canvas = document.createElement('canvas');
            canvas.width = img.width;
            canvas.height = img.height;
            //alert("w: " + canvas.width + "h: " + canvas.height)
            canvas.getContext('2d', {willReadFrequently: true}).drawImage(img, 0, 0, img.width, img.height);
            let imageData = canvas.getContext('2d', {willReadFrequently: true}).getImageData(0, 0, img.width, img.height);
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
    } catch (error) {
        $('#cacheerror-modal').modal('show');
    }

    // Copia imagens para os elementos de canvas buffers
    copyImagesToCanvas();
    // Calcula o GraphAVD

    //CalcShowGraphAVD();
}

//############################################################################
// Retorna um pixel da imagem passada
function getImagePixel(x, y, cvs) {
    let ret = cvs.getContext('2d', {willReadFrequently: true}).getImageData(x, y, 1, 1).data;
    ret = ret[0];
    return ret;
}

async function sleep() {
    return new Promise((resolve) => setTimeout(resolve, 300));
}

let avd_matrix = null;
let coom_matrix = null;
let backup_canvas = null;
//#######################################################################################
// Calcula a imagem AVD
// LEMBRAR QUE IMAGEM NA MEMÓRIA ESTÁ EM 4 BYTES
//#######################################################################################
async function CalcShowGraphAVD() {
    $('#graphavd-modal').modal('show');
    // Criando a imagem baseada na matrix AVD
    let canvas = document.getElementById('graphavd_cvs');
    let progress = document.getElementById("image_process");
    progress.max = image_info_list.length.toString();
    progress.value = "0";
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
    let n_images = 10;
    if (image_info_list.length < n_images)
        n_images = image_info_list.length - 1;
    progress.max = n_images.toString();
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
        window.requestAnimationFrame(() => {
            progress.value = (idx + 1).toString();
        });
        await sleep();
    }
    let red = 0;
    let green = 0;
    let blue = 0;
    let multi_factor = 3;
    for (let heigth_idx = 0; heigth_idx < image_info_list[0][IMAGE_HEIGTH]; heigth_idx++) {
        for (let width_idx = 0; width_idx < image_info_list[0][IMAGE_WIDTH]; width_idx++) {
            //avd_matrix[width_idx][heigth_idx] = avd_matrix[width_idx][heigth_idx]/(image_info_list.length - 2);
            // Calcula a "cor"
            if (avd_matrix[width_idx][heigth_idx] < 64) {
                red = 0;
                green = (avd_matrix[width_idx][heigth_idx] * multi_factor);
                blue = 255;
            } else {
                if (avd_matrix[width_idx][heigth_idx] < 128) {
                    red = 0;
                    green = 255;
                    blue = (255 - (avd_matrix[width_idx][heigth_idx] - 64) * multi_factor);
                } else {
                    if (avd_matrix[width_idx][heigth_idx] < 192) {
                        red = ((avd_matrix[width_idx][heigth_idx] - 128) * multi_factor);
                        green = 255;
                        blue = 0;
                    } else {
                        red = 255;
                        green = (255 - (avd_matrix[width_idx][heigth_idx] - 192) * multi_factor);
                        blue = 0;
                    }
                }
            }
            context_cvs.fillStyle = "rgba(" + red + "," + green + ", " + blue + ", 1)";
            context_cvs.fillRect(width_idx, heigth_idx, 1, 1);
        }
    }
    // Faz um backup da imagem
    backup_canvas.getContext('2d', {willReadFrequently: true}).drawImage(canvas, 0, 0);
    //img_avd.src = canvas.toDataURL();
    //alert("Exibir");
    //;; exibir image!!!!
    colorPicker();
    //const title_msg = document.getElementById("title_msg");
    //title_msg.innerHTML = "Images Processed<br>";

    calculateGaussian();
    progress.value = image_info_list.length.toString();
    // let btn_start = document.getElementById("btn_start_avd");
    // btn_start.innerText = msg_done;
    $('#clickpoint-modal').modal('show');
}

//##########################################################################
// Calcula a curva gaussiana para aplicar no AVD
function calculateGaussian() {
    gaussian_points_x = [];
    gaussian_points_y = [];
    const gau_points = document.getElementById("gau_num_points");
    const std_deviation = document.getElementById("std_deviation");
    let gpoints = 200;
    let stddev = 20;
    if (gau_points.value) {
        gpoints = gau_points.value;
    }
    if (std_deviation.value) {
        stddev = std_deviation.value;
    }
    console.log("Gauss:" + stddev + " : " + gpoints);
    for (let idx = 0; idx < gpoints; idx++) {
        // gerar pontos no x
        let xvalue = gaussianRandom(0, stddev);
        let yvalue = gaussianRandom(0, stddev);
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
let THSP_matrix = [];
let last_x = 0, last_y = 0;
const canvas_avd = document.getElementById("graphavd_cvs");
const ctx_avd = canvas_avd.getContext("2d", {willReadFrequently: true});

//#############################################################################
// Função que desenha a curva gaussiana no movimento do mouse
function pick(event) {
    const bounding = canvas_avd.getBoundingClientRect();
    const x = event.clientX - bounding.left;
    const y = event.clientY - bounding.top;

    last_x = x;
    last_y = y;
    plotGauss(x, y);
}

//##############################################################################
// Momento que o usuário clica em determinado ponto
// Gabarito X:
//     256.02
// Y:
//     140.42
//     >> C = coom(THSP);
//
// >> Y = avd(C);
//
// >> Y
// Y = 33.091
//     >>

function clickPick(event) {
    const bounding = canvas_avd.getBoundingClientRect();
    const x = event.clientX - bounding.left;
    const y = event.clientY - bounding.top;
    // const x = 140;
    // const y = 256;

    last_x = x;
    last_y = y;
    // Calcular THSP
    const gau_points = document.getElementById("gau_num_points");
    let gpoints = 200;
    if (gau_points.value) {
        gpoints = gau_points.value;
    }
    // O número de imagens está no primeiro indice e
    // o número de pontos da gaussiana está no segundo
    // Octave: Y é a matriz THSP e é pontos gaussianos x imagem
    // for m = 1:M
    // for k = 1:NTIMES
    // Y(m,k) = DATA( POINTS(m,1) , POINTS(m,2) , k);
    // end
    // end
    // Cria a matriz THSP
    for (let i = 0; i < gpoints; i++) {
        THSP_matrix[i] = [];
        for (let y = 0; y < image_info_list.length; y++)
            THSP_matrix[i][y] = 0;
    }

    for (let idx = 0; idx < image_info_list.length; idx++) {
        let cvs_img = document.getElementById("cvs" + idx);
        for (let gauss_idx = 0; gauss_idx < gpoints; gauss_idx++) {
            let xvalue = gaussian_points_x[gauss_idx];
            let yvalue = gaussian_points_y[gauss_idx];
            let pix_val = getImagePixel(x + Math.round(xvalue), y + Math.round(yvalue), cvs_img);
            // THSP : imagem x gauss index
            THSP_matrix[gauss_idx][idx] = pix_val;
        }
    }
    // Calcula o Absolute Value of the Differences (AVD)
    calculateCOM();
}

let COM_matrix = [256];
let color_hist = [256];
//##############################################################################
// Calcula o COM: Matriz de coocorrência ou matrizes de co-ocorrência em
// nível de cinza.
// ou GLCH (histogramas de co-ocorrência em nível de cinza)
// ou matriz de dependência espacial.
// Octave: C é a matriz COM e é d1 - linha - imagens x d2 - coluna - pontos gaussianos
// a = size(THSP);
// C = zeros(256,256);
//
// for linea = 1:a(1,1)
// for col   = 1:a(1,2)-1
//
// d1 = THSP(linea,col)+1;
// d2 = THSP(linea,col+1)+1;
//
// C(d1,d2) = C(d1,d2)+1;
// end
// end
function calculateCOM() {
    // Zera a matriz COM
    for (let zerosx = 0; zerosx < 256; zerosx++) {
        COM_matrix[zerosx] = [];
        for (let zerosy = 0; zerosy < 256; zerosy++) {
            COM_matrix[zerosx][zerosy] = 0;
        }
    }
    // linhas THSP
    let canvas_hist = document.getElementById('color_hist');
    let context_cvs = canvas_hist.getContext('2d', {willReadFrequently: true});
    context_cvs.fillStyle = "rgba(255, 255, 255, 1)";
    context_cvs.fillRect(0, 0, canvas_hist.width, canvas_hist.height);

    //let color_hist = [256];
    for (let i = 0; i < 256; i++) {
        color_hist[i] = 0;
    }

    let thsp_lines = THSP_matrix.length; // gausss - Ex: 0:200
    let thsp_cols = THSP_matrix[0].length; // imagens - Ex: 0:64
    for (let thsp_idx_line = 0; thsp_idx_line < thsp_lines; thsp_idx_line++) {
        for (let thsp_idx_col = 0; thsp_idx_col < thsp_cols; thsp_idx_col++) {
            let color1 = THSP_matrix[thsp_idx_line][thsp_idx_col];
            let color2 = THSP_matrix[thsp_idx_line][thsp_idx_col+1];
            if (color1 > 255) color1 = 255;
            if (color1 < 1) color1 = 1;
            if (color2 > 255) color2 = 255;
            if (color2 < 1) color2 = 1;
            COM_matrix[color1][color2] = COM_matrix[color1][color2] + 1;

            color_hist[color1]++;
            color_hist[color2]++;
            context_cvs.fillStyle = "rgba(0, 0, 0, 1)";
            context_cvs.fillRect(color1, 255, 1, (-color_hist[color1]*(32/thsp_cols)));
            context_cvs.fillRect(color2, 255, 1, (-color_hist[color2]*(32/thsp_cols)));
        }
    }
    calculateAVD();
}

//##############################################################################
// Função para clacular o Absolute Value of the Differences (AVD)
function calculateAVD() {
    // Octave:
    // function [Y, varargout] = avd(COM,varargin)
    // Nsize = size(COM); (tamanho em x e y)
    // Ntot=sum(sum(COM));
    // Y=0;
    // for b1 = 1:Nsize(1,1)
    // for b2 = 1:Nsize(1,2)
    // Y = Y+ (COM(b1,b2)*abs(b1-b2)) /Ntot;
    // Calculos:
    // sum(COM) - soma as colunas
    // sum(sum(COM)) - soma o somatório das colunas
    let com_lines = COM_matrix.length;
    let com_cols = COM_matrix[0].length;
    let AVD = 0;
    let COM_total = 0;
    let total_line_vec = [];
    // Somar as linhas em um vetor
    for (let idx_line = 0; idx_line < com_lines; idx_line++) {
        total_line_vec[idx_line] = 0;
        for (let idx_col = 0; idx_col < com_cols; idx_col++) {
            //console.log(COM_matrix[idx_line][idx_col])
            total_line_vec[idx_line] = total_line_vec[idx_line] + COM_matrix[idx_line][idx_col];
        }
    }
    for (let com_vector = 0; com_vector < total_line_vec.length; com_vector++) {
        // Calculi do AVD
        COM_total = COM_total + total_line_vec[com_vector];
    }

    for (let idx_line = 0; idx_line < com_lines; idx_line++) {
        for (let idx_col = 0; idx_col < com_cols; idx_col++) {
            AVD = AVD + (COM_matrix[idx_line][idx_col]*Math.abs(idx_line - idx_col))/ COM_total;
        }
    }

    let avd_number = document.getElementById("avd_number");
    let img_number = document.getElementById("avd_images");
    avd_number.innerHTML = "<b>" + String(Number(Math.round(AVD * 100) / 100).toFixed(2)) + "</b>";
    img_number.innerHTML = (image_info_list.length) + msg_avd_images;
    //console.log("AVD: " + AVD);

}

//##############################################################################
// Desenha a curva gaussiana
function plotGauss(x ,y) {
    //destination.style.background = rgba;
    //destination.textContent = rgba;
    // restaura a imagem
    canvas_avd.getContext('2d', {willReadFrequently: true}).drawImage(backup_canvas, 0, 0);
    // Gerar array de pontos na forma gaussiana
    const gau_points = document.getElementById("gau_num_points");
    let gpoints = 200;
    if (gau_points.value) {
        gpoints = gau_points.value;
    }
    // loop para plotar a curva gaussiana
    for (let idx = 0; idx < gpoints; idx++) {
        // gerar pontos no x
        let xvalue = gaussian_points_x[idx];
        let yvalue = gaussian_points_y[idx];
        // Plotar na imagem
        ctx_avd.fillStyle = "rgba(28, 28, 28, 1)";
        ctx_avd.fillRect(xvalue + x, yvalue + y, 2, 2);
    }
    return;
}

//###############################################################################
// Ativa os eventos de busca de ponto e cor da imagem
function colorPicker() {
    //const canvas = document.getElementById("graphavd_cvs");
    //const ctx = canvas.getContext("2d", {willReadFrequently: true});
    //const hoveredColor = document.getElementById("hovered-color");
    //const selectedColor = document.getElementById("selected-color");

    canvas_avd.addEventListener("mousemove", (event) => pick(event));
    canvas_avd.addEventListener("click", (event) => clickPick(event));
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
    // Trata as teclas de direção
    onkeydown = (event) => {
        let flg_prev = false;
        if (event.key === 'ArrowUp') {
            const gau_points = document.getElementById("gau_num_points");
            let gval = parseInt(gau_points.value) + 1;
            gau_points.value = gval;
            flg_prev = true;
        }
        if (event.key === 'ArrowDown') {
            const gau_points = document.getElementById("gau_num_points");
            let gval = parseInt(gau_points.value) - 1;
            gau_points.value = gval;
            flg_prev = true;
        }
        if (event.key === 'ArrowLeft') {
            const gau_points = document.getElementById("std_deviation");
            let gval = parseInt(gau_points.value) - 1;
            gau_points.value = gval;
            flg_prev = true;
        }
        if (event.key === 'ArrowRight') {
            const gau_points = document.getElementById("std_deviation");
            let gval = parseInt(gau_points.value) + 1;
            gau_points.value = gval;
            flg_prev = true;
        }
        if (flg_prev) {
            event.preventDefault();
            calculateGaussian();
            plotGauss(last_x, last_y);
        }
        //return false;
    };

    $('#ok_error').click( function () {
        clearAllData();
    });
    $('#ok_avd').click( function () {
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

function upCalc() {
    let input_val = document.getElementById("gau_num_points");
    let value = input_val.value;
    value++;
    input_val.value = value;
}

function downCalc() {
    let input_val = document.getElementById("gau_num_points");
    let value = input_val.value;
    value--;
    input_val.value = value;
}

function rightCalc() {
    let input_val = document.getElementById("std_deviation");
    let value = input_val.value;
    value++;
    input_val.value = value;
}

function leftCalc() {
    let input_val = document.getElementById("std_deviation");
    let value = input_val.value;
    value--;
    input_val.value = value;
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