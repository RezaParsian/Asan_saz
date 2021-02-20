@extends('layouts.master.master')

@section('ex-title', 'نمایش سفارش')

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
            <form class="col-md" method="POST" action="{{ route('orders.update', $order->id) }}">
                @csrf
                @method("put")

                <div class="form-group row">
                    <div class="col-md">
                        <label>محصول</label>
                        <select name="productID" id="productID" class="form-control">
                            <option value="-1">یک محصول انتخاب کنید</option>
                            @foreach ($proeudcts as $item)
                                <option value="{{ $item->id }}" data-tuser="{{ $item->tuserID }}"
                                    data-price="{{ $item->price }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md">
                        <label>تایمن کننده</label>
                        <select name="tuserID" id="tuserID" class="form-control">
                            <option value="-1">یک اپراتور انتخاب کنید</option>
                            @foreach ($users as $item)
                                @php
                                    $idk = $item->user ?? $item;
                                @endphp
                                <option value="{{$idk->id }}">{{$idk->name . ' ' .$idk->fname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" name="price" id="price" value="{{ $order->price }}">
                <div class="form-group row">
                    <div class="col-md">
                        <label>تعداد</label>
                        <input type="number" name="count" class="form-control text-center" value="{{ $order->count }}"
                            min="1">
                    </div>
                    <div class="col-md">
                        <label>قیمت کل</label>
                        <input type="text" name="sumprice" class="form-control text-center"
                            value="{{ $order->sumprice }}" min="1">
                    </div>
                </div>

                <input type="submit" class="btn btn-warning" value="ویرایش">
            </form>
        </div>
    </div>
@endsection

@section('ex-js')
    <script>
        var price = {{ $order->price }};

        $("#productID").change(function() {
            var taminkonande = $(this).find(":selected").data("tuser");
            alert(taminkonande);
            price = $(this).find(":selected").data("price");

            $("#tuserID").val(taminkonande);
            $("#price").val(price);
            $("input[name='sumprice']").val(price * $("input[name='count']").val());
        });

        $("input[name='count']").change(function() {
            $("input[name='sumprice']").val(price * $(this).val());
        });

        $(document).ready(function() {
            $("#productID").val("{{ $order->productID }}");
            var taminkonande = $(this).find(":selected").data("tuser");
            price = $(this).find(":selected").data("price");
            $("#tuserID").val(taminkonande);
        });

    </script>
@endsection
