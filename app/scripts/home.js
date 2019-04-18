var modalPic = document.getElementById('modalPic');
var modalUser = document.getElementById('modalUser');
var selected = null;

const displayModalPic = (index) => {
    selected = index;
    modalPic.style.display = "block";
    var modalImg = document.querySelectorAll('img')[index].src;
    document.getElementById('modal-img').src = modalImg;
}

window.onclick = (event) => {
    if (event.target == modalPic) {
        modalPic.style.display = "none";
    }
    if (event.target == modalUser) {
        modalUser.style.display = "none";
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

const comment = (idPhoto) => {
    var comment = document.getElementById('comment').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '?url=home&submit=comment');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
            console.log('comment');
        }
    });
    xhr.send("idPhoto=" + idPhoto + "&comment=" + comment);
}