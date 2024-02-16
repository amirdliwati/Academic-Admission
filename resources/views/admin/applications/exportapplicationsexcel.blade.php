<table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Code</th>
                  <th>Student Name</th>
                  <th>Program</th>
                  <th>Program Level</th>
                  <th>University</th>
                  <th>Status</th>

                </thead>
                <tbody>
            @foreach($allapplication as $myapplication)
                <tr>
                  <td>{{$myapplication->id}}</td>
                  <td>{{$myapplication->code}}</td>
                  <td>{{$myapplication->student->first_name}}  {{" "}} {{$myapplication->student->last_name}}</td>
                  @foreach ($myapplication->student->programs as $detailsstudent)
                  <td>{{$detailsstudent->p_name}}</td>
                  <td>{{$detailsstudent->p_level}}</td>
                  <td>{{$detailsstudent->institute_name}}</td>
                  @break
                  @endforeach
                  <td>{{$myapplication->status}}</td>
                </tr>
            @endforeach

                </tbody>
              </table>
                
     <?php        
      header("Content-Type: application/xls");
      header("Content-Disposition: attachment; filename=All Applications.xls");
       //echo $output  ?>

