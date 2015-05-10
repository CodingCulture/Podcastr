var playing = false;
var leaveOff = false;

$(document).ready(function(){
    $('#pause').hide();
    $('#reset').hide();
    $('#forward').hide();
});

function play(){
    if(playing == false){
        soundManager.play(podcast.id, {
            onfinish: function(){
                $('#pause').hide();
                $('#play').hide();
                $('#progress').hide();
                $('#time').hide();
                $('#forward').hide();
                $('#reset').show();
                leaveOff = true;
            }
        });
        $('#play').hide();
        $('#forward').show();
        $('#pause').show();
        updateloader(podcast.id);
        playing = true;
        isAvailable(podcast.id);
    }
}

function pause(){
    podcast.pause();
    $('#pause').hide();
    $('#play').show();
    playing = false;
}

function updateloader(id){
    var check = setInterval(function(){
        if(podcast.playState != 0 && playing == true){
            var now = podcast.position;
            var complete = podcast.duration;
            if(now >= complete){
                clearInterval(check);
            }

            var nowSeconds =  moment.duration(now, 'milliseconds').seconds();
            var completeSeconds =  moment.duration(complete, 'milliseconds').seconds();
            if (nowSeconds < 10){
                nowSeconds = '0' + nowSeconds;
            }

            if (completeSeconds < 10){
                completeSeconds = '0' + completeSeconds;
            }

            $(".progress-bar").css('width', (now/complete) * 100 + '%');
            $('#time').html('<span class="orange">' + moment.duration(now, 'milliseconds').hours() + ':' + moment.duration(now, 'milliseconds').minutes() + ':' + nowSeconds + '/' + '</span>'+ moment.duration(complete, 'milliseconds').hours() + ':' + moment.duration(complete, 'milliseconds').minutes() + ':' + completeSeconds);

        } else {
            $('#pause').hide();
            if(leaveOff == false){
                $('#play').show();
            }
            clearInterval(check);
        }

    }, 500);
}


function isAvailable(){
    var x = null;
    var id = 'aSound';
    x = podcast.duration;
    if(x != null){
        $('#time').html('<span class="orange">0:00/</span>' + moment.duration(x, 'milliseconds').minutes() + ':' + moment.duration(x, 'milliseconds').seconds());
    } else {
        setTimeout(isAvailable, 100);
    }
}

function restart(){
    window.location.href = document.URL;
}

function setPosition(seconds){

    if(seconds == 'this'){
        seconds = $('#skip-time').val();
    } else {
        if(seconds.indexOf(":") !== -1){
            seconds = seconds.split(":");
        } else {
            seconds = '00:00';
        }
    }

    if(seconds.length == 2){
        var milliseconds = (seconds[0] * 60 * 1000) + (seconds[1] * 1000);
    } else {
        var milliseconds = (seconds[0] * 60* 60 * 1000) + (seconds[1] * 60 * 1000) + ( seconds[2] * 1000);
    }

    if(podcast.duration > milliseconds){
            pause();
            podcast.setPosition(milliseconds);
            play();
    }
}


function validate(){
    $('#error-text').hide();
    //Get the input
    var seconds = $('#skip-time').val();
    seconds = seconds.split(":");

    if(seconds.indexOf(":") == -1){
        $('#error-text').html('Your input is invalid');
        $('#error-text').show()
    }

    //Check if it's hours or minutes
    if(seconds.length == 2){
        var milliseconds = (seconds[0] * 60 * 1000) + (seconds[1] * 1000);
        podcast.setPosition(milliseconds);
    } else {
        var milliseconds = (seconds[0] * 60* 60 * 1000) + (seconds[1] * 60 * 1000) + ( seconds[2] * 1000);
        podcast.setPosition(milliseconds);
    }


    if(podcast.duration < milliseconds){
        $('#error-text').html('Your timepoint is beyond the length of the podcast');
        $('#error-text').show()
    }


}

function setProgress(){
    console.log("You've clicked on the progressbar");
}