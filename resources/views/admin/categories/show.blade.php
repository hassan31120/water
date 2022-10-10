@extends('admin.layouts.main')

@section('dash')
الشركات
@endsection

@section('content')
    <div class="row">
        @isset($category)
            <div class="col-8">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                            <div class="col-12">
                                <h5 class="text-white text-capitalize ps-3 text-center"
                                    style="margin-right: 10px; font-weight: 700;">{{ $category->title }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">


                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th> --}}
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                            الإسم</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                            الوصف</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                            السعر القديم</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                            السعر الجديد</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                            القسم</th>

                                        <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            منذ</th>
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تعديل</th>
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            حذف</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($subs)
                                        @for ($i = 0; $i < count($subs); $i++)
                                            @foreach ($subs[$i]->products as $product)
                                                <tr>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0" style="margin-right:20px">
                                                            {{ $product->title }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0" style="margin-right:20px">
                                                            {{ $product->description }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0" style="margin-right:20px">
                                                            {{ $product->old_price }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0" style="margin-right:20px">
                                                            {{ $product->new_price }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0" style="margin-right:20px">
                                                            {{ $product->subcategories->title }}</p>
                                                    </td>

                                                    <td class="align-middle text-center">

                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $product->created_at->diffForHumans() }}</span>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <a href="{{ route('admin.product.edit', $product->id) }}"
                                                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                            data-original-title="Edit user">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="{{ route('admin.product.destroy', $product->id) }}"
                                                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                            data-original-title="Delete user"
                                                            onclick="return confirm('هل انت متأكد من حذف المنتج؟')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endfor
                                    @else
                                        <div class="alert alert-danger text-center" role="alert">
                                            <h2>لا يوجد أقسام</h2>
                                        </div>
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                            <div class="col-12">
                                <h5 class="text-center text-white text-capitalize ps-3"
                                    style="margin-right: 10px; font-weight: 700;">
                                    الأقسام</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="list-group">
                            @foreach ($category->subcategories as $cat)
                                <a href="{{ route('admin.category.products', $cat->id) }}"
                                    class="list-group-item list-group-item-action text-center">{{ $cat->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-danger text-center" role="alert">
                <h2>لا يوجد شركة</h2>
            </div>
        @endisset
    </div>
@endsection
