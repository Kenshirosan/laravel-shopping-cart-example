<script>
$(document).ready( function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.add_to_cart').click(function(){
            var product_id = $(this).data('id');
            var product_name = $(this).data('name');
            var product_price = $(this).data('price');
            var product_options = $(this).data('options');
            $.ajax({
                url: '{{ url('/cart') }}',
                method: 'POST',
                data: {
                    id:product_id,
                    name:product_name,
                    price:product_price
                },
                success: function(data){
                    $('.response').append('<p class=\'alert alert-success\'> ' + product_name + ' added !</p>').fadeIn().fadeOut(2000);
                }
            });
            return false;
        });
    });
</script>