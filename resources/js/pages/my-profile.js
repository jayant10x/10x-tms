// import $ from 'jquery';

document.addEventListener('DOMContentLoaded', async () => {
    const inputElement = document.querySelector('#profile_photo');
    let existingPhoto = window.loggedInEmployeeData?.emp_photo != null;

    // Initialize FilePond with custom options (overriding defaults if needed)
    const pond = await window.initFilePond(inputElement, {
        labelIdle: 'Drag & Drop profile photo or <span class="filepond--label-action">Browse</span>',
        imagePreviewHeight: 100,
        imageCropAspectRatio: '1:1', // Force square crop for profile pictures
        imageResizeTargetWidth: 100,
        imageResizeTargetHeight: 100,
        stylePanelLayout: 'compact circle',
        styleLoadIndicatorPosition: 'center bottom',
        styleProgressIndicatorPosition: 'right bottom',
        styleButtonRemoveItemPosition: 'center bottom',
        styleButtonProcessItemPosition: 'right bottom',
        storeAsFile: true,
        allowReplace: true,
        maxFileSize: '5MB',

        files: existingPhoto
            ? [
                {
                    source: `/storage/employees/${window.loggedInEmployeeData?.emp_photo}`,
                    options: {
                        // type: 'local',
                        metadata: {
                            poster: `/storage/employees/${window.loggedInEmployeeData?.emp_photo}`
                        }
                    }
                }
            ]
            : []
    });

    pond.on('addfile', () => {
        const fileItem = document.querySelector('.filepond--item');
        if (fileItem) {
            fileItem.addEventListener('click', (e) => {
                // Prevent default events and trigger file picker
                e.stopPropagation();
                pond.browse();
            });
        }
    });
});

$(document).ready(function () {
    $('#profile_edit_form').validate({
        ignore: [],
        rules: {
            full_name: {
                required: true,
                minlength: 2,
                maxlength: 100,
            },
            phone_number: {
                minlength: 10,
                maxlength: 15,
                number: true,
            },
            email: {
                required: true,
                email: true
            },
        },
        errorPlacement: function (error, element) {
            if (element.is("select")) {
                var choicesContainer = element.closest(".choices");
                if (choicesContainer.length) {
                    error.insertAfter(choicesContainer);
                } else {
                    error.insertAfter(element);
                }
            }
            else {
                error.insertAfter(element);
            }
        },
    })

    $('#profile_credential_form').validate({
        ignore: [],
        rules: {
            user_name: {
                required: true,
                minlength: 2,
                maxlength: 100,
            },
            password: {
                minlength: 8,
                maxlength: 20,
            },
        },
        errorPlacement: function (error, element) {
            if (element.is("select")) {
                var choicesContainer = element.closest(".choices");
                if (choicesContainer.length) {
                    error.insertAfter(choicesContainer);
                } else {
                    error.insertAfter(element);
                }
            }
            else {
                error.insertAfter(element);
            }
        },
    })
});
