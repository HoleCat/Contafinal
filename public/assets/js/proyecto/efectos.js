document.querySelector("body").classList.replace('bg-general','bg-general-modulos');

function sidebar(id) {
    let sidebar = document.querySelector(id);
    if(sidebar.classList.contains('side-bar-show')){
        sidebar.classList.remove('side-bar-show');
        sidebar.classList.add('side-bar-hide');
        sidebar.style.width = "0px";
    } else {
        sidebar.classList.add('side-bar-show');
        sidebar.classList.remove('side-bar-hide');
        sidebar.style.width = "160px";
    }
}

function optionsbar(id) {
    let optionsbar = document.querySelector(id);
    if(optionsbar.classList.contains('options-bar-show')){
        optionsbar.classList.remove('options-bar-show');
        optionsbar.classList.add('options-bar-hide');
        optionsbar.style.width = "0px";
    } else {
        optionsbar.classList.add('options-bar-show');
        optionsbar.classList.remove('options-bar-hide');
        optionsbar.style.width = "40px";
    }
}