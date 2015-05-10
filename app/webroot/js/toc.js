var amount = 0;

$(document).ready(function(){
    init(json)
});

function init(json){
    json = json || null;
    if(json != null){
        tocJsonToEntry(json);
    } else {
        tocAddRow();
    }
}

function tocAddRow(){
    amount++;
    var template = '<div class="row" data-id="row-' + amount +'"><div class="col-sm-3 formspaced-left"><input type="text" id="timestamp-' +  amount + '"placeholder="Timestamp" class="timestamp toc-field" onchange="tocUpdateValue()"></div><div class="col-sm-8  formspaced-left formspaced-right"><input type="text" id="subject-' +  amount + '" placeholder="Subject" class="subject toc-field" "onchange="tocUpdateValue()"></div><div class="col-sm-1 formspaced-right"><a onclick="tocDeleteRow(' + amount + ')"<span class="glyphicon glyphicon-remove"></span></a></div></div>';
    $('.toc-entries').append(template);
}

function tocDeleteRow(id){
    $(".row").find("[data-id='row-" + id + "']").remove();
    tocUpdateValue();
}

function tocDeleteAll(){
    $('.toc-entries').html('');
}

function tocUpdateValue(){
    var json = '[';

    $('.toc-entries').find(".row").each(function(index){
        var tmstmp = $(this).find('.timestamp').val();
        var subj = $(this).find('.subject').val();
        json += '{"title": "' + subj + '", "timestamp" : "' + tmstmp + '"},';
    });

    json += ']';

    var occur = json.lastIndexOf(',');
    json = json.slice(0, occur) + json.slice(occur + 1, json.length);

    console.log(json);
    $('textarea#PodcastToc').val(json);
}

function tocJsonToEntry(json){
        $('.toc-entries').html();
        amount = 0;
        var template = "";
        $.each(json, function(i, item){
            amount++;
            template += '<div class="row" data-id="row-' + amount +'"><div class="col-sm-3 formspaced-left"><input type="text" id="timestamp-' +  amount + '"placeholder="Timestamp" value="' + item.timestamp + '" class="timestamp toc-field" onchange="tocUpdateValue()" value="' + item.tmstmp + '"></div><div class="col-sm-8  formspaced-left formspaced-right"><input type="text" id="subject-' +  amount + '" placeholder="Subject" value="' + item.title + '" class="subject toc-field" "onchange="tocUpdateValue()"></div><div class="col-sm-1 formspaced-right"><a onclick="tocDeleteRow(' + amount + ')"<span class="glyphicon glyphicon-remove"></span></a></div></div>';
        });
        $('.toc-entries').append(template);
}

function tocPaste(){
    tocDeleteAll();
    $('#PodcastToc').show();
    $('#tocText').append('<a onClick="tocApplyJSONPaste()" class="btn btn-default btn-block" id="applyJson">Apply JSON</a><hr id="applyJsonRuler"/>');
    $('.toc-wrapper').hide();
}

function tocApplyJSONPaste(){
    tocJsonToEntry(JSON.parse($('#PodcastToc').val()));
    $('#PodcastToc').hide();
    $('#applyJson').remove(); $('#applyJsonRuler').remove();
    $('.toc-wrapper').show();
}