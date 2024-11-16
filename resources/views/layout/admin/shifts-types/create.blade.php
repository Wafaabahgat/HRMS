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
                <h3 class="card-title card_title_center"> اضافه شفت جديد</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('shifts-types.store') }}" method="post">
                    <div class="row">
                        @csrf

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>نوع الشفت</label>
                                <select name="type" value="type" class="form-control">
                                    <option value="">اختر النوع</option>
                                    <option @if (old('type') == 1) selected @endif value="1">صباحي</option>
                                    <option @if (old('type') == 2) selected @endif value="2">مسائي</option>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>يبدأ من الساعه</label>
                                <input type="time" name="from_time" id="from_time" class="form-control"
                                    value="{{ old('from_time') }}">

                                @error('from_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ينتهي الساعه</label>
                                <input type="time" name="to_time" id="to_time" class="form-control"
                                    value="{{ old('to_time') }}">

                                @error('to_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>عدد الساعات</label>
                                <input type="text" name="total_hours" id="total_hours" class="form-control"
                                    value="{{ old('total_hours') }}"> {{-- oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"> --}}

                                @error('total_hours')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>حاله التفعيل</label>
                                <select name="active" value="active" class="form-control">
                                    <option @if (old('active') == 1) selected @endif value="1">مفعل</option>
                                    <option @if (old('active') == 0 and old('active') != '') selected @endif value="0">غير مفعل
                                    </option>
                                </select>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <a class="btn btn-danger btn-sm" href={{ route('shifts-types.index') }}> الغاء </a>
                                <button class="btn btn-sm btn-success" type="submit" name="submit">اضف الشفت</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
