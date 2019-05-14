// Set the selected filter
var filter = "http://localhost:4200/public/asset/1.png";
var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var filter = null;
var cam = true;

// Get access to the camera!
if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ 
            video: true,
            audio: false
        }).then(function(stream) {
            video.srcObject = stream;
            video.play();
    });
} else if (navigator.getUserMedia) { // Standard
    navigator.getUserMedia({ video: true }, function(stream) {
        video.src = stream;
        video.play();
    }, errBack);
} else if (navigator.webkitGetUserMedia) { // WebKit-prefixed
    navigator.webkitGetUserMedia({ video: true }, function(stream){
        video.src = window.webkitURL.createObjectURL(stream);
        video.play();
    }, errBack);
} else if (navigator.mozGetUserMedia) { // Mozilla-prefixed
    navigator.mozGetUserMedia({ video: true }, function(stream){
        video.srcObject = stream;
        video.play();
    }, errBack);
}

video.addEventListener('play', function() {
    draw(this, context, 640, 480);
}, false);

function draw(video, context, width, height) {
    if (cam && !upload)
        context.drawImage(video, 0, 0, width, height);
    if (filter)
        context.drawImage(filter, 0, 0, 1000, 1000, 0, 200, 640, 600);
    setTimeout(draw, 10, video, context, width, height);
};

var save = document.getElementById('snap-push');
var upload = false;

// Trigger photo take
document.getElementById("snap").addEventListener("click", () => {
    if (cam) {
        save.style.display = 'block';
        cam = false;
    } else {
        save.style.display = 'none';
        cam = true;
    }
});

document.getElementById("import").addEventListener("click", () => {
    if (upload) {
        document.getElementById('import-zone').style.display = 'none';
        document.getElementById('snap').style.display = 'block';
        upload = false;
    } else {
        document.getElementById('import-zone').style.display = 'block';
        document.getElementById('snap').style.display = 'none';
        upload = true;
    }
});

var imageLoader = document.getElementById('import-img');
    imageLoader.addEventListener('change', handleImage, false);

function handleImage(e) {
    var reader = new FileReader();
    reader.onload = function(event){
        var img = new Image();
        img.onload = function(){
            canvas.width = img.width;
            canvas.height = img.height;
            context.drawImage(img, 0, 0);
        }
        img.src = event.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);     
}

const setFilter = (elem) => {
    filter = elem;
}

const addPhoto = () => {
    var canvas = document.getElementById('canvas');
    var dataURL = canvas.toDataURL();
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '?url=camagru&submit=pic');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
            save.style.display = 'none';
            document.getElementById('photoInfo').textContent = "Photo correctly added to your library";
            var clone = document.getElementsByTagName('article')[0].cloneNode(true);
            clone.style.display = 'block';
            clone.getElementsByTagName('img')[0].src = "public/asset/tmp.png";
            document.getElementById('cards').prepend(clone);
            document.location.reload(true);
            cam = true;
        }
    });
    xhr.send("img=" + dataURL + "&filter=" + filter);
}

// Drop the image on click
const dropPhoto = (id_photo, index) => {
    alert(id_photo);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '?url=camagru&submit=del');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
            index.parentNode.parentNode.remove();
        }
    });
    xhr.send("idPhoto=" + id_photo);
}
