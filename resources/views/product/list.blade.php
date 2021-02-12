@extends('layouts.master.master')

@section('ex-title', 'لیست دسته بندی ها')

@section('body')
    <div class="card">
        <div class="card-body">
            <table class="table-responsive-md text-center table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>محصول</th>
                        <th>دسته بندی</th>
                        <th>اولویت ({{$products->max("olaviyat")}})</th>
                        <th>قیمت</th>
                        <th>نمایش</th>
                        <th>مدیریت</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->Category->title ?? "One Click"}}</td>
                            <td>{{ $product->olaviyat }}</td>
                            <td>{{ number_format($product->price) }}</td>
                            <td>{{__($product->show)}}</td>
                            <td>
                                <a href="{{route("product.show",$product->id)}}">
                                    <button type="button" class="btn btn-outline-warning btn-floating"><i class="fa fa-eye"></i></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation example" class="mb-3">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $products->currentPage() == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ route('product.index') }}/?page={{ $products->currentPage() - 1 }}" tabindex="-1"
                        aria-disabled="true">قبلی</a>
                </li>
                @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}"><a class="page-link"
                            href="{{ route('product.index') }}/?page={{ $i }}">{{ $i }}</a></li>
                @endfor
                <li class="page-item {{ $products->currentPage() == $products->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ route('product.index') }}/?page={{ $products->currentPage() + 1 }}">بعدی</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
