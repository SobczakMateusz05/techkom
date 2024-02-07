function list(a){
    var item = document.getElementsByClassName(a);
    for (let i = 0; i < item.length; i++) {
        const element = item[i];
        element.classList.toggle("disable");
    }
}
function filtr(){
    var filtr = document.getElementsByClassName("filtr")[0];
    filtr.classList.toggle("disable");
}
function category(a){
    window.location.href= "ofert.php?category=" +a;
}



