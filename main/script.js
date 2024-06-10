
const textbox = document.getElementById("searchbox");
textbox.addEventListener("keypress", function onEvent(event) {
    if (event.key === "Enter") {
        document.getElementById("searchicon").click();
    }
});

function performSearch(){
    let searchValue = document.getElementById("searchbox").value.toLowerCase();
    
    if (searchValue === "lake palace" || searchValue === "lakepalace") {
        document.getElementById("searchbox").value = null;
        window.open("/lakepalace/lakepalace.html",'_blank');
    }
    else if (searchValue === "city palace" || searchValue === "citypalace") {
        document.getElementById("searchbox").value = null;
        window.open("/citypalace/citypalace.html",'_blank');
    }
    else if (searchValue === "jagmandir" || searchValue === "jag mandir") {
        document.getElementById("searchbox").value = null;
        window.open("/jagmandir/jagmandir.html",'_blank');
    }
    else if (searchValue === "fatehsagar lake" || searchValue === "fatehsagar" || searchValue === "lake fatehsagar") {
        document.getElementById("searchbox").value = null;
        window.open("/fatehsagar/fatehsagar.html",'_blank');
    }
    else if (searchValue === "pichola lake" || searchValue === "pichola" || searchValue ==="lake pichola") {
        document.getElementById("searchbox").value = null;
        window.open("/pichola/pichola.html",'_blank');
    }
    else if (searchValue === "sajjangarh" || searchValue === "sajjangarh fort" || searchValue === "sajjangarh palace") {
        document.getElementById("searchbox").value = null;
        window.open("/sajjangarh/sajjangarh.html",'_blank');
    }
    else if (searchValue === "jagdish temple" || searchValue === "jagdish mandir" || searchValue === "jagdishmandir") {
        document.getElementById("searchbox").value = null;
        window.open("/jagdish/jagdish.html",'_blank');
    }
    else if (searchValue === "sahelion ki bari" || searchValue === "sahelionkibari") {
        document.getElementById("searchbox").value = null;
        window.open("/sahelionkibari/sahelionkibari.html",'_blank');
    }
    else if (searchValue === "doodhtalai lake" || searchValue === "doodhtalai" || searchValue === "dudhtalai" || searchValue === "dudhtalai lake" || searchValue === "dudh talai lake" || searchValue === "doodh talai" || searchValue === "dudh talai" || searchValue === "doodh talai lake") {
        document.getElementById("searchbox").value = null;
        window.open("/doodhtalai/doodhtalai.html",'_blank');
    }
    else if (searchValue === "jaisamand lake" || searchValue === "jaisamand") {
        document.getElementById("searchbox").value = null;
        window.open("/jaisamand/jaisamand.html",'_blank');
    }
    else if (searchValue === "rajsamand lake" || searchValue === "rajsamand") {
        document.getElementById("searchbox").value = null;
        window.open("/rajsamand/rajsamand.html",'_blank');
    }
    else if (searchValue === "udaisagar lake" || searchValue === "udaisagar") {
        document.getElementById("searchbox").value = null;
        window.open("/udaisagar/udaisagar.html",'_blank');
    }
}




// // individual pages gallery code
// var slideIndex = 1;
// var myTimer;

// function plusSlides(n) {
//   clearInterval(myTimer);
//   if (n < 0) {
//     showSlides((slideIndex -= 1));
//   } else {
//     showSlides((slideIndex += 1));
//   }
//   if (n === -1) {
//     myTimer = setInterval(function () {
//       plusSlides(n + 2);
//     }, 4000);
//   } else {
//     myTimer = setInterval(function () {
//       plusSlides(n + 1);
//     }, 4000);
//   }
// }

// function showSlides(n) {
//   var i;
//   var slides = document.querySelector(".mySlides");
//   var dots = document.getElementsByClassName("dot");
//   if (n > slides.children.length) {
//     slideIndex = 1;
//   }
//   if (n < 1) {
//     slideIndex = slides.children.length;
//   }
//   var transformValue = -((slideIndex - 1) * 25); // Adjust as needed
//   slides.style.transform = "translateX(" + transformValue + "%)";
//   for (i = 0; i < dots.length; i++) {
//     dots[i].className = dots[i].className.replace(" active", "");
//   }
//   dots[slideIndex - 1].className += " active";
// }

// window.addEventListener("load", function () {
//   showSlides(slideIndex);
//   myTimer = setInterval(function () {
//     plusSlides(1);
//   }, 4000);
// });

// function currentSlide(n) {
//   clearInterval(myTimer);
//   myTimer = setInterval(function () {
//     plusSlides(n + 1);
//   }, 4000);
//   showSlides((slideIndex = n));
// }

// var slideshowContainer = document.querySelector(".slideshow-container");
// slideshowContainer.addEventListener("mouseenter", pause);
// slideshowContainer.addEventListener("mouseleave", resume);

// function pause() {
//   clearInterval(myTimer);
// }

// function resume() {
//   clearInterval(myTimer);
//   myTimer = setInterval(function () {
//     plusSlides(slideIndex);
//   }, 4000);
// }