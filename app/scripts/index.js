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

const displayUpdatePasswd = () => {
    document.getElementById('del-account').style.display = 'none';
    document.getElementById('update-passwd').style.display = 'block';
}

const displayDelAccount = () => {
    document.getElementById('update-passwd').style.display = 'none';
    document.getElementById('del-account').style.display = 'block';
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
        xhr.open('POST', '?url=login&submit=update');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.addEventListener('readystatechange', () => {
            if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                document.getElementsByClassName('info')[0].textContent = "Your password has been updated";
            }
        });
        xhr.send("newPasswd=" + passwd + "&oldPasswd=" + document.getElementById('oldPasswd').value);
    } else {
        document.getElementsByClassName('error')[0].textContent = "Passwords doesn't match";
    }
}