<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <h1>Login</h1>
    <h1>{{ $accessToken = session('access_token') }}</h1>
    <h1>{{ $userEmail = session('user_email') }}</h1>

    <button id="createProjectButton">Create Project</button>
    
    <script>
        $(document).ready(function() {
            $('#createProjectButton').click(function() {
                $.ajax({
                    url: "{{ route('create-project') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert("Project berhasil dibuat!");
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.log("Error:", error);
                        alert("Error occurred: " + xhr.status + " - " + xhr.responseText);
                    }
                });
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            // Gunakan token dan email dari session Laravel
            var accessToken = {!! json_encode(session('access_token')) !!};
            var userEmail = {!! json_encode(session('user_email')) !!};
            var projectName = userEmail.split('@')[0];

            console.log(`Access Token: ${accessToken}`);
            console.log(`User Email: ${userEmail}`);
            console.log(`Project Name: ${projectName}`);

            $('#sendApiRequest').click(function() {
                $.ajax({
                    url: "https://stg-ch-ai.beoverflow.com/oauth/create-project", // Express.js endpoint
                    type: "POST",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken,
                        'Content-Type': 'application/json'
                    },
                    data: JSON.stringify({
                        email: userEmail,
                        projectName: projectName
                    }),
                    success: function(response) {
                        alert("API call successful! Response: " + JSON.stringify(response));
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.log("Error:", error);
                        alert("Error occurred: " + xhr.status + " - " + xhr.responseText);
                    }
                });
            });
        });
    </script> --}}

</body>

</html>
