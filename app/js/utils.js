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

//########################################################################
// Validação da chave unica
// Comparar a chave digitada com as exsitentes e fazer o box ficar
// vermelho em caso de igualdade
function uniqueIDValidation() {
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
        if (((id_text.length <= 5) || (JSON.stringify(search_id).includes(id_text))) && (!editting)) {
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
        // Faz o update no banco de dados

        let header = id_text + "&" + sample_name.value + "&" + sample_frames.value + "&" +
            sample_config.value + "&" + sample_laser_type.value + "&" + other_laser_type.value + "&" +
            sample_wavelength.value + "&" + sample_permission.value + "&" + sample_pub_doi.value;

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

        //####################################################################
        // Faz update no banco de dados

        //alert("confirm");
    });
})
