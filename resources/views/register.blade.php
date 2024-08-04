<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Online Barangay Management Information System</title>
    @include('shared.css_links.css_links')
    <style>
        <style>
        .dropdown-wrapper {
            display: flex;
            align-items: center;
        }
        .dropdown-wrapper .form-control {
            margin-right: .5rem;
        }
        .form-control {
            width: 100%;
        }
        .title-box {
            background-color: #128212; /* Green background color */
            padding: 0.5rem 1rem; /* Space inside the box */
            border: 1px solid #dee2e6; /* Border color */
            border-radius: 0.25rem; /* Rounded corners */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            margin-bottom: 1rem; /* Space below the title box */
            font-weight: bold; /* Bold text */
            color: #dee2e6;
        }
        .form-section {
            margin-bottom: 2rem; /* Space below each section */
        }
        .box-background {
            background-color: #f8f9fa; /* Light gray background color */
            padding: 1rem; /* Space inside the box */
            border: 1px solid #dee2e6; /* Border color */
            border-radius: 0.25rem; /* Rounded corners */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            margin-bottom: 1rem; /* Space below the box */
        }
        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* 5% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 70%; /* Adjusted width for a document-like appearance */
            max-width: 800px; /* Max width to ensure it's not too wide */
            border-radius: 8px; /* Rounded corners for a bond-like feel */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Enhanced shadow for depth */
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-header {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        
        
        .modal-dialog {
            max-width: 120%;
            margin: 1.75rem auto;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white px-0">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home Page</a></li>
                <li class="breadcrumb-item active">Register</li>
            </ol>
        </nav>
    </div>

    
    
    <div class="modal fade show" id="documentModal" tabindex="-1" role="dialog" style="display: block;" aria-labelledby="documentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="documentModalLabel"><strong>Registration Form</strong></h1>
                    <a href="{{ route('index') }}"><button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 15px;">
                        <span aria-hidden="true">Close</span>
                    </button></a>
                </div>
                <p class="text-left mx-auto">Please fill up completely and correctly the required information before each item below. Required items are also marked with an asterisk (<strong style="color: crimson">*</strong>) so please fill it up correctly. Wait for the approval of the website owner to approve your account. </p>
        
                <form method="post" id="formAddUser" enctype="multipart/form-data">
                    @csrf
            
                    <div class="container" style="margin-top: 1rem">
                        <!-- Identifying Information Section -->
                        <div class="form-section">
                            <div class="title-box">
                                <h3>I. IDENTIFYING INFORMATION</h3>
                            </div>
                    
                            <div class="">
                                <div class="row mb-3">
                                    <!-- Personal Information Fields -->
                                    <div class="col-md-3">
                                        <label for="firstname" class="form-label">First Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="firstname" id="textFirstname" placeholder="Firstname">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="middleInitial" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" name="middle_initial" id="textMiddleInitial" placeholder="Middle Initial">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="lastname" class="form-label">Last Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="lastname" id="textLastname" placeholder="Lastname">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="textSuffix" class="form-label">Suffix</label>
                                        <input type="text" class="form-control" name="suffix" id="textSuffix" placeholder="Suffix">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="selectGender" class="form-label">Sex<span class="text-danger" title="Required">*</span></label>
                                        <select class="form-select w-100" id="selectGender" name="gender">
                                            <option value="0" disabled selected>Select One</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            {{-- <option value="3">Other</option> --}}
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="selectCivilStatus" class="form-label">Civil Status<span class="text-danger" title="Required">*</span></label>
                                        <select class="form-select w-100" id="selectCivilStatus" name="civil_status">
                                            <option value="0" disabled selected>Select One</option>
                                            <option value="1">Single</option>
                                            <option value="2">Married</option>
                                            <option value="3">Widow/er</option>
                                            <option value="4">Annulled</option>
                                            <option value="5">Legally Separated</option>
                                            {{-- <option value="6">Others</option> --}}
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="textReligion" class="form-label">Religion<span class="text-danger" title="Required">*</span></label>
                                        <select class="form-select w-100" id="textReligion" name="religion">
                                            <option value="0" disabled selected>Select One</option>
                                            <option value="1">Roman Catholic</option>
                                            <option value="2">Islam</option>
                                            <option value="3">Iglesia ni Cristo</option>
                                            <option value="4">Philippine Independent Church</option>
                                            <option value="5">Seventh-Day Adventist</option>
                                            {{-- <option value="6">Others</option> --}}
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="birthdate" class="form-label">Birthdate<span class="text-danger" title="Required">*</span></label>
                                        <input type="text" class="form-control datetimepicker" width="276" name="birthdate" id="textBirthdate" placeholder="Birthdate">
                                    </div>
                                        <div class="col-md-4">
                                        <label for="age" class="form-label">Age<span class="text-danger" title="Required">*</span></label>
                                        <input type="number" class="form-control" min="1" max="200" name="age" id="textAge" readonly placeholder="Age" title="Auto generated based on Birthdate">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="textBirthPlace" class="form-label">Birth Place</label>
                                        <input type="text" class="form-control" name="birth_place" id="textBirthPlace" placeholder="Birth Place">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="lengthOfStayNumber" class="form-label">Length of Stay<span class="text-danger" title="Required">*</span></label>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" id="lengthOfStayNumber" name="length_of_stay_number" placeholder="Enter number">
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-select" id="lengthOfStayUnit" name="length_of_stay_unit">
                                                    <option value="years">Years</option>
                                                    <option value="months">Months</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="textNationality" class="form-label">Nationality<span class="text-danger" title="Required">*</span></label>
                                        <input type="text" class="form-control" name="nationality" id="textNationality" placeholder="Nationality">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3 mb-1">
                                        <label class="form-label" for="permanent_addressInput"><b>Permanent Address</b><span class="text-danger">*</span></label>
                                        <input type="text" id="permanent_addressInput" class="form-control @error('permanent_address') is-invalid @enderror" value="{{ old('permanent_address', 'Oriental Mindoro') }}" readonly >
                                        <input type="hidden" name="permanent_address"  value="{{ old('permanent_address', 'Oriental Mindoro') }}" >
                                        <input type="hidden" name="province"  value="{{ old('province', 'Oriental Mindoro') }}" >
                                        @error('permanent_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                
                                    <div class="col-md-3 mb-1">
                                        <label class="form-label" for="municipalityInput"><b>City/Municipality</b><span class="text-danger"></span></label>
                                        <select id="municipalityInput" name="municipality" class="form-control @error('municipality') is-invalid @enderror" required>
                                            <option value="" disabled selected>Select</option>
                                            <option value="Baco" {{ old('municipality') == 'Baco' ? 'selected' : '' }}>Baco</option>
                                            <option value="Bansud" {{ old('municipality') == 'Bansud' ? 'selected' : '' }}>Bansud</option>
                                            <option value="Bongabong" {{ old('municipality') == 'Bongabong' ? 'selected' : '' }}>Bongabong</option>
                                            <option value="Bulalacao" {{ old('municipality') == 'Bulalacao' ? 'selected' : '' }}>Bulalacao</option>
                                            <option value="Calapan" {{ old('municipality') == 'Calapan' ? 'selected' : '' }}>Calapan</option>
                                            <option value="Gloria" {{ old('municipality') == 'Gloria' ? 'selected' : '' }}>Gloria</option>
                                            <option value="Mansalay" {{ old('municipality') == 'Mansalay' ? 'selected' : '' }}>Mansalay</option>
                                            <option value="Naujan" {{ old('municipality') == 'Naujan' ? 'selected' : '' }}>Naujan</option>
                                            <option value="Pinamalayan" {{ old('municipality') == 'Pinamalayan' ? 'selected' : '' }}>Pinamalayan</option>
                                            <option value="Pola" {{ old('municipality') == 'Pola' ? 'selected' : '' }}>Pola</option>
                                            <option value="Puerto Galera" {{ old('municipality') == 'Puerto Galera' ? 'selected' : '' }}>Puerto Galera</option>
                                            <option value="Roxas" {{ old('municipality') == 'Roxas' ? 'selected' : '' }}>Roxas</option>
                                            <option value="San Teodoro" {{ old('municipality') == 'San Teodoro' ? 'selected' : '' }}>San Teodoro</option>
                                            <option value="Socorro" {{ old('municipality') == 'Socorro' ? 'selected' : '' }}>Socorro</option>
                                            <option value="Victoria" {{ old('municipality') == 'Victoria' ? 'selected' : '' }}>Victoria</option>
                                        </select>
                                        @error('municipality')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                
                                    <div class="col-md-3 mb-1">
                                        <label class="form-label" for="barangaySelect"><b>Barangay</b><span class="text-danger"></span></label>
                                        <input type="text" class="form-control" name="barangay" id="textBarangay" placeholder="Barangay">
                                        @error('barangay')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                
                                    <div class="col-md-3 mb-1">
                                        <label class="form-label" for="textZone"><b>Zone/Street</b></label>
                                        <input type="text" id="textZone" name="zone" class="form-control" placeholder="Enter Zone/Street">
                                    </div>
                                </div>                                
                                
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label for="textOccupation" class="form-label">Occupation</label>
                                        <input type="text" class="form-control" name="occupation" id="textOccupation" placeholder="Occupation">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="textEducation" class="form-label">Educational Attainment</label>
                                        <select readonly class="form-select w-100" id="selectEducationalAttainment" name="educational_attainment"  readonly placeholder="Educational Attainment">
                                            <option value="0" disabled selected>Select One</option>
                                            <option value="1">Elementary Graduate</option>
                                            <option value="2">Elementary Undergraduate</option>
                                            <option value="3">High School Graduate</option>
                                            <option value="4">High School Undergraduate</option>
                                            <option value="5">College Graduate</option>
                                            <option value="6">College Undergraduate</option>
                                            <option value="7">Masters Graduate</option>
                                            <option value="8">Some/Completed Masters Degree</option>
                                            <option value="9">Vocational</option>
                                            <option value="10">Out of School Youth</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="textRegisteredVoter" class="form-label">A Registered Voter?<span class="text-danger" title="Required">*</span></label>
                                    <select class="form-select w-100" id="textRegisteredVoter" name="registered_voter">
                                        <option value="0" disabled selected>Select One</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="votersId" class="form-label">Voter's ID</label>
                                    <input type="file" class="form-control" name="voters_id" id="votersId" accept="image/*" onchange="previewVotersID()">
                                </div>
                                
                                <!-- Voter's ID Preview Area -->
                                <div id="votersIdPreview" style="display:none;">
                                    <img id="votersIdPreviewImage" src="" alt="Voter's ID Preview" style="max-width: 350px; max-height: 250px; width: auto; height: auto;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact & Account Information Section -->
                    <div class="form-section">
                        <div class="title-box">
                            <h3>II. CONTACT & ACCOUNT INFORMATION</h3>
                        </div>
                    
                        <!-- First Row: Email and Mobile Number -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="textEmail" class="form-label">Email Address
                                        <small>(Enter a valid email address.)</small>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" name="email" id="textEmail" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="textMobileNumber" class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile_number" id="textMobileNumber" placeholder="Mobile Number">
                                </div>
                            </div>
                        </div>

                        <!-- Second Row: Username, Password, and Confirm Password -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="textUsername" class="form-label">Username
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="username" id="textUsername" placeholder="Username">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="textPassword" class="form-label">Password
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" name="password" id="textPassword" placeholder="Password" oninput="validatePassword()">
                                    <small id="passwordError" class="text-danger" style="display:none;">Password must be at least 8 characters long and include a mix of letters and numbers.</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="textConfirmPassword" class="form-label">Confirm Password
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" name="password_confirmation" id="textConfirmPassword" placeholder="Confirm Password" oninput="validateConfirmPassword()">
                                    <small id="confirmPasswordError" class="text-danger" style="display:none;">Passwords must match.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row mb-3 align-items-center">
                        <div class="col-auto">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="confirmInfo">
                                <p class="form-check-label" for="confirmInfo">
                                    The information entered above is true and correct. I have full knowledge in providing the above information. I understand that this form contains with my personal information to be stored in the Online Barangay Information System (OBMIS) database.
                                </p>
                            </div>
                        </div>
                        <div class="col-auto ml-auto">
                            <button class="btn btn-success" type="submit" id="btnAddUser"  style="width: 150px; height: 40px; margin-right: 15px;">
                                <i id="btnAddUserIcon" class="fa fa-check"></i> Register
                            </button>
                        </div>
                    </div>
                    <br><br>
                </form>
            </div>
        </div>
    </div>
    
    @include('shared.js_links.js_links')

    <script>
        $(document).ready(function(){
            $("#formAddUser").submit(function(event){
                event.preventDefault();
                addUser();
            });

            // Initialize Select2 Elements
            $('.bootstrap-5').select2({
                theme: 'bootstrap-5'
            });

            // Disabled type on datepicker
            $(".datetimepicker").keydown(function(event) { 
                return false;
            });

            $("#textBirthPlace").on('click',function (e) { 
                e.preventDefault();
                $('.datetimepicker').datepicker('getValue');
            });

            $('.datetimepicker').datepicker({
                format: 'yyyy/mm/dd',
                forceParse: false,
                autoclose: true,
                clearBtn: true,
                todayHighlight: true,
            }).on('changeDate', function(e) {
                var today = new Date();
                age = new Date(today - e.date).getFullYear() - 1970;
                $('#textAge').val(age);
            });

            getUserLevel($('#userLevel'));

            $("#formAddBarangayResident").submit(function(event){
                event.preventDefault();
                addBarangayResident();
            });

            $("#buttonEditBarangayResident").on('click', function() {
                $('#divReuploadphoto').removeClass('d-none');
                $('#textAddphoto').removeClass('d-none');
                $('#fileAddPhoto').addClass('d-none');
            });

            $('#checkboxphoto').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fileAddPhoto').removeClass('d-none');
                    $('#textAddphoto').addClass('d-none');
                } else {
                    $('#fileAddPhoto').addClass('d-none');
                    $('#textAddphoto').removeClass('d-none');
                }
            });
        });
        

            document.addEventListener('DOMContentLoaded', function() {
                const municipalitySelect = document.getElementById('municipalityInput');
                const barangaySelect = document.getElementById('barangaySelect');

                municipalitySelect.addEventListener('change', function() {
                    const selectedMunicipality = this.value;
                    
                    // Hide all optgroups initially
                    const optgroups = barangaySelect.getElementsByTagName('optgroup');
                    for (let optgroup of optgroups) {
                        optgroup.style.display = 'none';
                    }

                    // Show optgroup corresponding to selected municipality
                    const selectedOptgroup = document.getElementById('barangay-' + selectedMunicipality.toLowerCase());
                    if (selectedOptgroup) {
                        selectedOptgroup.style.display = 'block';
                    }
                });

                // Trigger change event initially if there's a selected municipality
                if (municipalitySelect.value !== '') {
                    municipalitySelect.dispatchEvent(new Event('change'));
                }
            });

            function validatePassword() {
                const passwordInput = document.getElementById('textPassword');
                const passwordError = document.getElementById('passwordError');
                const passwordValue = passwordInput.value;

                // Regular expression for password validation (at least 8 characters, includes letters and numbers)
                const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;

                if (!passwordRegex.test(passwordValue)) {
                    // Show error message if the password doesn't meet the criteria
                    passwordError.style.display = 'block';
                } else {
                    // Hide error message if the password meets the criteria
                    passwordError.style.display = 'none';
                }
            }

            function validateConfirmPassword() {
                const passwordInput = document.getElementById('textPassword');
                const confirmPasswordInput = document.getElementById('textConfirmPassword');
                const confirmPasswordError = document.getElementById('confirmPasswordError');
                const passwordValue = passwordInput.value;
                const confirmPasswordValue = confirmPasswordInput.value;

                if (confirmPasswordValue !== '' && passwordValue !== confirmPasswordValue) {
                    // Show error message if passwords do not match
                    confirmPasswordError.style.display = 'block';
                } else {
                    // Hide error message if passwords match or confirm password is empty
                    confirmPasswordError.style.display = 'none';
                }
            }

            function previewVotersID() {
    const votersIdInput = document.getElementById('votersId');
    const votersIdPreview = document.getElementById('votersIdPreview');
    const votersIdPreviewImage = document.getElementById('votersIdPreviewImage');
    const file = votersIdInput.files[0];

    // Reset preview
    votersIdPreview.style.display = 'none';

    if (file) {
        // Validate file type and size (optional)
        const allowedTypes = ['image/jpeg', 'image/png'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        if (!allowedTypes.includes(file.type)) {
            alert('Only JPEG and PNG image files are allowed.');
            votersIdInput.value = ''; // Clear the input
            return;
        }

        if (file.size > maxSize) {
            alert('File size exceeds 2MB.');
            votersIdInput.value = ''; // Clear the input
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            votersIdPreviewImage.src = e.target.result;
            votersIdPreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('confirmInfo');
            const submitButton = document.getElementById('btnAddUser');

            // Function to toggle the button state
            function toggleSubmitButton() {
                submitButton.disabled = !checkbox.checked;
            }

            // Initial check on page load
            toggleSubmitButton();

            // Add event listener to the checkbox
            checkbox.addEventListener('change', toggleSubmitButton);
        });

        var modal = document.getElementById("viewResidentModal");

        // Get the button that opens the modal
        var btn = document.getElementById("viewDetailsBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    </script>
</body>
</html>
