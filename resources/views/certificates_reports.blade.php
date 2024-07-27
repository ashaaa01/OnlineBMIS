@extends('layouts.admin_layout')

@section('title', 'Report Management')

@section('content_page')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Report Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Combined Report -->
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background: linear-gradient(to right, #1BCFB4, #A2EAD5);">
                            <h3 class="card-title" style="margin-top: 6px;"><strong>Document Report</strong></h3>
                        </div>
                        <div class="card-body mt-4">
                            <div class="row">
                                <!-- Date Range Filter -->
                                <div class="col-md-6">
                                    <form method="get" id="filterForm">
                                        <div class="input-group input-group-sm mb-3">
                                            <!-- Date Range From -->
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Date Range From:</span>
                                            </div>
                                            <input type="datetime-local" class="form-control" name="from" id="dateRangeFrom" style="min-width: 70px;">
                
                                            <!-- To -->
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">To:</span>
                                            </div>
                                            <input type="datetime-local" class="form-control" name="to" id="dateRangeTo" style="min-width: 70px;">
                
                                            <!-- Search -->
                                            <div class="input-group-prepend">
                                                <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Document Type Filter -->
                                <div class="col-md-4">
                                    <form method="get" id="formFilter">
                                        <div class="input-group input-group-sm mb-3">
                                            <!-- Filters -->
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Document Type:</span>
                                            </div>
                                            <select class="form-control" id="documentType" name="document_type">
                                                <option value="">All</option>
                                                <option value="Barangay Clearance">Barangay Clearance</option>
                                                <option value="Indigency">Indigency</option>
                                                <option value="Indigency">Residency</option>
                                            </select>
                                            <button type="button" class="btn btn-primary" id="filterButton">Filter</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- PDF Button -->
                                <div class="col-md-2 text-right">
                                    <form id="pdfForm" method="get" action="{{ route('combinedReportPdf') }}" target="_blank">
                                        <input type="hidden" name="document_type" id="pdfDocumentType">
                                        <button type="submit" class="btn btn-primary" id="buttonPrintCombinedReport"><i class="fa fa-print fa-md"></i> Print</button>
                                    </form>
                                </div>
                            </div>
                        
                            <br>
                            <div class="table-responsive">
                                <table id="tableCombinedReport" class="table table-bordered table-hover nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Document Type</th>
                                            <th>Requested By</th>
                                            <th>OR Number</th>
                                            <th>Purpose</th>
                                            <th>Amount Collected</th>
                                            <th>Requested Date</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be populated by DataTables -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js_content')
<script>
     $(document).ready(function () {
        var table = $('#tableCombinedReport').DataTable({
            processing: false,
            serverSide: true,
            responsive: true,
            ajax: {
                url: '{{ route('getCombinedReportData') }}',
                data: function (d) {
                    d.dateRangeFrom = $('#dateRangeFrom').val();
                    d.dateRangeTo = $('#dateRangeTo').val();
                    d.document_type = $('#documentType').val(); // Pass the filter value
                }
            },
            columns: [
                { data: 'document_type', name: 'document_type' },
                { data: 'requested_by', name: 'requested_by' },
                { data: 'or_number', name: 'or_number' },
                { data: 'purpose', name: 'purpose' },
                { data: 'amount_collection', name: 'amount_collection' },
                { data: 'requested_date', name: 'requested_date' },
                { data: 'remarks', name: 'remarks' }
            ],
            columnDefs: [
                { className: 'text-center', targets: '_all' }
            ]
        });

        $("#formDateRange").submit(function(event) {
                event.preventDefault();
                dataTablesBarangayResident.ajax.reload(null, false);
            });
        
            $('#documentType').change(function() {
                table.draw();
            });

        // Event listener for the filter button
        $('#filterButton').on('click', function () {
            table.ajax.reload(); // Reload the table data with the new filter
        });

        // Event listener for the print button
        $('#buttonPrintCombinedReport').on('click', function () {
            $('#pdfDocumentType').val($('#documentTypeFilter').val());
        });
    });
</script>
@endsection
