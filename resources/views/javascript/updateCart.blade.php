<script>
    (function() {
        $('.quantity').on('change', function() {
            let id = $(this).attr('data-id'),
                url = '{{ url("/cart") }}' + '/' + id,
                data = {'quantity': this.value};

            axios.patch(url, data)
                .then(window.location.href = '{{ url('/cart') }}')
                .catch(e => console.log(e));
        });
    })();
</script>