function openMvTab(evt, tabName){
  
  let tabs = document.getElementsByClassName("mv-tabcontent");
  let tabContent = document.getElementById(tabName);
  
  let tabLinks = document.querySelectorAll(".mv-content-btns h4");
  for(let i=0; i<tabs.length; i++){
    tabs[i].classList.remove("active");
  }
  for(let i=0; i<tabLinks.length; i++){
    tabLinks[i].classList.remove("active");
  }
  
  
  tabContent.classList.add("active");
  evt.currentTarget.classList.add('active');
  
}
document.getElementById("default-tab").click();
