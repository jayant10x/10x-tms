import $ from 'jquery';

document.addEventListener('DOMContentLoaded', async () => {
    const inputElement = document.querySelector('#profile_photo');
    let existingPhoto= window.loggedInEmployeeData?.emp_photo != null;

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
