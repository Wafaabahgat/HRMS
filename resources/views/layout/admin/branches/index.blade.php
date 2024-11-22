@extends('layout.admin')

@section('title')
    الفروع
@endsection


@section('contentheader')
    قائمه الضبط
@endsection

@section('contentheaderactivelink')
    <a href={{ route('branches.index') }}> الفروع </a>
@endsection

@section('contentheaderactive')
    عرض
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center">بيانات الفرع
                    <a class="btn btn-sm btn-success" href={{ route('branches.create') }}>اضافه جديده</a>
                </h3>
            </div>
            <div class="card-body">
                @if (@isset($data) and !@empty($data))
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">
                            <th>كود الفرع</th>
                            <th>الاسم</th>
                            <th>العنوان</th>
                            <th>رقم الهاتف</th>
                            <th>البريد الالكتروني</th>
                            <th>حاله التفعيل</th>
                            <th>الاضافه بواسطه</th>
                            <th>التحديث بواسطه</th>
                            <th></th>

                        </thead>
                        <tbody>
                            @foreach ($data as $info)
                                <tr>
                                    <td> {{ $info->id }} </td>
                                    <td> {{ $info->name }} </td>
                                    <td> {{ $info->address }} </td>
                                    <td> {{ $info->phone }} </td>
                                    <td> {{ $info->email }} </td>
                                    <td class="{{ $info->active == 1 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $info->active == 1 ? 'مفعل' : 'معطل' }}
                                    </td>

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
                                        <a href="{{ route('branches.edit', $info->id) }}"
                                            class="btn btn-success btn-sm">تعديل</a>

                                        <form action="{{ route('branches.destroy', $info->id) }}" method="post">
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
            $(document).on('click', '.show_year_monthes', function() {
                var id = $(this).data('id');
                jQuery.ajax({
                    url: '{{ route('finance_calender.show_year_monthes') }}',
                    type: 'post',
                    'dataType': 'html',
                    cache: false,
                    data: {
                        "_token": '{{ csrf_token() }}',
                        'id': id
                    },
                    success: function(data) {
                        $("#show_year_monthesModalBody").html(data);
                        $("#show_year_monthesModal").modal("show");
                    },
                    error: function() {

                    }
                });
            });
        });
    </script>
@endsection
