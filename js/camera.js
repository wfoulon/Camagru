    let streaming = false,
        video = document.querySelector('#video'),
        cover = document.querySelector('#cover'),
        canvas = document.querySelector('#canvas'),
        startbutton = document.querySelector('#startbutton'),
        retry = document.getElementById("deletesnap"),
        save = document.querySelector("#save"),
        upload = document.getElementById('subFile'),
        input = document.getElementById('namePic'),
        regname = new RegExp('^[a-zA-Z0-9]+([a-zA-Z0-9](_|-| )[a-zA-Z0-9])*[a-zA-Z0-9]+$')
        constraints = {
            audio: false,
            video: true,
        }
    retry.addEventListener("click", function(e) {e.preventDefault; retryYolo()})
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
            streaming = true;   
        }
    }, false);

    // Secure the name of the picture with a regex
    input.addEventListener('keyup', function(){if (this.value.length !== 0 && regname.test(this.value)) {save.style.cursor = 'pointer'; input.style.borderColor = 'rgb(238, 238, 238)';} else {save.style.cursor = 'not-allowed';}})

    //function retry picture
    function retryYolo() {
        canvas.style.display = "none";
        video.style.display = "block";
    }

    function takepicture() {
        if (document.getElementById("canvas").style.display === "none") {
            canvas.width = 500;
            canvas.height = 380;
            canvas.getContext('2d').drawImage(video, 0, 0, 500, 380);
            canvas.style.display = "block";
            video.style.display = "none"
        }
    }
    
    //Save picture with mask
    function savepicture() {
        if (input.value.length !== 0 && regname.test(input.value)) {
            if (canvas.style.display === 'block') {
                let data = canvas.toDataURL('image/png'),
                    videoMasks = document.querySelectorAll(".VideoMask"),
                    name = document.getElementById('namePic').value,
                    mask = {};
                for (let i = 0; i < videoMasks.length; i++) {
                        mask[i] = videoMasks[i].style.display;
                }
                mask = JSON.stringify(mask)
                let xhr = new XMLHttpRequest();
                // Call a function when the state changes
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                        // Request finished. Doing process here
                        let resp = xhr.responseText;
                        if (resp != '0' && resp != '1') {
                            let div = document.createElement('div')
                            let img = document.createElement('img')
                            div.className = 'min';
                            img.src = 'pictures/' + resp
                            div.appendChild(img)
                            let main = document.getElementsByClassName('flex-box')
                            main[0].appendChild(div)
                        }
                        if (resp === '0') {
                            let name = document.getElementById('save-all')
                            let span = document.getElementById('selectMask')
                            if (!span)
                                name.innerHTML += "<br /><span id='selectMask'><strong>Please select at least one mask !!!!!!!!!!!!!</strong></span>"
                        }
                        if (resp === '1') {
                            input.style.borderColor = 'red';
                        }
                    }
                };
                xhr.open('POST', "script/savepic.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("img=" + data + "&all=" + mask + "&name=" + name);
            }
        }
        else
         input.style.borderColor = 'red';
    }

/*     function removepicture() {
        let  canvas = document.querySelector('#canvas'),
        video = document.getElementById('video');
        canvas.style.display = "none";
        video.style.display = "block";
    }; */

    // Event takepicture
    startbutton.addEventListener('click', function(ev) {
        takepicture();
        save.disabled = false;
        ev.preventDefault();
    }, false);

// Mask

//Event on click Mask
let allMask = document.querySelectorAll(".collage-items div img")
for(let i = 0; i <  allMask.length; i++) {
    allMask[i].addEventListener("click", function(e){e.preventDefault; printMask(i)})
}

//Display Mask Dynamic mode
function printMask(i) {
    let videoMasks = document.querySelectorAll(".VideoMask")
    if (videoMasks[i].style.display === 'none') {
        videoMasks[i].id = i;
        videoMasks[i].style.display = 'block';
    }
    else {
        videoMasks[i].id = '';
        videoMasks[i].style.display = 'none';
    }
}

// End mask

//Subfile with drag and drop

function dropHandler(ev) {
	ev.preventDefault();
	if (canvas.style.display === 'none') {
        let canvas = document.querySelector('#canvas'),
        startbutton = document.getElementById('startbutton');
		let data = ev.dataTransfer.items;
		for (let i = 0; i < data.length; i += 1) {
		if ((data[i].kind == 'file') && (data[i].type.match('^image/'))) {
			let f = data[i].getAsFile();
			let widthCan = 500,
			video = document.querySelector('#video'),
			heightCan = 380;
			canvas.width = widthCan;
			canvas.height = heightCan;
			canvas.renderImage(f);
			startbutton.click();
			canvas.style.display = "block"
			video.style.display = "none"
		}
		}
		removeDragData(ev)
	}
}
function dragOverHandler(ev) {
    ev.preventDefault();
}
function removeDragData(ev) {
	if (ev.dataTransfer.items) {
		ev.dataTransfer.items.clear();
	} else {
		ev.dataTransfer.clearData();
	}
	}

	HTMLCanvasElement.prototype.renderImage = function(blob){
	let ctx = this.getContext('2d');
	let img = new Image();
	img.src = URL.createObjectURL(blob);
	img.onload = function(){
		ctx.drawImage(img, 0, 0, 500, 380)
	}
};

//end Subfile
