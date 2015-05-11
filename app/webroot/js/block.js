$(function(){
    setInterval(function(){
        $("#blockdata").load("/blocks/getblockdata");
    },5000);
});