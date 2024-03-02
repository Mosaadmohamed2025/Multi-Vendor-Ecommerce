<script>
    document.addEventListener('click', function (event) {
        var addToWishlistButton = event.target.closest('.add_to_wishlist');

        if (addToWishlistButton) {
            event.preventDefault();

            var product_id = addToWishlistButton.getAttribute('data-id');
            var product_qty = addToWishlistButton.getAttribute('data-quantity');

            var token = "{{ csrf_token() }}";
            var path = "{{route('wishlist.store')}}";
            var xhr = new XMLHttpRequest();

            xhr.open('POST', path, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-CSRF-Token', token);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    // Restore the button text
                    addToWishlistButton.innerHTML = '<span>add to wishlistt</span>';

                    if (xhr.status === 200) {
                        try {
                            var data = JSON.parse(xhr.responseText);

                            if (data.status) {
                                document.getElementById('header-ajax').innerHTML = data.header;
                                swal({
                                    title: "Good Job!",
                                    text: data.message,
                                    icon: "success",
                                    button: "OK!"
                                });
                            } else if (data.present) {
                                swal({
                                    title: "OPPS!",
                                    text: data.message,
                                    icon: "warning",
                                    button: "OK!"
                                });
                            } else {
                                swal({
                                    title: "SORRY!",
                                    text: 'you cant add that product',
                                    icon: "error",
                                    button: "OK!"
                                });
                            }
                        } catch (error) {
                            console.error('Error parsing JSON response:', error);
                        }
                    }
                }
            };

            addToWishlistButton.innerHTML = '<span><i class="fas fa-spinner fa-spin" style="margin-right: 5px"></i> Loading</span>';

            var requestData = 'product_id=' + encodeURIComponent(product_id) + '&product_qty=' + encodeURIComponent(product_qty);

            xhr.send(requestData);
        }

    });

    document.addEventListener('click', function (event) {
        var wishlistDeleteButton = event.target.closest('.wishlist_delete');

        if (wishlistDeleteButton) {
            event.preventDefault();

            var wishlistID = wishlistDeleteButton.getAttribute('data-id');

            var token = "{{ csrf_token() }}";
            var path = "{{route('wishlist.delete')}}";
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
                            document.getElementById('body-wishlist').innerHTML = data.wish_list;
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

            var requestData = 'wishlist_id=' + encodeURIComponent(wishlistID) + '&_token=' + encodeURIComponent(token);

            xhr.send(requestData);
        }
    });

    document.addEventListener('click', function (event) {
        var MoveToCart = event.target.closest('.wishlist_move_to_cart');

        if (MoveToCart) {
            event.preventDefault();

            var rowID = MoveToCart.getAttribute('data-id');

            var token = "{{ csrf_token() }}";
            var path = "{{route('wishlist.move.cart')}}";
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
                            document.getElementById('body-wishlist').innerHTML = data.wish_list;
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

            MoveToCart.innerHTML = '<span><i class="fas fa-spinner fa-spin" style="margin-right: 5px"></i> Loading</span>';

            var requestData = 'rowId=' + encodeURIComponent(rowID) + '&_token=' + encodeURIComponent(token);

            xhr.send(requestData);
        }
    });
</script>
