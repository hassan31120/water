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
                            <h5 class="text-white text-capitalize ps-3" style="margin-right: 10px">تعديل العنوان</h5>
                        </div>
                        <div class="col-6" style="position: relative;"><a href="{{ route('admin.addresses') }}" style="position: absolute; left: 2%"
                                class="btn btn-primary">عرض العناوين</a></div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class=" container-fluid">
                            <!--form section-->
                            <section class="vh-100 gradient-custom sectionFormDIR">
                                <div class="container py-5 h-100">
                                    <div class="row justify-content-center align-items-center h-100">
                                        <div class="col-12 col-lg-9 col-xl-7">
                                            <div class="card shadow-2-strong card-registration"
                                                style="border-radius: 15px;">
                                                <div class="card-body p-4 p-md-5">
                                                    <form action="{{ route('admin.address.update', $address->id) }}" method="POST">
                                                        @csrf

                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="title"
                                                                        style="font-size: 18px">المكان</label>
                                                                    <input type="text" name="title" id="title"
                                                                        class="form-control form-control-lg formborderCSS"
                                                                        required value="{{ $address->title }}" />
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 mb-4 pb-2">

                                                            <div class="form-outline">
                                                                <label class="form-label" for="description"
                                                                    style="font-size: 18px"> التفاصيل</label>
                                                                <textarea class="form-control form-control-lg formborderCSS" name="description" id="description" cols="30"
                                                                    rows="5" required>{{ $address->description }}</textarea>
                                                            </div>

                                                        </div>


                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group mx-sm-3 mb-2">
                                                                    <label class="form-label" for="user_id"
                                                                        style="font-size: 18px">اختيار مستخدم</label>
                                                                    <select name="user_id" id="user_id" class="form-control form-control-lg formborderCSS"
                                                                        class="form-control" required>
                                                                        @foreach ($users as $user)
                                                                            <option value="{{ $user->id }}" {{isset($address) ? $address->user_id==$user->id ? 'selected' : '' : old('user_id')}} >
                                                                                {{ $user->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mt-4 pt-2 text-center">
                                                            <input class="btn btn-primary btn-lg" type="submit"
                                                                value="تعديل" />
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--endform section-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
