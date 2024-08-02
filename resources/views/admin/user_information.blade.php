@extends('layouts.user_layout')

@section('title', 'Dashboard')
@section('content_page')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        
                    </div>
                    <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Resident Management</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" >
                            <div class="card-header" style="background: linear-gradient(to right, #1BCFB4, #A2EAD5);">
                                <h3 class="card-title" style="margin-top: 7px;"><strong>Resident Management</strong></h3>
                            </div>
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-info-circle"></i>&nbsp;Resident Full Details</h4>
            </div>
            <form id="formViewBarangayResident" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5>I. Identifying Information</h5>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" id="textLastname" readonly placeholder="Lastname">
                                </div>
                                <div class="col-md-3">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="firstname" id="textFirstname" readonly placeholder="Firstname">
                                </div>
                                <div class="col-md-3">
                                    <label for="middleInitial" class="form-label">Middle Initial</label>
                                    <input type="text" class="form-control" name="middle_initial" id="textMiddleInitial" readonly placeholder="Middle Initial">
                                </div>
                                <div class="col-md-3">
                                    <label for="textSuffix" class="form-label">Suffix <small>(e.g Sr., Jr. I, II, III, IV, V, VI)</small></label>
                                    <input type="text" class="form-control" name="suffix" id="textSuffix" readonly placeholder="Suffix">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="gender" class="form-label">Sex</label>
                                    <input type="text" class="form-control" name="gender" id="textGender" readonly placeholder="Sex">
                                </div>
                                <div class="col-md-3">
                                    <label for="birthdate" class="form-label">Birthdate</label>
                                    <input type="text" class="form-control datetimepicker" name="birthdate" id="textBirthdate" readonly placeholder="Birthdate">
                                </div>
                                <div class="col-md-2">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" class="form-control" min="1" max="150" name="age" id="textAge" readonly placeholder="Age" title="Auto generated based on Birthdate" style="width: 100px;">
                                </div>
                                <div class="col-md-4">
                                    <label for="textBirthPlace" class="form-label">Birth Place</label>
                                    <input type="text" class="form-control" name="birth_place" id="textBirthPlace" readonly placeholder="Birth Place" >
                                </div>
                            </div>
                           
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="textNationality" class="form-label">Nationality</label>
                                    <input type="text" class="form-control" name="nationality" id="textNationality" readonly placeholder="Nationality">
                                </div>
                                <div class="col-md-6">
                                    <label for="textReligion" class="form-label">Religion</label>
                                    <input type="text" class="form-control" name="religion" id="textReligion" readonly placeholder="Religion">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="email" id="textEmail" readonly placeholder="Email Address">
                                </div>
                                <div class="col-md-6">
                                    <label for="contact_number" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" name="contact_number" id="textContactNumber" readonly placeholder="Contact Number">
                                </div>
                            </div>

                        <div class="mb-4">
                            <h5>II. Address Information</h5>
                            <hr>
                            <div class="mb-3">
                                <label for="textZone" class="form-label">Zone</label>
                                <input type="text" class="form-control" id="textZone" readonly placeholder="Zone">
                            </div>
                            <div class="mb-3">
                                <label for="textBarangay" class="form-label">Barangay</label>
                                <input type="text" class="form-control" name="barangay" id="textBarangay" readonly placeholder="Barangay">
                            </div>
                            <div class="mb-3">
                                <label for="textMunicipality" class="form-label">Municipality</label>
                                <input type="text" class="form-control" name="municipality" id="textMunicipality" readonly placeholder="Municipality">
                            </div>
                            <div class="mb-3">
                                <label for="textProvince" class="form-label">Province</label>
                                <input type="text" class="form-control" name="province" id="textProvince" readonly placeholder="Province">
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>III. Employment Information</h5>
                            <hr>
                            <div class="mb-3">
                                <label for="textOccupation" class="form-label">Occupation</label>
                                <input type="text" class="form-control" name="occupation" id="textOccupation" readonly placeholder="Occupation">
                            </div>
                            <div class="mb-3">
                                <label for="textMonthlyIncome" class="form-label">Monthly Income</label>
                                <input type="text" class="form-control" name="monthly_income" id="textMonthlyIncome" readonly placeholder="Monthly Income">
                            </div>
                            <div class="mb-3">
                                <label for="textPhilHealthNumber" class="form-label">Phil Health Number</label>
                                <input type="text" class="form-control" name="phil_health_number" id="textPhilHealthNumber" readonly placeholder="Phil Health Number">
                            </div>
                            <div class="mb-3">
                                <label for="textRemarks" class="form-label">Remarks</label>
                                <input type="text" class="form-control" name="remarks" id="textRemarks" readonly placeholder="Remarks">
                            </div>
                            <div class="mb-3">
                                <label for="textRegisteredVoter" class="form-label">A Registered Voter?<span class="text-danger" title="Required">*</span></label>
                                <select readonly class="form-select w-100" id="textRegisteredVoter" name="registered_voter">
                                    <option value="0" disabled selected>Select One</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="votersId" class="form-label">Voter's ID</label>
                                <div class="rounded mb-3" style="overflow: hidden;">
                                    <img src="https://via.placeholder.com/219X200" alt="voters id" id="imgVotersID" style="object-fit: cover; width: 200px; height: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- View Resident Modal End -->

    
