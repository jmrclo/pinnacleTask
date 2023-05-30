              
    <table class="table">
    <thead>
        <tr>
            
            <th>Firstname</th>
            <th>Lastname</th>
            <th>gender</th>
            <th>birthday</th>
            <th>age</th>
            <th>birthplace</th>
            <th>phonenumber</th>
            <th>email</th>
            <th>Address</th>
            
        </tr>
    </thead>
    <tbody>
        @unless(count($students) == 0 )
      @foreach($students as $student)
          <tr>
            
            <td data-column="Firstname"> {{ $student->firstname }}</td>
            <td data-column="Lastname">{{ $student->lastname }}</td>
            <td data-column="gender">{{ $student->gender }}</td>
            <td data-column="birthday"> {{ $student->birthday }}</td>
            <td data-column="age"> {{ $student->age }}</td>
            <td data-column="birthplace">{{ $student->birthplace }}</td>
            <td data-column="phone"> {{ $student->phone }}</td>
            <td data-column="email" style="color: dodgerblue;">{{ $student->email }}</td>
            <td data-column="Address"> {{ $student->address }}</td>
              
          </tr>
      @endforeach
       @else

        <p> no Students found</p>
        @endunless
      </tbody>
  </table>


     
                         
                         
   
