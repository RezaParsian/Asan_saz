@extends('layouts.master.master')

@section('ex-title', 'لیست دسته بندی ها')

@section('body')
    <div class="card">
        <div class="card-body">
            <form method="GET">
                <div class="row mx-auto justify-content-center">
                    <input type="text" class="form-control col-8 mx-2" placeholder="جستجو" name="q" value="{{Request()->q}}">
                    <input type="submit" value="جستجو" class="btn btn-primary">
                    <small class="text-muted col-12 text-center">جستجو بر اساس <strong>نام دسته بندی</strong> می‌باشد.</small>
                </div>
            </form>
            <hr class="my-4">
        <div class="card-body">
            <table class="table-responsive-md text-center table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>دسته بندی</th>
                        <th>اولویت ({{$categorys->max("olaviyat")}})</th>
                        <th>نوع</th>
                        <th>نمایش</th>
                        <th>مدیریت</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorys as $cat)
                        <tr>
                            <td>{{ $cat->title }}</td>
                            <td>{{ $cat->olaviyat }}</td>
                            <td>{{ empty(json_decode($cat->sub)) ? "اصلی" : "دارای محصول"}}</td>
                            <td>{{__($cat->show)}}</td>
                            <td>
                                <a href="{{route("category.show",$cat->id)}}">
                                    <button type="button" class="btn btn-outline-warning btn-floating"><i class="fa fa-eye"></i></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
