@extends('layouts.master.master')

@section('ex-title', 'ایجاد کاربر')

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
            <form class="col-md-md" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md">
                        <label>عنوان</label>
                        <input type="text" class="form-control" placeholder="عنوان" value="{{ old('title') }}"
                            name="title" required>
                    </div>
                    <div class="col-md">
                        <label>عکس</label>
                        <input type="file" name="img" class="form-control" accept="image/x-png,image/gif,image/jpeg" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>دسته مادر</label>
                        <select name="parent" class="form-control">
                            <option value="0">بدون دسته</option>
                            @foreach ($categorys as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md">
                        <label>نمایش</label>
                        <select name="show" class="form-control">
                            <option value="Yes">بله</option>
                            <option value="No">خیر</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>اولویت نمایش</label>
                        <input type="number" name="olaviyat" class="form-control text-center" min="0"
                            value="{{ empty(old('olaviyat')) ? 0 : old('olaviyat') }}">
                    </div>
                    <div class="col-md">
                    </div>
                </div>
                <input type="submit" class="btn btn-success" value="ثبت">
            </form>
        </div>
    </div>
@endsection
