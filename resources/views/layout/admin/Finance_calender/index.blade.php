@extends('layout.admin')

@section('title')
    السنوات الماليه
@endsection


@section('contentheader')
    قائمه الضبط
@endsection

@section('contentheaderactivelink')
    <a href={{ route('finance_calender.index') }}> السنوات الماليه </a>
@endsection

@section('contentheaderactive')
    عرض
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center"> بيانات السنوات الماليه
                    <a class="btn btn-sm btn-success" href={{ route('finance_calender.create') }}>اضافه جديده</a>
                </h3>
            </div>
            <div class="card-body">
                @if (@isset($data) and !@empty($data))
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">
                            <th>كود السنه</th>
                            <th>وصف السنه</th>
                            <th>تاريخ البدايه</th>
                            <th>تاريخ النهايه</th>
                            <th>الاضافه بواسطه</th>
                            <th>التحديث بواسطه</th>
                            <th></th>

                        </thead>
                        <tbody>
                            @foreach ($data as $info)
                                <tr>
                                    <td> {{ $info->FINANCE_YR }} </td>
                                    <td> {{ $info->FINANCE_YR_DESC }} </td>
                                    <td> {{ $info->start_date }} </td>
                                    <td> {{ $info->end_date }} </td>
                                    <td> {{ $info->added->name }} </td>
                                    <td>
                                        @if ($info->updated_by > 0)
                                            {{ $info->updatedby->name }}
                                        @else
                                            لايوجد
                                        @endif
                                    </td>
                                    <td>
                                        @if ($info->is_open == 0)
                                            {{-- @if ($CheckDataOpenCounter == 0)
                                            <a href="{{ route('finance_calender.do_open', $info->id) }}"
                                                class="btn btn-primary btn-sm">فتح</a>
                                        @endif --}}
                                            <a href="{{ route('finance_calender.edit', $info->id) }}"
                                                class="btn btn-success btn-sm">تعديل</a>
                                            <form action="{{ route('finance_calender.destroy', $info->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="btn btn are_you_shur btn-sm btn-danger">حذف</button>
                                            </form>
                                            {{-- <button class="btn btn-sm btn-info show_year_monthes"
                                            data-id="{{ $info->id }}">عرض الشهور</button> --}}
                                        @else
                                            سنة مالية مفتوحه
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="bg-danger text-center">عفوا لاتوجد بيانات لعرضها</p>
                @endif

            </div>
        </div>
    </div>
@endsection
