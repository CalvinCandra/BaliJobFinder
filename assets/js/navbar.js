const toggleBtn = document.querySelector('.toogle')
const toggleBtnIcon = document.querySelector('.toogle i')
const Dropdown = document.querySelector('.dropdown')

toggleBtn.onclick = function (){
    Dropdown.classList.toggle('open')
    const isOpen = Dropdown.classList.contains('open')

    toggleBtnIcon.classList = isOpen
    ? 'bi bi-x'
    : 'bi bi-list'
}

const NameBtn = document.querySelector('.name_session')
const DropdownMenu = document.querySelector('.menu_dropdown')
NameBtn.onclick = function (){
    DropdownMenu.classList.toggle('open')
}