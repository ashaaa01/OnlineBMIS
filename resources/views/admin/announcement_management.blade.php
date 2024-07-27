@extends('layouts.admin_layout')

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
                            <li class="breadcrumb-item active">Announcement Management</li>
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
                                <h3 class="card-title" style="margin-top: 6px;"><strong>Announcement Management</strong></h3>
                                {{-- <button class="btn float-right reload"><i class="fas fa-sync-alt"></i></button> --}}
                            </div>
                            <div class="card-body">
                                <div class="text-right mt-4">                   
                                    <button type="button" id="buttonAddAnnouncement" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddAnnouncement"><i class="fa fa-plus fa-md"></i> New Announcement</button>
                                </div><br>
                                <div class="table-responsive">
                                    <table id="tableAnnouncements" class="table table-sm table-bordered table-hover display nowrap" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Details</th>
                                                <th>Date</th>
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
    

    <!-- Add Announcement Modal Start -->
    <div class="modal fade" id="modalAddAnnouncement" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-info-circle"></i>&nbsp;Announcement Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="formAddAnnouncement" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <!-- For User Id -->
                                    <input type="text" class="form-control" style="display: none" name="user_id" id="userId" aria-label="Default" aria-describedby="inputGroup-sizing-default">

                                    <!-- For Edit -->
                                    <input type="text" class="form-control" style="display: none" name="announcement_id" id="textAannouncementId" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend w-50">
                                            <span class="input-group-text w-100" id="inputGroup-sizing-default">Title</span>
                                        </div>
                                        <input type="text" class="form-control" name="title" id="textAddTitle" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend w-50">
                                            <span class="input-group-text w-100" id="inputGroup-sizing-default">Details</span>
                                        </div>
                                        <textarea type="text" class="form-control" rows="3" name="details" id="textAddDetails" aria-label="Default" aria-describedby="inputGroup-sizing-default"></textarea>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend w-50">
                                            <span class="input-group-text w-100" id="inputGroup-sizing-default">Date</span>
                                        </div>
                                        <input type="datetime-local" class="form-control" name="date" id="textAddDate" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend w-50">
                                            <label class="input-group-text w-100 fw-normal" for="inputGroupFile01">Upload Image</label>
                                        </div>
                                        <input type="text" class="form-control d-none" disabled id="textAddImage"> <!-- Only for showing fetched file -->
                                        <input type="file" class="form-control" name="image" id="fileAddImage">
                                    </div>

                                    <div class="d-none" id="checkboxDivision">
                                        <input type="checkbox" id="checkboxImage" name="checkbox_image">
                                        <label class="font-weight-normal" for="checkboxImage">Re-upload Image</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddAnnouncement" class="btn btn-primary" title="On going module"><i id="iconAddAnnouncement" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- Add Announcement Modal End -->

    <!-- Edit Announcement Status Modal Start -->
    <div class="modal fade" id="modalEditAnnouncementStatus" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editAnnouncementStatusTitle"><i class="fas fa-info-circle"></i> Edit Announcement Status</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="formEditAnnouncementStatus" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <p id="paragraphEditAnnouncementStatus"></p>
                        <input type="hidden" name="announcement_id" placeholder="Announcement Id" id="textEditAnnouncementStatusAnnouncementId">
                        <input type="hidden" name="status" placeholder="Status" id="textEditAnnouncementStatus">
                    </div>
                    
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="buttonEditAnnouncementStatus" class="btn btn-primary"><i id="iconEditAnnouncement" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- Edit Announcement Status Modal End -->
@endsection

<!--     {{-- JS CONTENT --}} -->
@section('js_content')
    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize Select2 Elements
            // $('.bootstrap-5').select2();
            $('.bootstrap-5').select2({
                theme: 'bootstrap-5'
            });

            $('#formAddAnnouncement').on('keydown',function(e) {
                console.log(e.code); // ArrowDown
                console.log(e.keyCode); // 40
                if(["ArrowDown"].indexOf(e.code) > -1) {
                    e.preventDefault();
                }
            });

            $("#buttonAddAnnouncement").on('click',function(){
                $('#checkboxDivision').addClass('d-none');
                $('#textAddImage').addClass('d-none');
                $('#fileAddImage').removeClass('d-none');

                /**
                 * For disabling past dates to be select
                */
                var today = new Date().getTimezoneOffset() * 60000; // offset in milliseconds
                console.log('today ',today);
                
                var localISOTime = (new Date(Date.now() - today)).toISOString();
                console.log('localISOTime ',localISOTime);

                let fullLocalISOTime = localISOTime.slice(0, localISOTime.lastIndexOf(":")); // or .substring(0, 16)
                console.log('localISOTime ',fullLocalISOTime);
                $("#textAddDate").prop('min',fullLocalISOTime);
            });
            
            $("#formAddAnnouncement").submit(function(event){
                event.preventDefault();
                addAnnouncement();
            });

            dataTablesAnnouncements = $("#tableAnnouncements").DataTable({
                "processing" : false,
                "serverSide" : true,
                "responsive": true,
                "orderClasses": false, // disable sorting_1 for unknown background
                // "order": [[ 0, "desc" ],[ 4, "desc" ]],
                "ajax" : {
                    url: "view_announcements",
                },
                "columns":[
                    { "data" : "action", orderable:false, searchable:false},
                    { "data" : "image"},
                    { "data" : "title"},
                    { "data" : "details"},
                    { "data" : "date"},
                    { "data" : "status"},
                ],
                "columnDefs": [
                    { className: 'align-middle', targets: [0, 1, 2, 3, 4, 5] },
                ],
                "createdRow": function(row, data, index) {
                    $('td', row).eq(3).css('white-space', 'normal');
                    // console.log('row ', row);
                    // console.log('data ', data);
                    // console.log('index ', index);
                },
            });

            $(document).on('click', '.actionEditAnnouncement', function(){
                let id = $(this).attr('announcement-id');
                console.log('id ', id);
                $("input[name='announcement_id'", $("#formAddAnnouncement")).val(id);
                getAnnouncementById(id);
            });
            
            $(document).on('click', '.actionEditAnnouncementStatus', function(){
                let announcementStatus = $(this).attr('announcement-status');
                let announcementId = $(this).attr('announcement-id');
                console.log('announcementStatus', announcementStatus);
                console.log('announcementId', announcementId);
                
                $("#textEditAnnouncementStatus").val(announcementStatus);
                $("#textEditAnnouncementStatusAnnouncementId").val(announcementId);

                if(announcementStatus == 1){
                    $("#paragraphEditAnnouncementStatus").text('Are you sure to deactivate the announcement?');
                }
                else{
                    $("#paragraphEditAnnouncementStatus").text('Are you sure to activate the announcement?');
                }
            });

            $("#formEditAnnouncementStatus").submit(function(event){
                event.preventDefault();
                editAnnouncementStatus();
            });
        });
    </script>
@endsection
