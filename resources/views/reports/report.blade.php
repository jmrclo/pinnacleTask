

@extends('components.layout')
@section('content')
 
 <h2>
    {{$students['studentID']}}
        {{$students['firstname']}}
    </h2>
    <p>
        {{$students['lastname']}},
        {{$students['gender']}},
        {{$students['birthday']}},
        {{$students['birthplace']}},
        {{$students['contact']}}, 
        {{$students['email']}},
        {{$students['address']}},
    </p>

@endsection