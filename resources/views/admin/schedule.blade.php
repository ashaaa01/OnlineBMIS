@extends('layouts.master')

@section('css')
    <!-- Table css -->
    <link href="{{ URL::asset('plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet"
        type="text/css" media="screen">
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">Brands</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Brands</a></li>
			
 

        </ol>
    </div>
@endsection
@section('button')
    <a href="#addnew" data-toggle="modal" class="btn btn-success btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Add New Brand</a>


@endsection

@section('content')
@include('includes.flash')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
				

                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatable-buttons" class="table table-hover table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                            <thead class="thead-dark">
                                    <tr>
                                        <th data-priority="1">Brand Name</th>
                                        <th data-priority="2">Client Success Manager</th>
                                        <th data-priority="3">Week</th>
                                        <th data-priority="4">Weekly Hours Allocation</th>
                                        <th data-priority="5">Current Allocation</th>
                                        <th data-priority="6">Remaining Working Hours</th>
                                        <th data-priority="7">Weekly Outreach Target</th>
                                        <th data-priority="8">Current Outreach</th>
                                        <th data-priority="9">Remaining Target</th>
                                        <th data-priority="10">Actions</th>
                                     

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as $schedule)
                                        <tr>
                                            <td> {{ $schedule->brand_name }} </td>
                                            <td> {{ $schedule->client_success_manager }} </td>
                                            <td> {{ $schedule->week }} </td>
                                            <td> {{ $schedule->weekly_hours_allocation }} </td>
                                            <td> {{ $schedule->current_allocation }} </td>
                                            <td> {{ $schedule->remaining_working_hours }} </td>
                                            <td> {{ $schedule->weekly_outreach_target }} </td>
                                            <td> {{ $schedule->current_outreach }} </td>
                                            <td> {{ $schedule->remaining_target }} </td>
                                            <td>

                                                <a href="#edit{{ $schedule->slug }}" data-toggle="modal"
                                                    class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i>
                                                    </a>
                                                <!--a href="#delete{{ $schedule->slug }}" data-toggle="modal"
                                                    class="btn btn-danger btn-sm delete btn-flat"><i
                                                        class='fa fa-trash'></i></a-->

                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
								
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    @foreach ($schedules as $schedule)
        @include('includes.edit_delete_schedule')
    @endforeach

    @include('includes.add_schedule')

@endsection


@section('script')
    <!-- Responsive-table-->
    <script src="{{ URL::asset('plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js') }}"></script>
@endsection

@section('script')
    <script>
        $(function() {
            $('.table-responsive').responsiveTable({
                addDisplayAllBtn: 'btn btn-secondary'
            });
        });
    </script>
@endsection
