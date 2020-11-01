<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<style>
    .slick-list {
    position: relative;
    display: block;
    overflow: hidden;
    margin: 0;
    padding: 0;
    border-radius: 0px;
}

    .hide{display:none;}

@media only screen and (max-width: 767px){

    #prescription{
        display:none;
    }

    #lab{
        display:none;
    }
    #ask-doctor{
        display:none;
    }
    #heart{
        position:relative !important;
        top:0px  !important;
        right:0px  !important;
    }

    #adv-mobile{
        margin-top:7rem !important;
    }
    #adv-img-mobile{
        height:30rem;
    }
    #mainslider-mobile{
        height:30rem;
    }
}

.black-btn {
    padding: 6px 20px;
    border: 1px solid transparent!important;
    border-right: 1px solid transparent!important;
    display: inline-block;
    font-size: 12px;
    text-align: center;
    background: #ddd;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
    color: gray !important;
    margin-right: 8px;
}

.black-btn:hover {
    padding: 6px 20px;
    border: 1px solid transparent!important;
    border-right: 1px solid transparent!important;
    display: inline-block;
    font-size: 12px;
    text-align: center;
    background: #2385aa;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
    color: white !important;
    margin-right: 8px;
}


.glow {
  font-size: 80px;
  color: #fff;
  text-align: center;
  -webkit-animation: glow 1s ease-in-out infinite alternate;
  -moz-animation: glow 1s ease-in-out infinite alternate;
  animation: glow 1s ease-in-out infinite alternate;
}

@-webkit-keyframes glow {
  from {
    text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
  }

  to {
    text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
  }
}

