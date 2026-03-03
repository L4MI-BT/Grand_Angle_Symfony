const sideMenu = document.getElementById('sideMenu');
const burgerBtn = document.getElementById('burgerBtn');
const overlay = document.getElementById('overlay');
const submenu = document.getElementById('submenu');
const visiterItem = document.getElementById('visiterItem');

function openMenu() {
    sideMenu.classList.add('open');
    burgerBtn.classList.add('open');
    overlay.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeMenu() {
    sideMenu.classList.remove('open');
    burgerBtn.classList.remove('open');
    overlay.classList.remove('show');
    document.body.style.overflow = '';
}

overlay.addEventListener('click', closeMenu)

burgerBtn.addEventListener('click', ()=>{
      sideMenu.classList.contains('open') ? closeMenu() : openMenu();
})
 
  
visiterItem.addEventListener('click', ()=>{
    submenu.classList.toggle('open');
    visiterItem.classList.toggle('expanded');
})


