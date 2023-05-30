@extends('components.layout')
@section('content')

    <div class="text">Announcements
        <a href="{{ url('announcements/create') }}" class="btn btn-success btn-sm" title="Add New Contact">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>
        <a href="{{ url('announcements/trashed') }}" class="btn btn-primary btn-sm" title="Add New Contact">
            <i class="fa fa-plus" aria-hidden="true"></i> Trashed
        </a>
    </div>

    <form action="">
        <div class="relative border-2 border-gray-100 m-4 rounded-lg">
            <div class="absolute top-4 left-3">
                <i
                    class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
                ></i>
            </div>
            <input
                type="text"
                name="search"
                class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                placeholder="Search Announcement"
            />
            <div class="absolute top-2 right-2">
                <button
                    type="submit"
                    class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600"
                >
                    Search
                </button>
            </div>
        </div>
    </form>

        
             
<body class="bodys">
    <div class="wrapper">
      
      <i id="left" class="bx bx-chevron-left"></i>
      <ul class="carousel">
        @unless(count($announcements) == 0 )
        @foreach($announcements as $announcement)
        <li class="cards">
          <div class="img"><img draggable="false" src= "{{$announcement->logo ? asset('storage/' . $announcement->logo) : asset('/images/no-image.png')}}" alt="img" />
          </div>
          <h2>  {{ $announcement->title }}</h2>
          <span>{{ $announcement->content }}</span>
             <ul class="flex">
              <li
                class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                 {{ $announcement->start_date }}
            </li>
                 <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                   {{ $announcement->end_date }}
                 </li>
             </ul>                                  
        </li>
        @endforeach
      </ul>
      <i id="right" class="bx bx-chevron-right"></i>
      @else
      <p> no announcement found</p>
  @endunless
    </div>

  </body>


  <div class="card-body">
    @unless(isset($announcements) == 0 )
        @foreach($announcements as $announcement)
            <div class="bg-gray-50 border border-gray-200 rounded p-6">
                <div class="flex">
                    <img class="hidden w-48 mr-6 md:block" src= "{{$announcement->logo ? asset('storage/' . $announcement->logo) : asset('/images/no-image.png')}}" alt="" />
                    <div>
                        <h3 class="text-2xl font-bold mb-4">
                            <a href="/announcements/{{$announcement['id']}}">  {{ $announcement->title }}</a>
                        </h3>
                            <div class="text-xl">{{ $announcement->content }}</div>
                            {{-- <ul class="flex">
                                <li
                                class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                                {{ $announcement->start_date }}
                                </li>
                                <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                                {{ $announcement->end_date }}
                                </li>
                            </ul> --}}
                                {{-- <a href="/reports/{{$student->id}}" title="View Student"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a> --}}
                                <div class="text-xl" >   
                                    <a href="/announcements/{{$announcement->id}}/edit" title="Edit "><button class="btn btn-primary btn-sm"><i class="fa-solid fa-pencil" aria-hidden="true"></i> Edit</button></a>
                                    <form method="POST" action="/announcements/{{$announcement->id}}" accept-charset="UTF-8" style="display:inline">
                                        @csrf
                                       @method('DELETE')
                                 
                                         <button id=delbtn class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-o" aria-hidden="true"></i> Delete</button>
                                     </form>
                                </div>    
                    </div>
                </div>
        </div> 
        @endforeach
        @else
        <p> no Deleted announcement found</p>
    @endunless
</div>



@endsection