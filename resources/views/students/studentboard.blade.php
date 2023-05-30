<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    
                {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" class="">

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
    
    @yield('content2')
    @include('components.flash-message')
    @include('sweetalert::alert')

    <div class="text">Announcements
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
                  {{-- swiper js --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
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


