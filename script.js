function list(a){
    var item = document.getElementsByClassName(a);
    for (let i = 0; i < item.length; i++) {
        const element = item[i];
        element.classList.toggle("disable");
    }
}
function category(a){
    window.location.href= "ofert.php?category=" +a;
}
function remove(a){
    window.location.href= "remove.php?prod=" +a;
}



