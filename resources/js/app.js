import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dicRemoveFile: "Eliminar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);
            imagenPublicada.previewElement.classList.add("dz-success");
            imagenPublicada.previewElement.classList.add("dz-complete");
        }
    }
});



dropzone.on("success", function (file, response) {
    //document.querySelector("#imagen").value = response.imagen;
    document.querySelector('[name="imagen"]').value = response.imagen;
});


dropzone.on("removedfile", function () {
    document.querySelector('[name="imagen"]').value = "";
});
