@extends('layouts.master.master')

@section('ex-title', 'نمایش کاربر')

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
            <form onsubmit="return CheckSubmit()" class="col-md" method="POST" action="{{ route('user.update',$user->id) }}">
                @csrf
                @method("put")
                <div class="form-group row">
                    <div class="col-md">
                        <label>مسیر پیشفرض</label>
                        <select name="defaultaid" id="defaultaid" class="form-control">
                            <option value="-1">یک مسیر پیشفرض انتخاب کنید</option>
                            @foreach ($user->address as $address)
                                @php
                                    $select = '';
                                    if ($user->defaultaid == $address->id) {
                                        $select = 'selected';
                                    }
                                @endphp
                                <option value="{{ $address->id }}" {{ $select }}>{{ $address->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md">
                        <label>منطقه</label>
                        <select name="regionID" id="regionID" class="form-control">
                            <option value="-1">یک منطقه انتخاب کنید</option>
                            @foreach ($regions as $region)
                                @php
                                    $select = '';
                                    if ($user->regionID == $region->id) {
                                        $select = 'selected';
                                    }
                                @endphp
                                <option value="{{ $region->id }}" {{ $select }}>{{ $region->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>نام</label>
                        <input type="text" name="name" class="form-control text-left" placeholder="نام" required
                            value="{{ $user->name }}">
                    </div>
                    <div class="col-md">
                        <label>نام خانوادگی</label>
                        <input type="text" name="fname" class="form-control text-left" placeholder="نام خانوادگی" required
                            value="{{ $user->fname }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>ایمیل</label>
                        <input type="text" name="email" class="form-control text-left" placeholder="ایمیل"
                            value="{{ $user->email }}">
                    </div>
                    <div class="col-md">
                        <label>گذرواژه</label>
                        <input type="password" name="password" class="form-control text-left" placeholder="گذرواژه">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>کدملی</label>
                        <input type="text" name="code_meli" class="form-control text-left" placeholder="کدملی" required
                            value="{{ $user->code_meli }}">
                    </div>
                    <div class="col-md">
                        <label>شماره تلفن</label>
                        <input type="text" name="phone" class="form-control text-left" placeholder="شماره تلفن" required
                            value="{{ $user->phone }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>مقام</label>
                        <select name="roll" id="roll" class="form-control">
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
                        <input type="text" name="comision" class="form-control text-left" placeholder="سود حاصل از فروش"
                            value="{{ $user->comision }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md">
                        <label>شماره کارت</label>
                        <input type="text" name="bank" class="form-control text-left" placeholder="شماره کارت"
                            value="{{ $user->bank }}">
                    </div>
                    <div class="col-md">
                        <label>وضعیت کاربر</label>
                        <select name="block" id="block" class="form-control">
                            <option value="Yes">بله</option>
                            <option value="No">خیر</option>
                        </select>
                    </div>
                </div>
                @if ($user->img)
                <div class="form-group row">
                    <img src="{{asset("upload/".$user->img)}}" loading="lazy">
                </div>
                @endif
                <input type="submit" class="btn btn-success" value="ثبت">
            </form>
        </div>
    </div>
@endsection

@section('ex-js')
    <script>
        $(document).ready(function() {
            $("#roll").val("{{ $user->roll }}");
            $("#special").val("{{ $user->special }}");
            $("#block").val("{{ $user->block }}");
            $("#sex").val("{{ $user->sex }}");
            $("#taminkind").val("{{ $user->taminkind }}");
            $("#vehicle").val("{{ $user->vehicle }}");
        });
        function CheckSubmit() {
            var result=true;
            $("select").each(function() {
                if ($(this).val() == -1) {
                    $(this).focus();
                    $("#notvalid").remove();
                    $(this).after("<p id='notvalid' class='small text-danger'>لطفا یک گزینه معتبر انتخاب فرمایید<p>")
                    result=false;
                    return;
                }
            })
            return result;
        }
    </script>
@endsection
