@extends('components.layout')
@section('content')
<div class="text">Edit Student info</div>
    <div
    class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24 edit"
    >
<header class="text-center">
    <h2 class="text-2xl font-bold uppercase mb-1">
        
    </h2>
    <p class="mb-4">Update {{$students->lastname}}'S info</p>
</header>

<form method="POST" action="/reports/{{$students->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')


    <div class="mb-6">
        <label for="studentID"  class="inline-block text-lg mb-2"
            >studentID</label
        >
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="studentID"
            id= "studentID"
            pattern="[a-zA-Z ]*"
            placeholder=""
            value="{{$students->studentID}}"
            disabled
            
        />
        @error('studentID')
        <p class="text-red-500 text-xs mt-t">{{$message}}</p>
    @enderror
    </div>

    <div class="mb-6">
        <label for="firstname"  class="inline-block text-lg mb-2"
            >firstname</label
        >
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="firstname"
            id= "firstname"
            pattern="[a-zA-Z ]*"
            placeholder=""
            value="{{$students->firstname}}"
            
        />
        @error('firstname')
        <p class="text-red-500 text-xs mt-t">{{$message}}</p>
    @enderror
    </div>


    <div class="mb-6">
        <label
            for="lastname"
            class="inline-block text-lg mb-2"
            >last Name</label>
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="lastname" 
            id= "lastname"
            pattern="[a-zA-Z]*"
            value="{{$students->lastname}}"
        />
        @error('lastname')
            <p class="text-red-500 text-xs mt-t">{{$message}}</p>
        @enderror
    </div>

  
    <div class="mb-6">
        <label for="gender" class="inline-block text-lg mb-2"
            >gender: </label>
        <select 
            class="form-control" 
            name="gender"
            value="{{$students->gender}}">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          
        </select>
      
        @error('gender')
        <p class="text-red-500 text-xs mt-t">{{$message}}</p>
    @enderror
    </div>
    <div class="mb-6">
        <label
            for="birthplace"
            class="inline-block text-lg mb-2"
            >birthday</label
        >
        <input
            type="date"
            id="datepicker"
            class="border border-gray-200 rounded p-2 w-full "
            name="birthday"
            value="{{$students->birthday}}"
        />
        @error('birthday')
        <p class="text-red-500 text-xs mt-t">{{$message}}</p>
    @enderror
    </div>
    <div class="mb-6">
        <label
            for="age"
            class="inline-block text-lg mb-2"
            >age</label
        >
        <input
            type="number"
            id="age"
            class="border border-gray-200 rounded p-2 w-full"
            name="age"
            min="18" max="69"
            readonly
            value="{{$students->age}}"
        />
        
        @error('age')
        <p class="text-red-500 text-xs mt-t">{{$message}}</p>
    @enderror
    </div>
    <div class="mb-6">
        <label
            for="birthplace"
            class="inline-block text-lg mb-2"
            >birthplace</label
        >
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="birthplace"
            value="{{$students->birthplace}}"
        />
        @error('birthplace')
        <p class="text-red-500 text-xs mt-t">{{$message}}</p>
    @enderror
    </div>
  
    <div class="mb-6">
        <label
            for="phone"
            class="inline-block text-lg mb-2"
        >
        phone
        </label>
    
        <input
        
        type="text"
        id="phone"
        name="phone"
        value="{{$students->phone}}"
    />
    <span id="valid-msg" class="hide" style="color:green"></span>
    <span id="error-msg" class="hide" style="color:red"></span>
        
       
        @error('phone')
        <p class="text-red-500 text-xs mt-t">{{$message}}</p>
    @enderror
    </div>
   

    <div class="mb-6">
        <label for="email" class="inline-block text-lg mb-2"
            >Contact Email</label
        >
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="email"
            value="{{$students->email}}"
        />
        @error('email')
        <p class="text-red-500 text-xs mt-t">{{$message}}</p>
    @enderror
    </div>

 

    <div class="mb-6">
        <label
            for="address"
            class="inline-block text-lg mb-2"
            >address</label
        >
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="address"
            placeholder="Example: Remote, Boston MA, etc"
            value="{{$students->address}}"
        />
        @error('address')
        <p class="text-red-500 text-xs mt-t">{{$message}}</p>
    @enderror
    </div>

    

    <div class="mb-6">
        <button
            class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
        >
            Update Student
        </button>

        <a href="/" class="text-black ml-4"> Back </a>
    </div>
</form>
</div>
</div>

@endsection