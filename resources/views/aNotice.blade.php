<!DOCTYPE html>
<html>
<head>
    <title>Allocation Notice</title>
    <style>
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
    <table width='100%'>
<tr><td><b>{!!$date!!}</b></td><td style='text-align:center'><img src='{{$logo}}' width='100px'/></td><td style='text-align:right'><h3 >Allocation Notice</h3></td></tr>
    </table>

<p>{!!$project_address!!}</p>
<p>Dear {{$coordinator_name}}, <p>

<b><u>NEW SPONSORSHIP FOR {{$project_number}}</u></p>
<p>We are pleased to inform that we have found a sponsor from Norway, who is willing to help a Child in your home. The particulars are given below for your information.</p>

<table align='left' border='1' cellspacing="0" width="100%">
<tr>
    <th>Name of the child</th>
    <th>Name and address of the Sponsor</th>
    <th>Sponsor No:</th>
    <th>Sponsor’s e mail address</th>
    <th>Effective from</th>
    </tr>
    <tr>
    <td>{{$name}}</td>
    <td>{{$sponsor_name}}<br> {{$sponsor_address}}</td>
    <td>{{$sponsor_number}}</td>
    <td>{{$sponsor_email}}</td>
    <td>{{$effective_date}}</td>
    </tr>
    </table>
<p>Please send a letter at your earliest to the sponsor thanking for the kind gesture in sponsoring a child and including much information about the Home and the child. Such an early response would encourage the Coordinators in Norway to find more sponsors and also ensure their support.</p>
<p>As instructed by Mary’s Friends Foundation Circular Number 3 & 2, please ensure that the child writes to the sponsor on a regular basis after receiving sponsorship payments.</p>
<p>With Best Wishes</p>
<p>Yours faithfully</p>
<p><b>MARY’S FRIENDS FOUNDATION</b></p>
<br>
<br>
<br>
<br>

<p style='font-size: 18px;'>Asitha Fernando</p>
<p><b>Resident Representative</b></p>

</body>
</html>
