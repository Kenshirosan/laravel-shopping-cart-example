<ul class="right">
    <li>
        <a
            class="btn dropdown-button"
            role="button"
            href="#!"
            data-target="dropdown4">Language
            <i class="material-icons right">arrow_drop_down</i>
        </a>
        <!-- Dropdown Structure -->
        <ul id="dropdown4" class="dropdown-content">
            @php $locale = session()->get('locale'); @endphp
            <li>
                @switch($locale)
                    @case('fr')
                    <img src="{{asset('img/fr.svg')}}" alt="fr" width="30px" height="20x"> French
                    @break
                    @default
                    <img src="{{asset('img/us.svg')}}" alt="en" width="30px" height="20x"> English
                @endswitch
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="lang/en"><img src="{{asset('img/us.svg')}}" alt="en" width="30px" height="20x"> English</a>
                    <a class="dropdown-item" href="lang/fr"><img src="{{asset('img/fr.svg')}}" alt="fr" width="30px" height="20x"> French</a>
                </div>
            </li>
        </ul>
    </li>
</ul>

@section('lang')
<script>
    $(document).ready(function () {
        $('.dropdown-button').dropdown({
            constrainWidth: false,
            hover: true,
            belowOrigin: true,
            alignment: 'left'
        });
    });
</script>
@endsection
