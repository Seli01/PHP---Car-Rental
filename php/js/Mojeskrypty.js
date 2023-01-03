function smoothScroll(element){
    document.querySelector(element).scrollIntoView({
        behavior: 'smooth'
    });
}
// funkcja pozwala na znalezienie pierwszego elemetu na stronie, działa jak kotwica w WordPress
// behavior: 'smooth' - płynne przewijanie
window.onscroll = function () {
    scroll()
}
function scroll(){
    if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
        document.getElementById('up-button').style.display = "block";
    } else {
        document.getElementById('up-button').style.display = "none";
    }
}
function reserve(samochod){
    var select = document.getElementById('samochod');
    //poniższe usuwa dublowanie selected, usuwa ten atybut
    var options_selected = select.querySelectorAll('option[selected]');
    options_selected.forEach(function(option) {
        option.removeAttribute("selected");
    });
    var option = select.querySelector('option[value="'+samochod+'"]'); 
    option.setAttribute("selected","selected");
    smoothScroll('#rezerwacja');
}