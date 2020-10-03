<script>
    (function() {
        let jumbotron = document.querySelector('.jumbotron');
        let title = document.querySelector('.custom-title');
        // let subtitle = document.querySelector('.custom-subtitle');
        let wells = Array.from(document.querySelectorAll('.well'));

        axios.get('/customized-page-infos').then(response => {
            jumbotron.style.backgroundImage = `url(${response.data.image})`;
            jumbotron.style.backgroundSize = 'cover';
            jumbotron.style.backgroundRepeat = 'no-repeat';
            jumbotron.style.backgroundPosition = 'center';
            title.innerHTML = ucfirst(response.data.title) + `<span> ${response.data.subtitle}</span>`;
            title.style.color = response.data.color;
            // subtitle.innerText = ucfirst(response.data.subtitle);
            // subtitle.style.color = response.data.color;
            // document.body.style.backgroundColor = response.data.background_color;

            wells.forEach(well => {
                well.querySelector('.category-title').style.color = response.data.categories_title_color;
                well.style.backgroundColor = response.data.well_color;
            });
        });
    })();
</script>
