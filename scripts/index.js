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
    getNotifSet();
}

window.onclick = (event) => {
    if (event.target == modalUser) {
        modalUser.style.display = "none";
        hide();
    }
}

const hide = () => {
    document.getElementById('setting-error').style.display = 'none';
    document.getElementById('setting-info').style.display = 'none';
    document.getElementById('update-passwd').style.display = 'none';
    document.getElementById('del-account').style.display = 'none';
    document.getElementById('update-login').style.display = 'none';
    document.getElementById('update-email').style.display = 'none';
    document.getElementById('notifications').style.display = 'none';
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
            if (xhr.response == 0) {
                document.getElementById('setting-error').textContent = "Wrong password";
                document.getElementById('setting-error').style.display = 'block';
            } else {
                document.getElementById('setting-info').textContent = "Your password has been updated";
                document.getElementById('setting-info').style.display = 'block';
                document.getElementById('setting-error').style.display = 'none';
            }
        });
        xhr.send("newPasswd=" + passwd + "&oldPasswd=" + document.getElementById('oldPasswd').value);
    } else {
        document.getElementById('setting-error').textContent = "Passwords doesn't match";
        document.getElementById('setting-error').style.display = 'block';
        document.getElementById('setting-info').style.display = 'none';
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
                document.getElementById('setting-error').style.display = 'block';
                document.getElementById('setting-error').textContent = "This login already taken or wrong format (8 max, alphanumeric)";
            } else {
                document.getElementById('setting-info').style.display = 'block';
                document.getElementById('setting-info').textContent = "Your login has been updated";
            }
        }
    });
    xhr.send("login=" + login);
}

// Get the status of notifications
const getNotifSet = () => {
    let item = document.getElementById('notifications').getElementsByTagName('button')[0];
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '?url=login&submit=getNotif');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
            if (xhr.response === '1') {
                item.className = "on";
                item.textContent = "NOTIFICATIONS ENABLE";
            } else {
                item.className = "off"
                item.textContent = "NOTIFICATIONS DISABLE";
            }
        }
    });
    xhr.send(null);
}

// Switch the notifications state
const setNotifSet = () => {
    let item = document.getElementById('notifications').getElementsByTagName('button')[0];
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '?url=login&submit=setNotif');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    if (item.className === "off") {
        notif = 1;
        item.className = "on";
        item.textContent = "NOTIFICATIONS ENABLE";
    } else {
        notif = 0;
        item.className = "off";
        item.textContent = "NOTIFICATIONS DISABLE";
    }
    xhr.send("notif=" + notif);
}