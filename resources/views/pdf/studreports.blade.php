<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students</title>
    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 50px auto;
        }

        tr:nth-of-type(odd){
            background: #eee;
        }
        th{
            background: #3498db
            color: white;
            font-weight: bold;
        }
        td,
        th {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 18px;

        }
        </style>
</head>
<body>
    


    <div style ="width:95%; margin: 0 auto;">
        <div style= "width: 10%; float:left; margin-right: 20px;">
        </div style="width:50%; float: left; ">
            <div>
        </div>
    </div>
    <div class="table-responsive">                   
    <table class="table">
    <thead>
        <tr>
            <th>StudentID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>gender</th>
            <th>birthday</th>
            <th>age</th>
            <th>birthplace</th>
            <th>phone number</th>
            <th>email</th>
            <th>Address</th>
            
        </tr>
    </thead>
    <tbody>
        @unless(count($students) == 0 )
      @foreach($students as $student)
          <tr>
            <td data-column="studentID">{{ $student->studentID }}</td>
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
</div>


</body>
</html>
                 
                         
                         
   
