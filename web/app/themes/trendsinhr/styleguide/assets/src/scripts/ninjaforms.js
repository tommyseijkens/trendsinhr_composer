(function ($) {

    $(document).ready(function () {

        window.wpid = $("meta[name=wp]").data("id");

        // functions
        ninjaform();
        ninjaFormsClick();

    });

// =============================
// = Check for added elements
// =============================
$(document).bind('DOMNodeInserted', function (e) {
    var element = e.target.className;

    if (e.target.className == 'nf-form-cont') {
        ninjaFormsChange();
    }
});

// =============================
// Detect changes for Ninja Forms
// =============================
    function ninjaFormsClick() {
        // Fix checkbox added
        $('label').on("mouseleave", function (e) {
            ninjaFormsChange();
        });

    }


    function ninjaFormsChange() {
        // Fix Ninja Forms checkbox
        $('input[type="checkbox"]').change(function () {
            var val = $(this).attr('id');
            if ($(this).is(":checked")) {
                $("label[for='" + val + "']").parent().addClass("nf-checked-label");
            } else {
                $("label[for='" + val + "']").parent().removeClass("nf-checked-label");
            }
        });

    }

// =============================
// = Ninja form
// Fix labels checkbox and radio
// =============================
    function ninjaform() {
        $('.ninja-forms-cont input[type="checkbox"], .ninja-forms-cont input[type="radio"]').each(function () {

            // vars
            $elementId = $(this).attr('id');
            $parent = $(this).parent();
            $parentText = $parent.text();

            // append
            $parent.append('<label for="' + $elementId + '">' + $parentText + '</label>');

        });


    }

}(jQuery));