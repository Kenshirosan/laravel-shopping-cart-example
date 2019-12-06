@if($item->options)
    @if($item->options['options'])
        @foreach($item->options['options']['options'] as $option)
            <p><small>{{ $option['name'] }}</small></p>
        @endforeach
        @if($item->options['options']['way'])
            <p><small>{{ $item->options['options']['way'] }}</small></p>
        @endif
    @endif
@endif