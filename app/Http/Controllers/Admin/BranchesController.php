<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchesRequest;
use App\Models\Branche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchesController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p( new Branche(), array( '*' ), array( 'com_code'=>$com_code ), 'id', 'DESC', PAGENATION_COUNT );

        return view(
            'layout.admin.branches.index',
            [ 'data' => $data ]
        );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        return view( 'layout.admin.branches.create' );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( BranchesRequest $request ) {
        try {
            $com_code = auth()->user()->com_code;
            $CheckExetions =  get_cols_where_row( new Branche(), array( 'id' ), array( 'com_code'=>$com_code, 'name'=>$request->name ) );
            if ( !empty( $CheckExetions ) ) {
                return redirect()->back()->with( [ 'error' => 'عفوا اسم الفرع مسجل من قبل' ] )->withInput();

            }

            DB::beginTransaction();

            $dataToInsert = $request->only( [
                'name',
                'phone',
                'address',
                'active',
                'email'
            ] );
            $dataToInsert[ 'added_by' ] = auth()->user()->id;
            $dataToInsert[ 'com_code' ] = auth()->user()->com_code;

            insert ( new Branche(), $dataToInsert );

            DB::commit();
            return redirect()->route( 'branches.index' )->with( [ 'success' => 'تم اضافه الفرع بنجاح' ] );

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
        $data = get_cols_where_row( new Branche(), array( '*' ), array( 'id'=>$id, 'com_code'=> $com_code ) );

        if ( empty( $data ) ) {
            return redirect()->back()->with( [ 'error' => 'عفوا غير قادر للوصول الي البايات المطلوبه' ] );
        }

        return view( 'layout.admin.branches.update', [ 'data' => $data ] );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( BranchesRequest $request, string $id ) {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row( new Branche(), array( '*' ), array( 'id'=>$id, 'com_code'=> $com_code ) );

            if ( empty( $data ) ) {
                return redirect()->back()->with( [ 'error' => 'عفوا غير قادر للوصول الي البايات المطلوبه' ] );
            }

            DB::beginTransaction();

            $dataToUpdate = $request->only( [
                'name',
                'phone',
                'address',
                'active',
                'email'
            ] );
            $dataToUpdate[ 'updated_by' ] = auth()->user()->id;
            $dataToUpdate[ 'com_code' ] = auth()->user()->com_code;

            // update ( new Branche(), $dataToUpdate );
            update( new Branche(), $dataToUpdate, array( 'id'=>$id, 'com_code'=>$com_code ) );

            DB::commit();

            return redirect()->route( 'branches.index' )->with( [ 'success' => 'تم التعديل بنجاح' ] );

        } catch ( \Exception $ex ) {
            DB::rollBack();
            return redirect()->back()->with( [ 'error' => 'عفوا حدث خطأ ما' ] );
        }
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row( new Branche(), array( '*' ), array( 'id'=>$id, 'com_code'=> $com_code ) );

            if ( empty( $data ) ) {
                return redirect()->back()->with( [ 'error' => 'عفوا لا توجد بيانات' ] );
            }
            DB::beginTransaction();

            destroy( new Branche(), array( 'id'=>$id, 'com_code'=>$com_code ) );

            DB::commit();

            return redirect()->route( 'branches.index' )->with( [ 'success' => 'تم الحذف بنجاح' ] );

        } catch ( \Exception $ex ) {
            DB::rollBack();
            return redirect()->back()->with( [ 'error' => 'عفوا حدث خطأ ما' ] );
        }
    }
}
