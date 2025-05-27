import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dicRemoveFile: "Eliminar archivo",
    maxFiles: 1,
    uploadMultiple: false,
});

dropzone.on("sending", function (file, xhr, formData) {
    // formData.append('user_id', 1);
    console.log("Enviando archivo:", formData);
});

dropzone.on("success", function (file, response) {
    console.log("Archivo subido exitosamente:", response);
});

dropzone.on("error", function (file, message) {
    console.log("Error al subir el archivo:", message);
});
dropzone.on("removedfile", function () {});
