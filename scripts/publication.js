const comment = (idPhoto, login, idUser) => {
    var comment = document.getElementById('comment').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '?url=publication&submit=comment');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
            var clone;
            clone = document.getElementsByClassName('comment')[1].cloneNode(true);
            clone.style.display = 'block';
            clone.innerHTML = "<p><b class='btn-blue'>" + login + "</b> " + comment + "</p>";
            document.getElementById('com-zone').appendChild(clone);
        }
    });
    xhr.send("idPhoto=" + idPhoto + "&comment=" + comment + "&login=" + login + "&idUser" + idUser);
}