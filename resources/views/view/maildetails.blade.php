<!DOCTYPE html>
<html>

   @include('loginheader')
     
<head>
    <title>ItsolutionStuff.com</title>
</head>
@include('loginheader')

<body>

    <div class="container mx-5">
        <h3>{{ $details['title'] }}</h3>
        <p>{{ $details['body'] }}</p>
        <p>{{ $details['main'] }}</p>
        @if (array_key_exists('credentialshead', $details))
            <p>{{ $details['credentialshead'] }}</p>
            <p>{{ $details['credentialsusername'] }}</p>
            <p>{{ $details['credentialpassword'] }}</p>
        @endif

        <!-- Add the styled button -->
        <a class="button btn btn-primary" href="https://example.com">Visit Our Website</a>
    </div>
    @include('footer')
</body>

</html>
