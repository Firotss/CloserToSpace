function imgsrc(p1){
    
    $.ajax({
      url: 'func.php',
      type: 'GET',
      data: { 
          "txt": p1},
      error: function(){
      console.log('ERROR');
      }
   })
  }


