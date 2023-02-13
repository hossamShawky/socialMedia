
$("html,body").css("overflow","non-visible")
 	function goBack(){
		history.go(-1);
    }

    function goForward(){
		history.go(1);
    }
    

// scroll to top of page
   


$(window).scroll(function(){  

    if(document.body.scrollTop > 40 || document.documentElement.scrollTop>40)
    {
        $("#btn-top").fadeIn(1000);
        $(".navbar").css("padding","5px");
        $(".navbar").addClass("fixed-top");
    }
    else{
      $("#btn-top").fadeOut(800);
      $(".navbar").removeClass("fixed-top");

    }    


});


$("#btn-top").click(function(){

$('html,body').animate({scrollTop:0},2000);      
        });


        // loading


$(document).ready(function(){

// $("#loading").remove()

$(".spinner ").fadeOut(2000,function(){
  $("#loading ").fadeOut(3000); 
  $("#loading").remove();
}); 
  
 });
 

 