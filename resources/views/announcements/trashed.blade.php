
@extends('components.layout')
@section('content')
<div class="text">Deleted Announcements
                   
</div>

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
                                <a href="/announcements/restore/{{$announcement->id}}/" title="restore "><button class="btn btn-primary btn-sm"><i  aria-hidden="true"></i> restore</button></a>
                                <a href="#" onclick="deleteAnnounce({{$announcement->id}})" title="restore "><button class="btn btn-danger btn-sm"><i  aria-hidden="true"></i> delete</button></a>
                        
                             
                                    
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