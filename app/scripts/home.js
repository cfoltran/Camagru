var modalUser = document.getElementById('modalUser');

window.onclick = (event) => {
    if (event.target == modalUser) {
        modalUser.style.display = "none";
        hide();
    }
}

const like = (idPhoto, index, loggued) => {
    if (loggued) {
        nlike = document.getElementsByClassName("fa-thumbs-up")[index];
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '?url=home&submit=like');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send("idPhoto=" + idPhoto);
        xhr.addEventListener('readystatechange', () => {
            if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                var n = parseInt(nlike.textContent) + parseInt(xhr.responseText);
                nlike.textContent = " " + n;
            }
        });
    } else {
        alert("You must be connected to like publication 😭");
    }
}