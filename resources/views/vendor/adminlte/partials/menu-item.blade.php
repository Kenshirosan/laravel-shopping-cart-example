@if (is_string($item))
    <li class="header">{{ $item }}</li>
@else
{{-- this is not spaghetti code,
 it's a nice small block of php that eases my life :-),
it displays the count in the sidebar --}}
@php
    if($item['href'] == url('/calendar'))
    {
        $calendar = new \App\Models\Calendar();

        $item['label'] = $calendar->getAppointments() ? : $item['label'];
    }

    if($item['href'] == url('/contact-us'))
    {
        $messages = new \App\Models\Message();

        $item['label'] = $messages->count() ? : $item['label'];
    }

    if($item['href'] == url('/customer-orders'))
    {
        $orders = new \App\Models\Order();

        $item['label'] = $orders->todaysOrdersCount() ? : $item['label'];
    }
@endphp
    <li class="{{ $item['class'] }}">
        <a href="{{ $item['href'] }}"
           @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
        >
            <i
                class="fa fa-fw fa-{{ isset($item['icon']) ?
                                                                $item['icon']
                                                            :
                                                                'circle-o' }}
                                    {{ isset($item['icon_color']) ?
                                                                'text-' . $item['icon_color']
                                                            :
                                                                '' }}">
            </i>
            <span>{{ $item['text'] }}</span>
            @if (isset($item['label']))
                <span class="pull-right-container">
                    <span
                        class="label label-{{ $item['label_color'] }} pull-right">
                        {{ $item['label'] }}
                    </span>
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