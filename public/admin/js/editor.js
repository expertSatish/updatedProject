function UploadImage(files, editor, welEditable){
    data = new FormData();
    data.append("file", files);
    data.append("_token", XCSRF_Token);
    $.ajax({
        data: data,
        type: "POST",
        url: EditorImageUpload ,
        dataType:"Json",
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            $('#summernote').summernote('editor.insertImage', data.url);
        }
    });
}