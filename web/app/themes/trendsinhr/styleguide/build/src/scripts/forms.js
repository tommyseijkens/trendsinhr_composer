(function ($) {

    $(document).ready(function () {
        if ($("form#newsletter").length) {
            tripolisForm();
            $("form#newsletter").bind("submit", validate);
        }
    });



// =============================
// = Tripolis
// =============================
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validate() {
    $("#result").text("");
    var email = $("#email").val();
    if (validateEmail(email)) {
        $("#result").css("display", "none");
        return true;
    } else {
        $("#result").text("* e-mailadres is verplicht");
        $("#result").css("display", "block");
    }
    return false;
}

    // =============================
    // = Tripolis
    // =============================
    function tripolisForm() {

        // Prevent default form functions.
        $(document).on('submit', '.form-tripolis', function (event) {
            event.preventDefault()
        })

        // Submit.
        $('.form-tripolis input[type="submit"]').click(function (event) {
            if (validate()) {
                var $form = $(this).closest('form');
                if ($form[0].checkValidity()) {
                    $form.addClass('form-tripolis__form--loading')
                    $(".form-tripolis__message").hide();
                    var formData = $form.serializeArray()
                    $.ajax({
                        type: 'post',
                        url: 'https://subscribe.driessengroep.nl/subscribe/process/',
                        data: formData,
                        statusCode: {
                            200: function () {
                                $(".form-tripolis__group").hide();
                                $(".form-tripolis__message--success").show();
                            }
                        }
                    }).done(function (data) {

                    }).fail(function (jqXHR, textStatus, errorThrown) {
                        $form.removeClass('form-tripolis__form--loading')
                        $(".form-tripolis__message--warning").show();
                    }).always(function () {
                    })
                }
            }
        })
    }


}(jQuery));