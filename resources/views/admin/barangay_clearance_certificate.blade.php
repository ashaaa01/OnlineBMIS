@extends('layouts.admin_layout')

@section('title', 'Dashboard')
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
                            <li class="breadcrumb-item active">Brgy. Clearance Certificate Management</li>
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
                                <h3 class="card-title" style="margin-top: 6px;"><strong>Brgy. Clearance Certificate Management</strong></h3>
                            </div>
                            <div class="card-body">
                                <div class="text-right mt-4">                   
                                    <button type="button" id="buttonAddModalBarangayClearanceCertificate" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddBarangayClearanceCertificate"><i class="fa fa-plus fa-md"></i> New Clearance Certificate</button>
                                </div><br>
                                <div class="table-responsive">
                                    <table id="tableBarangayClearanceCertificate" class="table table-sm table-bordered table-hover display nowrap" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Civil Status</th>
                                                <th>Ticket Number</th>
                                                <th>Ticket Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <!-- Add Clearance Certificate Modal Start -->
    <div class="modal fade" id="modalAddBarangayClearanceCertificate" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-info-circle"></i>&nbsp;Brgy. Clearance Certificate Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="formAddBarangayClearanceCertificate" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <!-- For Edit -->
                                    <input type="hidden" name="barangay_clearance_certificate_id">

                                    <!-- Id of Request Cedula Basis -->
                                    <input type="hidden" name="issuance_configuration_id" id="issuanceConfigurationId">

                                    <div class="mb-3">
                                        <label for="selectResident" class="form-label">Select Resident<span class="text-danger" title="Required">*</span></label>
                                        <select class="form-select" id="selectResident" name="barangay_resident_id">
                                            <!-- Auto Generated -->
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="textTicketNumber" class="form-label">Ticket Number</label>
                                        <input type="text" class="form-control" name="ticket_number" id="textTicketNumber" readonly placeholder="Auto Generated after save">
                                    </div>
                                    <div class="mb-3">
                                        <label for="textTicketDate" class="form-label">Ticket Date</label>
                                        <input type="text" class="form-control" name="ticket_datetime" id="textTicketDate" readonly placeholder="Auto Generated after save">
                                    </div>
                                    <div class="mb-3">
                                        <label for="textTotalAmount" class="form-label">Total amount to be paid <span class="text-primary" title="Amount may vary based on admin"><i class="fas fa-info-circle"></i></span></label>
                                        <input type="text" class="form-control" name="total_amount_paid" id="textTotalAmount" readonly placeholder="Total Amount">
                                    </div>
                                    <div class="mb-3">
                                        <label for="textProcessingTime" class="form-label">Processing Time <span class="text-primary" title="Processing time may vary on admin"><i class="fas fa-info-circle"></i></span></label>
                                        <input type="text" class="form-control" name="cedula_processing_time" id="textProcessingTime" readonly placeholder="Processing Time">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="textPurpose" class="form-label">Purpose<span class="text-danger" title="Required">*</span></label>
                                        <textarea class="form-control" rows="3" name="purpose" id="textPurpose" placeholder="Purpose"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="textORNumber" class="form-label">OR Number<span class="text-danger" title="Required">*</span></label>
                                        <input type="text" class="form-control" name="or_number" id="textORNumber" placeholder="OR Number">
                                    </div>
                                    <div class="mb-3">
                                        <label for="textAmountCollection" class="form-label">Amount Collection<span class="text-danger" title="Required">*</span></label>
                                        <input type="text" class="form-control" name="amount_collection" id="textAmountCollection" placeholder="Amount Collection">
                                    </div>
                                    <div class="mb-3">
                                        <label for="textIssuedOn" class="form-label">Issued On<span class="text-danger" title="Required">*</span></label>
                                        <input type="date" class="form-control" name="issued_on" id="textIssuedOn">
                                    </div>
                                    <div class="mb-3">
                                        <label for="textRemarks" class="form-label">Remarks</label>
                                        <textarea class="form-control" rows="3" name="remarks" id="textRemarks" placeholder="Remarks"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="textStatus" class="form-label">Status<span class="text-danger" title="Required">*</span></label>
                                        <select class="form-select" id="selectStatus" name="status">
                                            <option value="0" disabled selected>Select One</option>
                                            <option value="1">Issued</option>
                                            <option value="2">For issuance</option>
                                            <option value="3">On Process</option>
                                            {{-- <option value="4">Disapproved</option>--}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="buttonAddBarangayClearanceCertificate" class="btn btn-primary"><i id="iconAddBarangayClearanceCertificate" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- Add ClearanceCertificate Modal End -->

    <!-- Edit ClearanceCertificate Status Modal Start -->
    <div class="modal fade" id="modalEditBarangayClearanceCertificateStatus" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editClearanceCertificateStatusTitle"><i class="fas fa-info-circle"></i> Edit Brgy. Clearance Certificate Status</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="formEditBarangayClearanceCertificateStatus" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <p id="paragraphEditClearanceCertificateStatus"></p>
                        <input type="hidden" name="barangay_clearance_certificate_id" id="textEditClearanceCertificateStatusClearanceCertificateId">
                        <input type="hidden" name="status" id="textEditClearanceCertificateStatus">
                    </div>
                    
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="buttonEditBarangayClearanceCertificateStatus" class="btn btn-primary"><i id="iconEditBarangayClearanceCertificateStatus" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- Edit ClearanceCertificate Status Modal End -->
@endsection

<!-- JS CONTENT -->
@section('js_content')
<script type="text/javascript">
    $(document).ready(function () {
        // Initialize Select2 Elements
        $('.bootstrap-5').select2({
            theme: 'bootstrap-5'
        });

        getResidentsBarangayClearance($('#selectResident'));

        $("#formAddBarangayClearanceCertificate").submit(function(event){
            event.preventDefault();
            addBarangayClearanceCertificate();
        });

        const dataTablesBarangayClearanceCertificate = $("#tableBarangayClearanceCertificate").DataTable({
            "processing": false,
            "serverSide": true,
            "responsive": true,
            "orderClasses": false, // disable sorting_1 for unknown background
            "ajax": {
                url: "{{ route('view_barangay_clearance_certificate') }}",
                dataSrc: function (json) {
                    console.log(json); // Log the response data
                    return json.data;
                }
            },
            "columns": [
                { "data": "action", orderable: false, searchable: false },
                { "data": function(data){
                    let firstName = data.resident_info?.user_info?.firstname || 'N/A';
                    let lastName = data.resident_info?.user_info?.lastname || '';
                    return capitalizeFirstLetter(firstName) + ' ' + capitalizeFirstLetter(lastName);
                }},
                { "data": function(data){
                    return data.resident_info?.user_info?.gender || 'N/A';
                }},
                { "data": function(data){
                    return data.resident_info?.user_info?.civil_status || 'N/A';
                }},
                { "data": "ticket_number" },
                { "data": "ticket_datetime" },
                { "data": "status" },
            ],
            "columnDefs": [
                { className: 'align-middle', targets: [0, 1, 2, 3] },
            ],
            "createdRow": function(row, data, index) {
                $('td', row).eq(1).css('white-space', 'normal');
                $('td', row).eq(2).css('white-space', 'normal');
            },
        });

        $(document).on('click', '.actionEditBarangayClearanceCertificate', function(){
            let id = $(this).attr('barangay-clearance-certificate-id');
            $("input[name='barangay_clearance_certificate_id']", $("#formAddBarangayClearanceCertificate")).val(id);
            getBarangayClearanceCertificateById(id);
        });

        function getCedulaBasis() {
            $.ajax({
                url: "{{ route('get_issuance_certification') }}",
                method: "get",
                data: {
                    id: 1, // 6-Cedula, 5-License & Permit, 4-Registration, 3-Residency, 2-Indigency, 1-Brgy. Clearance
                },
                dataType: "json",
                success: function(response) {
                    let issuanceConfigurationDetails = response['issuanceConfigurationDetails'];
                    if(issuanceConfigurationDetails.length > 0) {
                        let processingTime = issuanceConfigurationDetails[0].processing_time;
                        let cedulaProcessingTime;
                        switch(processingTime) {
                            case 1: cedulaProcessingTime = '1 Day'; break;
                            case 2: cedulaProcessingTime = '2 Days'; break;
                            case 3: cedulaProcessingTime = '3 Days'; break;
                            case 4: cedulaProcessingTime = '4 Days'; break;
                            case 5: cedulaProcessingTime = '5 Days'; break;
                            case 6: cedulaProcessingTime = '1 Week'; break;
                            case 7: cedulaProcessingTime = '2 Weeks'; break;
                            case 8: cedulaProcessingTime = '3 Weeks'; break;
                            case 9: cedulaProcessingTime = '1 Month'; break;
                            default: cedulaProcessingTime = 'Other'; break;
                        }
                        $("#issuanceConfigurationId").val(issuanceConfigurationDetails[0].id);
                        $("#textTotalAmount").val(issuanceConfigurationDetails[0].amount);
                        $("#textProcessingTime").val(cedulaProcessingTime);
                    } else {
                        toastr.warning('No records found!');
                    }
                },
                error: function(data, xhr, status) {
                    toastr.error('An error occurred!\n' + 'Data: ' + JSON.stringify(data) + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
                },
            });
        }

        $("#buttonAddModalBarangayClearanceCertificate").on('click', function(event){
            event.preventDefault();
            getCedulaBasis();
        });
    });
</script>
@endsection
