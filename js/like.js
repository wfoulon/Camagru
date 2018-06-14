let like = document.getElementById('like'),
    span = document.getElementById('likeSpan'),
    send = document.getElementById('send-com'),
    textCom = document.getElementById('text-com')

if (like) {
    // Event onclick on #like
    like.addEventListener('click', () => {doLike()})
}

let doLike = () => {
    let id = like.getAttribute("value");
    let xhr = new XMLHttpRequest();
    // Call a function when the state changes
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            // Request finished. Doing process here 
            let resp = xhr.responseText;
            resp = parseInt(resp)
            if (Number.isInteger(resp)) {
                span.innerText = resp;
            }
        }
    };
    xhr.open('POST', "script/like.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('like=' + id);
}

if (send && textCom) {
    send.addEventListener('click', () => {sendComment()})
}

let sendComment = () => {
    let txt = textCom.value,
        id = like.getAttribute("value");
    if (txt.length !== 0) {
        let xhr = new XMLHttpRequest();
        // Call a function when the state changes
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                // Request finished. Doing process here 
                let resp = xhr.responseText;
                console.log(resp)
                if (resp !== 'ERROR!') {
                    resp = JSON.parse(resp);
                    let div = document.createElement('div')
                    div.className = 'com-content'
                    let span1 = document.createElement('span')
                    span1.innerText = resp['user']
                    let br = document.createElement('br'),
                        br2 = document.createElement('br')
                    let span2 = document.createElement('span')
                    span2.innerText = resp['com']
                    div.appendChild(span1)
                    span1.after(br)
                    br.after(span2)
                    span2.after(br2)
                    let main = document.getElementById('form-content');
                    let nbcom = document.getElementById('nbcom');
                    main.after(div)
                    nbcom.innerText = resp['nb']
                    textCom.value = '';
                }
            }
        };
        xhr.open('POST', "script/like.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send('comment=' + txt + '&id=' + id);
    }
}
