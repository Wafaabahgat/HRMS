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
                <h3 class="card-title card_title_center"> اضافه فرع جديد</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('branches.store') }}" method="post">
                    <div class="row">
                        @csrf

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>اسم الفرع</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>عنوان الفرع</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ old('address') }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> رقم هاتف الفرع</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>البريد الالكتروني</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>حاله التفعيل</label>
                                <select name="active" value="active" class="form-control">
                                    <option selected value="1">مفعل</option>
                                    <option value="0">غير مفعل</option>
                                </select>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <a class="btn btn-danger btn-sm" href={{ route('branches.index') }}> الغاء </a>
                                <button class="btn btn-sm btn-success" type="submit" name="submit">اضف الفرع</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
