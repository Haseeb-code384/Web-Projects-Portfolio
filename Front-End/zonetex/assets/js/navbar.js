
// Menu Btn Clicking and Showing the menu Bar
let menuBtn = document.querySelector('.toggle-btn');
let menu = document.querySelector('.main-menu');

menuBtn.addEventListener('click', function(){
  menuBtn.classList.toggle('cross');
  
  if(menu.style.display!== 'block'){
    menu.style.display = `block`;
  }else{
    menu.style.display = 'none';
  }
})

// Active Links ColorCheck
let activePage = window.location.pathname;

let navLinks = document.querySelectorAll('.main-menu>ul>li>a');
let homenavLink =document.querySelector('.main-menu>ul>li>a:nth-child(1)');
navLinks.forEach(function(link){
  if(activePage==='/zonetex/'){
    homenavLink.classList.add('activelink');
  }
  else if(link.href.includes(`${activePage}`)){
    link.classList.add('activelink');
  }
  
})
let preLoader = document.getElementById('preloader');
window.addEventListener('load', function(){
  preLoader.style.display = 'none';
})
window.addEventListener('scroll', revealShow)


function revealShow(){
  let revealSection = document.querySelectorAll('.reveal');

revealSection.forEach((item)=>{
  let rect = item.getBoundingClientRect();
  // console.log(window.innerHeight);
  if(rect.top < window.innerHeight && rect.bottom > 0){
    item.classList.add('show');
  }
})
}

revealShow();

let navBar = document.querySelector('.nav-bar');

window.addEventListener('scroll', function(){
  if(window.scrollY>=navBar.offsetHeight){
    navBar.classList.add('fixed');
  }else{
    navBar.classList.remove('fixed');
  }
})