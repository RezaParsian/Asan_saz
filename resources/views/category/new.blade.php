@extends('layouts.master.master')

@section('ex-title', 'ایجاد دسته بندی جدید')

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
            <form class="col-md" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md">
                        <label>عنوان</label>
                        <input type="text" class="form-control" placeholder="عنوان" value="{{ old('title') }}"
                            name="title" required>
                    </div>
                    <div class="col-md">
                        <label>عکس</label>
                        <input type="file" name="image" class="form-control" accept="image/x-png,image/gif,image/jpeg"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>دسته مادر</label>
                        <input type="text" id="CategoryID" class="form-control" data-toggle="modal" data-target="#catmodal"
                            onclick="ChangeCat(0)" readonly>
                        <input type="hidden" name="CategoryID" id="hCategoryID" value="0">
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

            $("#hCategoryID").val($(element).data('catid')===undefined ? 0 : $(element).data('catid'));

            $.get('{{ env('APP_URL') }}/api/ajax/parent/' + $(element).data('catid'), function(data) {
                if (data == "") {
                    $("#btnclose").click();
                    $("#hCategoryID").val($(element).data('catid'));
                    return;
                }
                $("#modalbody").html(data);
            });

        }

    </script>
@endsection
