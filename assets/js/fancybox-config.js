$(document).ready(function() {
  $(".enlarge").fancybox();
});

$('.custom-file-input').on('change', function() {
  let photo = $(this).val().split('\\').pop();
  $(this).next('.custom-file-label').addClass("selected").html(photo);
});

function readPhoto(input) {
 if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#check_photo').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

function enlargePhoto(a) {
 if (a.files && a.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#check_enlarge_photo').attr('href', e.target.result);
    }

    reader.readAsDataURL(a.files[0]);
  }
}

$("#photo").change(function(){
   readPhoto(this);
});

$("#photo").change(function(){
   enlargePhoto(this);
});
