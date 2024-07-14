<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Finance_calender;
use App\Models\Finance_cln_period;
use App\Models\Month;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateInterval;
use DatePeriod;
use DateTime;


class Finance_calendersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Finance_calender::select('*')->orderby('FINANCE_YR', 'DESC')->paginate(11);

        return view(
            'layout.admin.Finance_calender.index',
            ['data' => $data]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layout.admin.Finance_calender.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate(Finance_calender::finance_calender_Req());
            DB::beginTransaction();

            $dataToInsert = $request->only([
                'FINANCE_YR',
                'FINANCE_YR_DESC',
                'start_date',
                'end_date'
            ]);
            $dataToInsert['added_by'] = auth()->user()->id;
            $dataToInsert['com_code'] = auth()->user()->com_code;

            $falg = Finance_calender::create($dataToInsert);
            
            /////////////////////////////////////////////
            if ($falg) {
                $dataParent = Finance_calender::select("id")->where($dataToInsert)->first();
                $startDate = new DateTime($request->start_date);
                $endDate = new DateTime($request->end_date);
                $dareInterval = new DateInterval('P1M');
                $datePerioud = new DatePeriod($startDate, $dareInterval, $endDate);
                
                foreach ($datePerioud as $date) {
                    $dataMonth['finance_calenders_id'] = $dataParent['id'];
                    $Montname_en = $date->format('F');
                    $dataParentMonth = Month::select("id")->where(['name_en' => $Montname_en])->first();
                    $dataMonth['MONTH_ID'] = $dataParentMonth['id'];
                    $dataMonth['FINANCE_YR'] = $dataToInsert['FINANCE_YR'];
                    $dataMonth['START_DATE_M'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                    $dataMonth['END_DATE_M'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                    $dataMonth['year_and_month'] = date('Y-m', strtotime($date->format('Y-m-d')));
                    $datediff = strtotime($dataMonth['END_DATE_M']) - strtotime($dataMonth['START_DATE_M']);
                    $dataMonth['number_of_days'] = round($datediff / (60 * 60 * 24)) + 1;
                    $dataMonth['com_code'] = auth()->user()->com_code;
                    $dataMonth['updated_at'] = date("Y-m-d H:i:s");
                    $dataMonth['created_at'] = date("Y-m-d H:i:s");
                    $dataMonth['added_by'] = auth()->user()->id;
                    $dataMonth['updated_by'] = auth()->user()->id;
                    $dataMonth['start_date_for_pasma'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                    $dataMonth['end_date_for_pasma'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                    Finance_cln_period::insert($dataMonth);
                }
            }
            /////////////////////////////////////////////

            DB::commit();
            return redirect()->route('finance_calender.index')->with(['success' => 'تم إدخال البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Finance_calender::select("*")->where(['id' => $id])->first();
            if (empty($data)) {
                return redirect()->back()->with(['error' => 'عفوا لا توجد بيانات']);
            }
            if ($data['is_open'] != 0) {
                return redirect()->back()->with(['error' => 'عفوا لايمكن فتح السنة المالية في هذه الحالة']);
            }

            $flag = Finance_calender::select("*")->where(['id' => $id])->delete();

            return redirect()->route('finance_calender.index')->with(['success' => 'تم الحذف بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما'])->withInput();
        }
    }
}