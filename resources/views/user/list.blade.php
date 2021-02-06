@extends('layouts.master.master')

@section('ex-title', 'لیست کاربران')

@section('body')
    <div class="card">
        <div class="card-body">
            <form method="GET">
                <div class="row mx-auto justify-content-center">
                    <input type="text" class="form-control col-8 mx-2" placeholder="جستجو" name="q" value="{{Request()->q}}">
                    <input type="submit" value="جستجو" class="btn btn-primary">
                    <small class="text-muted">جستجو بر اساس <strong>نام و نام خانوادگی، شماره تماس و کدملی</strong> می‌باشد.</small>
                </div>
            </form>
            <hr class="my-4">
            <table class="table-responsive-md text-center table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>نام و نام خانوادکی</th>
                        <th>شماره تماس</th>
                        <th>کدملی</th>
                        <th>مقام</th>
                        <th>مدیریت</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name . ' ' . $user->fname }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->code_meli }}</td>
                            <td>{{ __($user->roll) }}</td>
                            <td>
                                <a href="{{route("user.show",$user->id)}}">
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
                <li class="page-item {{ $users->currentPage() == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ route('user.index') }}/?page={{ $users->currentPage() - 1 }}" tabindex="-1"
                        aria-disabled="true">قبلی</a>
                </li>
                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}"><a class="page-link"
                            href="{{ route('user.index') }}/?page={{ $i }}">{{ $i }}</a></li>
                @endfor
                <li class="page-item {{ $users->currentPage() == $users->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ route('user.index') }}/?page={{ $users->currentPage() + 1 }}">بعدی</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
