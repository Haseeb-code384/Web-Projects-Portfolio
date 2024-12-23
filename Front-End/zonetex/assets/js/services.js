// let path = window.location.href;
//  let splitter = path.split('?')
//  let pathClass= splitter[splitter.length-1];
//  let btn = document.querySelector(`.service-container .services-box .service-links .${pathClass}`);
//  console.log(btn);
//  btn.classList.add('active-service');


window.addEventListener('load', ()=>{
  let path = window.location.href;
  
  if(path.includes('?')){
    let splitter = path.split('?');
    let pathClass= splitter[splitter.length-1];
    let btn = document.querySelector(`.service-container .services-box .service-links .${pathClass}`);
    btn.click();
  }else{
    let srvLink = document.getElementById('defaultService');
    srvLink.click();
  }
  
  
})

 function openContent(evt, srvId){
  let srvtabs  = document.querySelectorAll(".service-container .services-box .content-box");
  let srvLinks = document.querySelectorAll(".service-container .services-box .service-links button");
  let srvContent = document.getElementById(srvId);

  let pathLink = window.location.href;

  for(let i=0; i<srvtabs.length; i++){
    srvtabs[i].classList.remove('active-content');
  }
  for(let i=0; i<srvLinks.length; i++){
    srvLinks[i].classList.remove('active-service');
  }
  srvContent.classList.add('active-content');
  evt.currentTarget.classList.add('active-service');
 }