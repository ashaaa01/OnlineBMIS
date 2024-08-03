@extends('layouts.admin_layout')

@section('title', 'Dashboard')
@section('content_page')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- Empty column for spacing -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Resident Report Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background: linear-gradient(to right, #1BCFB4, #A2EAD5);">
                            <h3 class="card-title" style="margin-top: 6px;"><strong>Resident Report</strong></h3>
                        </div>

                        <div class="card-body">
                            <form method="get" id="formFilter">
                                <div class="input-group input-group-sm mb-3">
                                    <!-- Filters -->
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Sex:</span>
                                    </div>
                                    <select class="form-select" name="filter_gender" id="selectFilterGender">
                                        <option value="">All</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                        <option value="3">Other</option>
                                    </select>

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Zone:</span>
                                    </div>
                                    <select class="form-select" name="filter_zone" id="textFilterZone">
                                        <option value="">All</option>
                                        <option value="1">Zone 1</option>
                                        <option value="2">Zone 2</option>
                                        <option value="3">Zone 3</option>
                                        <option value="4">Zone 4</option>
                                        <option value="5">Zone 5</option>
                                        <option value="6">Zone 6</option>
                                        <!-- Add more zones as needed -->
                                    </select>

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Civil Status:</span>
                                    </div>
                                    <select id="selectFilterCivilStatus" name="selectFilterCivilStatus" class="form-select">
                                        <option value="">All</option>
                                        <option value="1">Single</option>
                                        <option value="2">Married</option>
                                        <option value="3">Widow/er</option>
                                        <option value="4">Annulled</option>
                                        <option value="5">Legally Separated</option>
                                        <option value="6">Others</option>
                                    </select>

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Educational Attainment:</span>
                                    </div>
                                    <select id="selectFilterEducationalAttainment" name="selectFilterEducationalAttainment" class="form-select">
                                        <option value="">All</option>
                                        <option value="1">Elementary Graduate</option>
                                        <option value="2">Elementary Undergraduate</option>
                                        <option value="3">High School Graduate</option>
                                        <option value="4">High School Undergraduate</option>
                                        <option value="5">College Graduate</option>
                                        <option value="6">College Undergraduate</option>
                                        <option value="7">Masters Graduate</option>
                                        <option value="8">Some/Completed Masters Degree</option>
                                        <option value="9">Vocational</option>
                                        <option value="10">Others</option>
                                    </select>

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Age:</span>
                                    </div>
                                    <input type="text" class="form-select" name="filter_age" id="textFilterAge" placeholder="Enter age">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Age Category:</span>
                                    </div>
                                    <select id="filter_age_category" class="form-select">
                                        <option value="">All</option>
                                        <option value="Children">Children (0-14)</option>
                                        <option value="Youth">Youth (15-24)</option>
                                        <option value="Adult">Adult (25-64)</option>
                                        <option value="Senior">Senior (65+)</option>
                                    </select>

                                    <div class="input-group-prepend">
                                        <button type="button" id="btnFilter" class="btn btn-info"><i class="fas fa-filter"></i> Filter</button>
                                    </div>
                                </div>
                            </form>
                            
                            <div class="text-right mt-4">
                                <a href="#" class="btn btn-primary" id="buttonPrint" onclick="printPDF()"><i class="fa fa-print fa-md"></i> Print</a>
                            </div>

                            <div class="table-responsive mt-3">
                                <table id="tableBarangayResident" class="table table-bordered table-hover nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Age Category</th>
                                            <th>Sex</th>
                                            <th>Zone</th>
                                            <th>Civil Status</th>
                                            <th>Occupation</th>
                                            <th>Religion</th>
                                            <th>Educational Attainment</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div> <!-- End of card-body -->
                    </div> <!-- End of card -->
                </div> <!-- End of col-md-12 -->
            </div> <!-- End of row -->
        </div> <!-- End of container-fluid -->
    </section> <!-- End of content -->
</div> <!-- End of content-wrapper -->

@section('js_content')
<script type="text/javascript">
    $(document).ready(function () {
        // Initialize Select2 Elements
        $('.bootstrap-5').select2({
            theme: 'bootstrap-5'
        });
        
        // Datepicker initialization
        $(".datetimepicker").datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true,
            clearBtn: true,
            todayHighlight: true,
        }).on('changeDate', function(e) {
            var today = new Date();
            var age = new Date(today - e.date).getFullYear() - 1970;
            $('#textAge').val(age);
        });

        // DataTables initialization
        // Initialize DataTables with age category filter
let dataTablesBarangayResident = $("#tableBarangayResident").DataTable({
    processing: false,
    serverSide: true,
    responsive: true,
    ajax: {
        url: "view_barangay_resident",
        data: function (param) {
            param.selectFilterGender = $('#selectFilterGender').val();
            param.textFilterZone = $('#textFilterZone').val();
            param.selectFilterCivilStatus = $('#selectFilterCivilStatus').val();
            param.selectFilterEducationalAttainment = $('#selectFilterEducationalAttainment').val();
            param.textFilterAge = $('#textFilterAge').val();
            param.filter_age_category = $('#filter_age_category').val();
        }
    },
    columns: [
        { data: function(data) { return capitalizeFirstLetter(data.user_info.firstname) + ' ' + capitalizeFirstLetter(data.user_info.lastname); }},
        { data: "age" },
        { data: "age_category" },
        { data: "gender" },
        { data: "zone" },
        { data: "civil_status" },
        { data: "occupation" },
        { data: "religion" },
        { data: "educational_attainment" },
    ],
    columnDefs: [
        { className: 'text-center', targets: [0, 1, 2, 3, 4] },
    ],
    createdRow: function(row, data, index) {
        $('td', row).eq(1).css('white-space', 'normal');
        $('td', row).eq(2).css('white-space', 'normal');
    },
});

// Filter button click event
$('#btnFilter').on('click', function() {
    dataTablesBarangayResident.draw();
});


        // Print button function
        window.printPDF = function() {
    var gender = $('#selectFilterGender').val();
    var zone = $('#textFilterZone').val();
    var civil_status = $('#selectFilterCivilStatus').val();
    var age_category = $('#filter_age_category').val();
    var url = 'resident-report?gender=' + gender + '&zone=' + zone + '&civil_status=' + civil_status + '&age_category=' + age_category;
    window.open(url, '_blank');
};
    });
</script>
@endsection
@endsection
