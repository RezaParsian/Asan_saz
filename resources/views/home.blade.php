@extends('layouts.master.master')

@section('ex-title', 'داشبورد')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <h5>سفارشات</h5>
        </div>
        <div class="col-md-12 d-flex">
            <div class="card border m-1 col">
                <a href="{{route("factor.index")}}">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <div class="icon-block icon-block-sm bg-warning icon-block-floating mr-2">
                                <i class="fa fa-hourglass-start"></i>
                            </div>
                        </div>
                        <span class="font-size-13">{{ __('waiting') }}</span>
                        <h2 class="m-1 ml-auto font-weight-bold text-warning primary-font line-height-30" id="waiting">0
                        </h2>
                    </div>
                    <div class="col text-center" id="waiting_price">
                        0 تومان
                    </div>
                </div>
                </a>
            </div>

            <div class="card border m-1 col">
                <a href="{{route("factor.index")}}">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <div class="icon-block icon-block-sm icon-block-floating mr-2"
                                style="background:var(--success)">
                                <i class="fa fa-american-sign-language-interpreting"></i>
                            </div>
                        </div>
                        <span class="font-size-13">{{ __('doing') }}</span>
                        <h2 class="m-1 ml-auto font-weight-bold primary-font line-height-30" id="doing"
                            style="color:var(--success)">0</h2>
                    </div>
                    <div class="col text-center" id="doing_price">
                        0 تومان
                    </div>
                </div>
                </a>
            </div>

            <div class="card border m-1 col">
                <a href="{{route("factor.index")}}">
                    <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <div class="icon-block icon-block-sm icon-block-floating mr-2" style="background:var(--purple)">
                                <i class="fa fa-paper-plane"></i>
                            </div>
                        </div>
                        <span class="font-size-13">{{ __('ready') }}</span>
                        <h2 class="m-1 ml-auto font-weight-bold primary-font line-height-30" id="ready"
                            style="color:var(--purple)">0</h2>
                    </div>
                    <div class="col text-center" id="ready_price">
                        0 تومان
                    </div>
                </div>
                </a>
            </div>

        </div>
        <div class="col-md-12 d-flex">
            <div class="card border m-1 col">
                <a href="{{route("factor.index")}}">
                    <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <div class="icon-block icon-block-sm icon-block-floating mr-2" style="background:var(--blue)">
                                <i class="fa fa-motorcycle"></i>
                            </div>
                        </div>
                        <span class="font-size-13">{{ __('sending') }}</span>
                        <h2 class="m-1 ml-auto font-weight-bold primary-font line-height-30" id="sending"
                            style="color:var(--blue)">0</h2>
                    </div>
                    <div class="col text-center" id="sending_price">
                        0 تومان
                    </div>
                </div>
                </a>
            </div>

            <div class="card border m-1 col">
                <a href="{{ route('closefactor.index') }}">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div>
                                <div class="icon-block icon-block-sm icon-block-floating mr-2"
                                    style="background:var(--success)">
                                    <i class="fa fa-check"></i>
                                </div>
                            </div>
                            <span class="font-size-13">{{ __('delivered') }}</span>
                            <h2 class="m-1 ml-auto font-weight-bold primary-font line-height-30" id="delivered"
                                style="color:var(--success)">0</h2>
                        </div>
                        <div class="col text-center" id="delivered_price">
                            0 تومان
                        </div>
                    </div>
                </a>
            </div>

            <div class="card border m-1 col">
                <a href="{{ route('closefactor.index') }}">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div>
                                <div class="icon-block icon-block-sm icon-block-floating mr-2"
                                    style="background:var(--red)">
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </div>
                            <span class="font-size-13">{{ __('canceled user') }}</span>
                            <h2 class="m-1 ml-auto font-weight-bold primary-font line-height-30" id="canceled user"
                                style="color:var(--red)">0</h2>
                        </div>
                        <div class="col text-center" id="canceled user_price">
                            0 تومان
                        </div>
                    </div>
            </div>
            </a>
        </div>

        <div class="col-md-12 d-flex">

            <div class="card border m-1 col">
                    <a href="{{route("closefactor.index")}}">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <div class="icon-block icon-block-sm icon-block-floating mr-2" style="background:var(--orange)">
                                <i class="fa fa-trash-o"></i>
                            </div>
                        </div>
                        <span class="font-size-13">{{ __('canceled tuser') }}</span>
                        <h2 class="m-1 ml-auto font-weight-bold primary-font line-height-30" id="canceled tuser"
                            style="color:var(--orange)">0</h2>
                    </div>
                    <div class="col text-center" id="canceled tuser_price">
                        0 تومان
                    </div>
                </div>
                    </a>
            </div>
            <div class=" border m-1 col"></div>
            <div class=" border m-1 col"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5>کاربران</h5>
        </div>
        <div class="col-md-12 d-flex">
            <div class="card border m-1 col">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <div class="icon-block icon-block-sm bg-success icon-block-floating mr-2">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <span class="font-size-13">{{ __('Customer') }}</span>
                        <h2 class="m-1 ml-auto font-weight-bold text-success primary-font line-height-30" id="Customer">0
                        </h2>
                    </div>
                </div>
            </div>

            <div class="card border m-1 col">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <div class="icon-block icon-block-sm icon-block-floating mr-2" style="background:var(--blue)">
                                <i class="fa fa-motorcycle"></i>
                            </div>
                        </div>
                        <span class="font-size-13">{{ __('Delivery') }}</span>
                        <h2 class="m-1 ml-auto font-weight-bold primary-font line-height-30" id="Delivery"
                            style="color:var(--blue)">0</h2>
                    </div>
                </div>
            </div>

            <div class="card border m-1 col">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <div class="icon-block icon-block-sm icon-block-floating mr-2" style="background:var(--red)">
                                <i class="fa fa-cogs"></i>
                            </div>
                        </div>
                        <span class="font-size-13">{{ __('Supplier') }}</span>
                        <h2 class="m-1 ml-auto font-weight-bold primary-font line-height-30" id="Supplier"
                            style="color:var(--red)">0</h2>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('ex-css')
        <link rel="stylesheet" href="{{ asset('assets/Owl/assets/owl.carousel.min.css') }}">
    @endsection

    @section('ex-js')
        <script>
            $(document).ready(function() {
                const factors = JSON.parse('{!!  $factors !!}');
                const users = JSON.parse('{!!  $users !!}');

                for (var item of factors) {
                    $("#" + item['status']).text(Number((parseInt(item['cnt'])).toFixed(1)).toLocaleString());
                    $("#" + item['status'] + "_price").text(Number((parseInt(item['price'])).toFixed(1)).toLocaleString() + " تومان");
                }

                for (var item of users) {
                    $("#" + item['roll']).text(item['cnt'])
                }
            });

        </script>
    @endsection
