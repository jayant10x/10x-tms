// resources/js/plugins/filepond.js

let filePondPromise;

async function getFilePond() {
    if (!filePondPromise) {
        filePondPromise = Promise.all([
            import('filepond'),
            import('filepond-plugin-image-preview'),
            import('filepond-plugin-image-crop'),
            import('filepond-plugin-image-resize'),
            import('filepond-plugin-file-validate-type'),
            import('filepond-plugin-file-validate-size'),
        ]).then(([
                     filepond,
                     imagePreview,
                     imageCrop,
                     imageResize,
                     validateType,
                     validateSize,
                 ]) => {
            filepond.registerPlugin(
                imagePreview.default,
                imageCrop.default,
                imageResize.default,
                validateType.default,
                validateSize.default
            );

            return filepond;
        });
    }

    return filePondPromise;
}

export async function initFilePond(element, options = {}) {
    const {create} = await getFilePond();

    const pond = create(element, {
        allowMultiple: false,
        storeAsFile: true,
        acceptedFileTypes: ['image/jpeg', 'image/png', 'image/jpg'],
        maxFileSize: '2MB',

        // Settings to enable file replacement without allowing removal
        allowBrowse: true,
        allowReplace: true,
        allowRemove: true,
        allowRevert: true,

        ...options,
    });

    // Directly bind a native click listener to the root container
    // This maintains direct user activation required by the browser
    if (pond.element) {
        pond.element.addEventListener('click', (e) => {
            // Only trigger browse if a file already exists and user clicked the preview
            if (pond.getFiles().length > 0) {
                const isRemoveButton = e.target.closest('.filepond--action-remove-item');
                if (!isRemoveButton) {
                    pond.browse();
                }
            }
        });
    }

    return pond;
}
