function load(){
    
    $.ajax({
      url: 'accept.php',
      error: function(){
      console.log('ERROR');
      }
   })
  }


