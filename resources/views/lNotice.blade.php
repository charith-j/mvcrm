<!DOCTYPE html>
<html>
<head>
    <title>{{$bio_data }} - Bio Data</title>
    <style>
        td, th {
            text-align: left;
            
        }
        img {
            display: block;
            margin-top: 10px;
        }

        .centered td {
            text-align: center;
        }
        h3 {
            padding: 0px;
            margin: 0px;
        }
    </style>
</head>
<body>

<table align='left' border='0' cellspacing="0" width="100%">

<th></th>
<td>{{$reference_number}}</td>
<td>{{$date}}</td>
</table>

<table class='centered' align='left' border='0' cellspacing="0" width="100%">
<td><img width='100px' src="{{$logo}}"/><h2>Mary's Friends Foundation</h2><h2>Removal Notice</h2></td>

</table>
   
<table align='left' border='1' cellspacing="0" width="100%">

<tr>
<td><h3>Child Name</h3></td>
<td>{{$name}}</td>
</tr>
<tr>
<td><h3>Date of Birth</h3></td>
<td>{!!$dob!!}</td>
</tr>
<tr>
<td><h3>Project</h3></td>
<td>{{$project}}</td>
</tr>
<tr>
<td><h3>Project Number</h3></td>
<td>{{$project_number}}</td>
</tr>
<tr>
<td><h3>Sponsor</h3></td>
<td>{{$sponsor}}</td>
</tr>
<tr>
<td><h3>Sponsor Number</h3></td>
<td>{{$sponsor_number}}</td>
</tr>
<tr>
<td><h3>Sponsor Address</h3></td>
<td>{{$sponsor_address}}</td>
</tr>
<tr>
<td><h3>Reason For Leaving</h3></td>
<td>{{$reason}}</td>
</tr>

</table>
<h3>Details</h3>
<table align='left' border='1' cellspacing="0" width="100%">

<tr>
<td><h3>Date of Removal</h3></td>
<td>{!!$date_of_removal!!}</td>
</tr>
<tr>
<td><h3>Informed By</h3></td>
<td>{{$informed_by}}</td>
</tr>
<tr>
<td><h3>Copy to</h3></td>
<td>{{$copy_to}}</td>
</tr>

</table>


</body>
</html>
