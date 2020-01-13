<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
jQuery(document).ready(function(){

    jQuery('body').on('change','#google_language_translator select.goog-te-combo',function(){
 var val=jQuery(this).val();
       
      if(val!=''){
     var url= window.location.href;
      
       if(url.indexOf(val) == -1){
       
         var str='/?lang=';
         
         if(url.indexOf(str) != -1){
          var res= url.split("?");
       var url1= res[0]+'?lang='+val;
         }else{
         var url1= window.location.href+'?lang='+val;
         }
        
       }else{
            //var url1= window.location.href;
          var str='/?lang=';
        if(url.indexOf(str) != -1){
          var res= url.split("?");
       var url1= res[0]+'?lang='+val;
         }else{
         var url1= window.location.href+'?lang='+val;
         }
       }
      }else{
       var url1= window.location.href;
      }
   
      setTimeout(function(){ window.location.href=url1; }, 800);
      //window.location.href=url1;
        
});
  
});
</script>
<!-- end Simple Custom CSS and JS -->
