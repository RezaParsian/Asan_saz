@extends('layouts.master.master')

@section('ex-title', 'ایجاد بنر جدید')

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
            <form class="col-md" method="POST" onsubmit="return CheckSubmit()" action="{{ route('banner.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md">
                        <label>عنوان</label>
                        <input required type="text" id="CategoryID" class="form-control" placeholder="عنوان" name="title"
                            value="{{ old('title') }}">
                    </div>
                    <div class="col-md">
                        <label>دسته بندی</label>
                        <select name="BannergpsID" id="BannergpsID" class="form-control">
                            <option value="-1">یک دسته بندی انتخاب کنید.</option>
                            @foreach ($categoryes as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>تاریخ شروع</label>
                        <input required type="text" name="start_date" class="form-control text-left datepicker" dir="ltr">
                    </div>
                    <div class="col-md">
                        <label>تاریخ اتمام</label>
                        <input required type="text" name="end_date" class="form-control text-left datepicker" dir="ltr">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>لینک</label>
                        <input required type="text" name="link" class="form-control" value="{{ old('link') }}">
                    </div>
                    <div class="col-md">
                        <label>عکس</label>
                        <input required type="file" name="image" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>نمایش</label>
                        <select name="show" id="show" class="form-control">
                            <option value="Yes">بله</option>
                            <option value="No">خیر</option>
                        </select>
                    </div>
                    <div class="col-md">
                        <label>نوع</label>
                        <select name="linkable" id="linkable" class="form-control">
                            <option value="link">لینک</option>
                            <option value="product">محصول</option>
                        </select>
                    </div>
                </div>

                <input type="submit" class="btn btn-success" value="ثبت">
            </form>
        </div>
    </div>
@endsection

@section('ex-css')
    <link rel="stylesheet" href="{{ asset('vendors/datepicker-jalali/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/datepicker/daterangepicker.css') }}">
@endsection

@section('ex-js')
    <script src="{{ asset('vendors/datepicker-jalali/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js') }}"></script>
    <script src="{{ asset('vendors/datepicker/daterangepicker.js') }}"></script>

    <script>
        $('input[name="start_date"],input[name="end_date"]').datepicker({
            dateFormat: "yy/mm/dd",
            showOtherMonths: true,
            selectOtherMonths: true,
            minDate: 0,
            maxDate: "+360D"
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
