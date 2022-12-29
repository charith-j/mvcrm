<!DOCTYPE html>
<html>
<head>
    <title>{{$bio_data }} - Bio Data</title>
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

<table class='centered' border='0' cellspacing="0" width="100%">
<td>{{$name}}</td>
<td>{{$reference_number}}</td>
<td>{{$date}}</td>
</table>

<table class='centered' align='left' border='0' cellspacing="0" width="100%">
<td><img width='100px' src="{{$logo}}"/><h2>Bio Data</h2><h2>Mary's Friends Foundation</h2></td>

</table>

<table class='centered' align='left' border='0' cellspacing="0" width="100%">
<td><img width='100px' src="{{$image1}}"/><img width='100px' src="{{$image2}}"/></td>
</table>

<h2>1. Basic Information</h2>
<h3>Project</h3>
   
    <table class='table table-bordered' align='left' border='1' cellspacing="0" width="100%">
<tr>
    <th>Name of Project</th>
    <td>{{$project}}</td>
</tr>
<tr>
    <th>Project Number</th>
    <td>{{$project_number}}</td>
</tr>
<tr>
    <th>Person in Charge</th>
    <td>{{$coordinator}}</td>
</tr>
</table>

<h3>Child</h3>
   
    <table class='table table-bordered' align='left' border='1' cellspacing="0" width="100%">
<tr>
    <th>Name of Child</th>
    <td>{{$name}}</td>
</tr>
<tr>
    <th>Common Name</th>
    <td>{{$common_name}}</td>
</tr>
<tr>
    <th>Gender</th>
    <td>{{$gender}}</td>
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
    <th>Ethnicity</th>
    <td>{{$ethnicity}}</td>
</tr>
<tr>
    <th>Religion</th>
    <td>{{$religion}}</td>
</tr>
<tr>
    <th>Grade in School</th>
    <td>{{$grade}}</td>
</tr>
<tr>
    <th>Name of School</th>
    <td>{{$school}}</td>
</tr>
<tr>
    <th>Special Interests</th>
    <td>{{$interests}}</td>
</tr>
</table>
   <br><br><br><br><br>
    
<h2>2. Background Information</h2>
<h3>Family</h3>
   
    <table class='table table-bordered' align='left' border='1' cellspacing="0" width="100%">
<tr>
    <th>Name of Father</th>
    <td>{{$name_of_father}}</td>
    <th>Age</th>
    <td colspan='2'>{{$age_of_father}}</td>
  
</tr>
<tr>
<th>Name of Mother</th>
<td>{{$name_of_mother}}</td>
    <th>Age</th>
    <td colspan='2'>{{$age_of_mother}}</td>

 
</tr>
<tr>
    <th>Number of Brothers</th>
    <th>Elder</th>
    <td>{{$no_of_elder_bros}}</td>
    <th>Younger</th>
    <td>{{$no_of_younger_bros}}</td>
</tr>
<tr>
    <th>Number of Sisters</th>
    <th>Elder</th>
    <td>{{$no_of_elder_sis}}</td>
    <th>Younger</th>
    <td>{{$no_of_younger_sis}}</td>
</tr>
</table>

<h2>3. Details of the Child</h2>

        <div>{!!$details_of_child!!}</div>

<h3>{{$date}}</h3>
</body>
</html>
