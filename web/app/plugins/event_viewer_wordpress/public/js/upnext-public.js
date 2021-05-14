/**
 * @file
 * Provides some features for the event viewer module.
 */

(function ($) {

  $(function () {

    /**
     * Modal for details.
     *
     * Provides a popup when clicked on a event
     * date and a close button.
     */
    $('.popup-modal').magnificPopup({
      type: 'inline',
      closeOnBgClick: true,
    });
    $(document).on('click', '.popup-close', function (e) {
      e.preventDefault();
      $.magnificPopup.close();
    });

    /**
     * Validation postcode.
     *
     * Provides a custom regex for postcode.
     */
    $.validator.addMethod("postalcodeNL", function (value, element) {
      return this.optional(element) || /^[1-9][0-9]{3}\s?[a-zA-Z]{2}$/.test(value);
    }, 'Vul hier een geldige postcode in.');

    /**
     * Validation postcode.
     *
     * Provides a custom regex for email. The default
     * regex is not sufficient.
     */
    $.validator.addMethod("emailRegex", function (value, element) {
      return this.optional(element) || (/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(value));
    }, 'Vul hier een geldig e-mailadres in.');


    /**
     * Enable validation for the event form.
     *
     * Some fields have custom validation and
     * for the checkboxes the error placement is
     * switched for better display.
     */
    var formSubscribe = $("#event-viewer-subscribe-form");

    formSubscribe.validate({
      rules: {
        'Organisation[Zipcode]': {
          postalcodeNL: true
        },
        'Organisation[HouseNumber]': {
          number: true
        },
        'Person[EmailAddress]': {
          emailRegex: true
        }
      },
      errorPlacement: function (error, element) {
        if (element[0].type == 'checkbox') {
          error.insertAfter(element.parent().children('label'));
        }
        else {
          error.insertAfter(element);
        }

      }
    });

    /**
     * Show breakouts
     */
    var EventIdSelected = $('[name="EventId"]').val();
    checkBreakout(EventIdSelected);

    $('[name="EventId"]').on('change', function () {
      checkBreakout(this.value);
    });

    function checkBreakout(id) {
      if ($('.breakout[data-breakout="' + id + '"]')) {
        $('.breakout').hide();
        $('.breakout select').prop("disabled", true);
        $('.breakout[data-breakout="' + id + '"]').show();
        $('.breakout[data-breakout="' + id + '"] select').prop("disabled", false);
      }
    }

    /**
     * Display message when form validation is accepted.
     *
     * When the form is submitted the code below only
     * executes when all fields are valid. Submitting can take
     * a few seconds and when waiting a message is displayed.
     * This message can be edited at the event viewer settings page.
     */
    formSubscribe.submit(function (event) {

      var formSend = false;

      if (formSubscribe.valid()) {
        if (!formSubscribe.children('div').hasClass('loading-text')) {
          formSubscribe.append('<div class="loading-text">Bezig met versturen. Een ogenblik geduld.</div>');
        }
        formSubscribe.addClass('loading');
        formSend = true;
      }

      if (!formSend) {
        event.preventDefault();
      }

    });
  });

})(jQuery);