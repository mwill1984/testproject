<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sign In | {{ $location['location_name'] }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand" href="#">
            {{ $location['location_name'] }}
        </span>
    </div>
</nav>
<!-- Page content-->
<div class="container">
    <div class="text-center mt-5">
        <h1>Welcome To {{ $location['location_name'] }}</h1>
        <p class="lead">In compliance with covid-19 guidance, we are required to limit the number of shoppers in the store at any given time.
        Please enter your name and email to be added to the queue.  Thank you for your patience.</p>
        
        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br />
                                @endforeach
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('public.checkin') }}">
                        @csrf
                        
                        <input type="hidden" name="location_id" value="{{ $location['id'] }}" />
                        <input type="hidden" name="status_id" value="3" />
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="locationName">
                                First Name
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstName" name="first_name" type="text" placeholder="First Name" value="{{ old('first_name') }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="shopperLimit">
                                Last Name
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastName" name="last_name" type="text" placeholder="Last Name" value="{{ old('last_name') }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="shopperLimit">
                                Email Address
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="text" placeholder="Email" value="{{ old('email') }}">
                        </div>
                        
                        <div class="mb-4">
                            <button class="inline-flex items-center px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">
                                Enter Queue
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
