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
            comBubble = document.getElementById('com-zone').appendChild(clone);
            comBubble.getElementsByTagName('p')[0].innerHTML = "<b class='btn-blue'>" + login + "</b><p id='com-txt'></p>";
            comBubble.getElementsByTagName('p')[1].textContent = comment;
        }
    });
    xhr.send("idPhoto=" + idPhoto + "&comment=" + comment + "&login=" + login + "&idUser" + idUser);
}