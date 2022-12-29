<!DOCTYPE html>
<html>
<head>
    <title>Child Profile {{$child_profile}}</title>
    <style>
   body { font-family: Arial, Helvetica, sans-serif;}
        td, th {
            text-align: left;
            padding: 3px;
        }
        img {
            display: block;
            margin-top: 10px;
        }

        .centered td{
            text-align: center;
        }
    </style>
</head>
<body>

<!-- <table class='centered' border='0' cellspacing="0" width="100%">
<td>{{$name}}</td>
<td>{{$reference_number}}</td>
<td>{{$date}}</td>
</table> -->

<table align='left' border='0' cellspacing="0" width="100%">
<td><h2>Mary's Friends Foundation</h2>@if($project) <h2> {{$project." (".$project_number.")"}} </h2> @endif<h2>{{$date}}</h2></td>
<td><img width='100px' src="{{$logo}}"/></td>
</table>



   
    <!-- <table class='table table-bordered' align='left' border='1' cellspacing="0" width="100%">
<tr>
    <th>Name of Child</th>
    <td>{{$name}}</td>
</tr>
<tr>
    <th>Project Number</th>
    <td>{{$project_number}}</td>
</tr>
<tr>
    <th>Person in Charge</th>
    <td>{{$coordinator}}</td>
</tr>
</table> -->
   
    <table class='table table-bordered' align='left' border='1' cellspacing="0" width="100%">
<tr>
    <th>Name of Child</th>
    <td>{{$name}}</td>
    <td rowspan='7'><img width='100px' src="{{$image1}}"/><img width='100px' src="{{$image2}}"/></td>
</tr>
<tr>
    <th>Sponsor Number</th>
    <td>{{$sponsor_number}}</td>
    
</tr>
<tr>
    <th>Sponsor Name</th>
    <td>{{$sponsor_name}}</td>
   
</tr>

<tr>
    <th>Date of Birth</th>
    <td>{{$dob}}</td>
   
</tr>
<tr>
    <th>Age</th>
    <td>{{$age}}</td>
    
</tr>
<tr>
    <th>Name of School</th>
    <td>{{$school}}</td>
    
</tr>
<tr>

 <th>Grade in School</th>
    <td>{{$grade}}</td>
    
</tr>

<tr>
    <th>Grade Point Average /
Rank in School</th>
    <td colspan='2'>{{$gpa}}</td>
 
</tr>

<tr>
    <th>Education/ Background</th>
<td colspan='2'>{!!$education!!}</td>
</tr>

<tr>
    <th>Bank Savings Balance</th>
    <td colspan='2'>{{$bank_balance}}</td>

</tr>


<tr>
    <th>Comments and Recommendations</th>
    <td colspan='2'>{!!$comments!!}</td>

</tr>
</table>
   



</body>
</html>
