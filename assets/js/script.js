( function($){
    console.log('Cart Notice JS Loaded');
    const conditionalNotice = $(".cd-conditional-discount");

    const originalFetch = window.fetch;

    window.fetch = function(){
        const response = originalFetch.apply(this, arguments);
        const url = arguments[0];

        if(typeof url === 'string' && url.includes('/wc/store/v1/batch')){
            response.then(res => {
                res.clone().json().then(data => {
                    updateNotice(data?.responses[0]?.body);
                })
            })
        }

        return response;
    }
    
    function updateNotice(data){
        if (!data?.fees || data.fees.length === 0) {
            conditionalNotice.hide();
            return;
        }

        const hasSpecialDiscount = data.fees.some(fee =>
            fee.key && fee.key.includes('special-discount')
        );

        console.log(hasSpecialDiscount);

        if (hasSpecialDiscount) {
            conditionalNotice.show();
        } else {
            conditionalNotice.hide();
        }
    }

}(jQuery));