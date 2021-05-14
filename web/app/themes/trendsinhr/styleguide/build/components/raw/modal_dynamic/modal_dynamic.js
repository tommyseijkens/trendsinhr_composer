$('.openPopup').on('click',function(){
  var dataURL = $(this).attr('data-href');
  $('.modal-body-url').load(dataURL,function(){
    $('#dynamicModal').modal({show:true});
  });
});
