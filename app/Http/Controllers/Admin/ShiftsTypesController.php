<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shiftes_type;
use Illuminate\Http\Request;
use App\Http\Requests\ShiftsTypesRequest;
use Illuminate\Support\Facades\DB;

class ShiftsTypesController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p( new Shiftes_type(), array( '*' ), array( 'com_code'=>$com_code ), 'id', 'DESC', PAGENATION_COUNT );

        return view(
            'layout.admin.shifts-types.index',
            [ 'data' => $data ]
        );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        return view( 'layout.admin.shifts-types.create' );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( ShiftsTypesRequest $request ) {
        try {
            $com_code = auth()->user()->com_code;
            $dataToInsert[ 'com_code' ] = auth()->user()->com_code;
            $dataToInsert = $request->only( [
                'type',
                'from_time',
                'to_time',
                'total_hours'
            ] );
            $dataToInsert[ 'added_by' ] = auth()->user()->id;

            $CheckExetions =  get_cols_where_row( new Shiftes_type(), array( 'id' ), $dataToInsert );

            if ( !empty( $CheckExetions ) ) {
                return redirect()->back()->with( [ 'error' => 'عفوا هذه البيانات مسجله من قبل' ] )->withInput();
            }
            $dataToInsert[ 'active' ] = $request->active;

            DB::beginTransaction();

            insert ( new Shiftes_type(), $dataToInsert );

            DB::commit();
            return redirect()->route( 'shifts-types.index' )->with( [ 'success' => 'تم اضافه الشفت بنجاح' ] );

        } catch( \Exception $ex ) {
            DB::rollBack();
            return redirect()->back()->with( [ 'error' => 'عفوا حدث خطأ ما'.$ex->getMessage() ] )->withInput();
        }
    }

    /**
    * Display the specified resource.
    */

    public function show( string $id ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( string $id ) {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row( new Shiftes_type(), array( '*' ), array('id'=>$id, 'com_code'=>$com_code ) );

        if ( empty( $data ) ) {
            return redirect()->back()->with( [ 'error' => 'عفوا غير قادر للوصول الي البايات المطلوبه' ] );
        }
        
        return view(
            'layout.admin.shifts-types.edit',
            [ 'data' => $data ]
        );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row( new Shiftes_type(), array( '*' ), array( 'id'=>$id, 'com_code'=> $com_code ) );

            if ( empty( $data ) ) {
                // return redirect()->back()->with( [ 'error' => 'عفوا لا توجد بيانات' ] );
                return redirect()->route( 'shifts-types.index' )->with( [ 'error' => 'عفو غير قادر ع الوصول للبيانات المطلوبه' ] );
            }
            DB::beginTransaction();

            destroy( new Shiftes_type(), array( 'id'=>$id, 'com_code'=>$com_code ) );

            DB::commit();

            return redirect()->route( 'shifts-types.index' )->with( [ 'success' => 'تم الحذف بنجاح' ] );

        } catch ( \Exception $ex ) {
            DB::rollBack();
            return redirect()->back()->with( [ 'error' => 'عفوا حدث خطأ ما' ] );
        }
    }
}
