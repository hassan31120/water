@extends('admin.layouts.main')

@section('dash')
الطلبيات
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                        <div class="col-6">
                            <h5 class="text-white text-capitalize ps-3" style="margin-right: 10px; font-weight: 700;">
                                طلب {{ $order->users->name }}</h5>
                        </div>
                        <div class="col-6" style="position: relative;"><a href="{{ route('admin.orders') }}"
                            style="position: absolute; left: 2%" class="btn btn-primary"> الطلبيات </a></div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        @if (count($details) > 0)
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th> --}}
                                        <th class="text-secondary font-weight-bolder opacity-7">الإسم
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                            الصورة</th>
                                        {{-- <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            القديم</th> --}}
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            السعر</th>
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الكمية</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $detail->title }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <img src="{{ asset($detail->image) }}" style="height: 80px"
                                                        class="img-thumbnail">
                                                </div>
                                            </td>

                                            {{-- <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $detail->old_price }}</span>
                                            </td> --}}

                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-center">
                                                    {{ $detail->new_price }}</p>
                                            </td>

                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-center">{{ $detail->quantity }}
                                                </p>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger text-center" role="alert">
                                <h2>لا يوجد بيانات</h2>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
