<script>
    (function() {
        let deleteProductButtons = Array.from(document.querySelectorAll('.deleteForm'));

        deleteProductButtons.forEach( button => {
            button.addEventListener('submit', confirmDeletion);
        });

        function confirmDeletion(e) {
            e.preventDefault();

            let form = e.target;
            let url = form.getAttribute('action');

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
                axios.delete(url)
                    .then(flash("Product deleted !"))
                    .then(
                        setTimeout( () => {
                            location.reload()
                        }, 500)
                    )
            }
        }
    })();
</script>