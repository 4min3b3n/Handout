$(window).scroll(function(){
    if ($(window).scrollTop() >= 40) {
        $('nav').addClass('fixed-header');
        $('nav div').addClass('visible-title');
    }
    else {
        $('nav').removeClass('fixed-header');
        $('nav div').removeClass('visible-title');
    }
});


function myFunction() {
    document.getElementById("myBtn").getAttribute("onclick");
    $("#myBtn").slideDown("slow");
}

function openPanel() {
    document.getElementById("myBtn").getAttribute("onclick");
    $("#panel").slideUp("slow");
}

function on() {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("frame").style.display = "block";
}

function off() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("frame").style.display = "none";
}


function show(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","Home.php?q="+str,true);
        xmlhttp.send();
    }
}
