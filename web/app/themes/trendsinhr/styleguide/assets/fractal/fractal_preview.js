// =============================
// = Document Ready
// =============================
$(document).ready(function () {
  popupModal();
  inputFieldUpload();
  dynamicModal();
  enablePopovers();
  enableScrollSpy();
  enableTooltips();
});

// =============================
// = Window onload
// =============================
$(window).on("load", function() {

});

// =============================
// = Window Scroll
// =============================
$(window).scroll(function () {

});

// =============================
// = Window Resize
// =============================
$(window).resize(function () {

});

// =============================
// = Ajax Complete
// =============================
$(document).ajaxComplete(function () {

});

// =============================
// = Functions
// =============================
function inputFieldUpload() {
  $('<span>&nbsp;</span>').insertAfter('input[type="file"] + label');
  $('input[type="file"]').change(function (e) {
    if (e.target.files.length > 0) {
      var label = $(this).next('label');
      var fileName = e.target.files[0].name;
      label.next('span').html(fileName);
      label.text('Wijzigen');
    }
  });
}

function popupModal() {
  $('.popup-modal').magnificPopup({
    type: 'inline',
    modal: true
  });
  $(document).on('click', '.popup-modal-dismiss', function (e) {
    e.preventDefault();
    $.magnificPopup.close();
  });
}

function dynamicModal() {
  $('.openPopup').on('click',function(){
    var dataURL = $(this).attr('data-href');
    $('.modal-body-url').load(dataURL,function(){
      $('#dynamicModal').modal({show:true});
    });
  });
}

function enablePopovers() {
  $('[data-toggle="popover"]').popover();
}

function enableScrollSpy() {
  $(".scrollspy-example").scrollspy({ target: '#list-example' });
}

function enableTooltips() {
  $('[data-toggle="tooltip"]').tooltip();
}