@endsection

<!--     {{-- JS CONTENT --}} -->
@section('js_content')
    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize Select2 Elements
            $('.bootstrap-5').select2({ // $('.bootstrap-5').select2();
                theme: 'bootstrap-5'
            });
            
            // Disabled type on datepicker
            $(".datetimepicker").keydown(function(event) { 
                return false;
            });

            $("#textBirthPlace").on('click',function (e) { 
                e.preventDefault();
                // get current datetimepicker's value
                $('.datetimepicker').datepicker('getValue');
            });

            $('.datetimepicker').datepicker({
                format: 'yyyy/mm/dd', // format: 'dd/mm/yyyy',
                forceParse: false, // prevent from clearing existing values from input when no date selected
                autoclose: true, // autoclose date after selecting date
                clearBtn: true, // include clear button
                todayHighlight: true,
            }).on('changeDate', function(e) {
                var today = new Date();
                age = new Date(today - e.date).getFullYear() - 1970;
                $('#textAge').val(age);
                // console.log('date ', e.date);
                // console.log('age ', age);
                // console.log('formatted ', e.format(0,"dd/mm/yyyy"));
            });

            getUserLevel($('#userLevel'));
            
            $("#formAddBarangayResident").submit(function(event){
                event.preventDefault();
                addBarangayResident();
            });

            $("#buttonEditBarangayResident").on('click', function() {
        $('#divReuploadphoto').removeClass('d-none'); // Show the re-upload section
        $('#textAddphoto').removeClass('d-none'); // Show the fetched file text input
        $('#fileAddPhoto').addClass('d-none'); // Hide the file input for uploading a new photo initially
    });

    // Handle the checkbox change event to toggle the visibility of the file input
    $('#checkboxphoto').on('change', function() {
        if ($(this).is(':checked')) {
            $('#fileAddPhoto').removeClass('d-none'); // Show the file input when checkbox is checked
            $('#textAddphoto').addClass('d-none'); // Hide the fetched file text input when checkbox is checked
        } else {
            $('#fileAddPhoto').addClass('d-none'); // Hide the file input when checkbox is unchecked
            $('#textAddphoto').removeClass('d-none'); // Show the fetched file text input when checkbox is unchecked
        }
    });

            dataTablesBarangayResident = $("#tableBarangayResident").DataTable({
                "processing" : false,
                "serverSide" : true,
                "responsive": true,
                "orderClasses": false, // disable sorting_1 for unknown background
                // "order": [[ 0, "desc" ],[ 4, "desc" ]],
                "ajax" : {
                    url: "view_barangay_resident",
                    data: function (param){
                        param.selectFilterGender            = $('#selectFilterGender').val();
                        param.selectFilterCivilStatus       = $('#selectFilterCivilStatus').val();
                        param.textFilterZone               = $('#textFilterZone').val();
                      //  param.textFilterIdNumber            = $('#textFilterIdNumber').val();
                        param.textFilterAge                 = $('#textFilterAge').val();
                        param.dateRangeFrom                 = $('#dateRangeFrom', $('#formDateRange')).val();
                        param.dateRangeTo                   = $('#dateRangeTo', $('#formDateRange')).val();
                    },
                },
                "columns":[
                    { "data" : "action", orderable:false, searchable:false},
                  //  { "data" : "barangay_id_number"},
                    {
                    data: null,
                    render: function (data, type, row) {
                        return `
                        <div style="overflow: hidden;">
                            <img
                            style="object-fit: cover;width:40px;height:40px"
                            src="${data.image}"
                            alt="Product Avatar"
                            />
                        </div>
                        `;
                    }
                    },
                    { "data" : function(data){
                        return capitalizeFirstLetter(data.user_info.lastname) +', '+ capitalizeFirstLetter(data.user_info.firstname);
                    }},
                    { "data" : "age"},
                    { "data" : "gender"},
                    { "data" : "zone"},
                    { "data" : "civil_status"},
                    { "data" : "user_info.contact_number"},
                    { "data" : "created_at"},
                    { "data" : "status"},
                ],
                "columnDefs": [
                    // { className: 'align-middle', targets: [0, 1, 2, 3, 4, 5, 6 ,7] },
                    { className: 'text-center', targets: [0, 1, 2, 3, 4] },
                ],
                "createdRow": function(row, data, index) {
                    $('td', row).eq(1).css('white-space', 'normal');
                    $('td', row).eq(2).css('white-space', 'normal');
                    // console.log('row ', row);
                    // console.log('data ', data);
                    // console.log('index ', index);
                },
            });
            
            // let dataTablesBarangayResidentBlotter = $("#tableBarangayResidentBlotter").DataTable({
            //     "processing" : false,
            //     "serverSide" : true,
            //     "responsive": true,
            //     "orderClasses": false, // disable sorting_1 for unknown background
            //     // "order": [[ 0, "desc" ],[ 4, "desc" ]],
            //     "ajax" : {
            //         url: "view_barangay_resident_blotter_by_resident",
            //         data: function (param){
            //             param.barangayResidentId = $('#barangayResidentId', $('#formViewBarangayResident')).val();
            //         },
            //     },
            //     "columns":[ 
            //         { "data" : function(data){
            //             return data.barangay_resident_blotter_details.case_number;
            //         }},
            //         { "data" : function(data){
            //             return data.barangay_resident_blotter_details.respondent;
            //         }},
            //         { "data" : function(data){
            //             return capitalizeFirstLetter(data.user_info.firstname) + ' ' + capitalizeFirstLetter(data.user_info.lastname);
            //         }},
            //         { "data" : function(data){
            //             return data.barangay_resident_blotter_details.complainant_statement;
            //         }},
            //         { "data" : function(data){
            //             return moment(data.created_at).format("dddd, MMM D YYYY");
            //         }},
            //         { "data" : function(data){
            //             return data.barangay_resident_blotter_details.action_taken;
            //         }},
            //         { "data" : function(data){
            //             return data.barangay_resident_blotter_details.status;
            //         }},
            //     ],
            //     "columnDefs": [
            //         // { className: 'align-middle', targets: [0, 1, 2, 3, 4, 5, 6 ,7] },
            //         // { className: 'text-center', targets: [0, 1, 2, 3, 4] },
            //     ],
            //     "createdRow": function(row, data, index) {
            //         $('td', row).eq(1).css('white-space', 'normal');
            //         $('td', row).eq(2).css('white-space', 'normal');
            //         // console.log('row ', row);
            //         // console.log('data ', data);
            //         // console.log('index ', index);
            //     },
            // });

            let dataTablesBarangayResidentBlotter = $("#tableBarangayResidentBlotter").DataTable({
                "processing" : false,
                "serverSide" : true,
                "responsive": true,
                "orderClasses": false, // disable sorting_1 for unknown background
                // "order": [[ 0, "desc" ],[ 4, "desc" ]],
                "ajax" : {
                    url: "view_barangay_resident_blotter_by_resident",
                    data: function (param){
                        param.barangayResidentId = $('#barangayResidentId', $('#formViewBarangayResident')).val();
                    },
                },
                "columns":[ 
                    { "data" : "case_number"},
                    { "data" : "respondent"},
                    { "data" : "complainant"},
                    { "data" : "complainant_statement"},
                    { "data" : function(data){
                            return moment(data.created_at).format("dddd, MMM D YYYY");
                        }
                    },
                    { "data" : "action_taken"},
                    { "data" : "status"},
                ],
                "columnDefs": [
                    // { className: 'align-middle', targets: [0, 1, 2, 3, 4, 5, 6 ,7] },
                    { className: 'text-start', targets: [ 3] },
                ],
                "createdRow": function(row, data, index) {
                    $('td', row).eq(1).css('white-space', 'normal');
                    $('td', row).eq(2).css('white-space', 'normal');
                    $('td', row).eq(3).css('white-space', 'normal');
                    // $('td', row).eq(4).css('white-space', 'normal');
                    // console.log('row ', row);
                    // console.log('data ', data);
                    // console.log('index ', index);
                },
            });
            $('#modalViewBarangayResident').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var email = button.data('email'); // Extract email from data-* attributes

                var modal = $(this);
                modal.find('#textEmail').val(email); // Set email field value
            });
                        

            $('#buttonAddBarangayResident').on('click', function(){
                getUsersWithResidentInfo($('#selectUser'));
            });

            $(document).on('click', '.actionEditBarangayResident', function(){
                getUsers($('#selectUser'));
                let id = $(this).attr('barangay-resident-id');
                console.log('id ', id);
                $("input[name='barangay_resident_id'", $("#formAddBarangayResident")).val(id);
                getBarangayResidentById(id);
            });
            
            $(document).on('click', '.actionEditBarangayResidentStatus', function(){
                let barangayResidentStatus = $(this).attr('barangay-resident-status');
                let barangayResidentId = $(this).attr('barangay-resident-id');
                
                $("#textEditResidentStatus").val(barangayResidentStatus);
                $("#textEditResidentStatusResidentId").val(barangayResidentId);

                if(barangayResidentStatus == 1){
                    $("#paragraphEditResidentStatus").text('Are you sure to disable?');
                }
                else{
                    $("#paragraphEditResidentStatus").text('Are you sure to enable?');
                }
            });

            $(document).on('click', '.actionViewBarangayResident', function(){
                // alert()
                let id = $(this).attr('barangay-resident-id');
                console.log('resident id ', id);
                $("input[name='barangay_resident_id'", $("#formViewBarangayResident")).val(id);
                viewBarangayResidentById(id);

                /* Resident Blotter */
                dataTablesBarangayResidentBlotter.draw();
            });

            $("#formEditBarangayResidentStatus").submit(function(event){
                event.preventDefault();
                editBarangayResidentStatus();
            });

            $("#formDateRange").submit(function(event) {
                event.preventDefault();
                dataTablesBarangayResident.ajax.reload(null, false);
            });

            $('#checkboxFilterGender').on('click', function(){
                $('#checkboxFilterGender').attr('checked', 'checked');
                
                if($('#checkboxFilterGender').is(':checked')){
                    $('#selectFilterGender').attr('disabled', false);
                }else{
                    $('#checkboxFilterGender').removeAttr('checked');
                    $('#selectFilterGender').attr('disabled', true);
                    $('#selectFilterGender').val('0').trigger('change');
                }
            });

            $('#checkboxFilterCivilStatus').on('click', function(){
                $('#checkboxFilterCivilStatus').attr('checked', 'checked');
                
                if($('#checkboxFilterCivilStatus').is(':checked')){
                    $('#selectFilterCivilStatus').attr('disabled', false);
                }else{
                    $('#checkboxFilterCivilStatus').removeAttr('checked');
                    $('#selectFilterCivilStatus').attr('disabled', true);
                    $('#selectFilterCivilStatus').val('0').trigger('change');
                }
            });

            $('#checkboxFilterZone').on('click', function(){
                $('#checkboxFilterZone').attr('checked', 'checked');
                
                if($('#checkboxFilterZone').is(':checked')){
                    $('#textFilterZone').attr('disabled', false);
                }else{
                    $('#checkboxFilterZone').removeAttr('checked');
                    $('#textFilterZone').attr('disabled', true);
                    $('#textFilterZone').val('');
                }
            });

            $('#checkboxFilterIdNumber').on('click', function(){
                $('#checkboxFilterIdNumber').attr('checked', 'checked');
                
                if($('#checkboxFilterIdNumber').is(':checked')){
                    $('#textFilterIdNumber').attr('disabled', false);
                }else{
                    $('#checkboxFilterIdNumber').removeAttr('checked');
                    $('#textFilterIdNumber').attr('disabled', true);
                    $('#textFilterIdNumber').val('');
                }
            });

            $('#checkboxFilterAge').on('click', function(){
                $('#checkboxFilterAge').attr('checked', 'checked');
                
                if($('#checkboxFilterAge').is(':checked')){
                    $('#textFilterAge').attr('disabled', false);
                }else{
                    $('#checkboxFilterAge').removeAttr('checked');
                    $('#textFilterAge').attr('disabled', true);
                    $('#textFilterAge').val('');
                }
            });

            $('#btnFilter').on('click', function(){
                dataTablesBarangayResident.draw();
                $('#modalFilter').modal('hide');
            });
        });
    </script>
@endsection