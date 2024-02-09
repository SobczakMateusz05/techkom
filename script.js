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
function operation(a,b){
    window.location.href= "order.php?prod=" +a +"&operation="+b;
}




