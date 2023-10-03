```<template>
    <a :class="btnClass" :href="btnUrl">{{ btnText }}</a>
</template>

<script>
export default {
  props: {
    btnClass: String, 
    btnText: String,
    btnUrl: String,  
  },
};

</script>

<style>


.btn {
display: block;
margin: 0 auto;
box-shadow: inset 0px 0px 6px #fff;
-webkit-box-shadow: inset 0px 0px 6px #fff;

border-radius: 10px;

font: bold 1em Helvetica, Sans-Serif;
text-align: center;
text-transform: uppercase;
text-decoration: none;
}

.blue{
background: cadetblue;
background: -moz-linear-gradient(top, #87CEEB 0%, #4682B4 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#87CEEB), color-stop(100%,#4682B4));
color: #3090C7;
border: 1px solid #62C2F9;
text-shadow: 0px 1px 2px #62C2F9;
}

.blue:hover {
  color:#4682B4
}

.red{
background: rosybrown !important;
background: -moz-linear-gradient(top, rosybrown 0%, rosybrown 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#87CEEB), color-stop(100%,#4682B4));
color: #c7305d;
border: 1px solid #c7305d;
text-shadow: 0px 1px 2px #c7305d;
}

.red:hover{
   color: #8b002a;
}

</style>

