/*
    Description:    Form Framework Pro
    Author:         InsideLab
    Version:        1.0
*/

/*  --------------------------------------------------
    :: Event Form
    -------------------------------------------------- */

var emailregex = "^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$";

jQuery.noConflict()(function($) {
    $(document).ready(function() {
        // $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);

        $('input, select').each(function(index, element) {
            $(this).attr('title', $(this).attr('placeholder'));
        });

        $('input, select').tooltipster({
            offsetY: 2,
            position: 'top'
        });

        $.validator.addMethod(
            "regexemail",
            function(value, element, regexp) {
                var check = false;
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            }, "Please enter a valid email id"
        );

        $(".irequire input").addClass('itrequired');
        $(".irequire select").addClass('itrequired');
        $(".irequire textarea").addClass('itrequired');
        $(".irequire input[type=file]").removeClass('itrequired');


        $("input[type=text]").attr('maxlength', 60);

        $("textarea").attr('maxlength', 2000);

        $('#section_register').validate({
            onfocusout: false,
            onkeyup: false,
            rules: {
                name: {
                    required: true,
                },
                address: {
                    required: true
                },
                email: {
                    required: true,
                    regexemail: emailregex
                },
                phonenumber: {
                    required: true
                },
                batchyear: {
                    required: true,
                    number: true
                },
                course: {
                    required: true
                },
                captcha: {
                    required: true,
                    remote: 'php/captcha/processor-captcha.php'
                }
            },
            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
                $(element).tooltipster('show');
            },
            success: function(label, element) {
                $(element).tooltipster('hide');
            },
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    beforeSubmit: function() {
                        $.blockUI();
                        $('#save-button').attr('disabled', 'disabled');
                    },
                    success: function(response) {
                        if (response === 'duplicate') {
                            $.unblockUI();
                            swal({
                                title: "Error!",
                                text: "This email already exist in our Database.",
                                type: "error",
                                animation: false
                            });
                        } else if (response === 'Failed') {
                            $.unblockUI();
                            swal({
                                title: "Error!",
                                text: "Please try again",
                                type: "error",
                                animation: false
                            });
                        } else {
                            window.location = "http://jbims.edu/alumnimeet2015/payment/TestSsl.php?uid=" + response;
                        }
                        $('#save-button').removeAttr('disabled');
                        $('#section_register').each(function() {
                            this.reset();
                        });
                    },
                });
            }
        });
    });
});
