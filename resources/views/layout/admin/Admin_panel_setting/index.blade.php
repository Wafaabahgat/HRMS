@extends('layout.admin')

@section('title')
    الضبط العام للنظام
@endsection


@section('contentheader')
    قائمه الضبط
@endsection

@section('contentheaderactivelink')
    <a href={{ route('admin_panel_settings.index') }}> الضبط العام </a>
@endsection

@section('contentheaderactive')
    عرض
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center"> بيانات الضبط العام للنظام </h3>
            </div>
            <div class="card-body">
                @if (@isset($data) and !@empty($data))
                    <table id="example2" class="table table-bordered table-hover">
                        <tr>
                            <td class="width30">اسم الشركة</td>
                            <td class="width30">{{ $data['company_name'] }}</td>
                        </tr>
                    </table>
                @else
                    <p class="bg-danger text-center">عفوا لاتوجد بيانات لعرضها</p>
                @endif

            </div>
        </div>
    </div>
@endsection
