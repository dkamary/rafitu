{{-- Flash message --}}

@if (session('success'))
    @if(is_array(session('success')))
        @foreach (session('success') as $notification)
            @include('_partials.back.notifications.alert', ['notification' => $notification, 'message_type' => 'success'])
        @endforeach
    @else
        @include('_partials.back.notifications.alert', ['notification' => session('success'), 'message_type' => 'success'])
    @endif
@endif

@if (session('warning'))
    @if(is_array(session('warning')))
        @foreach (session('warning') as $notification)
            @include('_partials.back.notifications.alert', ['notification' => $notification, 'message_type' => 'warning'])
        @endforeach
    @else
        @include('_partials.back.notifications.alert', ['notification' => session('warning'), 'message_type' => 'warning'])
    @endif
@endif

@if (session('error'))
    @if(is_array(session('error')))
        @foreach (session('error') as $notification)
            @include('_partials.back.notifications.alert', ['notification' => $notification, 'message_type' => 'danger'])
        @endforeach
    @else
        @include('_partials.back.notifications.alert', ['notification' => session('error'), 'message_type' => 'danger'])
    @endif
@endif
