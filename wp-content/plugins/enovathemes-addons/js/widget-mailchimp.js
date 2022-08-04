(function($){

    var valid = "invalid";
    function validateValue($value, $target, $placeholder,$email){
        if ($email == true) {
            var n = $value.indexOf("@");
            var r = $value.lastIndexOf(".");
            if (n < 1 || r < n + 2 || r + 2 >= $value.length) {
                valid =  "invalid";
            } else {
                valid = "valid";
            }
            
            if ($value == null || $value == "" || valid == "invalid") {
                $target.addClass('visible');
            } else {
                $target.removeClass('visible');
            }

        } else {
            if ($value == null || $value == "" || $value == $placeholder) {
                $target.addClass('visible');
            } else {
                $target.removeClass('visible');
            }
        }
    };

    $('.et-mailchimp-form').each(function(){

        var $this = $(this);

        $this.submit(function(event) {

            event.preventDefault();

            var formData = $this.serialize();

            var email   = $this.find("input[name='email']"),
                fname   = $this.find("input[name='fname']"),
                lname   = $this.find("input[name='lname']"),
                phone   = $this.find("input[name='phone']"),
                list    = $this.find("input[name='list']");

            validateValue(email.val(), email.next(".alert"), email.attr('data-placeholder'), true);
            if (fname.length && fname.attr('data-required') == "true") {validateValue(fname.val(), fname.next(".alert"), fname.attr('data-placeholder'), false);}
            if (lname.length && lname.attr('data-required') == "true") {validateValue(lname.val(), lname.next(".alert"), lname.attr('data-placeholder'), false);}
            if (phone.length && phone.attr('data-required') == "true") {validateValue(phone.val(), phone.next(".alert"), phone.attr('data-placeholder'), false);}

            if (email.val() != email.attr('data-placeholder') && valid == "valid"){

                if(fname.length && fname.attr('data-required') == "true" && fname.val() == fname.attr('data-placeholder')){event.preventDefault();}
                if(lname.length && lname.attr('data-required') == "true" && lname.val() == lname.attr('data-placeholder')){event.preventDefault();}
                if(phone.length && phone.attr('data-required') == "true" && phone.val() == phone.attr('data-placeholder')){event.preventDefault();}

                $this.find(".sending").addClass('visible');

                $.ajax({
                    type: 'POST',
                    url: $this.attr('action'),
                    data: formData
                })
                .done(function(response) {
                    $this.find(".sending").removeClass('visible');
                    $this.find(".et-mailchimp-success").addClass('visible');
                    setTimeout(function(){
                        $this.find(".et-mailchimp-success").removeClass('visible');
                    },2000);
                })
                .fail(function(data) {
                    $this.find(".sending").removeClass('visible');
                    $this.find(".et-mailchimp-error").addClass('visible');
                    setTimeout(function(){
                        $this.find(".et-mailchimp-error").removeClass('visible');
                    },2000);
                })
                .always(function(){
                    setTimeout(function(){
                        // Clear the form.
                        $this.find("input[name='email']").val(email.attr('data-placeholder'));
                        $this.find("input[name='fname']").val(fname.attr('data-placeholder'));
                        $this.find("input[name='lname']").val(lname.attr('data-placeholder'));
                        $this.find("input[name='phone']").val(phone.attr('data-placeholder'));
                    },2000);
                });

            }
        });
    });

})(jQuery);