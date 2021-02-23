@extends('layouts.master.master')

@section('ex-title', 'نمایش فاکتور')

@section('body')
@php
    $factor = $factor ?? $closefactor;
@endphp
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
            <form class="col-md" method="POST" action="{{ route('factor.update', $factor->id) }}">
                @csrf
                @method("put")
                <div class="form-group row">
                    <div class="col-md">
                        <label>کاربر</label>
                        <input type="text" class="form-control text-center" readonly
                            value="{{ $factor->User->name . ' ' . $factor->User->fname }}">
                    </div>
                    <div class="col-md">
                        <label>اپراتور</label>
                        <select name="ouserID" id="ouserID" class="form-control">
                            <option value="-1">یک اپراتور انتخاب کنید</option>
                            @foreach ($users->where('roll', 'Operator') as $item)
                                <option value="{{ $item->id }}">{{ $item->name . ' ' . $item->fname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>تامین کننده</label>
                        <select name="tuserID" id="tuserID" class="form-control">
                            <option value="-1">یک تامین کننده انتخاب کنید</option>
                            @foreach ($users->where('roll', 'Supplier') as $item)
                                <option value="{{ $item->id }}">{{ $item->name . ' ' . $item->fname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md">
                        <label>{{__("Delivery")}}</label>
                        <select name="puserID" id="puserID" class="form-control">
                            <option value="-1">یک پیک انتخاب کنید</option>
                            @foreach ($users->where('roll', 'Delivery') as $item)
                                <option value="{{ $item->id }}">{{ $item->name . ' ' . $item->fname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>آدرس</label>
                        <select name="addressID" id="addressID" class="form-control">
                            <option value="-1">یک آدرس انتخاب کنید</option>
                            @foreach ($address as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md">
                        <label>زمان تحویل</label>
                        <select name="timingID" id="timingID" class="form-control">
                            <option value="-1">یک زمان تحویل انتخاب کنید</option>
                            @foreach ($timings as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>هزینه کل</label>
                        <input type="text" class="form-control text-center" name="totalprice"
                            value="{{ $factor->totalprice }}">
                    </div>
                    <div class="col-md">
                        <label>هزینه پیک</label>
                        <input type="text" class="form-control text-center" name="peykprice"
                            value="{{ $factor->peykprice }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>سود حاصل از فروش</label>
                        <input type="text" class="form-control text-center" name="comision"
                            value="{{ $factor->comision }}">
                    </div>
                    <div class="col-md">
                        <label>وضعیت پرداخت</label>
                        <select name="recive" id="recive" class="form-control">
                            <option value="-1">یک اپراتور انتخاب کنید</option>
                            @foreach (['Yes',"No"] as $item)
                                <option value="{{ $item }}">{{ $item=="Yes" ? "پرداخت شده" : "پرداخت نشده" }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>توضیحات کاربر</label>
                        <textarea class="form-control" readonly>{{ $factor->userdes }}</textarea>
                    </div>
                    <div class="col-md">
                        <label>توضیحات اپراتور</label>
                        <textarea class="form-control" readonly>{{ $factor->operatordes }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>امتیاز</label>
                        <input type="text" value="{{ $factor->rate }}" readonly class="form-control text-center">
                    </div>
                    <div class="col-md">
                        <label>امتیاز پیک</label>
                        <input type="text" value="{{ $factor->peykrate }}" name="peykrate"
                            class="form-control text-center">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>توضیحات امتیاز پیک</label>
                        <textarea class="form-control" readonly>{{ $factor->peykratedes }}</textarea>
                    </div>
                    <div class="col-md">
                        <label>تحویل به پیک</label>
                        <input type="text" value="{{ $factor->peykrecive }}" readonly class="form-control text-center">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>تاریخ تحویل</label>
                        <input type="text" value="{{ $factor->delevry }}" readonly class="form-control text-center">
                    </div>
                    <div class="col-md">
                        <label>وضعیت</label>
                        <select name="status" id="status" class="form-control">
                            <option value="-1">یک اپراتور انتخاب کنید</option>
                            @foreach (['waiting', 'doing', 'ready', 'sending', 'delivered', 'canceled user', 'canceled tuser'] as $item)
                                <option value="{{ $item }}">{{ __($item) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>تاریخ درخواست ارسال</label>
                        <input type="text" value="{{ $factor->Rddate }}" readonly class="form-control text-center">
                    </div>
                    <div class="col-md">
                        <label>ارسال به پیام رسان</label>
                        <input type="text" value="{{ $factor->bale }}" readonly class="form-control text-center">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label>تاریخ ثبت</label>
                        <input type="text" value="{{ $factor->created_at }}" readonly class="form-control text-center"
                            dir="ltr">
                    </div>
                    <div class="col-md">
                        <label>تاریخ ویرایش</label>
                        <input type="text" value="{{ $factor->updated_at }}" readonly class="form-control text-center"
                            dir="ltr">
                    </div>
                </div>

                <input type="submit" class="btn btn-warning" value="ویرایش">
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header row">
            <div class="col-md mt-1">
                محصولات سبد
            </div>
            <div class="col-md">
                <a target="_blank" href="{{route("orders.create")}}?factorID={{$factor->id}}&userID={{$factor->id}}">
                    <button class="btn btn-outline-primary float-right">ثبت سفارش</button>
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table-responsive-md text-center table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>محصول</th>
                        <th>تامین کننده</th>
                        <th>تعداد</th>
                        <th>قیمت</th>
                        <th>جمع هزینه</th>
                        <th>مدیریت</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr id="{{ $order->id }}">
                            <td>{{ $order->Product->title }}</td>
                            <td>{{ $order->TaminKonande->name . ' ' . $order->TaminKonande->fname }}</td>
                            <td>{{ $order->count }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->sumprice }}</td>
                            <td>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="post"
                                    onsubmit="return YouSure()">
                                    @csrf
                                    @method("delete")
                                    <a target="_blank" href="{{ route('orders.show', $order->id) }}">
                                        <button type="button" class="btn btn-outline-warning btn-floating"><i
                                                class="fa fa-eye"></i></button>
                                    </a>
                                    |
                                    <button type="subbmit" class="btn btn-outline-danger btn-floating"><i
                                            class="fa fa-trash-o"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('ex-js')
    <script>
        if({{Request()->is("closefactor/".$factor->id)}}){
            $("select:not(#status)").prop( "disabled", true );
            $("input:not([type=hidden],[type=submit])").prop( "disabled", true );
            $("button").addClass("d-none")
        }
        $(document).ready(function() {
            $("#ouserID").val("{{ $factor->ouserID }}");
            $("#tuserID").val("{{ $factor->tuserID }}");
            $("#puserID").val("{{ $factor->puserID }}");
            $("#addressID").val("{{ $factor->addressID }}");
            $("#timingID ").val("{{ $factor->timingID }}");
            $("#status").val("{{ $factor->status }}");
            $("#recive").val("{{$factor->recive}}");
        });

        function YouSure() {
            var result = prompt("آیا از حذف این سفارش مطمئن هستید؟", "خیر");

            if (result == "بله") {
                return true;
            }

            return false;
        }
    </script>
@endsection
