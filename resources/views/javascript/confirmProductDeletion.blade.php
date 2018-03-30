<script>
    (function() {
        let deleteProductButton = document.querySelectorAll('.deleteForm');
        deleteProductButton = Array.from(deleteProductButton);

        deleteProductButton.forEach( button => {
            button.addEventListener('submit', confirmDeletion);
        });

        function confirmDeletion(e) {
            e.preventDefault();

            let target = e.target;
            let attr = target.getAttribute('action');

            swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((deleteProduct) => {
                if (deleteProduct) {
                swal("Product Deleted !", {
                  icon: "success",
                });
                } else {
                    swal("Your product is safe!");
                }
            });

            let confirm = document.getElementsByClassName('swal-button--confirm');
            confirm = confirm[0];
            confirm.addEventListener('click', deleteProduct);

            function deleteProduct() {
                axios.delete(attr)
                    .then(flash("Successfully deleted !"))
                    .then(location.reload());
            }
        }
    })();
</script>