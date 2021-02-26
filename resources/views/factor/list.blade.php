@extends('layouts.master.master')

@section('ex-title', Request()->is("closefactor") ? "لیست سفارشات بسته" : "لیست سفارشات")

@section('body')
    <div class="card">
        <div class="card-body">
            <form method="GET">
                <div class="row mx-auto justify-content-center">
                    <input type="text" class="form-control col-8 mx-2" placeholder="جستجو" name="q" value="{{Request()->q}}">
                    <small class="text-muted col-12 text-center">جستجو بر اساس <strong>نام مشتری و شماره فاکتور</strong> می‌باشد.</small>
                </div>
                <hr>
                <div class="form-group form-inline justify-content-center">
                        <label>تاریخ شروع</label>
                        <input type="text" name="start_date" class="form-control text-left datepicker mx-3" dir="ltr">
                        <label>تا تاریخ</label>
                        <input type="text" name="end_date" class="form-control text-left datepicker mx-3" dir="ltr">
                        <input type="submit" value="اعمال" class="btn btn-primary">
                </div>
            </form>
            <hr class="my-4">
        <div class="card-body">
            <table class="table-responsive-md text-center table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>شماره فاکتور</th>
                        <th>نام مشتری</th>
                        <th>قیمت فاکتور</th>
                        <th>تاریخ تحویل </th>
                        <th>ساعت تحویل</th>
                        <th>وضعیت</th>
                        <th>مدیریت</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($factors as $factor)
                        <tr>
                            <td>{{ $factor->id }}</td>
                            <td>{{ ($factor->User->name ?? "User")." ". ($factor->User->fname ?? "Not Found")}}</td>
                            <td>{{ number_format($factor->totalprice) }}</td>
                            <td>{{ $factor->Rddate }}</td>
                            <td>{{ $factor->Timing->title ?? "Not Found" }}</td>
                            <td>{{ __($factor->status) }}</td>
                            <td>
                                <a href="{{Request()->is("closefactor") ? route("closefactor.show",$factor->id) : route("factor.show",$factor->id)}}">
                                    <button type="button" class="btn btn-outline-warning btn-floating"><i class="fa fa-eye"></i></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation example" class="mb-3">
            @php
                $param=isset(Request()->q) ? "&q=".Request()->q : "";
                $param.=isset(Request()->special) ? "&special=".Request()->special : "";
                $param.=isset(Request()->roll) ? "&roll=".Request()->roll : "";
            @endphp
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $factors->currentPage() == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ route('factor.index') }}/?page={{ $factors->currentPage() - 1}}{{$param}}" tabindex="-1"
                        aria-disabled="true">قبلی</a>
                </li>
                @for ($i = 1; $i <= $factors->lastPage(); $i++)
                    <li class="page-item {{ $factors->currentPage() == $i ? 'active' : '' }}"><a class="page-link"
                            href="{{ route('factor.index') }}/?page={{ $i}}{{$param}}">{{ $i }}</a></li>
                @endfor
                <li class="page-item {{ $factors->currentPage() == $factors->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ route('factor.index') }}/?page={{ $factors->currentPage() + 1}}{{$param}}">بعدی</a>
                </li>
            </ul>
        </nav>
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
		dateFormat: "yy-mm-dd",
		showOtherMonths: true,
		selectOtherMonths: true,
	});
    </script>
@endsection
