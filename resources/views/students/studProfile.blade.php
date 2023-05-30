<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
                {{-- css --}}
               
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
                {{-- boxicons --}}
    <link href="{{asset ('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css')}}" rel='stylesheet'>
            {{-- phone design --}}
    <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css')}}">
    <script src="{{asset('https://code.jquery.com/jquery-3.6.0.js')}}"></script>
    <script src="{{asset ('https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js')}}"></script>
         
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>
    
    <title>Student Management</title>


                     {{-- table design --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
              
    
                {{-- swal --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
     <link rel="icon" type="image" href="images/logo.png">
</head>
<body class="body">
    

    <nav class="sidebar close">
        <header>
                <div class= "image-text">
                    <span class = "image">
                        <a href="/main">
                            <img src="{{ asset('images/logo.png')}}" alt="logo">
                        </a>
                    </span>

                    <div class ="text header-text">
                        <span class="name">Student Management</span>
                    </div>    
                </div>      
                
                    <i class='bx bx-chevron-right toggle'></i>

        </header>   
        @auth
     
            <div class="menu-bar">
                <div class="menu">
                   <li class="profile">
                       <a href="/profile/{{auth()->user()->id}}" title="Studentprofile"> 
                           <i class='bx bxs-report icon' ></i>
                           <span class="text nav-text">
                              Profile
                           </span>
                        </a>
                   </li>      
               
               </div>

         <div class="bottom-content">

                <div class ="text bottom-text">
                  <a href="/profile/{{auth()->user()->id}}" title="Studentprofile"> 
                    <span class="prof">Welcome {{auth()->user()->firstname}}</span>
                </a>
                </div>  
   
                    <form  method="POST" action="/logout">
                        @csrf
                       
                        <li class="logout">
                            <button type="submit">
                                <i class='bx bx-log-out icon' ></i>
                                <span class="text nav-text">
                                    Logout
                                </span>   
                            </button> 
                        </li>
                    </form>
             
            
                @else
                

                <li class="login">
                    <a href="/login" >
                        <i class='bx bx-log-in icon' ></i>
                        <span class="text nav-text">
                            Login
                        </span>
                     </a>
                </li>
                
                
                @endauth   

            </div>

        </div>      
              
   </nav>          
   <section class="home" id="home">
    
    @yield('content3')
    @include('components.flash-message')
    @include('sweetalert::alert')

                {{-- profile --}}
                <form method="POST" action="/profile/{{auth()->user()->id}}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                <section style="background-color: #E4E9F7;">
                    <div class="container py-5">
                      <div class="row">
                        <div class="col">
                          <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                            <ol class="breadcrumb mb-0">
                              <li class="breadcrumb-item"><a href="/main">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                            </ol>
                          </nav>
                        </div>
                      </div>
                  
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="card mb-4">
                            <div class="card-body text-center">
                              <img class="rounded-circle img-fluid " style="width: 250px;"  src= "{{$students->logo ? asset('storage/' . $students->logo) : asset('/images/ava3.png')}}" alt="" />
                              upload picture
                              <input
                                   type="file"
                                   class="p-2 w-20"
                                   name="logo"
                                   multiple accept="logo"
                               />
           
                               @error('logo')
                               <p class="text-red-500 text-xs mt-t">{{$message}}</p>
                             @enderror
                              <h5 class="my-3 text-lg">{{$students->firstname}} {{$students->lastname}}  </h5>
                              <p class="text-muted mb-1 text-lg">{{$students->studentID}} </p>
                              <p class="text-muted mb-4">{{$students->email}} </p>
                              <div class="d-flex justify-content-center mb-2">
                             
                              </div>
                            </div>
                          </div>
                         
                        </div>
                        <div class="col-lg-8">
                          <div class="card mb-4">
                            <div class="card-body">
                              <div class="row">
                                <label for="studentID"  class=" text-lg col-sm-3"
                                >Student ID:</label
                            >
                            <input
                                type="text"
                                class="col-sm-2"
                                name="studentID"
                                id= "studentID"
                                pattern="[a-zA-Z ]*"
                                placeholder=""
                                disabled
                                value="{{$students->studentID}}"
                                
                            />
                            @error('studentID')
                            <p class="text-red-500 text-xs mt-t">{{$message}}</p>
                        @enderror
                        </div>
                              </div>
                              <hr>
                              <div class="row">
                                <label for="firstname"  class="text-lg col-sm-3"
                                >firstname</label
                            >
                            <input
                                type="text"
                                class="col-sm-2"
                                name="firstname"
                                id= "firstname"
                                pattern="[a-zA-Z ]*"
                                placeholder=""
                                disabled
                                value="{{$students->firstname}}"
                                
                            />
                            @error('firstname')
                            <p class="text-red-500 text-xs mt-t">{{$message}}</p>
                        @enderror
                              </div>
                              <hr>
                              <div class="row">
                                <label for="lastname"  class="text-lg col-sm-3"
                                >lastname</label
                            >
                            <input
                                type="text"
                                class="col-sm-2"
                                name="lastname"
                                id= "lastname"
                                pattern="[a-zA-Z ]*"
                                placeholder=""
                                disabled
                                value="{{$students->lastname}}"
                                
                            />
                            @error('lastname')
                            <p class="text-red-500 text-xs mt-t">{{$message}}</p>
                        @enderror
                              </div>
                              <hr>
                              <div class="row">
                                <label for="gender" class="text-lg col-sm-3"
                                >gender</label>
                            <select 
                                class="col-sm-2"
                                name="gender"
                                value="{{$students->gender}}">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              
                            </select>
                          
                            @error('gender')
                            <p class="text-red-500 text-xs mt-t">{{$message}}</p>
                        @enderror
                              </div>
                              <hr>
                              <div class="row">
                                <label for="birthday"  class="text-lg col-sm-3"
                                >birthday</label
                            >
                            <input
                                type="date"
                                class="col-sm-2"
                                name="birthday"
                                id="datepicker"
                                value="{{$students->birthday}}"
                                
                            />
                            @error('birthday')
                            <p class="text-red-500 text-xs mt-t">{{$message}}</p>
                        @enderror
                              </div>
                              <hr>
                              <div class="row">
                                <label
                                for="age"
                                class="text-lg col-sm-3"
                                >age</label
                            >
                            <input
                                type="number"
                                id="age"
                                class="col-sm-2"
                                name="age"
                                min="18" max="69"
                                readonly
                                value="{{$students->age}}"
                            />
                            
                            @error('age')
                            <p class="text-red-500 text-xs mt-t">{{$message}}</p>
                        @enderror
                              </div>
                              <hr>
                              <div class="row">
                                <label
                                for="birthplace"
                                class="text-lg col-sm-3"
                                >birthplace</label >
                            <input
                                type="text"
                                class="col-sm-2"
                                name="birthplace"
                                value="{{$students->birthplace}}"
                            />
                            @error('birthplace')
                            <p class="text-red-500 text-xs mt-t">{{$message}}</p>
                        @enderror
                              </div>
                              <hr>
                              <div class="row">
                                <label for="email"  class="text-lg col-sm-3"
                                >email</label
                            >
                            <input
                                type="text"
                                class="col-sm-3"
                                name="email"
                                id= "email"
                                value="{{$students->email}}"
                                
                            />
                            @error('email')
                            <p class="text-red-500 text-xs mt-t">{{$message}}</p>
                        @enderror
                              </div>
                              <hr>
                              <div class="row">
                                <label for="address"  class="text-lg col-sm-3"
                                >address</label
                            >
                            <input
                                type="text"
                                class="col-sm-2"
                                name="address"
                                id= "address"
                                value="{{$students->address}}"
                                
                            />
                            @error('address')
                            <p class="text-red-500 text-xs mt-t">{{$message}}</p>
                        @enderror
                              </div>
                              <hr>
                              <div class="">
                               <label
                                  for="phone"
                                  class="text-lg col-sm-3"
                              >
                              phone
                              </label>
                          
                              <input
                              class="col-m-6"
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
                              
                            </div>
                            <div class="mb-6">
                              <button
                                  class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                              >
                                  Update Profile
                              </button>
                          </div>
                      </form>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                  <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                  </p>
                                  <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                  <div class="progress rounded" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                      aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                  <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                  <div class="progress rounded" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                      aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                  <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                  <div class="progress rounded" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                      aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                  <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                  <div class="progress rounded" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                      aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                  <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                  <div class="progress rounded mb-2" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                      aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                  <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                  </p>
                                  <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                  <div class="progress rounded" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                      aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                  <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                  <div class="progress rounded" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                      aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                  <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                  <div class="progress rounded" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                      aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                  <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                  <div class="progress rounded" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                      aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                  <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                  <div class="progress rounded mb-2" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                      aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                {{-- end --}}


    
                    {{-- alpine.js --}}
<script src="{{asset ('//unpkg.com/alpinejs')}}"></script>
            {{-- chart --}}

<script src="{{asset ('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js')}}" charset="utf-8"></script>

<script src="{{asset ('js/index.js')}}"></script>

</section>


<script>

 



    jQuery(document).ready(function($) {
        $('.datepicker').datepicker({
            dateFormat: "yy-mm-dd"
        });
    });

    var input = document.querySelector('#phone'),
    errorMsg = document.querySelector('#error-msg'),
    validMsg = document.querySelector('#valid-msg');


    var errorMap = ["Invalid number", "Invalid country code","Too short", "Too long"];
    var validMap = ["Valid number"];

    // var iti = window.intlTelInput(input, {
    //     utilscript:
    //     "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    // });

    var iti = window.intlTelInput(input, {
    utilsScript:
    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});
    var reset = function() {
        input.classList.remove("error");
        errorMsg.innerHTML = "";
        validMsg.innerHTML = "";
        errorMsg.classList.add("hide");
         validMsg.classList.add("hide");
    
    }

    input.addEventListener('blur', function(){
        reset();
        if(input.value.trim()){
            if(iti.isValidNumber()){
                var ValidCode = iti.getValidationError();
                validMsg.innerHTML = validMap[ValidCode];
                validMsg.classList.remove('hide');
                
            }else{
                input.classList.add('error');
                var errorCode = iti.getValidationError();
                errorMsg.innerHTML = errorMap[errorCode];
                errorMsg.classList.remove("hide");
            }
        }
    });



    const datepicker = document.getElementById("datepicker");
    datepicker.addEventListener("change", (event) => {
      const selectedDate = event.target.value;
      var age = calculateAge(selectedDate);
      // Perform any additional actions based on the selected date
    });

    input.addEventListener('change', reset);
    input.addEventListener("keyup",reset);
    
//     telInput.intlTelInput({

//       allowExtensions: true,
//       formatOnDisplay: true,
//       autoFormat: true,
//       autoHideDialcode:true,
//       autoPlaceholder: true,
//       defaultCountry: "",
//       ipinfoToken: "yolo",
      
//       nationalMode: false,
//       numberType : "MOBILE",
//       preferredCountries: ['sa','php','ph'],
//       preventInvalidNumber: true,
//       separateDialCode : true,
//       initialCountry: "php",

//       geoIpLookup: function(callback){
//         $.get("http://ipinfo.io", function(){}, "jsonp").always(function(resp){
//             var countryCode = (resp && resp.country) ? resp.country : "";
//             callback (countryCode);
//         });
//       },
//       utilScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/itils.js"

// });


    function calculateAge(dateOfBirth) {

        // const today = new Date();
        // const birthDate = new Date(dateOfBirth);
        // let age = today.getFullYear() - birthDate.getFullYear();
        // const monthDiff = today.getMonth() - birthDate.getMonth();
        // if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        //     age--;
    //     return age;
    // }
 
        // }

    const today = new Date();
    let age = 0;
    let birthYear = parseInt(dateOfBirth.split("-")[0]);
    let birthMonth = parseInt(dateOfBirth.split("-")[1]);
    let birthday = parseInt(dateOfBirth.split("-")[2]);
    age = today.getFullYear() - birthYear;
    if (birthYear % 4 == 0 && birthMonth == 2 && birthday == 29) {
        age = age / 4;
    }
    else {
        today.getMonth() < birthMonth || today.getMonth() == birthMonth && birthday > today.getDate() ? age-- : null;
    }
    return age;
}
    

$('#datepicker').change(function() {
    const selectedDate = $(this).val();
    var age = calculateAge(selectedDate);
    $("#age").val(age);
    
});


const inputElement = document.getElementById("firstname");

const inputElement2 = document.getElementById("lastname");
    inputElement.addEventListener("keypress", function(event) {
    
        const keyCode = event.keyCode;
      if (keyCode >= 48 && keyCode <= 57) {
        swal("Oops!","Numbers are not allowed!");
      }
    });
    inputElement2.addEventListener("keypress", function(event) {
    const keyCode = event.keyCode;
  if (keyCode >= 48 && keyCode <= 57) {
    swal("Oops!","Numbers are not allowed!");
  }  
  });
    


</script>

</body>
</html>

