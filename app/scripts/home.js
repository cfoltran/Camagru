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