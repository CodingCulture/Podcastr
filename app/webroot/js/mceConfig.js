tinyMCE.init({
    theme : "modern",
    mode : "textareas",
    editor_selector : "mceEditor",
    convert_urls : false,
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | bullist outdent indent | link image",
    image_advtab: true,
    height: 400
});