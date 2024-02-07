function products(){
    var product = document.getElementsByClassName("products");
    for (let i = 0; i < product.length; i++) {
        const element = product[i];
        element.classList.toggle("disable");
    }
}
function usluga(){
    var usluga = document.getElementsByClassName("usluga");
    for (let i = 0; i < usluga.length; i++) {
        const element = usluga[i];
        element.classList.toggle("disable");
    }
}
function actual(){
    var actual = document.getElementsByClassName("actual");
    for (let i = 0; i < actual.length; i++) {
        const element = actual[i];
        element.classList.toggle("disable");
    }
}
function filtr(){
    var filtr = document.getElementsByClassName("filtr")[0];
    filtr.classList.toggle("disable");
}
function sort(){
    var sort = document.getElementsByClassName("sort")[0];
    sort.classList.toggle("disable");
}



