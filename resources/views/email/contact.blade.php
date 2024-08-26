<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Email</title>
    <link rel="stylesheet" href="{{asset('asset/user/style.css')}}">
</head>

<body>
    <div class="Contact-email-container">
        <div>
            <h2>Name:</h2>
            <span>{{ $maildata['name'] }}</span>
        </div>
        <div>
            <h2>Phone:</h2>
            <span>{{ $maildata['subject'] }}</span>
        </div>
        <div>
            <h2>Email:</h2>
            <span>{{ $maildata['email'] }}</span>
        </div>
        <div>
            <h2>Message:</h2>
            <span>{{ $maildata['message'] }}</span>
        </div>
    </div>

</body>

</html>