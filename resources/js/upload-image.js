document.addEventListener("DOMContentLoaded", function(event) {
    Dropzone.options.dropzone =
        {
            maxFilesize: 5,
            maxFiles: 1,
            init: function () {
                this.on("maxfilesexceeded", function () {
                    if (this.files[1] != null) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            resizeQuality: 1.0,
            acceptedFiles: ".jpeg,.jpg,.png",
            addRemoveLinks: true,
            timeout: 60000,
            removedfile: function (file) {
                const name = file.upload.filename;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ url("files/destroy") }}',
                    data: {filename: document.getElementById('formFile').value},
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
                console.log(response);
                document.getElementById('formFile').value = response;
            },
            error: function (file, response) {
                return false;
            }
        };
})

