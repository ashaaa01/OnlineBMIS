@php
    $isLogin = false;
    if (!isset($_SESSION)) { 
        session_start(); 
    }

    // Check if the session_user_level_id is set
    if (isset($_SESSION['session_user_level_id'])) {
        $sessionId = $_SESSION['session_user_level_id'];
    } else {
        // Handle the case when the session_user_level_id is not set
        $sessionId = null; // or any default value you prefer
    }

    $layouts = ($sessionId == 1) ? 'layouts.admin_layout' : 'layouts.user_layout';
@endphp
@if ($sessionId  == 1)
    @php $layouts = 'layouts.admin_layout' @endphp
    {{-- {{ $sessionId }} --}}
@else
    @php $layouts = 'layouts.user_layout' @endphp
    {{-- {{ $sessionId }} --}}
@endif

@extends($layouts)
@section('title', 'Dashboard')
@section('content_page')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <h2 class="my-3">Dashboard</h2>

                    @if ($sessionId == 1)
                        <!-- Bar Graph Container -->
                        <div class="bar-graph-container">
                            <canvas id="barGraph"></canvas>
                        </div>
                        <!-- Total Pending Users -->
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <a href="#" class="card card-dashboard" style="background: linear-gradient(to right, #1BCFB4, #A2EAD5); text-decoration: none; color: inherit;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title-dashboard" style="color: #4B545C;">Total Pending Resident</h5>
                                            <h1 class="mt-1 mb-3" id="totalPendingUsers">0</h1>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <span><i class="fa-solid fa-users-slash" style="color: #4B545C;"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Total Residents -->
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <a href="{{ route('resident_management') }}" class="card card-dashboard" style="background: linear-gradient(to right, #1BCFB4, #A2EAD5); text-decoration: none; color: inherit;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title-dashboard" style="color: #4B545C;">Total Residents</h5>
                                            <h1 class="mt-1 mb-3" id="totalResidents">0</h1>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <span><i class="fa-solid fa-users" style="color: #4B545C;"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Total Barangay Clearance Requests -->
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                            <a href="{{ route('barangay_clearance_certificate') }}" class="card card-dashboard" style="background: linear-gradient(to right, #1BCFB4, #A2EAD5); text-decoration: none; color: inherit;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title-dashboard" style="color: #4B545C;">Total Barangay Clearance Requests</h5>
                                            <h1 class="mt-1 mb-3" id="totalBarangayClearanceCertificates">0</h1>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <span><i class="fa-solid fa-file-signature" style="color: #4B545C;"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Total Indigency Requests -->
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <a href="{{ route('indigency_certificate') }}" class="card card-dashboard" style="background: linear-gradient(to right, #1BCFB4, #A2EAD5); text-decoration: none; color: inherit;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title-dashboard" style="color: #4B545C;">Total Indigency Requests</h5>
                                            <h1 class="mt-1 mb-3" id="totalIndigencyCertificates">0</h1>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <span><i class="fa-solid fa-file-signature" style="color: #4B545C;"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Total Residency Requests -->
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <a href="{{ route('residency_certificate') }}" class="card card-dashboard" style="background: linear-gradient(to right, #1BCFB4, #A2EAD5); text-decoration: none; color: inherit;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title-dashboard" style="color: #4B545C;">Total Residency Requests</h5>
                                            <h1 class="mt-1 mb-3" id="totalResidencyCertificates">0</h1>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <span><i class="fa-solid fa-file-signature" style="color: #4B545C;"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Total Business Permit Requests -->
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <a href="{{ route('license_permit_certificate') }}" class="card card-dashboard" style="background: linear-gradient(to right, #1BCFB4, #A2EAD5); text-decoration: none; color: inherit;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title-dashboard" style="color: #4B545C;">Total Business Permit Requests</h5>
                                            <h1 class="mt-1 mb-3" id="totalBusinessPermitRequests">0</h1>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <span><i class="fa-solid fa-file-signature" style="color: #4B545C;"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <!-- User Dashboard Cards -->
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <div class="card card-dashboard" style="background: linear-gradient(to right, #1BCFB4, #A2EAD5);">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title-dashboard">REQUEST</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <span><i class="fa-solid fa-users"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3" id="totalBarangayClearanceRequests">0</h1>
                                    <div class="mb-0">
                                        <span class="text-muted-dashboard">Total Brgy. Clearance Requests</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <div class="card card-dashboard" style="background: linear-gradient(to right, #1BCFB4, #A2EAD5);">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title-dashboard">REQUEST</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <span><i class="fa-solid fa-users"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3" id="totalIndigencyRequests">0</h1>
                                    <div class="mb-0">
                                        <span class="text-muted-dashboard">Total Indigency Requests</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <div class="card card-dashboard" style="background: linear-gradient(to right, #1BCFB4, #A2EAD5);">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title-dashboard">REQUEST</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <span><i class="fa-solid fa-users"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3" id="totalResidencyRequests">0</h1>
                                    <div class="mb-0">
                                        <span class="text-muted-dashboard">Total Residency Requests</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <div class="card card-dashboard" style="background: linear-gradient(to right, #1BCFB4, #A2EAD5);">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title-dashboard">REQUEST</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <span><i class="fa-solid fa-users"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3" id="totalBusinessPermitRequests">0</h1>
                                    <div class="mb-0">
                                        <span class="text-muted-dashboard">Total Business Permit Requests</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection

