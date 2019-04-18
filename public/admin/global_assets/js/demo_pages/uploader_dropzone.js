/* ------------------------------------------------------------------------------
 *
 *  # Dropzone multiple file uploader
 *
 *  Demo JS code for uploader_dropzone.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var DropzoneUploader = function() {


    //
    // Setup module components
    //

    // Dropzone file uploader
    var _componentDropzone = function() {
        if (typeof Dropzone == 'undefined') {
            console.warn('Warning - dropzone.min.js is not loaded.');
            return;
        }

        // Multiple files
        Dropzone.options.productImages = {
            paramName: "file", // The name that will be used to transfer the file
            dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
            maxFilesize:1, // MB
            acceptedFiles: 'image/*',
            maxFiles: 5,
            maxThumbnailFilesize: 1,
            addRemoveLinks: true,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                alert(time+file.name);
               return time+file.name;
            },
            success: function(file, response)
            {
                console.log(file);
            },
            error: function(file, response)
            {
               return false;
            }
        };
    };
    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentDropzone();
        }
    }
}();


// Initialize module
// ------------------------------

DropzoneUploader.init();
