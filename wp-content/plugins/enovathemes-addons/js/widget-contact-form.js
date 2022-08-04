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

    $('.et-contact-form').each(function(){

        var $this = $(this);


        $this.submit(function(event) {

            event.preventDefault();

            var formData = $this.serialize();

            var name    = $this.find("input[name='name']");
            var email   = $this.find("input[name='email']");
            var message = $this.find("textarea[name='message']");

            validateValue(email.val(), email.next(".alert"), email.attr('data-placeholder'), true);
            validateValue(name.val(), name.next(".alert"), name.attr('data-placeholder'), false);
            validateValue(message.val(), message.next(".alert"), message.attr('data-placeholder'), false);

            if (
                email.val() != email.attr('data-placeholder') && valid == "valid" && 
                name.val() != name.attr('data-placeholder') && 
                message.val() != message.attr('data-placeholder')
            ){

                $this.find(".sending").addClass('visible');

                $.ajax({
                    type: 'POST',
                    url: $this.attr('action'),
                    data: formData
                })
                .done(function(response) {

                    $this.find(".sending").removeClass('visible');
                    $this.find(".success").addClass('visible');

                    setTimeout(function(){
                        $this.find(".success").removeClass('visible');
                    },2000);

                })
                .fail(function(data) {

                    $this.find(".sending").removeClass('visible');
                    $this.find(".error").addClass('visible');

                    setTimeout(function(){
                        $this.find(".error").removeClass('visible');
                    },2000);

                })
                .always(function(){
                    setTimeout(function(){
                        // Clear the form.
                        $this.find("input[name='email']").val(email.attr('data-placeholder'));
                        $this.find("input[name='name']").val(name.attr('data-placeholder'));
                        $this.find("textarea[name='message']").val(message.attr('data-placeholder'));
                    },2000);
                });

            }
        });
      
    });

})(jQuery);