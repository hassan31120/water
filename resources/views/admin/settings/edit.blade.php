@extends('admin.layouts.main')
@section('dash')
    الإعدادات
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                        <div class="col-6">
                            <h5 class="text-white text-capitalize ps-3" style="margin-right: 10px">تعديل الإعدادات</h5>
                        </div>
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
                                                    <form action="{{ route('admin.setting.update', $setting->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="summernote"
                                                                        style="font-size: 18px">من نحن</label>
                                                                    <textarea name="about" id="summernote" cols="30" rows="5" required
                                                                        class="form-control form-control-lg formborderCSS">{{ $setting->about }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="summernote1"
                                                                        style="font-size: 18px">تواصل معنا</label>
                                                                    <textarea name="contact" id="summernote1" cols="30" rows="5" required
                                                                        class="form-control form-control-lg formborderCSS">{{ $setting->contact }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="summernote2"
                                                                        style="font-size: 18px"> الشروط </label>
                                                                    <textarea name="terms" id="summernote2" cols="30" rows="5" required
                                                                        class="form-control form-control-lg formborderCSS">{{ $setting->terms }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="summernote3"
                                                                        style="font-size: 18px">سياسة الخصوصية</label>
                                                                    <textarea name="privacy" id="summernote3" cols="30" rows="5" required
                                                                        class="form-control form-control-lg formborderCSS">{{ $setting->privacy }}</textarea>
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
