@extends('layouts.master.master')

@section('ex-title', 'ثبت سفارش')

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
            <form class="col-md" method="POST" action="{{ route('orders.store') }}">
                @csrf
                <input type="hidden" name="factorID" value="{{ Request()->factorID }}">
                <input type="hidden" name="status" value="waiting">
                <input type="hidden" name="userID" value="{{ Request()->userID }}">
                <div class="form-group row">
                    <div class="col-md">
                        <label onclick="ChangeCat(0)" id="CategoryID" data-toggle="modal"
                            data-target="#catmodal">محصول</label>
                        <select name="productID" id="productID" class="form-control">
                            <option value="-1">یک محصول انتخاب کنید</option>
                            @foreach ($proeudcts as $item)
                                <option value="{{ $item->id }}" data-tuser="{{ $item->tuserID }}"
                                    data-price="{{ $item->price }}" data-CategoryID="{{ $item->CategoryID }}">
                                    {{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md">
                        <label>تامین کننده</label>
                        <select name="tuserID" id="tuserID" class="form-control">
                            <option value="-1">یک اپراتور انتخاب کنید</option>
                            @foreach ($users as $item)
                                <option value="{{ $item->id }}">{{ $item->name . ' ' . $item->fname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" name="price" id="price" value="">
                <div class="form-group row">
                    <div class="col-md">
                        <label>تعداد</label>
                        <input type="number" name="count" class="form-control text-center" value="{{ old('count') }}"
                            min="1">
                    </div>
                    <div class="col-md">
                        <label>قیمت کل</label>
                        <input type="text" name="sumprice" class="form-control text-center" value="{{ old('sumprice') }}"
                            min="1">
                    </div>
                </div>

                <input type="submit" class="btn btn-success" value="ثبت">
            </form>
        </div>
    </div>
@endsection

@section('ex-js')
    <script>
        var price = 0;

        $("#productID").change(function() {
            var taminkonande = $(this).find(":selected").data("tuser");
            price = $(this).find(":selected").data("price");

            $("#tuserID").val(taminkonande);
            $("#price").val(price);
            $("input[name='sumprice']").val(price * $("input[name='count']").val());
        });

        $("input[name='count']").change(function() {
            $("input[name='sumprice']").val(price * $(this).val());
        });

        $(document).ready(function() {
            $("#productID").val("{{ old('productID') }}");
            var taminkonande = $(this).find(":selected").data("tuser");
            price = $(this).find(":selected").data("price");
            $("#tuserID").val(taminkonande);
        });

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
                    var id=$(element).data('catid');

                    $("option[data-CategoryID]").each(function() {
                        if ($(this).data("categoryid")==id) {
                            $(this).show()
                        }else{
                            $(this).hide()
                        }
                    });
                    return;
                }
                $("#modalbody").html(data);
            });

        }

    </script>
@endsection
