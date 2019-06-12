<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {
    display: none;
    align-items: center;
    
/*    overflow-y: hidden;*/
    }
    .mySlides:hover{
        border: solid 2px rgba(102,0,204);
        box-shadow: 2px 2px 10px;
    }
    .flex_rows {
        display: flex;
        flex-direction: row;
    }
img {
    vertical-align: middle;
    max-height:100%;
    max-width: 100%;
    margin-left:auto;
    margin-right:auto;
    display: block;
    position: relative;
    left: 0;
    top:0;
/*    left: 36%;*/
/*    bottom: 0;*/
/*    text-align: center;*/
    }

/* Slideshow container */
.slideshow-container {
    border: solid 4px rgba(102,0,204);
/*    flex-flow: row;*/
  max-width: 1000px;
/*    background-color: orange;*/
    height: 250px;
  position: relative;
  margin: auto;
    justify-content: space-between;
    padding: 0 6%
/*    text-align: center;*/
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: #2e2e1f;
  font-weight: bold;
  font-size: 18px;
    border: solid 2px rgba(102,0,204);
    
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

    .mySlides > img{
        
    }
/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
   border-width: 2px 0 2px 2px; 
}
    
.prev{
    border-width: 2px 2px 2px 0;
    left: 0;
}
    
/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
    color: white;
}

/* Caption text */
.text {
  color: rgba(102,0,204,1);;
/*    border: solid rgba(102,0,204);*/
  font-size: 15px;
  padding: 2px 6px;
  position: relative;
    display: block;
/*  bottom: 8px;*/
    left: 30px;
  width: 75%;
  text-align: center;
    max-height: 100%;
}

    .text > * {
        margin-block-start: 0px;
    margin-block-end: 0px;
    }
    
/* Number text (1/3 etc) */
.numbertext {
  color: #000;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 3px;
  width: 15px;
  margin: 0 2px;
  background-color: rgba(102,0,204,0.50);
  border-radius: 0%;
  display: inline-block;
  transition: background-color 0.6s ease;
    transition: height 1s ease;
}

.active, .dot:hover {
  background-color: rgba(102,0,204,1);
    height: 20px;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
    .imaagen{
/*        height: 80%;*/
        height: 18vh;
        width: 12vw;;
    }
    
</style>
</head>
<body>

<div class="slideshow-container flex_rows">

    <div class="mySlides fade">
<!--        <div class="numbertext">1 / 7</div>-->
        <div class="imaagen"><img src="../img/ej1.jpg"></div>
        <div class="text">
            <h6>50% Descuento !</h6>
            <h5>Maxtor 2TB - 20.99€</h5>
            
        </div>
    </div>

    <div class="mySlides fade">
<!--        <div class="numbertext">2 / 7</div>-->
        <div class="imaagen"><img src="../img/ej2.jpg"></div>
        <div class="text">
                <h6>70% Descuento !</h6>
                <h5>SeaGate 1TB - 20.99€</h5>
        </div>
    </div>

    <div class="mySlides fade">
<!--        <div class="numbertext">3 / 7</div>-->
        <div class="imaagen">
            <img src="../img/ej3.png">
        </div>
        <div class="text">
            <h6>10% Descuento !</h6>
            <h5>Maxtor 500GB - 12.99€</h5> 
        </div>
    </div>

    <div class="mySlides fade">
<!--        <div class="numbertext">4 / 7</div>-->
        <div class="imaagen">
            <img src="../img/ej4.jpg">
        </div>
        <div class="text">
            <h6>50% Descuento !</h6>
            <h5>LG 1TB - 20.99€</h5>  
        </div>
    </div>
    <div class="mySlides fade">
<!--        <div class="numbertext">5 / 7</div>-->
        <div class="imaagen">
            <img src="../img/ej5.jpg">
        </div>        
        <div class="text">            
            <h6>9% Descuento !</h6>
            <h5>Samsung 4TB - 343.99€</h5> 
        </div>
    </div>
    <div class="mySlides fade">
<!--        <div class="numbertext">6 / 7</div>-->
        <div class="imaagen">
            <img src="../img/ej6.jpg" >
        </div>
        <div class="text">
            <h6>7% Descuento !</h6>
            <h5>SeaGate 500GB - 11.99€</h5> 
        </div>
    </div>
    <div class="mySlides fade">
<!--        <div class="numbertext">7 / 7</div>-->
       
        <div  class="imaagen">

           <img src="../img/ej7.jpg">
        </div>
        <div class="text">            
            <h6>10% Descuento !</h6>
            <h5>Maxtor 3TB - 250.99€</h5> 
        </div>
    </div>


    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<!--
<div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
    <span class="dot" onclick="currentSlide(4)"></span>
    <span class="dot" onclick="currentSlide(5)"></span>
    <span class="dot" onclick="currentSlide(6)"></span>
    <span class="dot" onclick="currentSlide(7)"></span>
</div>
-->
<script type="text/javascript">
    var slideIndex = 3;
    
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
        
      if (n > slides.length) {slideIndex = 3}    
      
        if (n < 1) {slideIndex = slides.length}
        
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";  
      }
      
        if(slideIndex<3) {
            slides[slideIndex-1].style.display = "block";  
            slides[slideIndex-2].style.display = "block"; 
            slides[slideIndex-3].style.display = "block";  
        }
      slides[slideIndex-1].style.display = "block";  
//      dots[slideIndex-1].className += " active";
        slides[slideIndex-2].style.display = "block";  
//      dots[slideIndex-2].className += " active";
        slides[slideIndex-3].style.display = "block";  
//      dots[slideIndex-3].className += " active";
    }
</script>

</body>
</html> 
