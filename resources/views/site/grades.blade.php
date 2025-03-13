@extends('layouts.site')

@section('content')
    @foreach($grades as $_grade)
        <div>
            <div>{{ $_grade['id'] }} — {{ $_grade['name'] }}</div>
        </div>
    @endforeach
@endsection
