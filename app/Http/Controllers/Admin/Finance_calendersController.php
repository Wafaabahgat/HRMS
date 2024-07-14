<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Finance_calender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            Finance_calender::create($dataToInsert);

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