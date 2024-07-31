<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Barangay Management Information System</title>
    @include('shared.css_links.css_links')
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

    <div class="container" style="margin-top: 1rem">
        <h1 class="fw-bold text-md-center">Registers</h1>
        <p class="text-left mx-auto">Please fill up completely and correctly the required information before each item below. Required items are also marked with an asterisk (<strong style="color: crimson">*</strong>) so please fill it up correctly. Wait for the approval of the website owner to approve your account. </p>
        
        <form method="post" id="formAddUser" enctype="multipart/form-data">
            @csrf
            
            <div class="container" style="margin-top: 1rem">
                <!-- Identifying Information Section -->
                <div class="form-section">
                    <div class="title-box">
                        <h3>I. IDENTIFYING INFORMATION</h3>
                    </div>
                    
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Personal Information Fields -->
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">First Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="firstname" id="textFirstname" placeholder="Firstname">
                                </div>
                                <div class="mb-3">
                                    <label for="lastname" class="form-label">Last Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="lastname" id="textLastname" placeholder="Lastname">
                                </div>
                                <div class="mb-3">
                                    <label for="middleInitial" class="form-label">Middle Initial</label>
                                    <input type="text" class="form-control" name="middle_initial" id="textMiddleInitial" placeholder="Middle Initial">
                                </div>
                                <div class="mb-3">
                                    <label for="textSuffix" class="form-label">Suffix</label>
                                    <input type="text" class="form-control" name="suffix" id="textSuffix" placeholder="Suffix">
                                </div>
                                <div class="mb-3">
                                    <label for="selectGender" class="form-label">Gender<span class="text-danger" title="Required">*</span></label>
                                    <select class="form-select w-100" id="selectGender" name="gender">
                                        <option value="0" disabled selected>Select One</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                        <option value="3">Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="selectCivilStatus" class="form-label">Civil Status<span class="text-danger" title="Required">*</span></label>
                                    <select class="form-select w-100" id="selectCivilStatus" name="civil_status">
                                        <option value="0" disabled selected>Select One</option>
                                        <option value="1">Single</option>
                                        <option value="2">Married</option>
                                        <option value="3">Widow/er</option>
                                        <option value="4">Annulled</option>
                                        <option value="5">Legally Separated</option>
                                        <option value="6">Others</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="birthdate" class="form-label">Birthdate<span class="text-danger" title="Required">*</span></label>
                                    <input type="text" class="form-control datetimepicker" width="276" name="birthdate" id="textBirthdate" placeholder="Birthdate">
                                </div>
                                <div class="mb-3">
                                    <label for="age" class="form-label">Age<span class="text-danger" title="Required">*</span></label>
                                    <input type="number" class="form-control" min="1" max="200" name="age" id="textAge" readonly placeholder="Age" title="Auto generated based on Birthdate">
                                </div>
                                <div class="mb-3">
                                    <label for="lengthOfStayNumber" class="form-label">Length of Stay<span class="text-danger" title="Required">*</span></label>
                                    <div class="dropdown-wrapper row ">
                                        <div class="col-6">
                                            <input type="number" class="form-control" id="lengthOfStayNumber" name="length_of_stay_number" placeholder="Enter number">
                                        </div>
                                        <div class="col-6">
                                            <select class="form-select" id="lengthOfStayUnit" name="length_of_stay_unit">
                                                <option value="years">Years</option>
                                                <option value="months">Months</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Additional Personal Information Fields -->
                                
                                <div class="mb-3">
                                    <label for="textBirthPlace" class="form-label">Birth Place</label>
                                    <input type="text" class="form-control" name="birth_place" id="textBirthPlace" placeholder="Birth Place">
                                </div>
                                <div class="mb-3">
                                    <label for="textZone" class="form-label">Zone</label>
                                    <input type="text" class="form-control" name="zone" id="textZone" placeholder="Zone">
                                </div>
                                <div class="mb-3">
                                    <label for="textBarangay" class="form-label">Barangay</label>
                                    <input type="text" class="form-control" name="barangay" id="textBarangay" placeholder="Barangay">
                                </div>
                                <div class="mb-3">
                                    <label for="textNationality" class="form-label">Nationality<span class="text-danger" title="Required">*</span></label>
                                    <input type="text" class="form-control" name="nationality" id="textNationality" placeholder="Nationality">
                                </div>
                                <div class="mb-3">
                                    <label for="textMunicipality" class="form-label">Municipality</label>
                                    <input type="text" class="form-control" name="municipality" id="textMunicipality" placeholder="Municipality">
                                </div>
                                <div class="mb-3">
                                    <label for="textReligion" class="form-label">Religion<span class="text-danger" title="Required">*</span></label>
                                    <input type="text" class="form-control" name="religion" id="textReligion" placeholder="Religion">
                                </div>
                                <div class="mb-3">
                                    <label for="textOccupation" class="form-label">Occupation</label>
                                    <input type="text" class="form-control" name="occupation" id="textOccupation" placeholder="Occupation">
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
                                    <input type="file" class="form-control" name="voters_id" id="votersId" placeholder="Voter's ID">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact & Account Information Section -->
                <div class="form-section">
                    <div class="title-box">
                        <h3>II. CONTACT & ACCOUNT INFORMATION</h3>
                    </div>
                    
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Contact Information Fields -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address<small>(For Account Activation)</small><span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                                </div>
                                <div class="mb-3">
                                    <label for="textMobileNumber" class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile_number" id="textMobileNumber" placeholder="Mobile Number">
                                </div>
                                <div class="mb-3">
                                    <label for="textUsername" class="form-label">Username<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username" id="textUsername" placeholder="Username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Account Information Fields -->
                                <div class="mb-3">
                                    <label for="textPassword" class="form-label">Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" id="textPassword" placeholder="Password">
                                </div>
                                <div class="mb-3">
                                    <label for="textConfirmPassword" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation" id="textConfirmPassword" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="submit-button text-right mb-3">
                <button class="btn btn-success" type="submit" id="btnAddUser"><i id="btnAddUserIcon" class="fa fa-check"></i> Request Access</button>
            </div>
        </form>
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
    </script>
</body>
</html>
