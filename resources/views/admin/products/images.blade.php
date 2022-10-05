@extends('admin.layouts.main')

@section('dash')
    صور المنتجات
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                            <div class="col-6">
                                <h5 class="text-white text-capitalize ps-3" style="margin-right: 10px; font-weight: 700;">جدول
                                    صور {{ $product->title }} </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 text-center">
                        <div class="table-responsive p-0">
                            @if (count($images) > 0)
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th> --}}

                                            <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                                الصورة</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($images as $image)
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0" style="margin-right:20px">
                                                        <img src="{{ asset($image) }}" alt="product image" width="120"
                                                            height="100" class="img-thumbnail">
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-danger text-center" role="alert">
                                    <h2>لا يوجد صور في هذا المنتج</h2>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
