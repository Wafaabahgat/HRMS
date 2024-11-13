<?php

function get_cols_where_p( $model = null, $col_names = array(), $where = array(), $order_field = 'id', $order_type = 'DESC', $pagenation_count = '10' ) {
    $data = $model::select( $col_names )->where( $where )->orderby( $order_field, $order_type )->paginate( $pagenation_count );
    return $data;
}

function get_cols_where_row( $model = null, $col_names = array(), $where = array() ) {
    $data = $model::select( $col_names )->where( $where )->first();
    return $data;
}

function insert( $model = null, $arrayToInsert = array(), $retunData = false ) {
    $falg = $model::create( $arrayToInsert );
    if ( $retunData == true ) {
        $data = get_cols_where_row( $model, array( '*' ), array( $arrayToInsert ) );
        return $data;
    } else {
        return $falg;
    }
}

function update( $model = null, $dataToUpdate = array(), $where = array() ) {
    $falg = $model::where( $where )->update( $dataToUpdate );
    return $falg;
}

function destroy( $model = null, $where = array() ) {
    $falg = $model::where( $where )->delete();
    return $falg;
}
