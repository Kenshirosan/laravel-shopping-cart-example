@if(Auth::user()->isAdmin())
    @if (is_string($item))
        <li class="header">{{ $item }}</li>
    @else
    {{-- display the number in the sidebar --}}
    @if($item['href'] == 'http://127.0.0.1:8000/calendar')
        {{ $calendar = new \App\Calendar() }}
        {{ $item['label'] = $calendar->whereDate('created_at', '>=', date('Y-m-d'))->count() }}
    @elseif($item['href'] == 'http://127.0.0.1:8000/contact-us')
        {{ $calendar = new \App\Message() }}
        {{ $item['label'] = $calendar->all()->count() }}
    @elseif($item['href'] == 'http://127.0.0.1:8000/customer-orders')
        {{ $calendar = new \App\Order() }}
        {{ $item['label'] = $calendar->whereDate('created_at', '=', date('Y-m-d'))->count() }}
    @endif

        <li class="{{ $item['class'] }}">
            <a href="{{ $item['href'] }}"
               @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
            >
                <i class="fa fa-fw fa-{{ $item['icon'] or 'circle-o' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                <span>{{ $item['text'] }}</span>
                @if (isset($item['label']))
                    <span class="pull-right-container">
                        <span class="label label-{{ $item['label_color'] or 'primary' }} pull-right">{{ $item['label'] }}</span>

                    </span>
                @elseif (isset($item['submenu']))
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                @endif
            </a>
            @if (isset($item['submenu']))
                <ul class="{{ $item['submenu_class'] }}">
                    @each('adminlte::partials.menu-item', $item['submenu'], 'item')
                </ul>
            @endif
        </li>
    @endif
@endif