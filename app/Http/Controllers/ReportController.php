<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

use App\Models\IndigencyCertificate;
use App\Models\ResidencyCertificate;
use Yajra\DataTables\Facades\DataTables;
use App\Models\BarangayClearanceCertificate;

class ReportController extends Controller
{
    public function certificateReport()
    {
        return view('certificates_reports'); // return the Blade view
    }

    public function getCombinedReportData(Request $request)
{
    Log::info('Request Data: ', $request->all());

    $barangayClearanceQuery = BarangayClearanceCertificate::with('resident_info.user_info')
        ->where('is_deleted', 0)
        ->when($request->dateRangeFrom, function ($query) use ($request) {
            return $query->where('created_at', '>=', $request->dateRangeFrom);
        })
        ->when($request->dateRangeTo, function ($query) use ($request) {
            return $query->where('created_at', '<=', $request->dateRangeTo);
        });

    $indigencyQuery = IndigencyCertificate::with('resident_info.user_info')
        ->where('is_deleted', 0)
        ->when($request->dateRangeFrom, function ($query) use ($request) {
            return $query->where('created_at', '>=', $request->dateRangeFrom);
        })
        ->when($request->dateRangeTo, function ($query) use ($request) {
            return $query->where('created_at', '<=', $request->dateRangeTo);
        });

    $residencyQuery = ResidencyCertificate::with('resident_info.user_info')
        ->where('is_deleted', 0)
        ->when($request->dateRangeFrom, function ($query) use ($request) {
            return $query->where('created_at', '>=', $request->dateRangeFrom);
        })
        ->when($request->dateRangeTo, function ($query) use ($request) {
            return $query->where('created_at', '<=', $request->dateRangeTo);
        });

    Log::info('Filtering by document_type: ' . $request->document_type);

    if ($request->has('document_type') && !empty($request->document_type)) {
        if ($request->document_type == 'Barangay Clearance') {
            $barangayClearanceData = $barangayClearanceQuery->get()->map(function ($row) {
                return [
                    'document_type' => 'Barangay Clearance',
                    'requested_by' => $row->resident_info->user_info->firstname . ' ' .
                        ($row->resident_info->user_info->middle_initial ? substr($row->resident_info->user_info->middle_initial, 0, 1) . '.' : '') . ' ' .
                        $row->resident_info->user_info->lastname,
                    'or_number' => $row->or_number,
                    'purpose' => $row->purpose,
                    'amount_collection' => $row->amount_collection,
                    'requested_date' => Carbon::parse($row->created_at)->format('Y-m-d H:i:s'),
                    'remarks' => $row->remarks,
                ];
            });
            $indigencyData = collect(); // Empty collection for Indigency
            $residencyData = collect(); // Empty collection for Residency
        } elseif ($request->document_type == 'Indigency') {
            $barangayClearanceData = collect(); // Empty collection for Barangay Clearance
            $indigencyData = $indigencyQuery->get()->map(function ($row) {
                return [
                    'document_type' => 'Indigency',
                    'requested_by' => $row->resident_info->user_info->firstname . ' ' .
                        ($row->resident_info->user_info->middle_initial ? substr($row->resident_info->user_info->middle_initial, 0, 1) . '.' : '') . ' ' .
                        $row->resident_info->user_info->lastname,
                    'or_number' => $row->or_number,
                    'purpose' => $row->purpose,
                    'amount_collection' => $row->amount_collection,
                    'requested_date' => Carbon::parse($row->created_at)->format('Y-m-d H:i:s'),
                    'remarks' => $row->remarks,
                ];
            });
            $residencyData = collect(); // Empty collection for Residency
        } elseif ($request->document_type == 'Residency') {
            $barangayClearanceData = collect(); // Empty collection for Barangay Clearance
            $indigencyData = collect(); // Empty collection for Indigency
            $residencyData = $residencyQuery->get()->map(function ($row) {
                return [
                    'document_type' => 'Residency',
                    'requested_by' => $row->resident_info->user_info->firstname . ' ' .
                        ($row->resident_info->user_info->middle_initial ? substr($row->resident_info->user_info->middle_initial, 0, 1) . '.' : '') . ' ' .
                        $row->resident_info->user_info->lastname,
                    'or_number' => $row->or_number,
                    'purpose' => $row->purpose,
                    'amount_collection' => $row->amount_collection,
                    'requested_date' => Carbon::parse($row->created_at)->format('Y-m-d H:i:s'),
                    'remarks' => $row->remarks,
                ];
            });
            Log::info('Residency data count: ' . $residencyData->count());
        }
    } else {
        $barangayClearanceData = $barangayClearanceQuery->get()->map(function ($row) {
            return [
                'document_type' => 'Barangay Clearance',
                'requested_by' => $row->resident_info->user_info->firstname . ' ' .
                    ($row->resident_info->user_info->middle_initial ? substr($row->resident_info->user_info->middle_initial, 0, 1) . '.' : '') . ' ' .
                    $row->resident_info->user_info->lastname,
                'or_number' => $row->or_number,
                'purpose' => $row->purpose,
                'amount_collection' => $row->amount_collection,
                'requested_date' => Carbon::parse($row->created_at)->format('Y-m-d H:i:s'),
                'remarks' => $row->remarks,
            ];
        });

        $indigencyData = $indigencyQuery->get()->map(function ($row) {
            return [
                'document_type' => 'Indigency',
                'requested_by' => $row->resident_info->user_info->firstname . ' ' .
                    ($row->resident_info->user_info->middle_initial ? substr($row->resident_info->user_info->middle_initial, 0, 1) . '.' : '') . ' ' .
                    $row->resident_info->user_info->lastname,
                'or_number' => $row->or_number,
                'purpose' => $row->purpose,
                'amount_collection' => $row->amount_collection,
                'requested_date' => Carbon::parse($row->created_at)->format('Y-m-d H:i:s'),
                'remarks' => $row->remarks,
            ];
        });

        $residencyData = $residencyQuery->get()->map(function ($row) {
            return [
                'document_type' => 'Residency',
                'requested_by' => $row->resident_info->user_info->firstname . ' ' .
                    ($row->resident_info->user_info->middle_initial ? substr($row->resident_info->user_info->middle_initial, 0, 1) . '.' : '') . ' ' .
                    $row->resident_info->user_info->lastname,
                'or_number' => $row->or_number,
                'purpose' => $row->purpose,
                'amount_collection' => $row->amount_collection,
                'requested_date' => Carbon::parse($row->created_at)->format('Y-m-d H:i:s'),
                'remarks' => $row->remarks,
            ];
        });
    }

    $combinedData = $barangayClearanceData->merge($indigencyData)->merge($residencyData);

    Log::info('Combined data count: ' . $combinedData->count());

    return DataTables::of($combinedData)->make(true);
}
    public function generateCombinedReportPdf(Request $request)
    {
        // Fetch the data for the report
        $barangayClearanceQuery = BarangayClearanceCertificate::with('resident_info.user_info')
            ->where('is_deleted', 0);

        $indigencyQuery = IndigencyCertificate::with('resident_info.user_info')
            ->where('is_deleted', 0);

        $residencyQuery = ResidencyCertificate::with('resident_info.user_info') // Add this query
            ->where('is_deleted', 0);

        // Apply filtering based on date range and document type
        if ($request->has('document_type') && !empty($request->document_type)) {
            if ($request->document_type == 'Barangay Clearance') {
                $barangayClearanceData = $barangayClearanceQuery->get()->map(function ($row) {
                    return [
                        'document_type' => 'Barangay Clearance',
                        'requested_by' => $row->resident_info->user_info->firstname . ' ' .
                            ($row->resident_info->user_info->middle_initial ? substr($row->resident_info->user_info->middle_initial, 0, 1) . '.' : '') . ' ' .
                            $row->resident_info->user_info->lastname,
                        'or_number' => $row->or_number,
                        'purpose' => $row->purpose,
                        'amount_collection' => $row->amount_collection,
                        'requested_date' => Carbon::parse($row->created_at)->format('Y-m-d H:i:s'),
                        'remarks' => $row->remarks,
                    ];
                });
                $indigencyData = collect(); // Empty collection for Indigency
                $residencyData = collect(); // Empty collection for Residency
            } elseif ($request->document_type == 'Indigency') {
                $barangayClearanceData = collect(); // Empty collection for Barangay Clearance
                $indigencyData = $indigencyQuery->get()->map(function ($row) {
                    return [
                        'document_type' => 'Indigency',
                        'requested_by' => $row->resident_info->user_info->firstname . ' ' .
                            ($row->resident_info->user_info->middle_initial ? substr($row->resident_info->user_info->middle_initial, 0, 1) . '.' : '') . ' ' .
                            $row->resident_info->user_info->lastname,
                        'or_number' => $row->or_number,
                        'purpose' => $row->purpose,
                        'amount_collection' => $row->amount_collection,
                        'requested_date' => Carbon::parse($row->created_at)->format('Y-m-d H:i:s'),
                        'remarks' => $row->remarks,
                    ];
                });
                $residencyData = collect(); // Empty collection for Residency
            } elseif ($request->document_type == 'Residency') {
                $barangayClearanceData = collect(); // Empty collection for Barangay Clearance
                $indigencyData = collect(); // Empty collection for Indigency
                $residencyData = $residencyQuery->get()->map(function ($row) {
                    return [
                        'document_type' => 'Residency',
                        'requested_by' => $row->resident_info->user_info->firstname . ' ' .
                            ($row->resident_info->user_info->middle_initial ? substr($row->resident_info->user_info->middle_initial, 0, 1) . '.' : '') . ' ' .
                            $row->resident_info->user_info->lastname,
                        'or_number' => $row->or_number,
                        'purpose' => $row->purpose,
                        'amount_collection' => $row->amount_collection,
                        'requested_date' => Carbon::parse($row->created_at)->format('Y-m-d H:i:s'),
                        'remarks' => $row->remarks,
                    ];
                });
            }
        } else {
            $barangayClearanceData = $barangayClearanceQuery->get()->map(function ($row) {
                return [
                    'document_type' => 'Barangay Clearance',
                    'requested_by' => $row->resident_info->user_info->firstname . ' ' .
                        ($row->resident_info->user_info->middle_initial ? substr($row->resident_info->user_info->middle_initial, 0, 1) . '.' : '') . ' ' .
                        $row->resident_info->user_info->lastname,
                    'or_number' => $row->or_number,
                    'purpose' => $row->purpose,
                    'amount_collection' => $row->amount_collection,
                    'requested_date' => Carbon::parse($row->created_at)->format('Y-m-d H:i:s'),
                    'remarks' => $row->remarks,
                ];
            });

            $indigencyData = $indigencyQuery->get()->map(function ($row) {
                return [
                    'document_type' => 'Indigency',
                    'requested_by' => $row->resident_info->user_info->firstname . ' ' .
                        ($row->resident_info->user_info->middle_initial ? substr($row->resident_info->user_info->middle_initial, 0, 1) . '.' : '') . ' ' .
                        $row->resident_info->user_info->lastname,
                    'or_number' => $row->or_number,
                    'purpose' => $row->purpose,
                    'amount_collection' => $row->amount_collection,
                    'requested_date' => Carbon::parse($row->created_at)->format('Y-m-d H:i:s'),
                    'remarks' => $row->remarks,
                ];
            });

            $residencyData = $residencyQuery->get()->map(function ($row) {
                return [
                    'document_type' => 'Residency',
                    'requested_by' => $row->resident_info->user_info->firstname . ' ' .
                        ($row->resident_info->user_info->middle_initial ? substr($row->resident_info->user_info->middle_initial, 0, 1) . '.' : '') . ' ' .
                        $row->resident_info->user_info->lastname,
                    'or_number' => $row->or_number,
                    'purpose' => $row->purpose,
                    'amount_collection' => $row->amount_collection,
                    'requested_date' => Carbon::parse($row->created_at)->format('Y-m-d H:i:s'),
                    'remarks' => $row->remarks,
                ];
            });
        }

        $combinedData = $barangayClearanceData->merge($indigencyData)->merge($residencyData);

    $data = [
        'repub_title' => 'Republika ng Pilipinas',
        'province_title' => 'Lalawigan ng Oriental Mindoro',
        'city_title' => 'Bayan ng Bansud',
        'brgy_title' => "BARANGAY PAG-ASA",
        'telephone_title' => "Telephone No.: (049)-502-6234",
        'title' => 'Combined Report',
        'data' => $combinedData, // Ensure this is populated correctly
    ];

    $pdf = PDF::loadView('certificates_reports_pdf', $data);
    $pdf->setPaper('A4', 'landscape');
    return $pdf->stream('Resident Report PDF File.pdf');
}
}
