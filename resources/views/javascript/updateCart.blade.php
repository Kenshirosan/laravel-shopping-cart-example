<script>
    (function() {
        $('.quantity').on('change', function() {
            let id = $(this).attr('data-id'),
                url = '{{ url("/cart") }}' + '/' + id,
                data = {'quantity': this.value};

            axios.patch(url, data)
                .then(flash('Successfully updated !'))
                .then(setTimeout( () => {
                    location.reload()
                }, 100))
                .catch(e => flash('Something wrong happened, try again later', 'danger'));
        });
    })();
</script>