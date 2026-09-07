/*
Template Name: Ubold - Responsive Bootstrap 5 Admin Dashboard
Author: Techzaa
File: Quilljs init js
*/
import Quill from 'quill';

// Import Quill theme styles (Snow or Bubble depending on what your template uses)
import 'quill/dist/quill.snow.css';
import 'quill/dist/quill.bubble.css';

// Attach Quill to the window object so inline page scripts can access it
window.Quill = Quill;

// Snow theme
var ele = document.getElementById('snow-editor')
if (ele) {
    var quill = new Quill(ele, {
        theme: 'snow',
        modules: {
            'toolbar': [[{'font': []}, {'size': []}], ['bold', 'italic', 'underline', 'strike'], [{'color': []}, {'background': []}], [{'script': 'super'}, {'script': 'sub'}], [{'header': [false, 1, 2, 3, 4, 5, 6]}, 'blockquote', 'code-block'], [{'list': 'ordered'}, {'list': 'bullet'}, {'indent': '-1'}, {'indent': '+1'}], ['direction', {'align': []}], ['link', 'image', 'video'], ['clean']]
        },
    });
}

// Bubble theme
var ele = document.getElementById('bubble-editor')
if (ele) {
    var quill = new Quill(ele, {
        theme: 'bubble'
    });
}
