<script src="js/validate.js"></script>
<script>
  $(document).on('click','.btnDeleteBook', function(e){
    e.preventDefault();
    var id = $(this).val();
    var tr = $(this).closest('tr');
    
    $.ajax({
      url: '/book/'+id,
      type : 'DELETE',
      data: {
        "_token": "{{ csrf_token() }}"
      },
      success : function(data){
        tr.remove();
        var success ='';
        success += 
          '<div class="card-header p-2"> \
            <div class="alert alert-primary alert-dismissible fade show" role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                <span aria-hidden="true">&times;</span>\
                <span class="sr-only">Close</span>\
              </button>\
              <strong>Notify!</strong> Delete Book successfully!\
            </div>\
          </div>';
        $('#alertDelete').html(success);
      },
      error : function(){
        var success ='';
        success += 
          '<div class="card-header p-2"> \
            <div class="alert alert-warning alert-dismissible fade show" role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                <span aria-hidden="true">&times;</span>\
                <span class="sr-only">Close</span>\
              </button>\
              <strong>Notify!</strong> Delete Book failed!\
            </div>\
          </div>';
        $('#alertDelete').html(success);
      },
      always : function(){
          console.log('complete');
      }
    });
  });
   
  $(document).on('click','.btnRestoreBook', function(e){
    e.preventDefault();
    var id = $(this).val();
    var tr = $(this).closest('tr');
  
    $.ajax({
      url: 'book/restore/'+id,
      type : 'PUT',
      data: {
        "_token": "{{ csrf_token() }}"
      },
      success : function(data){
        tr.remove();
        var success ='';
        success += 
          '<div class="card-header p-2"> \
            <div class="alert alert-primary alert-dismissible fade show" role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                <span aria-hidden="true">&times;</span>\
                <span class="sr-only">Close</span>\
              </button>\
              <strong>Notify!!</strong> Book recovery successful!\
            </div>\
          </div>';
        $('#alertRestore').html(success);
      },
      error : function(){
        var success ='';
        success += 
          '<div class="card-header p-2"> \
            <div class="alert alert-warning alert-dismissible fade show" role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                <span aria-hidden="true">&times;</span>\
                <span class="sr-only">Close</span>\
              </button>\
              <strong>Notify!</strong> Recovery book failed!\
            </div>\
          </div>';
        $('#alertDelete').html(success);
      },
      always : function(){
        console.log('complete');
      }
    });
  }); 
</script>