/* Blue Shadow */
@-moz-keyframes blue {
  0%,
  100% {
    -moz-box-shadow: 1px 0px 19px 4px rgba(0, 130, 196, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
    box-shadow: 1px 0px 19px 4px rgba(0, 130, 196, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    -moz-box-shadow: 0px 0px 0px 0px rgba(0, 130, 196, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
    box-shadow: 0px 0px 0px 0px rgba(0, 130, 196, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@-webkit-keyframes blue {
  0%,
  100% {
    -webkit-box-shadow: 1px 0px 19px 4px rgba(0, 130, 196, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
    box-shadow: 1px 0px 19px 4px rgba(0, 130, 196, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 130, 196, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
    box-shadow: 0px 0px 0px 0px rgba(0, 130, 196, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@-o-keyframes blue {
  0%,
  100% {
    box-shadow: 1px 0px 19px 4px rgba(0, 130, 196, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    box-shadow: 0px 0px 0px 0px rgba(0, 130, 196, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@keyframes blue {
  0%,
  100% {
    box-shadow: 1px 0px 19px 4px rgba(0, 130, 196, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    box-shadow: 0px 0px 0px 0px rgba(0, 130, 196, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

/* Yellow Shadow */
@-moz-keyframes yellow {
  0%,
  100% {
    -moz-box-shadow: 1px 0px 19px 4px #fff503,
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
    box-shadow: 1px 0px 19px 4px #fff503,
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    -moz-box-shadow: 0px 0px 0px 0px rgba(255, 245, 3, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
    box-shadow: 0px 0px 0px 0px rgba(255, 245, 3, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@-webkit-keyframes yellow {
  0%,
  100% {
    -webkit-box-shadow: 1px 0px 19px 4px #fff503,
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
    box-shadow: 1px 0px 19px 4px #fff503,
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    -webkit-box-shadow: 0px 0px 0px 0px rgba(255, 245, 3, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
    box-shadow: 0px 0px 0px 0px rgba(255, 245, 3, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@-o-keyframes yellow {
  0%,
  100% {
    box-shadow: 1px 0px 19px 4px #fff503,
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    box-shadow: 0px 0px 0px 0px rgba(255, 245, 3, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@keyframes yellow {
  0%,
  100% {
    box-shadow: 1px 0px 19px 4px #fff503,
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    box-shadow: 0px 0px 0px 0px rgba(255, 245, 3, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

/* White Shadow */
@-moz-keyframes white {
  0%,
  100% {
    -moz-box-shadow: 1px 0px 19px 4px rgba(255, 255, 255, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
    box-shadow: 1px 0px 19px 4px rgba(255, 255, 255, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    -moz-box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
    box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@-webkit-keyframes white {
  0%,
  100% {
    -webkit-box-shadow: 1px 0px 19px 4px rgba(255, 255, 255, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
    box-shadow: 1px 0px 19px 4px rgba(255, 255, 255, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    -webkit-box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
    box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@-o-keyframes white {
  0%,
  100% {
    box-shadow: 1px 0px 19px 4px rgba(255, 255, 255, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@keyframes white {
  0%,
  100% {
    box-shadow: 1px 0px 7px 2px rgba(255, 255, 255, 0.7),
      inset 0px 0px 6px rgba(255, 255, 255, 0.5);
  }

  50% {
    box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

/* Button */
.button {
  text-align: center;
  padding: 10px 20px;
  text-decoration: none;
  color: #000;
  font-weight: bold;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px 0;
  border-radius: 10px 0;
  margin-right: 20px;
}

/* Blue Background */
.blue {
  /* text-shadow: 0px 1px 0px #83e0f7; */
  /* background-image: -webkit-linear-gradient(top, #87e0fd, #53cbf1);
  background-image: -moz-linear-gradient(top, #87e0fd, #53cbf1);
  background-image: -o-linear-gradient(top, #87e0fd, #53cbf1);
  background-image: linear-gradient(to bottom, #87e0fd, #53cbf1); */
  -webkit-animation: blue 2s infinite;
  -moz-animation: blue 2s infinite;
  -o-animation: blue 2s infinite;
  animation: blue 4s infinite;
}

/* Yellow Background */
.yellow {
  text-shadow: 0px 1px 0px #faffc7;
  background-image: -webkit-linear-gradient(top, #fff966, #f3fd80);
  background-image: -moz-linear-gradient(top, #fff966, #f3fd80);
  background-image: -o-linear-gradient(top, #fff966, #f3fd80);
  background-image: linear-gradient(to bottom, #fff966, #f3fd80);
  -webkit-animation: yellow 2s infinite;
  -moz-animation: yellow 2s infinite;
  -o-animation: yellow 2s infinite;
  animation: yellow 2s infinite;
}

/* White Background */
.white {
  text-shadow: 0px 1px 0px #fff;
  background-image: -webkit-linear-gradient(top, #ffffff, #cccccc);
  background-image: -moz-linear-gradient(top, #ffffff, #cccccc);
  background-image: -o-linear-gradient(top, #ffffff, #cccccc);
  background-image: linear-gradient(to bottom, #ffffff, #cccccc);
  -webkit-animation: white 2s infinite;
  -moz-animation: white 2s infinite;
  -o-animation: white 2s infinite;
  animation: white 2s infinite;
}

    .header-searched-item-list-wrap {
    position: absolute;
    background: #fff;
    right: 0;
    width: 500px;
    top: 65px;
    z-index: 9;
    padding: 10px;
    box-shadow: 0 0 5px #ddd;
    border-bottom: 5px solid #2385aa;
    display: none;
}

.header-searched-item-list-wrap-mobile {
    position: absolute;
    background: #fff;
    right: 0;
    width: 500px;
    top: 65px;
    z-index: 9;
    padding: 10px;
    box-shadow: 0 0 5px #ddd;
    border-bottom: 5px solid #2385aa;
    display: none;
}

.header-middle-right-wrap li a {
    border-color: transparent !important;
    color: #2385aa ;
    font-weight: 700;
    font-size: 12px;
    display: inline-block;
}

#cart-list.header-middle-right-wrap li a {
    border-color: transparent !important;
    color: #2385aa;
    font-weight: 700;
    font-size: 12px;
    display: inline-block;
    padding: 0 0px;
}

.gallery-overlay {
    background-color: #869296 !important;
}

    .u-btn-outline-bluegray.u-btn-hover-v1-4::after, .u-btn-outline-bluegray.u-btn-hover-v1-4:hover::after {
      background-color: #2385aa !important;
    }



    #lab:hover {
        transform:scale(1.1);

        color:#2385aa;
        font-weight: 700;
        transition:all 0.3s;

    }

    #promotion:hover {
        transform:scale(1.1);

        color:#2385aa;
        font-weight: 700;
        transition:all 0.2s;


    }

    #askdoctor:hover {
        transform:scale(1.1);

        color:#2385aa;
        font-weight: 700;
        transition:all 0.3s;

    }


    .header-menu-wrap li {
        display: inline-block;
        margin-right: 10px !important;
        position: relative;
    }

    [class*="u-badge"]:not([class*="--top-left"]):not([class*="--bottom-left"]):not([class*="--bottom-right"]) {
        top: 4px;
        right: 0;
        -ms-transform: translate(50%, -50%);
        transform: translate(104%, -17%);
    }
        a{
            text-decoration: none !important;
        }

        .header-menu-wrap li {
        display: inline-block;
        margin-right: 20px;
        position: relative;
    }

    @media only screen and (max-width: 767px){

        .header-middle-right-wrap li a span {
    display: block;

    }

    .addToMycart{
        right:-40px !important;
    }
    .header-middle-right-wrap ul li a i {
        height: 30px;
        width: 30px;
        background: transparent;
        border-radius: 100%;
        line-height: 30px;
        text-align: center;
        color: #2385aa;
        display: inline-block;
        margin-right: 0;
    }


    #doctor{
        text-align: center;
    }
    }

    @media only screen and (max-width: 767px){
    .cart-quantity {
        right: 0;
        top: -12px;
        left:15px !important;
    }

    #mobile-nav{
        display:none;
    }
    .header-bottom-area{
        display: none !important;
    }

    #categories{
        display:block !important;
    }

    #js-header{
        display:none;
    }

    #navbarmenu{
        text-align:center !important;
    }
    /* #business-text{
        display:none;
    } */
    #login-text{
        display:none;
    }
    }

    @media (min-width: 320px) and (max-width: 767px){


        .header-searched-item-list-wrap-mobile {
        right: 0%;
        width: 100% !important;
        top: 120px;
        z-index: 99999;
        }

        #search-list-desktop{
            display:none !important;
        }

        #lab{
            display:block !important;
        }
    }
    #header-mobile{
          display: none;
      }

    @media only screen and (max-width: 767px){

      #header-mobile{
          display: block !important;
      }
    li.myCart {
        display: inline-block !important;
    }


    }

    @media only screen and (max-width: 767px){
    .cart-quantity1 {
        right: 0;
        top: -11px !important;
        left:29px !important;
    }

    #popup-cart {
        right: 0;
        top: -7px !important;
        left:35px !important;
    }
    }

    .cart-quantity1 {
        position: absolute;
        left: 30px;
        top: -5px;
        background: #2385aa;
        color: #fff;
        width: auto;
        text-align: center;
        border-radius: 30px;
        display: block;
        line-height: 1;
        padding: 5px;
        font-size: 10px;
    }
        .category_nav{
            padding:1rem;

        }
        .header-menu-wrap li a.active {
        color: black;
    }
    .header-menu-wrap ul {
        padding-top: 18px;
    }

    @media only screen and (max-width: 991px) and (min-width: 768px){
    .header-menu-wrap ul {
        padding-top: 20px;
    }
    }
    .header-search-box {
        margin-top: 10px;
    }

    #style-2::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    border-radius: 6px;
    background-color: #F5F5F5;
}

#style-2::-webkit-scrollbar
{
    width: 8px;
    background-color: #F5F5F5;
}

#style-2::-webkit-scrollbar-thumb
{
    border-radius: 6px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #c1c1c1;
}

        </style>


    <style>


     .overlay {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: rgb(0,0,0);
    background-color: #2385aa;
    overflow-x: hidden;
    transition: 0.5s;
}

        .overlay-content {
          position: relative;
          top: 5%;
          width: 100%;
          text-align: center;
          margin-top: 30px;
        }

        .overlay a {
          padding: 8px;
          text-decoration: none;
          font-size: 36px;
          color: #818181;
          display: block;
          transition: 0.3s;
        }

        .overlay a:hover, .overlay a:focus {
          color: #f1f1f1;
        }

        .overlay .closebtn {
          position: absolute;
          top: 20px;
          right: 45px;
          font-size: 25px;
        }

        @media screen and (max-height: 450px) {
          .overlay a {font-size: 20px}
          .overlay .closebtn {
          font-size: 40px;
          top: 15px;
          right: 35px;
          }
        }
        </style>

<style>
    .dropbtn {

      color: #2385aa;
      padding: 0px;
      font-size: 14px;
      border: none;
      background-color: transparent;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;

      min-width: 250px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1000;
      display: none;

      text-align:left;


    }


    .dropdown-content a {
      color: black;
      background-color: #f1f1f1;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {background-color: #ddd;}

    .dropdown:hover .dropdown-content {display: block;}

    .dropdown:hover .dropbtn {background-color: transparent;}

    .dropdown-user {
      position: relative;
      display: inline-block;
    }

    .dropdown-content-user {
      display: none;
      position: absolute;

      min-width: 180px;
      /* box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); */
      z-index: 1000;
      display: none;
      right:-10px;
      text-align:left;
      background: #f1f1f1;


    }



    .dropdown-content-user a {
      color: black;
      background-color: #f1f1f1;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content-user a:hover {background-color: #ddd;}

    .dropdown-user:hover .dropdown-content-user {display: block;}

    .dropdown-user:hover .dropbtn {background-color: #f1f1f1;}

    .scroll-bar-wrap {
  width: 300px;
  position: relative;
  margin: 2em auto;
}
.scroll-box {

  overflow-y: scroll;
}
.scroll-box::-webkit-scrollbar {
  width: .4em;
}
.scroll-box::-webkit-scrollbar,
.scroll-box::-webkit-scrollbar-thumb {
  overflow:visible;
  border-radius: 4px;
}
.scroll-box::-webkit-scrollbar-thumb {
  background: rgba(0,0,0,.2);
}
.cover-bar {
  position: absolute;
  background: #fff;;
  height: 100%;
  top: 0;
  right: 0;
  width: .4em;
  -webkit-transition: all .5s;
  opacity: 1;
}
/* MAGIC HAPPENS HERE */
.scroll-bar-wrap:hover .cover-bar {
   opacity: 0;
  -webkit-transition: all .5s;
}

.shimmer {
  text-align: center;
  color: rgba(255,255,255,0.1);
  background: -webkit-gradient(linear, left top, right top, from(#222), to(#222), color-stop(0.5, #fff));
  background: -moz-gradient(linear, left top, right top, from(#222), to(#222), color-stop(0.5, #fff));
  background: gradient(linear, left top, right top, from(#222), to(#222), color-stop(0.5, #fff));
  -webkit-background-size: 125px 100%;
  -moz-background-size: 125px 100%;
  background-size: 125px 100%;
  -webkit-background-clip: text;
  -moz-background-clip: text;
  background-clip: text;
  -webkit-animation-name: shimmer;
  -moz-animation-name: shimmer;
  animation-name: shimmer;
  -webkit-animation-duration: 2s;
  -moz-animation-duration: 2s;
  animation-duration: 2s;
  -webkit-animation-iteration-count: infinite;
  -moz-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
  background-repeat: no-repeat;
  background-position: 0 0;
  background-color: #222;
}
@-moz-keyframes shimmer {
  0% {
    background-position: top left;
  }
  100% {
    background-position: top right;
  }
}
@-webkit-keyframes shimmer {
  0% {
    background-position: top left;
  }
  100% {
    background-position: top right;
  }
}
@-o-keyframes shimmer {
  0% {
    background-position: top left;
  }
  100% {
    background-position: top right;
  }
}
@keyframes shimmer {
  0% {
    background-position: top left;
  }
  100% {
    background-position: top right;
  }
}
</style>


{{-- @if($gs->is_loader == 1)
<div id="cover"></div>
@endif --}}


<style>

.nav-mobile {
  background: white;
  color: #000;
  padding: 0;
  margin: 0;
  cursor: auto;
  font-size: 18px;
  list-style-type: none;
  box-shadow: 0 5px 5px -5px #333;
}
.nav-mobile:after {
  content: "";
  display: table;
  clear: both;
}
.nav-mobile svg {
  height: 45px;
  width: 65px;
  padding: 9px;
}
.nav-mobile svg path {
  fill: #000;
}
.nav-mobile svg.icon-close {
  display: none;
  padding: 15px;
}
.nav-mobile li {
  width: 100%;
  height: 45px;
  line-height: 46px;
  text-align: center;
  float: left;
}
.nav-mobile li a {
  display: block;
  color: #333;
  width: 100%;
  height: 100%;
  text-decoration: none;
}
.nav-mobile .menu-button {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  margin: 0;
  cursor: pointer;
  display: block;
}
.nav-mobile .menu-button:after {
  opacity: 0;
  top: 45px;
  content: "";
  width: 100vw;
  display: block;
  position: fixed;
  height: 100vh;
  /* background: #f1f1f1; */
  content: "";
  pointer-events: none;
  transition: opacity 0.2s cubic-bezier(0, 0, 0.3, 1);
  transition-delay: 0.1s;
}
.nav-mobile #menu-toggle {
  display: none;
}
.nav-mobile #menu-toggle.active ~ .menu-button .icon-close, .nav-mobile #menu-toggle:checked ~ .menu-button .icon-close {
  display: block;
}
.nav-mobile #menu-toggle.active ~ .menu-button .icon-open, .nav-mobile #menu-toggle:checked ~ .menu-button .icon-open {
  display: none;
}
.nav-mobile #menu-toggle.active ~ .menu-button:after, .nav-mobile #menu-toggle:checked ~ .menu-button:after {
  opacity: 1;
  pointer-events: auto;
  transition: opacity 0.3s cubic-bezier(0, 0, 0.3, 1);
}
.nav-mobile #menu-toggle.active ~ .menu-sidebar, .nav-mobile #menu-toggle:checked ~ .menu-sidebar {
  transform: translateX(0);
  transition: transform 0.3s cubic-bezier(0, 0, 0.3, 1);
}
.nav-mobile .menu-container {
  width: 65px;
  float: left;
  cursor: pointer;
  position: absolute;
}
.nav-mobile .menu-container .menu-sidebar {
  box-shadow: 5px 0 5px -5px #333;
  display: block;
  width: 70vw;
  bottom: 0;
  background: white;
  color: #333;
  position: fixed;
  transform: translateX(-405px);
  transition: transform 0.3s cubic-bezier(0, 0, 0.3, 1);
  top: 45px;
  z-index: 2;
  list-style-type: none;
  padding: 0;
  max-width: 400px;
}
.nav-mobile .menu-container .menu-sidebar .arrow {
  position: absolute;
  line-height: 40px;
  font-size: 32px;
  color: #555;
  top: 0;
  z-index: 0;
}
.nav-mobile .menu-container .menu-sidebar .arrow.left {
  left: 25px;
}
.nav-mobile .menu-container .menu-sidebar .arrow.right {
  right: 25px;
}
.nav-mobile .menu-container .menu-sidebar li {
  height: 40px;
  line-height: 40px;
  font-size: 16px;
  text-align: left;
  position: relative;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  padding-left: 20px;
}
.nav-mobile .menu-container .menu-sidebar li:hover {
  background: #eee;
}
.nav-mobile .menu-container .menu-sidebar li .menu-sub {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  width: 0;
  overflow: hidden;
  background: white;
  visibility: hidden;
  transition: all 0.3s cubic-bezier(0, 0, 0.3, 1);
  border-left: 1px solid #ccc;
  list-style-type: none;
  padding: 0;
  margin: 0;
  z-index: 2;
  max-width: 400px;
}
.nav-mobile .menu-container .menu-sidebar li .menu-sub li {
  overflow: hidden;
}
.nav-mobile .menu-container .menu-sidebar li .menu-sub .menu-sub-title {
  padding-left: 50px;
}
.nav-mobile .menu-container .menu-sidebar li .submenu-label {
  cursor: pointer;
  width: 100%;
  height: 100%;
  display: block;
}
.nav-mobile .menu-container .menu-sidebar li .submenu-toggle {
  display: none;
}
.nav-mobile .menu-container .menu-sidebar li .submenu-toggle.active ~ .menu-sub, .nav-mobile .menu-container .menu-sidebar li .submenu-toggle:checked ~ .menu-sub {
  width: 65vw;
  visibility: visible;
  z-index: 1;
  transition: width 0.35s cubic-bezier(0, 0, 0.3, 1);
}

/* a:hover{
  color:#dc3545 !important;
 
} */

</style>


<div id="header-mobile" class="u-header__section g-brd-bottom g-brd-gray-light-v4 g-bg-black g-transition-0_3" style="background-color: #2383aa !important;" >
    <ul class="nav-mobile" style="z-index: 100000;" >
        <li>
            <div class="header-middle-left-wrap">
                <div id="logodiv" class="logo">
                    <a href="{{route('front.index')}}">
                        <img src="{{asset('assets/images/'.$gs->logo)}}" style="height:2.75rem; width:5rem;" alt="Logo" title="Go to Home" data-animation="flipInY" data-animation-delay="0" data-animation-duration="1000" >
                    </a>
                </div>
            </div>
        </li>
        <li class="menu-container">
          <input id="menu-toggle" type="checkbox">
          <label for="menu-toggle" class="menu-button">
            <svg class="icon-open" viewBox="0 0 24 24"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path></svg>
            <svg class="icon-close" viewBox="0 0 100 100">
              <path d="M83.288 88.13c-2.114 2.112-5.575 2.112-7.69 0L53.66 66.188c-2.113-2.112-5.572-2.112-7.686 0l-21.72 21.72c-2.114 2.113-5.572 2.113-7.687 0l-4.693-4.692c-2.114-2.114-2.114-5.573 0-7.688l21.72-21.72c2.112-2.115 2.112-5.574 0-7.687L11.87 24.4c-2.114-2.113-2.114-5.57 0-7.686l4.842-4.842c2.113-2.114 5.57-2.114 7.686 0l21.72 21.72c2.114 2.113 5.572 2.113 7.688 0l21.72-21.72c2.115-2.114 5.574-2.114 7.688 0l4.695 4.695c2.112 2.113 2.112 5.57-.002 7.686l-21.72 21.72c-2.112 2.114-2.112 5.573 0 7.686L88.13 75.6c2.112 2.11 2.112 5.572 0 7.687l-4.842 4.84z"/>
            </svg>
          </label>
          <ul class="menu-sidebar" style="z-index:1000000 !important;  overflow-y: scroll; ">

            <li style="background: #2385aa;">
                @if(Auth::guard('user')->check())
                @php
                    $user = Auth::guard('user')->user();
                    $user_str = $user->name;
                    $user_name = explode(' ', $user_str);
                @endphp


                <a class="" style="color: white;border-radius: 0px;border-color: #2385aa;font-weight: 500;font-size: 14px;" href="{{route('user-dashboard')}}">
                    <span>
                        @if($user->is_provider == 0)
                            <img style="position:relative;bottom:5px;width: 25px; height: 25px; border-radius:30px;" src="{{ $user->photo ? asset('assets/images/'.$user->photo) :asset('assets/images/user.png')}}" alt="profile no image"></i> Welcome, {{ $user_name[0] }}
                        @else
                        <img style="position:relative;bottom:5px;width: 25px; height: 25px; border-radius:30px;" src="{{ $user->photo ? $user->photo :asset('assets/images/user.png')}}" alt="profile no image"></i> Welcome, {{ $user_name[0] }}
                        @endif

                        </span>
                </a>
                @else

                    <a class="" style="color: white;border-radius: 0px;border-color: #2385aa;font-weight: 500;font-size: 14px;" href="{{route('user-login')}}">
                        {{-- <i class="fa fa-user"></i> <span>{{$lang->signinup}}</span> --}}
                        <i class="icon-user" style="font-size:18px; background:transparent; color:white;" title="User Login"></i> <span title="User Login ">Login / Register</span>
                    </a>
                @endif
            </li>

            @if(Auth::guard('user')->check())
            <li>
                <a class="" href="{{route('user-dashboard')}}" style="padding: .375rem .75rem;border-radius: 0px;border-color: #2385aa;font-weight: 500;font-size: 14px; color:#2385aa" ><i class="icon-user" style="font-size:18px;background:transparent; color:#2385aa; "></i> Profile</a>
            </li>

            <li>
            <a class="" href="{{route('user-logout')}}" style="padding: .375rem .75rem;border-radius: 0px;border-color: rgb(129, 72, 84);font-weight: 500;font-size: 14px; color:rgb(129, 72, 84);" onclick="event.preventDefault();document.getElementById('logout-form').submit();" ><i class="icon-logout" style="font-size:18px;background:transparent; color:rgb(129, 72, 84); "></i> Logout</a>
                <form id="logout-form" action="{{route('user-logout')}}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
            @endif

            <li><a href="#" style="font-weight:600;">Categories</a></li>

            @foreach($categories->sortBy('cat_name') as $category)
            <li>
            <input type="checkbox" id="{{$category->id}}" class="submenu-toggle">
              <label class="submenu-label" for="{{$category->id}}" style="font-weight:400;font-size:14px;"> {{$category->cat_name}}</label>
              <div class="arrow right">&#8250;</div>
              <ul class="menu-sub" style="overflow-y: scroll;">
                <li class="menu-sub-title">
                  <label class="submenu-label" for="{{$category->id}}">{{$category->cat_name}}</label>
                  <div class="arrow left">&#8249;</div>
                </li>
                <li style="height: auto; background: #fff;">
                  @foreach($category->subs()->where('status','=',1)->orderBy('sub_name')->get() as $subcategory)
                  <div class="" style="padding: 10px;">
                      <div class="">
                          <a class="d-block g-font-weight-600 text-uppercase mb-0 g-font-size-14" style="color:#2385aa; line-height:20px;" href="{{route('front.subcategory',$subcategory->sub_slug)}}">{{$subcategory->sub_name}}</a>

                              @foreach($subcategory->childs()->where('status','=',1)->orderBy('child_name')->get() as $childcategory)

                                <a class="child d-block g-color-text g-py-0 g-font-size-14" style="color:#6d6d6d;"  href="{{route('front.childcategory',$childcategory->child_slug)}}">{{ $childcategory->child_name }}</a>

                              @endforeach

                      </div>
                  </div>
                  @endforeach
                </li>


              </ul>
            </li>
            @endforeach
          </ul>
        </li>
    </ul>

    <div class="container">
      <div class="row justify-content-between align-items-center g-mx-0--lg">

        <div class="col-sm-auto g-pos-rel g-py-6 g-pt-12 text-center">
          <!-- List -->
          <ul class="list-inline g-pt-1 mb-0">

            <div class="dropdown" style="margin-right:5px;">
              <button class="dropbtn" style="color: white;"><i class="icon-phone"></i> </button>
              <div class="dropdown-content" style="top:32px;">
                <a href="tel:+977-1-5902444" style="color:brown;"><i class="icon-phone" style="font-size:18px;"></i> +977-1-5902444</a>
                <a class="dropdown-item" href="https://wa.me/9779840860410" style="padding:10px;color:green;">&nbsp;&nbsp;<i class="fa fa-whatsapp" aria-hidden="true" style="font-size:20px;"></i> +9779840860410 (WhatsApp)</a>
                <a class="dropdown-item" href="viber://chat?number=9779840860410" style="padding:10px;color:purple">&nbsp;&nbsp;<i class="fab fa-viber" aria-hidden="true" style="font-size:20px;"></i> +9779840860410 (Viber)</a>
                <a href="mailto:info@merohealthcare.com" style="color:#2385aa"><i class="fa fa-envelope-o" style="font-size:18px;color:#2385aa;"></i> info@merohealthcare.com</a>
            
              
              </div>
          </div>

          <li class="list-inline-item g-color-white-opacity-0_3 g-mx-1">|</li>

            <li>
              @if(Auth::guard('user')->check())
              @php
                  $user = Auth::guard('user')->user();
                  $user_str = $user->name;
                  $user_name = explode(' ', $user_str);
              @endphp


              <a class="" style="color: white;border-radius: 0px;border-color: #2385aa;font-weight: 500;font-size: 14px;" href="{{route('user-dashboard')}}">
                  <span>
                      @if($user->is_provider == 0)
                          <img style="position:relative;bottom:5px;width: 25px; height: 25px; border-radius:30px;" src="{{ $user->photo ? asset('assets/images/'.$user->photo) :asset('assets/images/user.png')}}" alt="profile no image">
                      @else
                      <img style="position:relative;bottom:5px;width: 25px; height: 25px; border-radius:30px;" src="{{ $user->photo ? $user->photo :asset('assets/images/user.png')}}" alt="profile no image"/>
                      @endif

                    </span>
                    <small style="display:block; position:absolute; top:-30px; right:25px; color:#333" >Welcome, {{ $user_name[0] }}</small>
              </a>
              @else

                  <a class="" style="color: white;border-radius: 0px;border-color: #2385aa;font-weight: 500;font-size: 14px;" href="{{route('user-login')}}">
                      {{-- <i class="fa fa-user"></i> <span>{{$lang->signinup}}</span> --}}
                      <i class="icon-user" style="font-size:14px; background:transparent; color:white;" title="User Login"></i> <span title="User Login "></span>
                  </a>
              @endif
          </li>

            <li class="list-inline-item g-color-white-opacity-0_3 g-mx-1">|</li>
            <li class="list-inline-item g-pos-rel">
                @if(Auth::guard('user')->check())
                    <a href="{{route('user-wishlists')}}" href="javascript:;" style="color: white; background:transparent; "><i class="icon-heart" style="font-size:14px;background:transparent; color: white;" title="Wishlist"></i>
                        @if($wishlist == 0)
                            <span class="cart-quantity1" style="width:20px; left:20px !important; color: #dc3545; background:transparent; font-weight:800;"> </span>
                        @else
                            <span class="cart-quantity1" style="width:20px;left:20px !important; color: #fff; background:#dc3545;font-weight:800;top:-8px; ">{{ $wishlist}}</span>
                        @endif
                    </a>
                @else
                <a href="{{route('user-login')}}" style="color: white; background:transparent; "><i id="heart" title="Wishlist" class="icon-heart" style="font-size:14px;"></i> <span> </span></a>
                @endif
            </li>
            <li class="list-inline-item g-color-white-opacity-0_3 g-mx-1">|</li>



            {{--<li class="list-inline-item g-pos-rel">

                <div class="d-inline-block g-valign-middle">
                    <div class="g-py-10 g-pl-15">
                    <a href="#" class="g-color-white-opacity-0_8 g-color-primary--hover g-font-size-17 g-text-underline--none--hover" aria-haspopup="true" aria-expanded="false" data-dropdown-event="click" aria-controls="searchform-1" data-dropdown-target="#searchform-1" data-dropdown-type="css-animation" data-dropdown-duration="300" data-dropdown-animation-in="fadeInUp" data-dropdown-animation-out="fadeOutDown">
                        <i class="g-pos-rel g-top-3 icon-education-045 u-line-icon-pro"></i>
                    </a>
                    </div>


                    <form id="searchform-1" class="u-searchform-v1 u-dropdown--css-animation u-shadow-v20 g-brd-around g-brd-gray-light-v4 g-bg-white g-right-0 rounded g-pa-10 1g-mt-8 u-dropdown--hidden" style="animation-duration: 300ms; right: 0px;">
                    <div class="input-group">
                        <input class="form-control g-font-size-13" type="search" placeholder="Search Here...">
                        <div class="input-group-append p-0">
                        <button class="btn u-btn-primary g-font-size-12 text-uppercase g-py-13 g-px-15" type="submit">Go</button>
                        </div>
                    </div>
                    </form>

                </div>

            </li> --}}


            <!-- Language -->
            <li class="list-inline-item g-pos-rel">
                <div class="u-basket d-inline-block g-z-index-1">
                    <div id="cart-list" class="myCart">
                        <a href="javascript:void(0)"> <i class="icon-finance-100 u-line-icon-pro" style="font-size:14px; color: white; background:transparent;"></i></a>

                        <span class="cart-quantity" style="width:20px;left:25px; color: #fff; background:#dc3545; font-weight:800;">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                        <div class="addToMycart scroll-box" style="right:0px; border-radius:10px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);" >

                                <div class="container" style="background-color:#f3f3f3f3;border-radius:10px;">
                                <h6 class="empty text-center g-mt-10">{{ Session::has('cart') ? '' :$lang->h }}</h6>
                                {{-- <hr style="margin-top:1rem; margin-bottom:1rem;"> --}}
                                <h5 class="text-center" style="text-transform:capitalize;"><strong style="font-weight:600;">{{$lang->vt}}</strong>
                                @if($gs->sign == 0)
                                    <strong style="font-weight:600;">Rs </strong><span class="total"> {{ Session::has('cart') ? round(Session::get('cart')->totalPrice * $curr->value , 2) : '0.00' }}</span>
                                @else
                                    <span class="total">{{ Session::has('cart') ? round(Session::get('cart')->totalPrice * $curr->value , 2) : '0.00' }}</span>{{$curr->sign}}
                                @endif
                                </h5>
                                {{-- <hr style="margin-top:1rem; margin-bottom:1rem;"> --}}
                                <div class="addMyCart-btns g-mb-10">
                                    <a href="{{route('front.cart')}}" class="btn btn-warning " style="border-radius:30px;font-size:12px;" ><i class="icon-eye"></i> {{$lang->vdn}}</a>
                                    <a href="{{route('front.checkout')}}" id="proceed-checkout" class="btn btn-lg  u-btn-primary u-btn-hover-v1-4" style="border-radius:30px;color:white !important;font-size:12px;background: rgb(4 85 116);" ><i class="icon-basket-loaded" style="color:white;"></i> {{$lang->gt}} <i class="loading-icon fa fa-spinner fa-spin hide"></i></a>
                                </div>
                                </div>
                                <div class="cart" >
                                    @if(Session::has('cart'))
                                        @foreach(Session::get('cart')->items as $product)
                                            <div class="single-myCart" style="margin: 10px !important;" >
                                                <div class="u-basket__product g-brd-none g-px-20">
                                                    <div class="row no-gutters g-pb-5">

                                                        <div class="col-4 pr-3">
                                                                <img class="img-fluid mCS_img_loaded" style="height:60px;" src="{{ asset('assets/images/'.$product['item']['photo']) }}" alt="Product image">
                                                        </div>

                                                        <div class="col-8">
                                                            <a href="{{ route('front.product',[$product['item']['id'],str_slug($product['item']['name'],'-')]) }}" style="color: black; padding:0 0px; "><h6 style="font-size: 12px;">{{strlen(ucwords(strtolower($product['item']['name']))) > 45 ? substr(ucwords(strtolower($product['item']['name'])),0,45).'...' : ucwords(strtolower($product['item']['name']))}}</h6></a>
                                                            <p style="font-size:12px;">{{$lang->cquantity}}: <span id="cqt{{$product['item']['id']}}">{{$product['qty']}}</span> <span>{{ $product['item']['measure'] }}</span></p>
                                                            <p style="font-size:12px;">
                                                            @if($gs->sign == 0)
                                                                {{$curr->sign}}<span id="prct{{$product['item']['id']}}">{{round($product['price'] * $curr->value , 2) }}</span>
                                                            @else
                                                                <span id="prct{{$product['item']['id']}}">{{round($product['price'] * $curr->value , 2) }}</span>{{$curr->sign}}
                                                            @endif
                                                            </p>
                                                            <button type="button" class="u-basket__product-remove cart-close" onclick="remove({{$product['item']['id']}})">×</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                            </div>
                        </div>
                    </div>
                  </div>
            </li>

       
         

          <li class="list-inline-item g-color-white-opacity-0_3 g-mx-1">|</li>

          <li class="mobile-search list-inline-item g-mx-2"><a href="javascript:void(0)" style="color: white;" onclick="openNav()"><i class="g-pos-rel g-top-3 icon-education-045 u-line-icon-pro" style="background: transparent;color: white;font-size: 14px;"></i> </a>
          </li>

          <div id="myNav" class="overlay" >
              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="color: white;">&times;</a>
              <div class="overlay-content" >
                  <div class="form-group container">
                  <form action="{{route('front.search')}}" method="GET">
                      <h6 style="color:white;">Search for Products</h6>
                      <input type="text" class="ss form-control g-mb-5" id="" name="product" placeholder="{{$lang->ec}}" required autocomplete="off" style="height:3rem;border-radius:30px;">
             
                      <button type="submit" class="btn btn-block" style="height:3rem;border-radius:30px;background:#045574;color:white;"><i class="fa fa-search" title="Search Products "></i> Search</button>
                  </form>
                  <div class="header-searched-item-list-wrap-mobile" style="display: none; overflow-y:auto;border-radius:10px;">

                      <ul>

                      </ul>
                  </div>

                  </div>

              </div>
          </div>



            <!-- End Language -->
          </ul>
          <!-- End List -->
        </div>

       

       
      </div>
    </div>
  </div>

@if($gs->is_subscribe == 1)
@if(isset($visited))
    <div style="display:none">
        <img src="{{asset('assets/images/'.$gs->subscribe_image)}}">
    </div>
    <!--  Starting of subscribe-pre-loader Area   -->
    <div class="subscribe-preloader-wrap" id="subscriptionForm" style="display: none;">
        <div class="subscribePreloader__thumb" style="background-image: url({{asset('assets/images/'.$gs->subscribe_image)}});">
            <span class="preload-close"><i class="fa fa-close"></i></span>
            <div class="subscribePreloader__text text-center">
                <h1>{{$gs->subscribe_title}}</h1>
                <p>{{$gs->subscribe_text}}</p>
                <form action="{{route('front.subscribe.submit')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="email" name="email" id="" placeholder="{{$lang->supl}}" required="">
                        <button type="submit">{{$lang->s}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  Ending of subscribe-pre-loader Area   -->



@endif
@endif



<style>
  .feedback {
  background-color : #31B0D5;
  color: white;
  padding: 10px 20px;
  border-radius: 4px;
  border-color: #46b8da;
}

#cartbutton {
  position: fixed;
  bottom: 27px;
  left: 24px;
  z-index: 1000;
}
#cartbutton{
  display: none;
}
    @media only screen and (max-width: 767px) {

      #cartbutton{
        display: block;
      }

        #logodiv{
            text-align:center !important;
        }

        #logoimg{
            height:5rem !important;
            width: 10rem !important;
            display:none;
        }
    }

    @media only screen and (max-width: 767px){
        .header-middle-right-wrap {
            padding-top: 0px;
        }
    }
</style>



<div id="cartbutton">
  <div id="cart-list" class="myCart">
    <a href="javascript:void(0)" class="btn btn-primary u-shadow-v1-5 btn btn-primary g-brd-2 g-brd-white g-font-size-13 g-rounded-50 g-pl-15 g-pr-15 g-py-7" style="border-radius:30px;"> <i class="icon-finance-100 u-line-icon-pro" style="font-size:25px; color: white; background:transparent;"></i></a>

    <span id="popup-cart" class="cart-quantity g-brd-2 g-brd-white u-shadow-v1-5" style="width:20px;left:35px; color: #fff; background:#dc3545; font-weight:800;">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
    <div class="addToMycart scroll-box" style="top:-190px; bottom:55px !important;left:10px; border-radius:10px;" >

            <div class="container" style="background-color:#f3f3f3f3;border-radius:10px;">
            <h6 class="empty text-center g-mt-10">{{ Session::has('cart') ? '' :$lang->h }}</h6>
            {{-- <hr style="margin-top:1rem; margin-bottom:1rem;"> --}}
            <h5 class="text-center" style="text-transform:capitalize;"><strong style="font-weight:600;">{{$lang->vt}}</strong>
            @if($gs->sign == 0)
                <strong style="font-weight:600;">Rs </strong><span class="total"> {{ Session::has('cart') ? round(Session::get('cart')->totalPrice * $curr->value , 2) : '0.00' }}</span>
            @else
                <span class="total">{{ Session::has('cart') ? round(Session::get('cart')->totalPrice * $curr->value , 2) : '0.00' }}</span>{{$curr->sign}}
            @endif
            </h5>
            {{-- <hr style="margin-top:1rem; margin-bottom:1rem;"> --}}
            <div class="addMyCart-btns g-mb-10">
                <a href="{{route('front.cart')}}" class="btn btn-lg btn-block" style="border-radius:30px;font-size:12px;" ><i class="icon-eye"></i> {{$lang->vdn}}</a>
                <a href="{{route('front.checkout')}}" id="proceed-checkout" class="btn btn-lg btn-block u-btn-primary u-btn-hover-v1-4" style="border-radius:30px;color:white !important;font-size:12px;background: rgb(4 85 116);" ><i class="icon-basket-loaded" style="color:white;"></i> {{$lang->gt}} <i class="loading-icon fa fa-spinner fa-spin hide"></i></a>
            </div>
            </div>
            <div class="cart" >
                @if(Session::has('cart'))
                    @foreach(Session::get('cart')->items as $product)
                        <div class="single-myCart" style="margin: 10px !important;" >
                            <div class="u-basket__product g-brd-none g-px-20">
                                <div class="row no-gutters g-pb-5">

                                    <div class="col-4 pr-3">
                                            <img class="img-fluid mCS_img_loaded" style="height:60px;" src="{{ asset('assets/images/'.$product['item']['photo']) }}" alt="Product image">
                                    </div>

                                    <div class="col-8">
                                        <a href="{{ route('front.product',[$product['item']['id'],str_slug($product['item']['name'],'-')]) }}" style="color: black; padding:0 0px; "><h6 style="font-size: 12px;">{{strlen(ucwords(strtolower($product['item']['name']))) > 45 ? substr(ucwords(strtolower($product['item']['name'])),0,45).'...' : ucwords(strtolower($product['item']['name']))}}</h6></a>
                                        <p style="font-size:12px;">{{$lang->cquantity}}: <span id="cqt{{$product['item']['id']}}">{{$product['qty']}}</span> <span>{{ $product['item']['measure'] }}</span></p>
                                        <p style="font-size:12px;">
                                        @if($gs->sign == 0)
                                            {{$curr->sign}}<span id="prct{{$product['item']['id']}}">{{round($product['price'] * $curr->value , 2) }}</span>
                                        @else
                                            <span id="prct{{$product['item']['id']}}">{{round($product['price'] * $curr->value , 2) }}</span>{{$curr->sign}}
                                        @endif
                                        </p>
                                        <button type="button" class="u-basket__product-remove cart-close" onclick="remove({{$product['item']['id']}})">×</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
        </div>
    </div>
</div>
  </div>



<div class="header-middle-area" id="mobile-nav">
    <div class="container">
        {{-- <marquee style="color:red;">Due to covid19 Lockdown we are not able to deliver the products for time being but our business site is open and we are delivering to stockists only!!</marquee> --}}
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="header-middle-left-wrap">
                    <div id="logodiv" class="logo">
                        <a href="{{route('front.index')}}">
                            <img id="logoimg" src="{{asset('assets/images/'.$gs->logo)}}" style="height:4.5rem" alt="Logo" title="Go to Home" data-animation="flipInY" data-animation-delay="0" data-animation-duration="1000" >
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <div id="navbarmenu" class="header-middle-right-wrap text-right">
                    <ul style="margin-bottom:0rem; margin-top:10px;">



            <div class="dropdown" style="margin-right:5px;">
              <button class="dropbtn"><i class="icon-phone" style="font-size:18px;"></i> Customer Care </button>
              <div class="dropdown-content">
                  <a href="tel:+977-1-5902444" style="color:brown;"><i class="icon-phone" style="font-size:18px;"></i> +977-1-5902444</a>
                  <a class="dropdown-item" href="https://wa.me/9779840860410" style="padding:10px;color:green;">&nbsp;&nbsp;<i class="fa fa-whatsapp" aria-hidden="true" style="font-size:20px;"></i> +9779840860410 (WhatsApp)</a>
                  <a class="dropdown-item" href="viber://chat?number=9779840860410" style="padding:10px;color:purple">&nbsp;&nbsp;<i class="fab fa-viber" aria-hidden="true" style="font-size:20px;"></i> +9779840860410 (Viber)</a>
                  <a href="mailto:info@merohealthcare.com" style="color:#2385aa"><i class="fa fa-envelope-o" style="font-size:18px;color:#2385aa;"></i> info@merohealthcare.com</a>
              
              </div>
          </div>

          <li class="list-inline-item g-color-primary g-mx-2">|</li>


                        {{-- <li>
                            <a class="" style="color: #2385aa;border-radius: 0px;border-color: #2385aa;font-weight: 500;font-size: 14px;" href="{{route('front.sell-on-mhc')}}">
                                <i class="icon-finance-075 u-line-icon-pro" style="font-size:18px; background:transparent; color:#2385aa;" title="Sell on Merohealthcare"></i> Sell on Merohealthcare
                            </a>
                        </li> --}}

                        <li>
                            @if(Auth::guard('user')->check())
                                <a href="{{route('user-wishlists')}}" href="javascript:;" style="color: #2385aa; background:transparent; "><i class="icon-heart" style="font-size:18px;background:transparent; color: #2385aa;" title="Wishlist"></i>
                                    @if($wishlist == 0)
                                        <span class="cart-quantity1" style="width:20px;top:-11px; left:20px; color: #dc3545; background:transparent; font-weight:800;"> </span>
                                    @else
                                        <span class="cart-quantity1" style="width:20px;top:-11px; left:20px; color: #fff; background:#dc3545;font-weight:800;top:-8px; ">{{ $wishlist}}</span>
                                    @endif
                                </a>
                            @else
                              <a  href="{{route('user-login')}}"><i id="heart" title="Wishlist" class="icon-heart" style="font-size:18px; color:#2385aa !important; background:transparent;"></i> <span> </span></a>
                            @endif
                        </li>

                         <li class="list-inline-item g-color-primary g-mx-2">|</li>

                        <li id="cart-list" class="myCart"><a href="javascript:void(0)"> <i class="icon-finance-100 u-line-icon-pro" style="font-size:18px; color: #2385aa; background:transparent;"></i></a>

                            <span class="cart-quantity" style="width:20px;left:20px; color: #fff; background:#2385aa; font-weight:800;">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                            <div class="addToMycart scroll-box" style="right:10px; border-radius:10px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);" >

                                    <div class="container" style="background-color:#f3f3f3f3;border-radius:10px;">
                                    <h6 class="empty text-center g-mt-10">{{ Session::has('cart') ? '' :$lang->h }}</h6>
                                    {{-- <hr style="margin-top:1rem; margin-bottom:1rem;"> --}}
                                    <h5 class="text-center" style="text-transform:capitalize;"><strong style="font-weight:600;">{{$lang->vt}}</strong>
                                    @if($gs->sign == 0)
                                        <strong style="font-weight:600;">Rs </strong><span class="total"> {{ Session::has('cart') ? round(Session::get('cart')->totalPrice * $curr->value , 2) : '0.00' }}</span>
                                    @else
                                        <span class="total">{{ Session::has('cart') ? round(Session::get('cart')->totalPrice * $curr->value , 2) : '0.00' }}</span>{{$curr->sign}}
                                    @endif
                                    </h5>
                                    {{-- <hr style="margin-top:1rem; margin-bottom:1rem;"> --}}
                                    <div class="addMyCart-btns g-mb-10">
                                        <a href="{{route('front.cart')}}" class="btn btn-lg btn-block u-btn-outline-primary" style="border-radius:30px;" ><i class="icon-eye"></i> {{$lang->vdn}}</a>
                                        <a href="{{route('front.checkout')}}" id="proceed-checkout" class="btn btn-lg btn-block u-btn-primary" style="border-radius:30px;color:white !important;background: rgb(4 85 116);" ><i class="icon-basket-loaded" style="color:white;"></i> {{$lang->gt}} <i class="loading-icon fa fa-spinner fa-spin hide"></i></a>
                                    </div>
                                    </div>
                                    <div class="cart" >
                                      @if(Session::has('cart'))
                                      @foreach(Session::get('cart')->items as $product)
                                      <div class="single-myCart" style="margin: 10px !important;" >
                                          <p class="cart-close" onclick="remove({{$product['item']['id']}})"><i class="fa fa-close"></i></p>
                                          <div class="cart-img">
                                              <img src="{{ asset('assets/images/'.$product['item']['photo']) }}" alt="Product image">
                                          </div>
                                          <div class="cart-info">
                                              <a href="{{ route('front.product',[$product['item']['id'],str_slug($product['item']['name'],'-')]) }}" style="color: black; padding:0 0px; "><h5>{{strlen($product['item']['name']) > 45 ? substr($product['item']['name'],0,45).'...' : $product['item']['name']}}</h5></a>
                                          <p style="font-size:12px;">{{$lang->cquantity}}: <span id="cqt{{$product['item']['id']}}">{{$product['qty']}}</span> <span>{{ $product['item']['measure'] }}</span></p>
                                          <p style="font-size:12px;">
                                          @if($gs->sign == 0)
                                              {{$curr->sign}}<span id="prct{{$product['item']['id']}}">{{round($product['price'] * $curr->value , 2) }}</span>
                                          @else
                                              <span id="prct{{$product['item']['id']}}">{{round($product['price'] * $curr->value , 2) }}</span>{{$curr->sign}}
                                          @endif
                                          </p>
                                          </div>
                                      </div>
                                      @endforeach
                                      @endif                                            
                                      </div>
                            </div>
                        </li>

                        <li class="list-inline-item g-color-primary g-mx-2">|</li>

                        <li class="mobile-search"><a href="javascript:void(0)" onclick="openNav()"><i class="g-pos-rel g-top-3 icon-education-045 u-line-icon-pro" style="background: transparent;color: #2385aa;font-size: 20px;"></i></a>
                        </li>

                        <li>
                            @if(Auth::guard('user')->check())
                            @php
                                $user = Auth::guard('user')->user();
                                $user_str = $user->name;
                                $user_name = explode(' ', $user_str);
                            @endphp
                            {{-- <a class="" style="color: #2385aa;border-radius: 0px;border-color: #2385aa;font-weight: 500;font-size: 14px;" href="{{route('user-dashboard')}}">
                                <span>
                                    @if($user->is_provider == 0)
                                        <img style="position:relative;bottom:5px;width: 25px; height: 25px; border-radius:30px;" src="{{ $user->photo ? asset('assets/images/'.$user->photo) :asset('assets/images/user.png')}}" alt="profile no image"></i> Welcome, {{ $user_name[0] }}
                                    @else
                                    <img style="position:relative;bottom:5px;width: 25px; height: 25px; border-radius:30px;" src="{{ $user->photo ? $user->photo :asset('assets/images/user.png')}}" alt="profile no image"></i> Welcome, {{ $user_name[0] }}
                                    @endif

                                    </span>
                            </a> --}}

                            
                            <div class="dropdown-user" style="margin-right:5px;">
                              <a class="" style="color: #2385aa;border-radius: 0px;border-color: #2385aa;font-weight: 500;font-size: 14px;" href="{{route('user-dashboard')}}">
                                <span>
                                    @if($user->is_provider == 0)
                                        <img style="position:relative;bottom:5px;width: 25px; height: 25px; border-radius:30px;" src="{{ $user->photo ? asset('assets/images/'.$user->photo) :asset('assets/images/user.png')}}" alt="profile no image"></i> Welcome, {{ $user_name[0] }}
                                    @else
                                    <img style="position:relative;bottom:5px;width: 25px; height: 25px; border-radius:30px;" src="{{ $user->photo ? $user->photo :asset('assets/images/user.png')}}" alt="profile no image"></i> Welcome, {{ $user_name[0] }}
                                    @endif

                                    </span>
                            </a>
                                <button class="dropbtn"><i class="icon-options-vertical"></i></button>
                                <div class="dropdown-content-user" style="background: transparent;">
                                
                                    <a class="" href="{{route('user-dashboard')}}" style="padding: .375rem .75rem;border-radius: 5px;border-color: #2385aa;font-weight: 500;font-size: 14px; color:white;background:#2385aa;" ><i class="icon-user" style="font-size:18px;background:transparent; color:white; "></i> Profile</a>
                                    <a class="" href="{{route('user-logout')}}" style="padding: .375rem .75rem;border-radius: 5px;border-color: rgb(129, 72, 84);font-weight: 500;font-size: 14px; color:white; background:coral;" onclick="event.preventDefault();document.getElementById('logout-form').submit();" ><i class="icon-logout" style="font-size:18px;background:transparent; color:white; "></i> Logout</a>
                                    <form id="logout-form" action="{{route('user-logout')}}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                  
                                

                                </div>
                            </div>
                            @else

                                <a class="" style="color: #2385aa;border-radius: 0px;border-color: #2385aa;font-weight: 500;font-size: 14px;" href="{{route('user-login')}}">
                                    {{-- <i class="fa fa-user"></i> <span>{{$lang->signinup}}</span> --}}
                                    <i class="icon-user" style="font-size:18px; background:transparent; color:#2385aa;" title="User Login"></i> <span id="login-text" title="User Login ">Login</span>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>



        </div>
    </div>
</div>


{{-- <div id="lab" class="header-middle-right-wrap text-right" style="text-align:center !important; padding-top:0px; display:none;">
<ul>
    <li id="lab-mobile"><a href="{{route('lab.index')}}" style="text-transform: uppercase; color:2385aa;">Lab Test</a></li>
    <li id="askdoctor-mobile"><a id="askdoctor-mobile-a" href="{{route('user-askdoctor-index')}}" style="text-transform: uppercase;color:#2385aa; " >Ask a Doctor Free</a></li>
</ul>
</div> --}}

<div class="header-bottom-area">
    <div class="container">
        <div class="row">
            <div id="prescription" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
                <style>
                    .hrt{margin-top:50px}
                    .heart{font-size:15px; margin:auto auto; color:white;animation: pulse 3s infinite;}

                    .pulse {
                        -webkit-animation-duration: 3s;
                        -webkit-animation-delay: 2s;
                        -webkit-animation-iteration-count: 5;
                    }
                    @keyframes pulse {
                        0%, 50%, 100% { transform: scale(1, 1); }
                        30%, 80% { transform: scale(0.85, 0.87); }
                        }
                    </style>

                {{-- <a href="{{ Auth::guard('user')->check() ? route('user-prescriptions.create') : '/upload-prescription' }}" style="font-size:14px; padding:10px;" class="text-center btn btn-xl u-btn-primary text-uppercase g-rounded-5 g-px-30 g-mr-10 g-mb-8 g-mt-8" data-animation="fadeInUp" data-animation-delay="0" data-animation-duration="1000" title="Upload Prescription">
                    <span class="icon-real-estate-079 u-line-icon-pro" aria-hidden="true"></span>
                    <span class="">
                        Upload Prescription
                    </span>
                </a> --}}
            </div>


            <div class="mobileMenuActive"></div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-5" style="padding:0px;">
                <div class="header-menu-wrap">
                    <ul>

                        {{-- <li><a href="{{route('front.index')}}">{{$lang->home}}</a></li> --}}
                        {{-- <li><a id="lab" href="{{route('lab.index')}}" style="text-transform: uppercase; font-size:13px;" title="Lab Test">Lab Test</a></li> --}}
                        {{-- <li><a href="{{route('front.blog')}}">{{$lang->blog}}</a></li> --}}

                        {{-- <li><a id="promotion" href="{{route('front.promotions')}}" style="text-transform: uppercase" title="Promotions of Advertisements">Promotions</a></li> --}}
                        {{-- <li><a id="askdoctor" href="/askdoctor/index" style="text-transform: uppercase;font-size:13px; " title="Get your queries addressed " >Ask a Doctor <span class="u-label g-bg-primary u-label--sm " style=" border-radius:30px;padding: 3px 6px 3px 6px;
                            font-size: 11px;">Free</span></a></li> --}}

                    </ul>
                </div>
            </div>

            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="header-search-box text-right" style="margin-bottom: -10px;">
                    <form action="{{route('front.search')}}" method="GET">
                        <input type="text"  style="width:90%;border-radius: 5px;font-weight:500;" class="ss" id="" name="product" placeholder="{{$lang->ec}}" required autocomplete="off">
                        <button type="submit" style="width:10%;border-top-right-radius: 5px; border-bottom-right-radius: 5px; margin-bottom:20px;"><i class="fa fa-search" title="Search Products "></i></button>
                    </form>
                </div>
                <div id="search-list-desktop" class="header-searched-item-list-wrap scroll-box" style="display: none; z-index:1000;border-radius:10px;">
                    <ul>

                    </ul>
                </div>
            </div>
            <div class="mobileSlickMenuActive">

            </div>

        </div>
    </div>
</div>




<script>
function openNav() {
document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
document.getElementById("myNav").style.width = "0%";
}

</script>

<script>
    $(window).on('load',function(){
          $('#cover').fadeOut('slow');
      });
</script>



@if(Request::segment(1)!='lab')
<header id="js-header" class="u-header u-header--static">
    <div class="u-header__section u-header__section--light g-bg-white g-transition-0_3 ">
        <nav class="js-mega-menu navbar navbar-expand-lg hs-menu-initialized hs-menu-horizontal g-pa-0 mb-0 justify-content-center">
            <div class="">
                <h5 id="categories" style="padding-top:10px; color: #2385aa; display:none;
                    font-weight: 600;">CATEGORIES</h5>

                        <button class="navbar-toggler navbar-toggler-right btn g-line-height-1 g-brd-none g-pa-0 g-pos-abs g-top-minus-3 g-right-0 collapsed" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
                            <span class="hamburger hamburger--slider">
                            <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                            </span>
                            </span>
                        </button>
                        <!-- End Responsive Toggle Button -->

                        <div style="display:flex;margin:0rem 0rem;">
                            <!-- Navigation -->
                            <div class="navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg g-mr-40--lg collapse" id="navBar" style="">
                                <ul id="tablet-navbar" class="navbar-nav  g-pos-rel g-font-weight-600 ml-auto g-brd-10" style="border-radius:10px;">

                                        {{-- @foreach($categories->sortBy('cat_name') as $category)

                                        <li class="nav-item hs-has-sub-menu menu_hover g-px-10">

                                        <a id="nav-link--pages--about" class="nav-link g-color-black g-font-weight-400 g-font-size-13" style="padding-top:5px; padding-bottom:5px;" href="{{route('front.category',$category->cat_slug)}}" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu--pages--about" >{{$category->cat_name}}</a>


                                        <ul class="{{count($category->subs) > 0?'hs-sub-menu':''}} list-unstyled g-bg-white u-shadow-v11 g-brd-top g-brd-primary g-brd-top-2 g-min-width-220 g-mt-minus-2 animated g-brd-10" id="nav-submenu--pages--about" aria-labelledby="nav-link--pages--about" style="display: none;border-radius:10px;">
                                            @foreach($category->subs()->where('status','=',1)->orderBy('sub_name')->get() as $subcategory)
                                            <li class="{{count($subcategory->childs) > 0?'hs-has-sub-menu':''}} dropdown-item g-font-weight-600 g-px-10 g-py-7 menu_hover " aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu--pages--about">
                                            <a class="nav-link  g-color-black g-font-weight-400 g-font-size-13" style="padding-top:5px; padding-bottom:5px;" href="{{route('front.subcategory',$subcategory->sub_slug)}}">{{$subcategory->sub_name}}</a>
                                            <ul class="hs-sub-menu list-unstyled u-shadow-v11 g-brd-top g-brd-primary g-brd-top-2 g-min-width-220 g-mt-minus-2 animated" id="nav-submenu--pages--about" aria-labelledby="nav-link--pages--about" style="display: none; border-radius:10px;">
                                                    @foreach($subcategory->childs()->where('status','=',1)->orderBy('child_name')->get() as $childcategory)

                                                    <li class="dropdown-item menu_hover ">
                                                    <a class="nav-link g-color-black g-font-weight-400 g-font-size-13" style="padding-top:5px; padding-bottom:5px;" href="{{route('front.childcategory',$childcategory->child_slug)}}">{{ $childcategory->child_name }}</a>
                                                    </li>
                                                    @endforeach



                                                </ul>
                                            </li>
                                            @endforeach
                                        </ul>

                                        </li>
                                        @endforeach --}}

                                    @foreach($categories->sortBy('cat_name')->slice(0, 7) as $category)
                                        <li class="hs-has-mega-menu nav-item g-mx-5--lg g-mx-5--xl" data-animation-in="fadeIn" data-animation-out="fadeOut" data-position="right">
                                            <a id="mega-menu-label-4" class="nav-link text-uppercase g-color-primary--hover g-px-5 g-py-5 g-font-size-11" href="{{route('front.category',$category->cat_slug)}}" aria-haspopup="true" aria-expanded="false">
                                                {{$category->cat_name}}
                                                <i class="hs-icon hs-icon-arrow-bottom g-font-size-11 g-ml-7"></i>
                                            </a>

                                            <!-- Mega Menu -->
                                            <div class="w-100 hs-mega-menu u-shadow-v11 g-text-transform-none g-brd-top g-brd-primary g-brd-top-2 g-bg-white g-pa-30 animated hs-position-right fadeOut" aria-labelledby="mega-menu-label-4" style="display: none;border-radius:10px;">
                                              <span class="u-label g-bg-primary g-rounded-3 g-mr-10 g-mb-15"><i class="icon-direction g-mr-3"></i>{{$category->cat_name}}</span>
                                              <div class="row">
                                                    @foreach($category->subs()->where('status','=',1)->orderBy('sub_name')->get() as $subcategory)
                                                    <div class="col-sm-6 col-md-2 g-mb-30 g-mb-0--sm">
                                                        <!-- Links -->

                                                        <div class="mb-5">
                                                          <a class="d-block g-font-weight-600 text-uppercase mb-2 g-font-size-12" style="color: #2385aa;" href="{{route('front.subcategory',$subcategory->sub_slug)}}">{{$subcategory->sub_name}}</a>
                                                          <ul class="list-unstyled mb-0">
                                                              @foreach($subcategory->childs()->where('status','=',1)->orderBy('child_name')->get() as $childcategory)
                                                              <li>
                                                              <a class="d-block g-color-text g-color-primary--hover g-text-underline--none--hover g-py-5 g-font-size-11" style="color: gray" href="{{route('front.childcategory',$childcategory->child_slug)}}">{{ $childcategory->child_name }}</a>
                                                              </li>
                                                              @endforeach
                                                          </ul>
                                                      </div>
                                                        <!-- End Links -->
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- End Mega Menu -->
                                        </li>
                                    @endforeach
                                </ul>
                            
                               
                               
                                </div>
                            <!-- End Navigation -->
                        </div>

                        <div style="display:flex;margin:0rem 0rem;">
                          <!-- Navigation -->
                          <div class="navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg g-mr-40--lg collapse" id="navBar" style="">
                              <ul id="tablet-navbar" class="navbar-nav g-pos-rel ml-auto g-font-weight-600 g-brd-10" style="border-radius:10px;">
                                @foreach($categories->sortBy('cat_name')->slice(7, 18) as $category)
                                <li class="hs-has-mega-menu nav-item g-mx-5--lg g-mx-5--xl" data-animation-in="fadeIn" data-animation-out="fadeOut" data-position="right">
                                    <a id="mega-menu-label-4" class="nav-link text-uppercase g-color-primary--hover g-px-5 g-py-5 g-font-size-11" href="{{route('front.category',$category->cat_slug)}}" aria-haspopup="true" aria-expanded="false">
                                        {{$category->cat_name}}
                                        <i class="hs-icon hs-icon-arrow-bottom g-font-size-11 g-ml-7"></i>
                                    </a>

                                    <!-- Mega Menu -->
                                    <div class="w-100 hs-mega-menu u-shadow-v11 g-text-transform-none g-brd-top g-brd-primary g-brd-top-2 g-bg-white g-pa-30 animated hs-position-right fadeOut" aria-labelledby="mega-menu-label-4" style="display: none;border-radius:10px;">
                                      <span class="u-label g-bg-primary g-rounded-3 g-mr-10 g-mb-15"><i class="icon-direction g-mr-3"></i>{{$category->cat_name}}</span>
                                      <div class="row">
                                            @foreach($category->subs()->where('status','=',1)->orderBy('sub_name')->get() as $subcategory)
                                            <div class="col-sm-6 col-md-2 g-mb-30 g-mb-0--sm">
                                                <!-- Links -->

                                                <div class="mb-5">
                                                  <a class="d-block g-font-weight-600 text-uppercase mb-2 g-font-size-12" style="color: #2385aa;" href="{{route('front.subcategory',$subcategory->sub_slug)}}">{{$subcategory->sub_name}}</a>
                                                  <ul class="list-unstyled mb-0">
                                                      @foreach($subcategory->childs()->where('status','=',1)->orderBy('child_name')->get() as $childcategory)
                                                      <li>
                                                      <a class="d-block g-color-text g-color-primary--hover g-text-underline--none--hover g-py-5 g-font-size-11" style="color: gray" href="{{route('front.childcategory',$childcategory->child_slug)}}">{{ $childcategory->child_name }}</a>
                                                      </li>
                                                      @endforeach
                                                  </ul>
                                              </div>
                                                <!-- End Links -->
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- End Mega Menu -->
                                </li>
                            @endforeach
                              </ul>
                            </div>
                          </div>
            </div>
        </nav>
    </div>
</header>
@endif


@php
$i=1;
$j=1;
@endphp
<script>
    $(document).ready(function(){
      $("#proceed-checkout").on("click", function(){
        $(".loading-icon").removeClass("hide");
        // $("#proceed-payment").attr("disabled", true);
        $(".btn-txt").text("Processing");
      });
    });
    </script>


