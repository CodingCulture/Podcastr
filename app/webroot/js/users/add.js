function setAuthor(id){

    //Remove everything of styling
    $('.img-circle').each(function(i,e){
        $('#' + e.id).removeAttr('style');
    });

    //Set the id of the hidden field
    $('#author_id').val(id);

    //Give the user visual feedback
    $('#image-' + id).css('opacity', '0.8');

}