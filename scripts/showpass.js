const img1 = document.querySelector('.lock1');
const img2 = document.querySelector('.lock2');

function show1(){
    img1.classList.toggle('active');
    var x = document.getElementById("cpassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function show2(){
    img2.classList.toggle('active');
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}