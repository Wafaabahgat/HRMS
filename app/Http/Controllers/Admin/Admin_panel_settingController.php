<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin_panel_setting;
use Illuminate\Http\Request;

class Admin_panel_settingController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $com_code = auth()->user()->com_code;

        $data = Admin_panel_setting::select( '*' )
        ->where( 'com_code', $com_code )
        ->first();

        return view(
            'layout.admin.Admin_panel_setting.index',
            [ 'data' => $data ]
        );
    }
    /**
    * Edit
    */

    public function edit() {
        $com_code = auth()->user()->com_code;

        $data = Admin_panel_setting::select( '*' )
        ->where( 'com_code', $com_code )
        ->first();

        // dd( $data );
        return view(
            'layout.admin.Admin_panel_setting.edit',
            [ 'data' => $data ]
        );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request ) {
        try {
            $request->validate( Admin_panel_setting::rules() );

            $com_code = auth()->user()->com_code;

            $dataToUpdate = $request->only( [
                'company_name',
                'phones',
                'address',
                'email',
                'after_miniute_calculate_delay',
                'after_miniute_calculate_early_departure',
                'after_miniute_quarterday',
                'after_time_half_daycut',
                'after_time_allday_daycut',
                'monthly_vacation_balance',
                'after_days_begin_vacation',
                'first_balance_begin_vacation',
                'sanctions_value_first_abcence',
                'sanctions_value_second_abcence',
                'sanctions_value_thaird_abcence',
                'sanctions_value_forth_abcence'
            ] );

            $dataToUpdate[ 'updated_by' ] = auth()->user()->id;

            $result = Admin_panel_setting::updateSettings( $com_code, $dataToUpdate );

            if ( $result ) {
                return redirect()->route( 'admin_panel_settings.index' )->with( [ 'success' => 'تم تحديث البيانات بنجاح' ] );
            } else {
                return redirect()->back()->with( [ 'error' => 'فشل في تحديث البيانات' ] )->withInput();
            }
        } catch ( \Exception $ex ) {
            return redirect()->back()->with( [ 'error' => 'عفوا حدث خطأ ما' ] )->withInput();
        }
    }
}
