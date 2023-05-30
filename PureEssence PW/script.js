let navbar = document.querySelector('.header .flex .navbar');
let userBox = document.querySelector('.header .flex .account-box');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    userBox.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
    userBox.classList.toggle('active');
    navbar.classList.remove('active');
}

window.onscroll = () => {
    navbar.classList.remove('active');
    userBox.classList.remove('active');
}

let slides = document.querySelectorAll('.home .slide');
let index = 0;

function next(){
    slides[index].classList.remove('active');
    index = (index + 1) % slides.length;
    slides[index].classList.add('active');
}

function prev(){
    slides[index].classList.remove('active');
    index = (index - 1 + slides.length) % slides.length;
    slides[index].classList.add('active');
}

var searchBox = document.querySelectorAll('.search-box input[type="text"] + span');

searchBox.forEach((elm) => {
    elm.addEventListener('click', () => {
        elm.previousElementSibling.value = '';
    });
});