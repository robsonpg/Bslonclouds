
/* global zip, document, URL, MouseEvent, AbortController, alert */

(() => {

    if (typeof TransformStream == "undefined") {
        const script = document.createElement("script");
        script.src = "js/zip/web-streams-polyfill.min.js";
        document.body.appendChild(script);
    }

    const model = (() => {

        let zipWriter;
        return {
            addFile(file, options) {
                if (!zipWriter) {
                    zipWriter = new zip.ZipWriter(new zip.BlobWriter("application/zip"), { bufferedWrite: true });
                }
                return zipWriter.add(file.name, new zip.BlobReader(file), options);
            },
            async getBlobURL() {
                if (zipWriter) {
                    const blobURL = URL.createObjectURL(await zipWriter.close());
                    zipWriter = null;
                    return blobURL;
                } else {
                    throw new Error("Zip file closed");
                }
            }
        };

    })();

    (() => {

        async function selectFiles() {
            try {
                await addFiles();
                fileInput.value = "";
                downloadButton.disabled = false;
            } catch (error) {
                alert(error);
            } finally {
                zipProgress.remove();
            }
        }

        //const fileInput = document.getElementById("file-input");
        const fileInput = document.getElementById("getfiles");
        const fileInputButton = document.getElementById("file-input-button");
        const zipProgress = document.createElement("progress");
        const downloadButton = document.getElementById("download-button");
        const fileList = document.getElementById("file-list");
        const filenameInput = document.getElementById("filename-input");
        const passwordInput = document.getElementById("password-input");
        fileInputButton.addEventListener("click", () => fileInput.dispatchEvent(new MouseEvent("click")), false);
        downloadButton.addEventListener("click", onDownloadButtonClick, false);
        //fileInput.addEventListener("change", selectFiles);
        fileInput.onchange = selectFiles;

        async function addFiles() {
            downloadButton.disabled = true;
            await Promise.all(Array.from(fileInput.files).map(async file => {
                const li = document.createElement("li");
                const filenameContainer = document.createElement("span");
                const filename = document.createElement("span");
                const zipProgress = document.createElement("progress");
                filenameContainer.classList.add("filename-container");
                li.appendChild(filenameContainer);
                filename.classList.add("filename");
                filename.textContent = file.name;
                filenameContainer.appendChild(filename);
                zipProgress.value = 0;
                zipProgress.max = 0;
                li.appendChild(zipProgress);
                fileList.classList.remove("empty");
                fileList.appendChild(li);
                li.title = file.name;
                li.classList.add("pending");
                li.onclick = event => event.preventDefault();
                const controller = new AbortController();
                const signal = controller.signal;
                const abortButton = document.createElement("button");
                abortButton.onclick = () => controller.abort();
                abortButton.textContent = "✖";
                abortButton.title = "Abort";
                filenameContainer.appendChild(abortButton);
                try {
                    const entry = await model.addFile(file, {
                        password: passwordInput.value,
                        signal,
                        onstart(max) {
                            li.classList.remove("pending");
                            li.classList.add("busy");
                            zipProgress.max = max;
                        },
                        onprogress(index, max) {
                            zipProgress.value = index;
                            zipProgress.max = max;
                        }
                    });
                    li.title += `\n  Last modification date: ${entry.lastModDate.toLocaleString()}\n  Compressed size: ${entry.compressedSize.toLocaleString()} bytes`;
                } catch (error) {
                    if (signal.reason && signal.reason.code == error.code) {
                        if (!li.previousElementSibling && !li.nextElementSibling) {
                            fileList.classList.add("empty");
                        }
                        li.remove();
                    } else {
                        throw error;
                    }
                } finally {
                    li.classList.remove("busy");
                    zipProgress.remove();
                }
            }));
        }

        async function onDownloadButtonClick(event) {
            let blobURL;
            try {
                blobURL = await model.getBlobURL();
            } catch (error) {
                alert(error);
            }
            if (blobURL) {
                const anchor = document.createElement("a");
                const clickEvent = new MouseEvent("click");
                anchor.href = blobURL;
                anchor.download = filenameInput.value;
                anchor.dispatchEvent(clickEvent);
                fileList.innerHTML = "";
                fileList.classList.add("empty");
            }
            downloadButton.disabled = true;
            event.preventDefault();
        }

    })();

})();




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
        tumb_image.style.width = "10%";
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

function zipFiles() {
    alert("zip");
}


