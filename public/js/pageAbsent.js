const back = document.querySelector("#back");
const cameraZone = document.querySelector("#cameraZone")
const resultZone = document.querySelector("#resultZone");
const locationInput = document.querySelector("#location_input");

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
}

function showPosition(position) {
    locationInput.setAttribute("value" , `${position.coords.latitude}&${position.coords.longitude}`);
}

function openCam()
{
    Webcam.set({
        width: 420,
        height: 340,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach( '#camera' );
}

function toggleHidden(){
    cameraZone.classList.toggle("hidden");
    resultZone.classList.toggle("hidden");
}

function take_snapshot() {
    toggleHidden()

    Webcam.snap( function(data_uri) {
        console.log(data_uri)
        $("#image_tag").val(data_uri);
        document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
    } );

    const video = document.querySelector('video');

    const mediaStream = video.srcObject;

    const tracks = mediaStream.getTracks();

    tracks[0].stop();

    tracks.forEach(track => track.stop())

    document.removeEventListener("keyup", spaceKeyListener);
}

const spaceKeyListener = function(e){
    if(e.key == " " || e.code == "Space" || e.keyCode == 32 ){
        take_snapshot();
    }
}

restart.addEventListener("click" , function(){
    toggleHidden();
    openCam();

    document.addEventListener("keyup", spaceKeyListener);

})

back.addEventListener("click" , function(){
    window.history.back()
});

document.addEventListener("keyup" , spaceKeyListener);
