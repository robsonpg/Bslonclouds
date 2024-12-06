//###############################################################
// Sacode
function shakeDOM(element) {
    // verifica o tipo do elemento
    //var type = element.nodeName;

    if ((element.value === '') || (element.value === null)) {
        //alert("animation!");
        element.focus();
        element.style.borderColor = "red";
        element.className = "shake";
        element.addEventListener("webkitAnimationEnd", function endEdit() {
            element.style.borderColor = "#A9A9A9";
            element.className = "";
        });

        return false;
    }
    return true;
}

function alphaOnly(event) {
    var key = event.keyCode;
    return (((key >= 65 && key <= 90) || (key >= 97 && key <= 122) || (key >= 48 && key <= 57)) || (key === 8) || (key === 189) || (Key === 95));
}

//########################################################################
// Validação da chave unica
// Comparar a chave digitada com as exsitentes e fazer o box ficar
// vermelho em caso de igualdade
function uniqueIDValidation(event) {
    let sample_id = document.getElementById("sample_id");
    let id_text = sample_id.value.trim();
    let unique_id_help = document.getElementById("unique_id_help");

    let search_id = null;
    if (typeof researchers != "undefined") search_id = researchers;
    if (typeof public_researchers != "undefined") search_id = public_researchers;

    // Verifica se o digitado está na lista
    for (let idx=0; idx < search_id.length; idx++) {
        if (search_id[idx]["bsl_sample_data_unique_id"] === id_text) {
            sample_id.style.backgroundColor = "#efc1c1";
            unique_id_help.innerHTML = "<b>" + msg_exist + "</b>";
            return false;
            //alert(id_text.length);
        } else {
            if (id_text.length <= 5) {
                // Fazer a borda ficar normal
                sample_id.style.backgroundColor = "#efc1c1";
                unique_id_help.innerHTML = "<b>" + msg_min + "</b>";
                return false;
            } else {
                sample_id.style.backgroundColor = "white";
                unique_id_help.innerHTML = msg_ok;
            }
        }
    }
}


//#######################################################################
// Função de leitura da imagem de capa
function readCoverURL(input) {
    let cover_img = document.getElementById("cover_image");
    cover_img.style.height = "20mm";
    const reader = new FileReader();
    reader.onload = function (e) {
        // Verificar se a imagem está dentro do tamanho máximo
        let image_main = new Image();
        image_main.src = e.target.result;
        image_main.onload = function () {
            // Determna o tamanho padrão
            if ((image_main.height > 300) || (image_main.width > 300)) {
                let warn_msg = document.getElementById("image_max_size");
                warn_msg.style.borderColor = "red";
                warn_msg.className = "row shake";
                warn_msg.addEventListener("webkitAnimationEnd", function endEdit() {
                    warn_msg.style.borderColor = "#A9A9A9";
                    warn_msg.className = "row";
                });
            } else {
                $('#cover_image')
                    .attr('src', e.target.result);
            }
        };
    }

    reader.readAsDataURL(input.files[0]);
}

