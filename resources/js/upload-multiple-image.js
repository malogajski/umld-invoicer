document.addEventListener("DOMContentLoaded", function(event) {
    Dropzone.options.somedropzone =
        {
            maxFilesize: 5,
            maxFiles: 5,
            uploadMultiple: true,
            parallelUploads: 5,
            resizeQuality: 1.0,
            acceptedFiles: ".jpeg,.jpg,.png",
            addRemoveLinks: true,
            timeout: 60000,
            init: function() {
                const self = this;
                self.on("complete", function(file) {
                    for (let i = 0; i < document.getElementsByClassName("dz-preview").length; i++) {
                        document.getElementById("preview-template").appendChild(document.getElementsByClassName("dz-preview")[i]);
                    }
                });
            },
            removedfile: function (file) {
                const name = file.newName;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: window.origin + "/files/destroy",
                    data: {filename: name},
                    success: function (data) {
                        console.log("File has been successfully removed!!");
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
                let fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function (file, response) {
                file.newName = response;
                if (document.getElementById('formFile').value) {
                    document.getElementById('formFile').value = document.getElementById('formFile').value + '|' + response;
                } else {
                    document.getElementById('formFile').value = response;
                }
            },
            error: function (file, response) {
                return false;
            }
        };
})

