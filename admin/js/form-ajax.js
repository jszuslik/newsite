jQuery('#nrw-footer-contact').submit(function (event) {
    var inputs = jQuery('#nrw-footer-contact :input');

    var values = {};
    inputs.each(function(){
        values[this.name] = jQuery(this).val();
    });
    console.log(values);
    jQuery.ajax({
        url: nrw_ftr_ajax.ajax_url,
        type: 'post',
        data: values,
        success: function (response) {
            var j = JSON.parse(response);
            var form = jQuery('#nrw-footer-contact');
            form.find("input[type=text], input[type=email], textarea").val("");
            form.replaceWith(j.msg);
            // nrw_send_email();
        }
    });

    event.preventDefault();
});

function nrw_send_email() {
    jQuery.ajax({
       url: nrw_ftr_ajax.ajax_url,
       type: 'post',
       data: {
           action: 'nrw_send_form_submission'
       },
       success: function (response) {
           console.log(response);
       }
    });
}