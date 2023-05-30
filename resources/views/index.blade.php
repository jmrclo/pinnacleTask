@extends('components.layout')
@section('content')
<br>

<div class="text">Student Management</div>
<br>

    <div
    class="p-5 text-center bg-image"
    style="
      background-image: url('images/laravel-logo.png');
      height: 400px;
    "
  >
   
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
       
         
        
          <div class="text"></div>
          @guest
          <div
          class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
      >
          <header class="text-center">
            
              <h2 style="color:black;" class="text-2xl font-bold uppercase mb-1">
                  Login
              </h2>
              <p class="mb-3" style="color:black;"  >Log into an account</p>
          </header>
      
          <form action="/users/authenticate" method="POST">
              @csrf
             
      
              <div class="mb-6">
                  <label for="studentID"  style="color:black;" class="inline-block text-lg mb-2"
                      >username</label
                  >
                  <input
                      type="studentID"
                      class="border border-gray-200 rounded p-2 w-full"
                      name="studentID"
                      style="color:black;"
                      value="{{old('studentID')}}"
                  />
                  @error('studentID')
                      
              
                  <p class="text-red-500 text-xs mt-1"> {{$message}}</p>
                      
                  @enderror
              </div>
      
              <div class="mb-6">
                  <label
                      for="password"
                      style="color:black;"
                      class="inline-block text-lg mb-2"
                  >
                      Password
                  </label>
                  <input
                      type="password"
                      class="border border-gray-200 rounded p-2 w-full"
                      name="password"
                      style="color:black;"
                      value="{{old('Password')}}"
                  />
                  @error('password')
                      
              
                  <p class="text-red-500 text-xs mt-1"> {{$message}}</p>
                      
                  @enderror
              </div>
      
             
      
              <div class="mb-6">
                  <button
                      type="submit"
                      class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                  >
                       log in
                  </button>
              </div>
      
            
          </form>
      </div>
          @endguest
        </div>
      </div>
    
  </div>

@endsection