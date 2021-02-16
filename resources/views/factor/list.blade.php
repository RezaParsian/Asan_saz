@extends('layouts.master.master')

@section('ex-title', 'لیست فاکتورها')

@section('body')
    <div class="card">
        <div class="card-body">
            <form method="GET">
                <div class="row mx-auto justify-content-center">
                    <input type="text" class="form-control col-8 mx-2" placeholder="جستجو" name="q" value="{{Request()->q}}">
                    <input type="submit" value="جستجو" class="btn btn-primary">
                    <small class="text-muted col-12 text-center">جستجو بر اساس <strong>نام محصول</strong> می‌باشد.</small>
                    <div class="form-group">
                        <input type="checkbox" class="form-check-input" name="special" value="Yes" onclick="submit()" {{!empty(Request()->special) ? "checked" : ""}}>
                    <label class="form-check-label">محصولات ویژه</label>
                    </div>
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
                            <td>{{ $factor->User->name." ".$factor->User->fname}}</td>
                            <td>{{ number_format($factor->totalprice) }}</td>
                            <td>{{ $factor->Rddate }}</td>
                            <td>{{ $factor->Timing->title }}</td>
                            <td>{{ __($factor->status) }}</td>
                            <td>
                                <a href="{{route("factor.show",$factor->id)}}">
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
