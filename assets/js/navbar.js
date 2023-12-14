const toggleBtn = document.querySelector('.icon-bars')
const toggleBtnIcon = document.querySelector('.icon-bars i')
const Dropdown = document.querySelector('.dropdown')

toggleBtn.onclick = function (){
    Dropdown.classList.toggle('open')
    const isOpen = Dropdown.classList.contains('open')

    toggleBtnIcon.classList = isOpen
    ? 'fa-solid fa-x'
    : 'fa-solid fa-bars'
}

const NameBtn = document.querySelector('.name_session')
const DropdownMenu = document.querySelector('.menu_dropdown')
NameBtn.onclick = function (){
    DropdownMenu.classList.toggle('open')
}