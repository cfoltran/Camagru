var modalPic = document.getElementById('modalPic');
var modalUser = document.getElementById('modalUser');

const displayModalPic = (index) => {
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

const like = (idPhoto) => {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '?url=home&submit=like');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
            console.log('like');
        }
    });
    xhr.send("idPhoto=" + idPhoto);
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