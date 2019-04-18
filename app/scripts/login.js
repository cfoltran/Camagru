const toggleForm = () => {
    document.getElementById('email').style.display = 'block';
    document.getElementById('reset').style.display = 'block';
}

// Let's save our user
const resetPasswd = () => {
    var email = document.getElementById('email').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '?url=login&submit=resetPasswd');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
            if (xhr.response == 0)
                alert("Please check your mail box 💌");
            else
                alert("This email doesn't exists 😭");
        }
    });
    xhr.send("email=" + email);
}