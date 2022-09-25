@extends('admin.layouts.main')

@section('dash')
    العناوين
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                        <div class="col-6">
                            <h5 class="text-white text-capitalize ps-3" style="margin-right: 10px; font-weight: 700;">جدول
                                العناوين</h5>
                        </div>
                        <div class="col-6" style="position: relative;"><a href="{{ route('admin.address.create') }}"
                                style="position: absolute; left: 2%" class="btn btn-primary">إضافة عنوان جديد</a></div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        @if (count($addresses) > 0)
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th> --}}
                                    <th class="text-secondary font-weight-bolder opacity-7">المكان
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        الإسم</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                            الرقم</th>
                                            <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                                التفاصيل</th>

                                    <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                        منذ</th>
                                    <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                        اسم المستخدم</th>
                                    <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                        تعديل</th>
                                    <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                        حذف</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($addresses as $address)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0" style="margin-right:20px">{{ $address->title }}</p>
                                        </td>

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $address->name }}</p>
                                        </td>

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $address->number }}</p>
                                        </td>

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $address->description }}</p>
                                        </td>

                                        <td class="align-middle text-center">

                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $address->created_at->diffForHumans() }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $address->users->name }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('admin.address.edit', $address->id) }}" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('admin.address.destroy', $address->id) }}" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Delete user"
                                                onclick="return confirm('هل انت متأكد من حذف العنوان؟')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="alert alert-danger text-center" role="alert">
                                <h2>لا يوجد عنواين</h2>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
