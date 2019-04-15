<script>
$( document ).ready(function() {

    // An element to play the speech from Google Cloud
    var Sound = (function () {

        var df = document.createDocumentFragment();

        return function Sound(src) {

            var snd = new Audio(src);
            df.appendChild(snd); // keep in fragment until finished playing
            snd.addEventListener('ended', function () {df.removeChild(snd);});
            snd.play();
            return snd;
        }

    }());

    // The settings for the Ajax Request
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://texttospeech.googleapis.com/v1/text:synthesize",
        "method": "POST",
        "headers": {
            "x-goog-api-key": "AIzaSyDpCeA3TkyK4tGxjbKnQWVcXaA3C6SgULM",
            "content-type": "application/json",
            "cache-control": "no-cache",
        },
        "processData": false,
        "data": {'input':{'text':'I have added the event to your calendar.'},
        'voice':{'languageCode':'en-gb','name':'en-GB-Standard-A','ssmlGender':'FEMALE'},'audioConfig':{'audioEncoding':'MP3' }}
    }

    // The Ajax Request, on success play the speech
    $.ajax(settings).done(function (response) {
    	alert(7)
      console.log(response.audioContent);
      var snd = Sound("data:audio/wav;base64," + response.audioContent);
    });
alert(3)
});
</script>