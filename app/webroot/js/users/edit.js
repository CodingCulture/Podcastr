$(document).ready(function(){
    var author = $('#UserAuthorId').val();
    if(author != 0){
        $('#image-' + author).css('opacity', '0.8');
    }
});