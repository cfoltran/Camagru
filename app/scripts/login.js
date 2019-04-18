const toggleForm = () => {
    document.getElementById('email').style.display = 'block';
    document.getElementById('reset').style.display = 'block';
}

// Let's save our user
// const resetPasswd = () => {
//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', '?url=login&submit=resetPasswd');
//     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
//     xhr.addEventListener('readystatechange', () => {
//         if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
//             document.getElementsByClassName('info').textContent = "Check your mailbox";
//         }
//     });
//     xhr.send(null);
// }