function clickRename() {
    let sample_unique_id = document.getElementById("rename_uid");
    let sample_new_uid = document.getElementById("sample_id");
    let header = sample_unique_id.innerText + "&" + sample_new_uid.value;
    console.log("header: " + header);
    // chama a função em php usando ajax de renomear
    let ajaxRequest = $.ajax({
        type: 'POST',
        url: 'rename_sample_uid.php',
        dataType: "text",
        //async: true,
        data: header,
        processData: false,
        contentType: false,
        success: function (response) {
            //location.reload();
            if (response.includes('ERROR #0:')) {
                //messages_place.innerHTML = response.toString();
                location.reload();
            } else {
                messages_place.innerText = "Fail to update data in database.";
                //messages_place.innerText = response.toString();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("Error: A" + textStatus + " - " + errorThrown);
            console.log(textStatus, errorThrown);
        }
    });



}

//#########################################################
// Cliques comuns
$(document).ready(function() {

    //#########################################################################
    // Salva inserido os dados em banco de dados
    // Quando usuário clicar em salvar será feito todos os passo abaixo
    //#########################################################################
    $('#sample_data_confirm').click(function() {
        let sample_unique_id = document.getElementById("sample_id");
        let sample_name = document.getElementById("sample_name");
        let sample_frames = document.getElementById("sample_frames");
        let sample_config = document.querySelector('input[name="sample_config"]:checked');
        let sample_laser_type = document.querySelector('input[name="sample_laser_type"]:checked');
        let other_laser_type = document.getElementById("other_laser_type");
        let sample_wavelength = document.getElementById("sample_wavelength");
        let sample_permission = document.querySelector('input[name="sample_permission"]:checked');
        let sample_pub_doi = document.getElementById("research_public_id");
        let messages_place = document.getElementById("messages_place");
        let cover_image = document.getElementById("cover_image");
        let observations = document.getElementById("research_observation");

        // Se o id da amostra tem menos que 6 caracteres, não aceita
        let id_text = sample_unique_id.value;
        let search_id = null;
        let editting = false;
        //alert(typeof researchers);
        if (typeof researchers != "undefined") search_id = researchers;
        if (typeof public_researchers != "undefined") {
            search_id = public_researchers;
            editting = true;
        }
        if (((id_text.length <= 5) || (JSON.stringify(search_id).includes('"' + id_text + '"'))) && (!editting)) {
            // Sacode a entrada
            sample_unique_id.focus();
            sample_unique_id.style.borderColor = "red";
            sample_unique_id.className = "shake";
            sample_unique_id.addEventListener("webkitAnimationEnd", function endEdit() {
                sample_unique_id.style.borderColor = "#A9A9A9";
                sample_unique_id.className = "";
            });
            return false;
        }
        // verify field empty
        if (!shakeDOM(sample_unique_id)) return false;
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
        if (sample_laser_type === null) {
            let sample_laser_type_label = document.getElementById("sample_laser_type_label");
            sample_laser_type_label.style.borderColor = "red";
            sample_laser_type_label.className = "col shake";
            sample_laser_type_label.addEventListener("webkitAnimationEnd", function endEdit() {
                sample_laser_type_label.style.borderColor = "#A9A9A9";
                sample_laser_type_label.className = "col";
            });
            return false;
        }
        if (!shakeDOM(sample_wavelength)) return false;
        if (sample_permission === null) {
            let sample_permission_label = document.getElementById("sample_permission_label");
            sample_permission_label.style.borderColor = "red";
            sample_permission_label.className = "col shake";
            sample_permission_label.addEventListener("webkitAnimationEnd", function endEdit() {
                sample_permission_label.style.borderColor = "#A9A9A9";
                sample_permission_label.className = "col";
            });
            return false;
        }

        //###################################################################
        // Faz o update no banco de dados em caso de edição
        if (editting) {

            let header = id_text + "&" + sample_name.value + "&" + sample_frames.value + "&" +
                sample_config.value + "&" + sample_laser_type.value + "&" + other_laser_type.value + "&" +
                sample_wavelength.value + "&" + sample_permission.value + "&" + sample_pub_doi.value + "&" +
                cover_image.src + "&" + observations.value;

            let ajaxRequest = $.ajax({
                type: 'POST',
                url: 'update_sample_data.php',
                dataType: "text",
                //async: true,
                data: header,
                processData: false,
                contentType: false,
                success: function (response) {
                    //location.reload();
                    if (response.includes('ERROR #0:')) {
                        //messages_place.innerHTML = response.toString();
                        location.reload();
                    } else {
                        messages_place.innerText = "Fail to update data in database.";
                        //messages_place.innerText = response.toString();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Error: A" + textStatus + " - " + errorThrown);
                    console.log(textStatus, errorThrown);
                }
            });
        } else {
            //###################################################################
            // Salva os dados para inserir no banco de dados
            images_properties = [];
            images_properties.push(sample_unique_id.value.trim());
            images_properties.push(sample_name.value);
            images_properties.push(sample_frames.value);
            images_properties.push(sample_config.value);
            images_properties.push(sample_laser_type.value);
            let other_laser_type = document.getElementById("other_laser_type");
            images_properties.push(other_laser_type.value);
            images_properties.push(sample_wavelength.value);
            images_properties.push(sample_permission.value);
            images_properties.push(sample_pub_doi.value);
            //####################################################################
            // Coloca a imagem de capa na list
            images_properties.push(cover_image.getAttribute("src"));
            images_properties.push(observations.value);

            //####################################################################
            // Preenche a interface
            let image_properties = document.getElementById("images_properties");
            image_properties.innerHTML = "";
            let row_prop = document.createElement("div");
            row_prop.className = "row justify-content-between align-items-center";
            let col_prop = document.createElement("div");
            col_prop.className = "col-10";

            let config_id = sample_config.getAttribute("id").toString();
            let config_text = $("label[for='" + config_id + "']").text();
            let laser_type_id = sample_laser_type.getAttribute("id").toString();
            let laser_type_text = $("label[for='" + laser_type_id + "']").text();
            let permission_id = sample_permission.getAttribute("id").toString();
            let permission_text = $("label[for='" + permission_id + "']").text();
            let pub_text = sample_pub_doi.value;
            let obs_text = observations.value;

            col_prop.innerHTML = msg_user_name + ": <b>" + login_user_name + "</b><br>" +
                msg_uid + ": <b>" + sample_unique_id.value + "</b><br><br>" + msg_cover + ": " +
                "<img id='cover_image_prop' src='" + cover_image.getAttribute("src") + "' style='height: 20mm'><br><br>" +
                msg_illumi + ": <b>" + sample_name.value + "</b> " +
                msg_fr + ": <b>" + sample_frames.value + "</b> " +
                msg_config + ": <b>" + config_text + "</b> " +
                msg_lt + ": <b>" + laser_type_text + "</b> " +
                msg_lw + ": <b>" + sample_wavelength.value + " nm</b> " +
                msg_per + ": <b>" + permission_text + "</b> " +
                msg_pub + ": <b>" + pub_text + "</b><br>" +
                msg_observations + ": <b>" + obs_text + "</b>";

            //#############################################################
            // Botão de editar as propriedades
            let col_prop_edit = document.createElement("div");
            col_prop_edit.className = "col-2";
            let btn_edit = document.createElement("a");
            btn_edit.className = "btn btn-info";
            btn_edit.setAttribute("id", "properties_edit");
            btn_edit.onclick = showPropertiesModal;
            btn_edit.innerHTML = "<a style='color: white'>" + btn_edit_text + "</a>";
            //<a id="sample_data_confirm" className="btn btn-primary delete" href="#"><?=lang("BTN_ACCEPT")?></a>
            col_prop_edit.append(btn_edit);

            row_prop.append(col_prop);
            row_prop.append(col_prop_edit);
            image_properties.append(row_prop);
            image_properties.style.display = "block";
            // Aiva o botão de selecionar imagens
            let btn_get_files = document.getElementById("btn_get_files");
            btn_get_files.disabled = false;

            // Preencheu as propriedades, ativa o botão de envio
            if ((image_info_list.length > 0) && (images_properties.length > 0)) {
                let btn_send = document.getElementById("btn_send_modal");
                btn_send.disabled = false;
            }
        }
        // Esconde o modal
        $('#properties-modal').modal('hide');
        // Desabilita o botão de entrada de probpriedades
        let btn_properties = document.getElementById("btn_prop_modal");
        btn_properties.disabled = true;
        //alert("confirm");
    });
})
