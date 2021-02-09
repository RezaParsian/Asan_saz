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
            <form class="col-md-md" method="POST" action="{{ route('category.update', $cat->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method("put")
                <div class="form-group row">
                    <div class="col-md">
                        <label>عنوان</label>
                        <input type="text" class="form-control" placeholder="عنوان" value="{{ $cat->title }}" name="title"
                            required>
                    </div>
                    <div class="col-md">
                        <label>عکس</label>
                        <div class="row mx-auto">
                            <input type="file" name="img" class="form-control col" accept="image/x-png,image/gif,image/jpeg"
                                id="img">
                            @if ($cat->img)
                                <a href='{{ asset('upload/' . $cat->img) }}' target="_blank">
                                    <button type='button' class='btn btn-outline-info ml-2 my-auto'>
                                        <li class='fa fa-eye'></li>
                                    </button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>دسته مادر</label>
                        <select name="parent" class="form-control" id="parent">
                            <option value="0">بدون دسته</option>
                            @foreach ($categorys as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md">
                        <label>نمایش</label>
                        <select name="show" id="show" class="form-control">
                            <option value="Yes">بله</option>
                            <option value="No">خیر</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>اولویت نمایش</label>
                        <input type="number" name="olaviyat" class="form-control text-center" min="0"
                            value="{{ empty($cat->olaviyat) ? 0 : $cat->olaviyat }}">
                    </div>
                    <div class="col-md">
                    </div>
                </div>
                <input type="submit" class="btn btn-success" value="ثبت">
            </form>
        </div>
    </div>
@endsection

@section('ex-js')
    <script>
        $(document).ready(function() {
            $("#parent").val("{{ $cat->parent }}");
            $("#show").val("{{ $cat->show }}");
        });

    </script>
@endsection
