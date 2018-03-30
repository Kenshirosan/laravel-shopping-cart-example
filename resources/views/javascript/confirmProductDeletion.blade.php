<script>
    (function() {
        let deleteProductButton = Array.from(document.querySelectorAll('.deleteForm'));

        deleteProductButton.forEach( button => {
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
                    .then(location.reload())
                    .catch(flash("Something Went wrong, please try again later", "danger"));
            }
        }
    })();
</script>