<script>
    document.addEventListener('click', function (event) {
        var addToCartButton = event.target.closest('.add_to_cart');

        if (addToCartButton) {
            event.preventDefault();

            var product_id = addToCartButton.getAttribute('data-product-id');
            var product_qty = addToCartButton.getAttribute('data-quantity');

            var token = "{{ csrf_token() }}";
            var path = "{{route('cart.store')}}";
            var xhr = new XMLHttpRequest();

            xhr.open('POST', path, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-CSRF-Token', token);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    // Restore the button text
                    addToCartButton.innerHTML = '<span>add to cart</span>';

                    if (xhr.status === 200) {
                        try {
                            var data = JSON.parse(xhr.responseText);

                            document.getElementById('header-ajax').innerHTML = data.header;
                            if (data.status) {
                                swal({
                                    title: "Good Job!",
                                    text: data.message,
                                    icon: "success",
                                    button: "OK!"
                                });
                            }
                        } catch (error) {
                            console.error('Error parsing JSON response:', error);
                        }
                    }
                }
            };

            addToCartButton.innerHTML = '<i class="fa fa-spinner fa-spin" style="margin-right: 5px"></i>Loading.....';

            var requestData = 'product_id=' + encodeURIComponent(product_id) + '&product_qty=' + encodeURIComponent(product_qty);

            xhr.send(requestData);
        }

    });

    document.addEventListener('click', function (event) {
        var cartDeleteButton = event.target.closest('.cart_delete');

        if (cartDeleteButton) {
            event.preventDefault();

            var cartId = cartDeleteButton.getAttribute('data-id');

            var token = "{{ csrf_token() }}";
            var path = "{{route('cart.delete')}}";
            var xhr = new XMLHttpRequest();

            xhr.open('POST', path, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-CSRF-Token', token);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        try {
                            var data = JSON.parse(xhr.responseText);
                            document.getElementById('header-ajax').innerHTML = data.header;

                            if (data.status) {
                                swal({
                                    title: "Good Job!",
                                    text: data.message,
                                    icon: "success",
                                    button: "OK!"
                                });
                            }
                        } catch (error) {
                            console.error('Error parsing JSON response:', error);
                        }
                    }
                }
            };

            var requestData = 'cart_id=' + encodeURIComponent(cartId) + '&_token=' + encodeURIComponent(token);

            xhr.send(requestData);
        }
    });

</script>
