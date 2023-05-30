@extends('components.layout')
@section('content')

<div class="text">Announcements</div>


<div class="mx-4">
    <div class="bg-gray-50 border border-gray-200 p-10 rounded">
        <div class="flex flex-col items-center justify-center text-center">
             <img class="w-48 mr-6 mb-6"  src= "{{$announcements->logo ? asset('storage/' . $announcements->logo) : asset('/images/no-image.png')}}" alt="" />

            <h3 class="text-2xl mb-2">  {{ $announcements->title}}</h3>
     
            <ul class="flex">
                <li
                    class="bg-black text-white rounded-xl px-3 py-1 mr-2"
                >
                
                {{ $announcements->start_date}},
                </li>
                <li
                    class="bg-black text-white rounded-xl px-3 py-1 mr-2"
                > 
                {{ $announcements->end_date }},
                </li>
            </ul>
      
            <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Description
                    </h3>
                    <div class="text-lg space-y-6">
                        <p> 
                            {{ $announcements->content }}
                        </p>
                    
                    </div>
                    <div class="text-xl" >   
                        <a href="/announcements/{{$announcements->id}}/edit" title="Edit "><button class="btn btn-primary btn-sm"><i class="fa-solid fa-pencil" aria-hidden="true"></i> Edit</button></a>
                        <form method="POST" action="/announcements/{{$announcements->id}}" accept-charset="UTF-8" style="display:inline" id="frm">
                            @csrf
                           @method('DELETE')
                     
                             <button id=delbtn class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-o" aria-hidden="true"></i> Delete</button>
                         </form>
                    </div>    
                </div>
        </div>
    </div>
</div>



@endsection