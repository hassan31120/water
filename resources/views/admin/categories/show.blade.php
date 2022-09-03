@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                        <div class="col-6">
                            <h5 class="text-white text-capitalize ps-3" style="margin-right: 10px; font-weight: 700;">جدول
                                الشركات</h5>
                        </div>
                        <div class="col-6" style="position: relative;"><a href="#" style="position: absolute; left: 2%"
                                class="btn btn-primary">إضافة شركة جديدة</a></div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">

                        @isset($category)
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th> --}}
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                            العنوان</th>

                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                            الصورة</th>

                                        <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            منذ</th>
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تعديل</th>
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            حذف</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0" style="margin-right:20px">
                                                {{ $category->title }}</p>
                                        </td>

                                        <td>
                                            <img class="img-thumbnail" style="height: 80px; width: 80px ;"
                                                src="{{ asset($category->image) }}" alt="banner">
                                        </td>

                                        <td class="align-middle text-center">

                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $category->created_at->diffForHumans() }}</span>
                                        </td>

                                        <td class="align-middle text-center">
                                            <a href="{{ route('admin.category.edit', $category->id) }}"
                                                class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                data-original-title="Edit user">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('admin.category.destroy', $category->id) }}"
                                                class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                data-original-title="Delete user"
                                                onclick="return confirm('هل انت متأكد من حذف الشركة؟')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger text-center" role="alert">
                                <h2>لا يوجد شركة</h2>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                        <div class="col-6">
                            <h5 class="text-white text-capitalize ps-3" style="margin-right: 10px; font-weight: 700;">جدول
                                الشركات</h5>
                        </div>
                        <div class="col-6" style="position: relative;"><a href="#"
                                style="position: absolute; left: 2%" class="btn btn-primary">إضافة شركة جديدة</a></div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="list-group">
                        @foreach ($category->subcategories as $cat)
                            <a href="#" class="list-group-item list-group-item-action text-center">{{ $cat->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
