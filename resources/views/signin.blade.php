@if(isset(Auth::user()->id))
    <script type="text/javascript">
        window.location = "{{ url('dashboard') }}";
    </script>
@else

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Barangay Management Information System</title>
    @include('shared.css_links.css_links')
    <!-- Bootstrap CSS for Modal -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('/images/svg/omlogos.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex; /* Enable Flexbox */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.7); /* White background with 80% opacity */
            border-radius: 10px; /* Optional: Adds rounded corners */
            padding: 20px; /* Adjust padding as needed */
            max-width: 600px; /* Adjust max-width as needed */
            width: 100%; /* Ensures form container is responsive */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: Adds a subtle shadow */
        }
    </style>
</head>
<body>
    
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    <div class="">
            <div class="form-container">
                
                <a href="{{ route('index') }}"><button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 15px;">
                    <span aria-hidden="true">Close</span>
                </button></a>
                <h1 class="fw-bold text-left">Sign In</h1>
                <p class="text-left">Sign in to personalize your account and easily access your most important information from the website.</p>
                <form id="formSignIn">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 form-check" style="margin-left: 18px;">
                            <input type="checkbox" class="form-check-input" id="showPassword">
                            <label class="form-check-label" for="showPassword">Show Password</label>
                        </div>
                        <div class="col-5 text-right">
                            <a href="#" data-toggle="modal" data-target="#forgotPasswordModal" class="text-decoration-none">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="submit-button text-right">
                        <button class="btn btn-success" id="btnSignIn" type="submit"><i id="btnSignInIcon" class="fa fa-check"></i> Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="alertMessage" class="d-none"></div>
                    <form id="formForgotPassword">
                        @csrf
                        <div class="mb-3">
                            <label for="forgotEmail" class="form-label">Email Address<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" id="forgotEmail" placeholder="Email Address" required>
                        </div>
                        <div class="submit-button text-right">
                            <button class="btn btn-primary" id="btnForgotPassword" type="submit">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>

    @include('shared.js_links.js_links')

    <!-- Bootstrap JS and dependencies for Modal -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
    // Handle the Show Password checkbox toggle
    $('#showPassword').on('change', function() {
        var passwordField = $('#password');
        if (this.checked) {
            passwordField.attr('type', 'text'); // Show password
        } else {
            passwordField.attr('type', 'password'); // Hide password
        }
    });

    $("#formSignIn").submit(function(event){
        event.preventDefault();
        signIn();
    });

            var alertMessage = $("#alertMessage");

            $("#formForgotPassword").submit(function(event){
                event.preventDefault();
                $.ajax({
                    url: '/auth/user/reset-password',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function() {
                        alertMessage.removeClass("alert-danger").addClass("alert-success").text("Password reset link has been sent to your email.").removeClass("d-none");
                    },
                    error: function() {
                        alertMessage.removeClass("alert-success").addClass("alert-danger").text("Failed to send password reset link. Please try again.").removeClass("d-none");
                    }
                })
            });
        });
        
        function forgotPassword() {
            var email = $("#email").val();
            
            // Simulate AJAX request
            setTimeout(function() {
                // Mock response
                var success = true; // Change to false to simulate error

                var alertMessage = $("#alertMessage");
                if(success) {
                    alertMessage.removeClass("alert-danger").addClass("alert-success").text("Password reset link has been sent to your email.").removeClass("d-none");
                } else {
                    alertMessage.removeClass("alert-success").addClass("alert-danger").text("Failed to send password reset link. Please try again.").removeClass("d-none");
                }
                $("#forgotPasswordModal").modal('hide');
            }, 1000);
        }

        document.addEventListener('DOMContentLoaded', function () {
        @if(session('blocked'))
        var cooldown = {{ session('cooldown') }};
        var loginButton = document.getElementById('btnSignIn');
        var countdownElement = document.getElementById('countdown');

        function startCountdown() {
            loginButton.disabled = true; // Disable login button during cooldown

            // Function to update the countdown display
            function updateCountdown() {
                if (cooldown > 0) {
                    countdownElement.innerHTML = 'Please wait ' + cooldown + ' second(s).'; // Update countdown text
                    cooldown--; // Decrease countdown
                    setTimeout(updateCountdown, 1000); // Call updateCountdown again after 1 second
                } else {
                    countdownElement.innerHTML = ''; // Clear countdown text when done
                    loginButton.disabled = false; // Re-enable login button
                }
            }

            updateCountdown(); // Start the countdown
        }

        startCountdown(); // Initialize countdown
    @endif
});
    </script>
        </script>
@endif


