<script>
    let inputTimer = document.querySelector('.pickup-time');
    $(inputTimer).hide();

    let types = document.querySelectorAll('input[type="radio"]');
    types.forEach( type => {
        type.addEventListener('click',  toggleElements);
    });

    function toggleElements(e) {
        if (e.target.value == 'Pick-up') {
            $(inputTimer).fadeIn();
        } else {
            $(inputTimer).fadeOut();
        }
    }

    let time = document.querySelector('input[type="time"]');
    time.addEventListener('change', logTime);

    function logTime(e) {
        let timeElement = document.createElement('h4');
        timeElement.classList.add('text-info');
        timeElement.classList.add('timer-helper');
        timeElement.textContent = e.target.value;

        let parent = document.querySelector('.pickup-time');

        let child = parent.querySelector('.timer-helper');
        if (child) {
            $(child).remove();
        }

        parent.append(timeElement);
    }
</script>