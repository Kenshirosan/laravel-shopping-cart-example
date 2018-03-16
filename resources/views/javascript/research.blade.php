 <script>
    $(document).ready(function(){
        $("#search").keyup(function(){
            var str=  $("#search").val();
            if(str == "") {
                $( "#txtHint" ).html("<b>Results ..</b>");
            }else {
                $.get( "{{ url('/livesearch?id=') }}"+str, function( data ) {
                    $( "#txtHint" ).html( data );
                });
            }
        });
    });
</script>