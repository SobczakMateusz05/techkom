function sort() {
    var currentUrl = window.location.href;
    if (currentUrl.indexOf("&sort=") !== -1) {
        var urlBeforeSort = currentUrl.split("&sort=")[0];
        var urlAfterSort = currentUrl.split("&sort=")[1];
        var urlRest = "";
        if (urlAfterSort.indexOf("&") !== -1) {
            urlRest = "&" + urlAfterSort.substring(1);
        }
        var selectedOption = document.getElementById("mySelect").value;
        window.location.href = urlBeforeSort + "&sort=" + selectedOption + urlRest;
    } else {
        var selectedOption = document.getElementById("mySelect").value;
        window.location.href = currentUrl + "&sort=" + selectedOption;
    }
}

function filtr(a) {
    var currentUrl = window.location.href;
    if (currentUrl.indexOf("&" + a + "=") !== -1) {
        var urlBeforeA = currentUrl.split("&" + a + "=")[0];
        var urlAfterA = currentUrl.split("&" + a + "=")[1];
        var urlRest = "";
        if (urlAfterA.indexOf("&") !== -1) {
            urlRest = "&" + urlAfterA.substring(urlAfterA.indexOf("&") + 1);
        }
        var selectElement = document.getElementById(a);
        var selectedOption = selectElement.value;
        window.location.href = urlBeforeA + "&" + a + "=" + selectedOption + urlRest;
    } else {
        var selectElement = document.getElementById(a);
        var selectedOption = selectElement.value;
        window.location.href = currentUrl + "&" + a + "=" + selectedOption;
    }
}

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
    
    window.location.href= "operation.php?prod=" +a +"&operation="+b;
}

function spec(a){
    window.location.href = "spec.php?prod=" +a;
}

function history(a){
    window.location.href = "orderhistory.php?number=" +a;
}
