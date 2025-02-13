<!DOCTYPE html>
<html>
<head>
    <title>{{ $mailData['subject'] }}</title>
</head>
<body>
    <h1>{{ $mailData['subject'] }}</h1>
    <p>{!! $mailData['message'] !!}</p>
</body>
</html>