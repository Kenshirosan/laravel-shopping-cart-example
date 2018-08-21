<script>
    (function() {
        let jumbotron = document.querySelector('.jumbotron');
        let title = document.querySelector('.custom-title');
        let subtitle = document.querySelector('.custom-subtitle');
        let wells = Array.from(document.querySelectorAll('.well'));

        axios.get('/customized-page-infos').then(response => {

            jumbotron.style.background = `url(${response.data.image})no-repeat fixed center`;
            jumbotron.style.backgroundSize = 'cover';
            title.innerText = ucfirst(response.data.title);
            title.style.color = response.data.color;
            subtitle.innerText = ucfirst(response.data.subtitle);
            subtitle.style.color = response.data.color;
            document.body.style.backgroundColor = response.data.background_color;
            wells.forEach(well => {
                console.log(response.data.categories_title_color)
                well.querySelector('.category-title').style.color = response.data.categories_title_color;
                well.style.backgroundColor = response.data.well_color;
            });
        });
    })();
</script>