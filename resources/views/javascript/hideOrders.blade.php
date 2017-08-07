<script>
    $(function(){   
        $('.clickToHideTheOrder').click(function(event) {
            event.preventDefault();
            $(this).parent().fadeOut('400') 
            });
        });
</script>