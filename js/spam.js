let spam = document.getElementById('spam')
spam.onchange = function () {
    let val = spam.checked === true ? '1' : '0';
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            // Request finished. Doing process here 
            let resp = xhr.responseText;
        }
    };
    xhr.open('POST', "script/nospam.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('spam=' + val);
}
