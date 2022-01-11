<script>
    const btns = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.menu-item');

    btns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            items.forEach(item => {
                if(this.dataset.id === item.dataset.category || this.dataset.id === 'All') {
                    $(item).fadeIn();
                } else {
                    $(item).fadeOut();
                }
            });
        });
    });
</script>
