const comment = (idPhoto, login, idUser) => {
    var comment = document.getElementById('comment').value;
    if (comment) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '?url=publication&submit=comment');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.addEventListener('readystatechange', () => {
            if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                var clone;
                clone = document.getElementsByClassName('comment')[1].cloneNode(true);
                clone.style.display = 'block';
                document.getElementById('comments').prepend(clone);
                document.getElementsByClassName('comment')[2].innerHTML = "<p id='com-login'><b class='btn-blue'>"+login+"</b><p id=com-txt></p></p>";
                document.getElementById('com-txt').textContent = comment;
                document.getElementsByClassName('comment')[0].value = '';
            }
        });
        xhr.send("idPhoto=" + idPhoto + "&comment=" + comment + "&login=" + login + "&idUser" + idUser);
    }
}