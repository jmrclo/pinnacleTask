@extends('components.layout')
@section('content')
<div class="text">Create announcements</div>
    <div
    class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
    >


<form method="POST" action="/announcements" enctype="multipart/form-data">
    @csrf


    <div class="mb-6">
        <label for="firstname" class="inline-block text-lg mb-2"
            >title</label
        >
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="title"
            id= "title"
            pattern="[a-zA-Z ]*"
            placeholder=""
            value="{{old('title')}}"
            
        />
        @error('title')
        <p class="text-red-500 text-xs mt-t">{{$message}}</p>
    @enderror
    </div>


    <div class="mb-6">
        <label
            for="start_date"
            class="inline-block text-lg mb-2"
            >start date</label
        >
        <input
            type="date"
            id="datepicker"
            class="border border-gray-200 rounded p-2 w-full "
            name="start_date"
            value="{{old('start_date')}}"
        />
        @error('start_date')
        <p class="text-red-500 text-xs mt-t">{{$message}}</p>
    @enderror
    </div>

    <div class="mb-6">
        <label
            for="end_date"
            class="inline-block text-lg mb-2"
            >end date</label
        >
        <input
            type="date"
            id="datepicker"
            class="border border-gray-200 rounded p-2 w-full "
            name="end_date"
            value="{{old('end_date')}}"
        />
        @error('end_date')
        <p class="text-red-500 text-xs mt-t">{{$message}}</p>
    @enderror
    </div>


    <div class="mb-6">
        <label for="logo" class="inline-block text-lg mb-2">
           Image
        </label>
        <input
            type="file"
            class="border border-gray-200 rounded p-2 w-full"
            name="logo"
            multiple accept="logo"
        />
        @error('logo')
        <p class="text-red-500 text-xs mt-t">{{$message}}</p>
      @enderror
    </div>

    <div class="mb-6">
        <label
            for="content"
            class="inline-block text-lg mb-2"
        >
         content        
        </label>
        <textarea
            class="border border-gray-200 rounded p-2 w-full"
            name="content"
            rows="10"
            placeholder="Include tasks, requirements, etc"
            
        >{{old('content')}}</textarea>
          @error('content')
            <p class="text-red-500 text-xs mt-t">{{$message}}</p>
          @enderror
        
    </div>
    

    <div class="mb-6">
        <button
            class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
        >
            Create Student
        </button>

        <a href="/" class="text-black ml-4"> Back </a>
    </div>
</form>
</div>
</div>
@endsection