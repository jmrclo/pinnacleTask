@extends('components.layout')
@section('content')
  <div class="text">Reports</div>
  
  <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header"><h1>Students</h1></div>
              <div class="card-body">
                  <a href="{{ url('reports/create') }}" class="btn btn-success btn-sm" title="Add New Contact">
                      <i class="fa fa-plus" aria-hidden="true"></i> Add New
                  </a>
                  <a href="{{ url('/pdf') }}" class="btn btn-danger btn-sm" title="export pdf">
                    <i  aria-hidden="true"></i> PDF
                </a>
                <a href="{{ url('/excel') }}" class="btn btn-success btn-sm" title="export csv">
                  <i  aria-hidden="true"></i> EXCEL
              </a>
              
              
          
                @if (session()->has('failures'))
                  <table class ="table table-danger">
                    <tr>
                        <th>row</th>
                        <th>attribute</th>
                        <th>errors</th>
                        <th>value</th>

                    </tr>
                  @foreach (session()->get('failures') as $failure)

                    <tr>
                        <td>{{$failure->row()}} </td>
                        <td>{{$failure->attribute()}} </td>
                        <td>
                            <ul>  
                              @foreach ($failure->errors() as $e)
                                <li>  {{$e}} </li>
                                @endforeach
                            </ul>
                           </td>
                        <td>
                          {{$failure->values()[$failure->attribute()]}}
                           </td>
                    </tr>
                 {{-- On row {{$failure->row()}} has error Name: "{{$failure->values()['firstname']}}, {{$failure->values()['lastname']}} Email: {{$failure->values()['email']}}, phonenumber: {{$failure->values()['phonenumber']}}"
                --}}
            

                  @endforeach 
               
                @endif
                   
              <form  action="{{ url('/import') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" style="display:inline" >
                @csrf
                <label for="file">Select CSV file to import</label>
               <input type="file"   class="p-2 w-20" name="students" required>
               <button  class="btn btn-success btn-sm" ><i class="fa-solid fa-trash-o" aria-hidden="true"></i> import</button>
         
             </form>
             @if(session()->has('failures'))
             <h5 style="color:red"> following errors exists in your excel file</h5>
            </table>
             @endif
             
                
                
                  <div class="table-responsive">
                      <table class="table" >
                          <thead>
                              <tr>
                                  <th>Student ID</th>
                                  <th>Firstname</th>
                                  <th>Lastname</th>
                                  <th>gender</th>
                                  <th>birthday</th>
                                  <th>age</th>
                                  <th>birthplace</th>
                                  <th>phone number</th>
                                  <th>email</th>
                                  <th>Address</th>
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                            @unless(count($students) == 0 )
                          @foreach($students as $student)
                              <tr>
                                <td> {{ $student->studentID }}</td>
                                  <td>{{ $student->firstname }}</td>
                                  <td>{{ $student->lastname }}</td>
                                  <td>{{ $student->gender }}</td>
                                  <td>{{ $student->birthday }}</td>
                                  <td>{{ $student->age }}</td>
                                  <td>{{ $student->birthplace }}</td>
                                  <td>{{ $student->phone }}</td>
                                  <td>{{ $student->email }}</td>
                                  <td>{{ $student->address }}</td>
                                  
                                  <td>
                                      {{-- <a href="/reports/{{$student->id}}" title="View Student"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a> --}}
                                      <a href="/reports/{{$student->id}}/edit" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa-solid fa-pencil" aria-hidden="true"></i> Edit</button></a>
                                      <form method="POST" action="/reports/{{$student->id}}" accept-charset="UTF-8" style="display:inline">
                                         @csrf
                                        @method('DELETE')
                                  
                                          <button id=delbtn class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-o" aria-hidden="true"></i> Delete</button>
                                      </form>
                                  </td>
                              </tr>
                          @endforeach
                           @else

                            <p> no Students found</p>
                            @endunless
                          </tbody>
                      </table>
                  </div>
                 
              </div>
          </div>
      </div>
  </div>
</div>

@endsection