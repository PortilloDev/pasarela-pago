var $form = $('#checkout-form');

$form.submit(function(event) {
    $('charge-error').addClass('hidden');
    $form.find('button').prop('disabled', true);
    Stripe.card.createToken({
        number:
    })

});
