<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    @if ($position > 0)
        <meta http-equiv="refresh" content="5" />
    @endif
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand" href="#">
            {{ $location['location_name'] }}
        </span>
    </div>
</nav>
<body>
@if ($position > 0)
<div class="container">
    <div class="text-center mt-5">
        <h1>
            Welcome, {{ $shopper->first_name }} {{ $shopper->last_name }}.
            Your current position in the queue is {{ $position }}.  This page 
            will update to let you know when it is your turn to enter.  Thank 
            you for your patience.
        </h1>
        <img src="/images/redlight.png" />
    </div>
</div>
@else
<div class="container">
    <div class="text-center mt-5">
        <h1>You may now enter the store.  Thank you for your patience.  Please
        remember to wear a mask and keep six feet of distance from other shoppers.
        Be sure to check out with the employee as you exit the store.
        Have a great day.</h1>
        <img src="/images/greenlight.png" />
    </div>
</div>
@endif
</body>