@extends('layouts.master.master')

@section('ex-title', 'نمایش محصول')

@section('body')
    <div class="modal" id="catmodal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">دسته بندی</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="modalbody">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnclose">بستن</button>
                </div>

            </div>
        </div>
    </div>

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
            <form class="col-md" method="POST" action="{{ route('product.update', $product->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method("put")

                <div class="form-group row">
                    <div class="col-md">
                        <label>دسته بندی</label>
                        <input type="text" id="CategoryID" class="form-control" data-toggle="modal" data-target="#catmodal"
                            onclick="ChangeCat(0)" readonly>
                        <input type="hidden" name="CategoryID" id="hCategoryID" value="{{ $product->CategoryID }}">
                    </div>
                    <div class="col-md">
                        <label>تامین کننده</label>
                        <select name="tuserID" id="tuserID" class="form-control">
                            <option value="-1">یک تامین کننده انتخاب فرمایید.</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} {{ $user->fname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>نام محصول</label>
                        <input type="text" class="form-control" name="title" placeholder="نام محصول" required
                            value="{{ $product->title }}">
                    </div>
                    <div class="col-md">
                        <label>نوع سرویس</label>
                        <select name="action" id="action" class="form-control">
                            <option value="pay" selected>خرید</option>
                            <option value="one_click">وان کلیک</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>قیمت خرید</label>
                        <input type="text" class="form-control" name="buyprice" placeholder="قیمت خرید" required
                            value="{{ $product->buyprice }}">
                    </div>
                    <div class="col-md">
                        <label>قیمت فروش</label>
                        <input type="text" class="form-control" name="price" placeholder="قیمت فروش" required
                            value="{{ $product->price }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>محدودیت</label>
                        <input type="number" class="form-control" name="max" placeholder="محدودیت" min="1" max="100"
                            value="{{ $product->max }}">
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
                            value="{{ empty($product->olaviyat) ? 0 : $product->olaviyat }}">
                    </div>
                    <div class="col-md">
                        <label>محصول پر کاربرد</label>
                        <select name="highrate" id="highrate" class="form-control">
                            <option value="Yes">بله</option>
                            <option value="No">خیر</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>عکس کاور</label>
                        <input type="file" class="form-control col" name="img">

                        @if (!empty($product->img))
                            <a href="{{ asset('upload/' . $product->img) }}" target="_blank" rel="noopener noreferrer"
                                class="btn border border-info mt-1 mx-1">عکس کاور</a>
                        @endif

                        @if (!empty($product->gallery))
                            @php
                                $gallery = json_decode($product->gallery);
                            @endphp
                            @foreach ($gallery as $item)
                                <a href="{{ asset('upload/' . $item) }}" target="_blank" rel="noopener noreferrer"
                                    class="btn border border-info mt-1 mx-1">گالری</a>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-md">
                        <label>گالری</label>
                        <input type="file" class="form-control" name="gallery[]">
                        <input type="file" class="form-control" name="gallery[]">
                        <input type="file" class="form-control" name="gallery[]">
                    </div>
                </div>

                <div class="form-group row">
                    <label>توضیحات</label>
                    <textarea name="des" class="form-control" required>{{ $product->des }}</textarea>
                </div>
                <input type="submit" class="btn btn-success" value="ثبت">
            </form>
        </div>
    </div>
@endsection

@section('ex-js')
    <script>
        function MakeBreadcrumb(element) {
            var newvalue = $("#CategoryID").val() + " > " + element.innerText;
            $("#CategoryID").val(newvalue);
        }

        function ChangeCat(element) {
            if (element == 0) {
                $("#CategoryID").val("");
            }

            $.get('{{ env('APP_URL') }}/api/ajax/' + $(element).data('catid'), function(data) {
                if (data == "") {
                    $("#btnclose").click();
                    $("#hCategoryID").val($(element).data('catid'));
                    return;
                }
                $("#modalbody").html(data);
            });

        }
        $(document).ready(function() {
            if ("{{ $product->CategoryID }}" == 0) {
                $("#CategoryID").val("وان کلیک");
            } else {
                $.get('{{ env('APP_URL') }}/api/ajax/name/{{ $product->CategoryID }}', function(data) {
                    console.log(data);
                    $("#CategoryID").val(data);
                });
            }

            $("#tuserID").val("{{ $product->tuserID }}");
            $("#action").val("{{ $product->action }}");
            $("#highrate").val("{{ $product->highrate }}");
            $("#show").val("{{ $product->show }}");
        });

    </script>
@endsection
