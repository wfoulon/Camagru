/* function loadMedia(){ */
    let streaming = false,
        video = document.querySelector('#video'),
        cover = document.querySelector('#cover'),
        canvas = document.querySelector('#canvas'),
        startbutton = document.querySelector('#startbutton'),
        retry = document.getElementById("#deletesnap"),
        save = document.querySelector("#save"),

        constraints = {
            audio: false,
            video: true,
        }
/*     var event = document.createEvent("MouseEvents");
    event.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null); */
    navigator.mediaDevices.getUserMedia(constraints)
    .then(function(mediastream) {
        video.srcObject = mediastream;
        video.play();
    })
    .catch(function(err) {
        console.log(err.name + ":" + err.message);
    })
    video.addEventListener('canplay', function(ev) {
        if (!streaming) {
/*             height = video.videoHeight / (video.videoWidth / width);
            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height); */
            streaming = true;   
        }
    }, false);

    function takepicture() {
        if (document.getElementById("canvas").style.display === "none") {
/*             let widthCan = document.getElementById("video").offsetWidth;
            let heightCan = document.getElementById("video").offsetheight; */
            canvas.width = 500;
            canvas.height = 375;
            canvas.getContext('2d').drawImage(video, 0, 0, 500, 375);
            canvas.style.display = "block";
            video.style.display = "none"
        }
    }

    function removepicture() {
        canvas.style.diplay = "none";
        video.style.display = "block";
    };
    
/*     cross.addEventListener('click', function(ev) {
        removepicture();
        save.disabled = true;
        ev.preventDefault();
    }, false); */

    startbutton.addEventListener('click', function(ev) {
        takepicture();
        save.disabled = false;
        ev.preventDefault();
    }, false);

/*     retry.addEventListener("click", function (ev) {
        cross.click();
        ev.preventDefault();
    }, false); */
/*     startbutton.dispatchEvent(event);
    cross.dispatchEvent(event); */
//};
