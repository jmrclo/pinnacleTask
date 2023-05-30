@extends('components.layout')
@section('content')
<div class="text"></div>
    <div
    class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
>
    <header class="text-center">
       
        <p class="mb-4">Create an account</p>
    </header>

    <form action="/users" method="POST">
        @csrf
        <div class="mb-6">
            <label for="studentID" class="inline-block text-lg mb-2"
                >username</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="studentID"
                id= "studentID"
                placeholder=""
                value="{{old('studentID')}}"
                
            />
            @error('studentID')
            <p class="text-red-500 text-xs mt-t">{{$message}}</p>
        @enderror
        </div>
        
        <div class="mb-6">
            <label for="firstname" class="inline-block text-lg mb-2"
                >firstname</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="firstname"
                id= "firstname"
                pattern="[a-zA-Z ]*"
                placeholder=""
                value="{{old('firstname')}}"
                
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
                value="{{old('lastname')}}"
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
                name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                value="{{old('gender')}}"
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
                value="{{old('birthday')}}"
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
                value="{{old('age')}}"
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
                value="{{old('birthplace')}}"
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
                value="{{old('phone')}}"
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
                value="{{old('email')}}"
            />
            @error('email')
            <p class="text-red-500 text-xs mt-t">{{$message}}</p>
        @enderror
        </div>

        <div class="mb-6">
            <label
                for="password"
                class="inline-block text-lg mb-2"
            >
                Password
            </label>
            <input
                type="password"
                class="border border-gray-200 rounded p-2 w-full"
                name="password"
                value="{{old('Password')}}"
            />
            @error('password')
                
        
            <p class="text-red-500 text-xs mt-1"> {{$message}}</p>
                
            @enderror
        </div>

        <div class="mb-6">
            <label
                for="password_confirmation"
                class="inline-block text-lg mb-2"
            >
                Confirm Password
            </label>
            <input
                type="password"
                class="border border-gray-200 rounded p-2 w-full"
                name="password_confirmation"
                value="{{old('password_confirmation')}}"
            />
            @error('password_confirmation')
            <p class="text-red-500 text-xs mt-1"> {{$message}}</p>    
            @enderror
        </div>

        <div class="mb-6">
            <button
                type="submit"
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
            >
                Sign Up
            </button>
        </div>
        @guest
                <div class="mt-8">
                    <p>
                        Already have an account?
                        <a href="/login" class="text-laravel"
                            >Login</a
                        >
                    </p>
                </div>
                @endguest
        </form>
    </div>

@endsection