let like = document.getElementById('like'),
    span = document.getElementById('likeSpan')

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
