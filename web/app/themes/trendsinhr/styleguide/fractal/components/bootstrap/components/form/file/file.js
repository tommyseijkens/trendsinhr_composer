$('<span>&nbsp;</span>').insertAfter('input[type="file"] + label');
$('input[type="file"]').change(function (e) {
  if (e.target.files.length > 0) {
    var label = $(this).next('label');
    var fileName = e.target.files[0].name;
    label.next('span').html(fileName);
    label.text('Wijzigen');
  }
});
