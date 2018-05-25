/* (function () {
    var streaming = false,
        video = document.querySelector('#video'),
        cover = document.querySelector('#cover'),
        canvas = document.querySelector('#canvas'),
        photo = document.querySelector('#photo'),
        startbutton = document.querySelector('#startbutton'),
        width = 700;
        height = 550;
        
/*    navigator.getMedia = (navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia);
    navigator.getMedia(
        {
            video: true,
            audio: false
        },
        function (stream) {
            // if (navigator.mozGetUserMedia) {
            //     video.mozSrcObject = stream;
            // } else {
                var vendorURL = window.URL || window.webkitURL;
                video.src = vendorURL.createObjectURL(stream);
            // }
            video.play();
        },
        function (err) {
            console.log("An error occured! " + err);
        }
    );
    video.addEventListener('canplay', function (ev) {
        if (!streaming) {
            height = video.videoHeight / (video.videoWidth / width);
            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            streaming = true;
        }
    }, false); */

/*     function takepicture() {
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        var data = canvas.toDataURL('image/png');
        photo.setAttribute('src', data);
    }
    startbutton.addEventListener('click', function (ev) {
        takepicture();
        ev.preventDefault();
    }, false);
}) (); */

/* let img = document.getElementById("imageTaken");

(function () {
    'use strict';
    var video = document.querySelector('video')
        , canvas;

    function takeSnapshot() {
        // var img = document.querySelector('pict') || document.createElement('pict');
        var context;
        var width = video.offsetWidth
            , height = video.offsetHeight;
        canvas = canvas || document.createElement('canvas');
        
        canvas.width = width;
        canvas.height = height;

        context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, width, height);

        img.src = canvas.toDataURL('image/png');
        img.style.display = "block";
        video.style.display = "none";
        // document.body.appendChild(img);
    }
    if (navigator.mediaDevices) {
        // access the web cam:
        navigator.mediaDevices.getUserMedia({ video: true })
            // permission granted:
            .then(function (stream) {
                video.src = window.URL.createObjectURL(stream);
                //video.addEventListener('click', takeSnapshot);
            })
            // permission denied:
            .catch(function (error) {
                document.body.textContent = 'Could not access the camera. Error: ' + error.name;
            });
    }
    startbutton.addEventListener('click', function (ev) {
        takeSnapshot();
        ev.preventDefault();
    }, false);
})(); */

//References to all the element we will need
var video = document.querySelector('#camera-stream'),
    image = document.querySelector('#snap'),
    start_camera = document.querySelector('#start-camera'),
    controls = document.querySelector('.controls'),
    take_photo_btn = document.querySelector('#take-photo'),
    delete_photo_btn = document.querySelector('#delete-photo'),
    download_photo_btn = document.querySelector('#download-photo'),
    error_message = document.querySelector('#error-message');

//The getUserMedia interface is used for handling camera input
//Some browsers need a prefix so here we're covering all the options
navigator.getMedia = (
    navigator.getUserMedia ||
    navigator.webkitGetuserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia);

if (!navigator.getMedia){
    displayErrorMessage("Your browser doesn't have support for the navigator.getUserMedia interface.");
}
else {
    //Request the camera.
    navigator.getMedia(
        {
            video: true,
            audio: false,
        },
        //Success Callback
        function(stream){
            //Create an object URL for the video stream and
            //set it as src of our HTML video element
            video.src = window.URL.createObjectURL(stream);

            //Play the video element to start the stream
            video.play();
            video.onplay = function() {
                showVideo();
            };
        },
        // Error Callback
        function(err){
            displayErrorMessage("An error occured with accessing the camera stream:" + err.name, err);
        }
    );
}

// Mobile browsers cannot play video without user input
// Using a button to start it manually
start_camera.addEventListener('click', function(e){
    e.preventDefault();

    // Start video playback manually
    video.play();
    showVideo();
});

take_photo_btn.addEventListener('click', function(e){
    e.preventDefault();

    var snap = takeSnapshot();

    // Show image
    image.setAttribute('src', snap);
    image.classList.add("visible");

    //Enable delete and save buttons
    delete_photo_btn.classList.remove("disabled");
    download_photo_btn.classList.remove("disabled");

    // Set the href attribute of the download button to the snap url
    download_photo_btn.href = snap;
    
    // Pause video playback of stream
    video.pause();
});

delete_photo_btn.addEventListener('click', function(e){
    e.preventDefault();

    // Hide image
    image.setAttribute('src', "");
    image.classList.remove("visible");

    // Disabled delte and save buttons
    delete_photo_btn.classList.add("disabled");
    download_photo_btn.classList.add("disabled");

    // Resume playback of stream
    video.play();
});

function showVideo(){
    // Display the video stream
    hideUI();
    video.classList.add("visible");
    controls.classList.add("visible");
}

function takeSnapshot(){
    // Little trick that involves a hidden canvas element
    var hidden_canvas = document.querySelector('canvas'),
        video = document.querySelector('video.camera_stream'),
        image = document.querySelector('img.photo'),

        // Get the exact size of the video element
        width = 640,
        height = 480,

        // Context object for working with the canvas
        context = hidden_canvas.getContext('2d');

    // Set the canvas to the same dimensions as the video
    hidden_canvas.width = 640;
    hidden_canvas.height = 480;

    // Draw a copy of the current frame from the video on the canvas
    context.drawImage(video, 0, 0, 640, 480);

    // Get an image dataURL from the canvas
    var imageDataURL = hidden_canvas.toDataURL('image/png');

    // Set the href attribute of the download button
    document.querySelector('#startbutton').href = imageDataURL;

    // Set the attribute as source of an image element, showing the captured photo
    image.setAttribute('src', imageDataURL);
}

function displayErrorMessage(error_msg, error){
    error = error || "";
    if (error){
        console.log(error);
    }
    error_message.innerHTML = error_msg;
    hideUI();
    error_message.classList.add("visible");
}

function hideUI(){
    controls.classList.remove("visible");
    start_camera.classList.remove("visible");
    video.classList.remove("visible");
    snap.classList.remove("visible");
    error_message.classList.remove("visible");
}
