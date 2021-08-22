 
 (function(){

   

   
    document.addEventListener('DOMContentLoaded',function(){
 
       var toggler = document.querySelector('.navbar-toggler');
 
       toggler.addEventListener('click', function(){
 
          var links = document.querySelector('.nav ul');
 
          if(links.style.display=="none"){
             links.style.display="flex";
          }else{
             links.style.display="none";
          }  
       });
 
 
       window.addEventListener('resize',function(){
          if(this.innerWidth>550){
             document.querySelector('.nav ul').style.display="flex";
          }else{
             document.querySelector('.nav ul').style.display="none";
          }
       });


       //link active :
       //1.on selectionne le lien
       // on supprime active du lien precedent
       // on ajoute active au lien present
       

      
       
       var href = window.location.href;
       //console.log("href :"+href);
       var hashed = href.split("/").pop();
       //console.log("hashed: "+hashed);
       
       

       if(hashed==""){
          //console.log("hashed2=index.php");
         var a = document.querySelector('a[href="index.php"]');
         //a.parentNode.style.backgroundColor="#ff55778a";
         //a.parentNode.style.borderRadius="5px";
         //a.parentNode.style.fontWeight="bold";

         a.parentNode.style.borderBottom="solid 3px #ff55778a";


         //console.log(" le lien : "+a);
       }else{

         var a = document.querySelector('a[href="'+ hashed +'"]');
         
         //a.parentNode.style.backgroundColor="#ff55778a";
         //a.parentNode.style.borderRadius="5px";
         //a.parentNode.style.fontWeight="bold";


         
         a.parentNode.style.borderBottom="solid 3px #ff55778a";


            //console.log(" le lien : "+a);

       }


       
       




    });
  })();