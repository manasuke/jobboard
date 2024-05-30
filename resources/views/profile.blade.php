@foreach ($user as $item)
    <h1>{{ $item['name'] }}</h1>
    <h2>{{ $item['age'] }}</h2>
    @if ($item['age'] < 17)
        <p>User cant drive</p>
    @endif
    <hr>
@endforeach

@coppyright {{ date('Y') }}