<!--     {{-- JS CONTENT --}} -->
@section('js_content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script type="text/javascript">
    function renderChart(data) {
    var ctx = document.getElementById('barGraph').getContext('2d');
    var certificateRequestsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Children', 'Youth', 'Adult', 'Senior'], // Sequential numbers for the x-axis labels
            datasets: [
                {
                    label: 'Male',
                    data: [
                        data['totalMaleChildren'],
                        data['totalPendingIndigencyCertificates'],
                        data['totalPendingResidencyCertificates'],
                        data['totalLicensePermitCertificate'],
                        0
                    ],
                    backgroundColor: '#6c757d',
                    borderColor: '#6c757d',
                    borderWidth: 1,
                    barThickness: 30,
                    borderRadius: 5
                },
                {
                    label: 'For Issuance',
                    data: [
                        data['totalProcessingBarangayClearanceCertificates'],
                        data['totalProcessingIndigencyCertificates'],
                        data['totalProcessingResidencyCertificates'],
                        data['totalProcessingLicensePermitCertificate'],
                        0
                    ],
                    backgroundColor: '#4FC1E8',
                    borderColor: '#4FC1E8',
                    borderWidth: 1,
                    barThickness: 30,
                    borderRadius: 5
                },
                {
                    label: 'Issued',
                    data: [
                        data['totalApprovedBarangayClearanceCertificates'],
                        data['totalApprovedIndigencyCertificates'],
                        data['totalApprovedResidencyCertificates'],
                        data['totalApprovedLicensePermitCertificate'],
                        0
                    ],
                    backgroundColor: '#A0D568',
                    borderColor: '#A0D568',
                    borderWidth: 1,
                    barThickness: 30,
                    borderRadius: 5
                },
                {
                    label: 'Total Requests',
                    data: [
                        data['totalBarangayClearanceCertificates'],
                        data['totalIndigencyCertificates'],
                        data['totalResidencyCertificates'],
                        data['totalLicensePermitCertificatesRequests'],
                    ],
                    backgroundColor: [
                        '#FFCE54',
                        '#FFCE54',
                        '#FFCE54',
                        '#FFCE54'
                    ],
                    borderColor: [
                        '#FFCE54',
                        '#FFCE54',
                        '#FFCE54',
                        '#FFCE54'
                    ],
                    borderWidth: 1,
                    barThickness: 30,
                    borderRadius: 5
                }
            ]
        },
        options: {
                plugins: {
                    legend: {
                    position: 'bottom'
                },
                    backgroundColorPlugin: {
                        color: '#f0f0f0' // Set the background color here
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        suggestedMin: 1,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            },
            
        });
    }


    function renderGenderDistributionChart(data) {
        var ctx = document.getElementById('genderDistributionChart').getContext('2d');
        var genderDistributionChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Female', 'Male', 'Other'],
                datasets: [{
                    data: [
                        data['totalFemale'],
                        data['totalMale'],
                        data['totalOther']
                    ],
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#9966FF'
                    ],
                    borderColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#9966FF'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                var label = tooltipItem.label || '';
                                if (label) {
                                    label += ': ' + tooltipItem.raw;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    }

    $(document).ready(function () {
        function getDataForDashboard() {
            $.ajax({
                url: "get_data_for_dashboard",
                method: "get",
                dataType: "json",
                success: function(response) {
                    console.log('response ', response);

                    // Update the text content
                    $('#totalUsers').text(response['totalUsers']);
                    $('#totalPendingUsers').text(response['totalPendingUsers']);
                    $('#totalResidents').text(response['totalResidents']);
                    $('#totalBlotters').text(response['totalBlotters']);
                    $('#totalBarangayClearanceCertificates').text(response['totalBarangayClearanceCertificates']);
                    $('#totalPendingBarangayClearanceCertificates').text(response['totalPendingBarangayClearanceCertificates']);
                    $('#totalProcessingBarangayClearanceCertificates').text(response['totalProcessingBarangayClearanceCertificates']);
                    $('#totalDisapprovedBarangayClearanceCertificates').text(response['totalDisapprovedBarangayClearanceCertificates']);
                    $('#totalApprovedBarangayClearanceCertificates').text(response['totalApprovedBarangayClearanceCertificates']);
                    $('#totalIndigencyCertificates').text(response['totalIndigencyCertificates']);
                    $('#totalResidencyCertificates').text(response['totalResidencyCertificates']);
                    $('#totalLicensePermitCertificatesRequests').text(response['totalLicensePermitCertificatesRequests']);

                    // Render the charts
                    renderChart(response);
                    renderGenderDistributionChart(response);
                },
            });
        }

        getDataForDashboard();
    });
</script>
@endsection





