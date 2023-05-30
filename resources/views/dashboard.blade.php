@extends('components.layout')
@section('content')
    @include('partials._hero')

 
    
         {{-- add chart --}}
  <div class="graphBox ">

     <div class="box">
          {!! $chart2->container() !!}
  
     </div>

     <div class="box flex">
          {!! $chart->container() !!}  
     </div>
   </div>

  
   {!! $chart->script() !!}
   {!! $chart2->script() !!}
@endsection