<script>
    (function() {
        $('.quantity').on('change', function() {
            let id = $(this).attr('data-id');
            let url = '{{ url("/cart") }}' + '/' + id;
            let data = {'quantity': this.value};

            axios.patch(url, data).then(flash('Successfully updated !'))
                                    .then(location.reload())
                                    .catch(e => console.log(e));
        });
    })();
</script>