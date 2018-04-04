<script>
    (function() {
        let jumbotron = document.querySelector('.jumbotron');
        let title = document.querySelector('.custom-title');
        let subtitle = document.querySelector('.custom-subtitle');

        axios.get('/page-infos').then(response => {
            title.textContent = response.data.title;
            subtitle.textContent = response.data.subtitle;
            jumbotron.style.backgroundImage = `url(${response.data.image})`;
        });
    })();
</script>