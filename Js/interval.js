var n = 0;
var doc = document.getElementById("LoadPage");
var texto = document.getElementById("Loading");
window.setInterval(function () {
    n++;
    if (n%3 == 0) {
        texto.innerHTML = "...";
    }
    if (n%3 == 1) {
        texto.innerHTML = ".";
    }
    if (n%3 == 2) {
        texto.innerHTML = "..";
    }
    if(n == 3){
        doc.style.left = "-100%",
        window.setInterval(function () {
          if (n == 4) {
            window.open('WebPage/home_login.php', '_self');
          } 
        },100)
    }
},1000);