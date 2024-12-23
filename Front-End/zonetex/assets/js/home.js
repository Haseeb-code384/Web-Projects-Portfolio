
const banner= document.querySelector('.hero-banner');
let slideHero = document.querySelectorAll('.slide-hero');
let slidetotal = slideHero.length;
let currentIndex = 0;

function showNextSlide(){
  slideHero[currentIndex].classList.remove('hero-active');
  currentIndex = (currentIndex + 1) % slidetotal;
  slideHero[currentIndex].classList.add('hero-active');
}

setInterval(showNextSlide, 5000);


const clientLogo = document.querySelector('.clients-logo');
const logoContainer = document.querySelector('.clients-logo .logo-container');
const logoItems = document.querySelectorAll('.clients-logo .logo-container img');
let logoTotal = logoItems.length;
let logoWidth = 140;
let logoIndex = 0;
let startX = 0;
let currentTranslate = 0;



for(let i=0; i<7; i++){
  let clone = logoItems[i].cloneNode(true);
  logoContainer.appendChild(clone);
  
}
function showNextLogo(){
  logoIndex++;
  
  logoContainer.style.transform = `translateX(${logoIndex * -logoWidth}px)`;


  if (logoIndex === logoTotal) {
    setTimeout(() => {
      logoContainer.style.transition = 'none'; // Temporarily disable the transition
      logoContainer.style.transform = `translateX(0px)`; // Instantly move to the start
      logoIndex = 0; // Reset the index
      setTimeout(() => {
        logoContainer.style.transition = 'transform 1s ease-in-out'; // Re-enable transition after reset
      }, 150); // Add a small delay before re-enabling the transition
    }, 1000); // Allow enough time for the last sliding transition
  }


}

setInterval(showNextLogo, 3000);

