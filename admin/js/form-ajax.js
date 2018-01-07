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
            alert('Success');
            console.log(response);
        }
    });

    event.preventDefault();
});