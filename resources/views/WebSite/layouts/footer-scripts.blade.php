<script src="{{ asset('WebSite/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('WebSite/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('WebSite/assets/js/jquery.hoverIntent.min.js') }}"></script>
<script src="{{ asset('WebSite/assets/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('WebSite/assets/js/superfish.min.js') }}"></script>
<script src="{{ asset('WebSite/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('WebSite/assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('WebSite/assets/js/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('WebSite/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('WebSite/assets/js/jquery.countdown.min.js') }}"></script>
<script src="{{asset('WebSite/assets/js/jquery.countTo.js')}}"></script>
<!-- Main JS File -->
<script src="{{ asset('WebSite/assets/js/main.js') }}"></script>
<script src="{{ asset('WebSite/assets/js/demos/demo-6.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




<script>
    function currency_change(currency_code) {
        fetch('{{route('currency.load')}}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '{{csrf_token()}}'
            },
            body: JSON.stringify({
                currency_code: currency_code
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    location.reload();
                } else {
                    alert('خطأ في الخادم');
                }
            })
            .catch(error => {
                console.error('حدث خطأ في الاتصال بالخادم:', error);
                alert('حدث خطأ في الخادم');
            });
    }

</script>
