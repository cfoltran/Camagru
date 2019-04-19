const menu = () => {
    var x = document.getElementById("menu");
    if (x.className === "nav-menu") {
        x.className += "responsive";
    } else {
        x.className = "nav-menu";
    }
}
var modalUser = document.getElementById('modalUser');

// Display the good interfaces
const displayModalUser = () => {
    modalUser.style.display = "block";
}

window.onclick = (event) => {
    if (event.target == modalUser) {
        modalUser.style.display = "none";
        hide();
    }
    if (event.target == modalPic) {
        modalPic.style.display = "none";
    }
}

const hide = () => {
    document.getElementById('update-passwd').style.display = 'none';
    document.getElementById('del-account').style.display = 'none';
    document.getElementById('update-login').style.display = 'none';
    document.getElementById('update-email').style.display = 'none';
}

const displayForm = (name) => {
    hide();
    document.getElementById(name).style.display = 'block';
}

const checks = () => {
    if (document.getElementById('newPasswd1').value === document.getElementById('newPasswd2').value)
        return (true);
    else
        return (false)
}

// Let's update the password using AJAX
const updatePasswd = () => {
    const passwd = document.getElementById('newPasswd1').value;
    if (checks() === true) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '?url=login&submit=updatePasswd');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.addEventListener('readystatechange', () => {
            if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                document.getElementById('setting-info').textContent = "Your password has been updated";
            }
        });
        xhr.send("newPasswd=" + passwd + "&oldPasswd=" + document.getElementById('oldPasswd').value);
    } else {
        document.getElementById('setting-error').textContent = "Passwords doesn't match";
    }
}

// Let's update the login
const updateLogin = () => {
    const login = document.getElementById('login').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '?url=login&submit=updateLogin');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
            if (xhr.response == 1) {
                document.getElementById('setting-error').textContent = "This login already taken";
            } else {
                document.getElementById('setting-info').textContent = "Your login has been updated";
            }
        }
    });
    xhr.send("login=" + login);
}