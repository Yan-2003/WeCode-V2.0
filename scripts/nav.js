const icon1 = document.querySelector('.icon--btn1');
const icon2 = document.querySelector('.icon--btn2');
const icon3 = document.querySelector('.icon--btn3');

const leaderboard = document.querySelector('.leaderboard');
const home = document.querySelector('.home');
const profile = document.querySelector('.profile');


function btn1(){
    profile.classList.add('active');
    home.classList.add('active');
    leaderboard.classList.remove('active');
    icon1.classList.add('active');
    icon2.classList.remove('active');
    icon3.classList.remove('active');
}
function btn2(){
    profile.classList.add('active');
    home.classList.remove('active');
    leaderboard.classList.add('active');
    icon1.classList.remove('active');
    icon2.classList.add('active');
    icon3.classList.remove('active');
}
function btn3(){
    profile.classList.remove('active');
    home.classList.add('active');
    leaderboard.classList.add('active');
    icon1.classList.remove('active');
    icon2.classList.remove('active');
    icon3.classList.add('active');
}

///currently not used.