@extends('layouts.master.master')

@section('ex-title', 'ایجاد کاربر جدید')

@section('body')
    <div class="card">
        <div class="card-body">
            @if (!empty(session()->get('msg')))
                <div class="alert alert-success">
                    {{ session()->get('msg') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="col-md" method="POST" action="{{ route('user.store') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-md">
                        <label>معرف</label>
                        <select name="moarefID" id="moarefID" class="form-control">
                            <option value="-1">یک معرف انتخاب کنید</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} {{ $user->fname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md">
                        <label>منطقه</label>
                        <select name="regionID" id="regionID" class="form-control">
                            <option value="-1">یک منطقه انتخاب کنید</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>نام</label>
                        <input type="text" name="name" class="form-control text-left" placeholder="نام" required
                            value="{{ old('name') }}">
                    </div>
                    <div class="col-md">
                        <label>نام خانوادگی</label>
                        <input type="text" name="fname" class="form-control text-left" placeholder="نام خانوادگی" required
                            value="{{ old('fname') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>ایمیل</label>
                        <input type="text" name="email" class="form-control text-left" placeholder="ایمیل"
                            value="{{ old('email') }}">
                    </div>
                    <div class="col-md">
                        <label>گذرواژه</label>
                        <input type="password" name="password" class="form-control text-left" placeholder="گذرواژه"
                            value="{{ old('password') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>کدملی</label>
                        <input type="text" name="code_meli" class="form-control text-left" placeholder="کدملی" required
                            value="{{ old('code_meli') }}">
                    </div>
                    <div class="col-md">
                        <label>شماره تلفن</label>
                        <input type="text" name="phone" class="form-control text-left" placeholder="شماره تلفن" required
                            value="{{ old('phone') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>مقام</label>
                        <select name="roll" id="rool" class="form-control">
                            <option value="Developer">توسعه دهنده</option>
                            <option value="Owner">مالک</option>
                            <option value="Admin">مدیر</option>
                            <option value="Operator">اپراتور</option>
                            <option value="Supplier">تامین کننده</option>
                            <option value="Courier Manager">مدیر پیک</option>
                            <option value="Delivery">پیک</option>
                            <option value="Customer" selected>مشتری</option>
                        </select>
                    </div>
                    <div class="col-md">
                        <label>ویژه</label>
                        <select name="special" id="special" class="form-control">
                            <option value="Yes">بله</option>
                            <option value="No" selected>خیر</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>جنسیت</label>
                        <select name="sex" id="sex" class="form-control">
                            <option value="IDK" selected>نامعلوم</option>
                            <option value="Men">مرد</option>
                            <option value="Women">زن</option>
                        </select>
                    </div>
                    <div class="col-md">
                        <label>نوع تامین کننده</label>
                        <select name="taminkind" id="taminkind" class="form-control">
                            <option value="IDK" selected>نامعلوم</option>
                            <option value="Static">ثابت</option>
                            <option value="Dynamic">سیار</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>وسیله نقلیه</label>
                        <select name="vehicle" id="vehicle" class="form-control">
                            <option value="Car">ماشین</option>
                            <option value="Motor" selected>موتور</option>
                            <option value="Bike">دوچرخه</option>
                        </select>
                    </div>
                    <div class="col-md">
                        <label>سود حاصل از فروش</label>
                        <input type="text" name="comision" class="form-control text-left" placeholder="سود حاصل از فروش">
                    </div>
                </div>


                <input type="submit" class="btn btn-success" value="ثبت">
            </form>
        </div>
    </div>
@endsection
