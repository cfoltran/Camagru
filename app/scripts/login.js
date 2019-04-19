var error = document.getElementById('login-error');
var info = document.getElementById('login-info');

const hide = () => {
    error.style.display = 'none';
    info.style.display = 'none';
}

const toggleForm = () => {
    document.getElementById('email').style.display = 'block';
    document.getElementById('reset').style.display = 'block';
}

// Let's save our user
const resetPasswd = () => {
    hide();
    var email = document.getElementById('email').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '?url=login&submit=resetPasswd');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
            if (xhr.response == 0) {
                info.style.display = 'block';
                info.textContent = "Please check your mail box";
            } else {
                error.style.display = 'block';
                error.textContent = "This email doesn't exists";
            }
        }
    });
    xhr.send("email=" + email);
}