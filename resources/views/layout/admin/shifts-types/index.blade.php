@extends('layout.admin')

@section('title')
    نوع الشفتات
@endsection


@section('contentheader')
    قائمه الضبط
@endsection

@section('contentheaderactivelink')
    <a href={{ route('shifts-types.index') }}> انواع شفتات الموظفين </a>
@endsection

@section('contentheaderactive')
    عرض
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center">بيانات الشفت
                    <a class="btn btn-sm btn-success" href={{ route('shifts-types.create') }}>اضافه جديده</a>
                </h3>
            </div>

            {{-- search input --}}
            <div class="row px-4 pt-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>نوع الشفت</label>
                        <select name="type_search" id="type_search" class="form-control">
                            <option value="">بحث كلي</option>
                            <option value="1">صباحي</option>
                            <option value="2">مسائي</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>من عدد الساعات</label>
                        <input type="text" name="hours_from_range" id="hours_from_range" class="form-control"
                            value="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>الي عدد الساعات</label>
                        <input type="text" name="hours_to_range" id="hours_to_range" class="form-control" value="">
                    </div>
                </div>
            </div>

            <div class="card-body" id="ajax_response_searchDiv">
                @if (@isset($data) and !@empty($data))
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">
                            <th> </th>
                            <th>نوع الشفت</th>
                            <th>عدد ساعات الشفت</th>
                            <th>من الساعه</th>
                            <th>الي الساعه</th>
                            <th>تاريخ الاضافه</th>
                            <th>تاريخ التحديث</th>
                            <th></th>

                        </thead>
                        <tbody>
                            @foreach ($data as $info)
                                <tr>
                                    <td> </td>
                                    <td> {{ $info->type }} </td>
                                    <td> {{ $info->total_hours }} </td>
                                    <td> {{ $info->from_time }} </td>
                                    <td> {{ $info->to_time }} </td>
                                    <td>
                                        {{ $info->added->name }}
                                    </td>
                                    <td>
                                        @if ($info->updated_by > 0)
                                            {{ $info->updatedBy->name }}
                                        @else
                                            لايوجد
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('shifts-types.edit', $info->id) }}"
                                            class="btn btn-success btn-sm">تعديل</a>

                                        <form action="{{ route('shifts-types.destroy', $info->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="btn btn are_you_shur btn-sm btn-danger">حذف</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div class="col-md-12 text-center">
                        {{ $data->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <p class="bg-danger text-center">عفوا لاتوجد بيانات لعرضها</p>
                @endif

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function ajax_search() {
                var type_search = $("#type_search").val();
                var hours_from_range = $("#hours_from_range").val();
                var hours_to_range = $("#hours_to_range").val();
                // url: '{{ route('finance_calender.show_year_monthes') }}',
                    type: 'post',
                    'dataType': 'html',
                    cache: false,
                    data: {
                        "_token": '{{ csrf_token() }}',
                        'id': id
                    },
            }
            // $(document).on('click', '.show_year_monthes', function() {
            //     var id = $(this).data('id');
            //     jQuery.ajax({
            //         url: '{{ route('finance_calender.show_year_monthes') }}',
            //         type: 'post',
            //         'dataType': 'html',
            //         cache: false,
            //         data: {
            //             "_token": '{{ csrf_token() }}',
            //             'id': id
            //         },
            //         success: function(data) {
            //             $("#show_year_monthesModalBody").html(data);
            //             $("#show_year_monthesModal").modal("show");
            //         },
            //         error: function() {

            //         }
            //     });
            // });
        });
    </script>
@endsection
