@extends('Backend.layouts.master')
@section('css')
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('Backend_Files/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{URL::asset('Backend_Files/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

    <!-- Internal Select2 css -->
    <link href="{{URL::asset('Backend_Files/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{URL::asset('Backend_Files/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}"
          rel="stylesheet">
    <link href="{{URL::asset('Backend_Files/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}"
          rel="stylesheet">
    <link href="{{URL::asset('Backend_Files/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{URL::asset('Backend_Files/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">

    @section('title')
        SMTP
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Settings</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
               SMTP</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('smtp.update', 'test') }}" method="post" autocomplete="off"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">

                            <div class="row row-xs align-items-center mg-b-20">
                                <input name="types[]" type="hidden" value="MAIL_DRIVER" />
                                <div class="col-md-2">
                                    <label for="exampleInputEmail1">
                                        Type
                                    </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <select id="" name="MAIL_DRIVER" class="form-control" onchange="checkMailDriver();">
                                        <option value="sendmail" @if(env('MAIL_DRIVER') == 'sendmail') selected @endif >SendMail</option>
                                        <option value="smtp" @if(env('MAIL_DRIVER') == 'smtp') selected @endif>SMTP</option>
                                        <option value="mailgun" @if(env('MAIL_DRIVER') == 'mailgun') selected @endif>Mailgun</option>
                                    </select>
                                </div>
                            </div>
                            <div id="smtp">
                                <div class="row row-xs align-items-center mg-b-20">
                                    <input name="types[]" type="hidden" value="MAIL_HOST" />
                                    <div class="col-md-2">
                                        <label for="exampleInputEmail1">
                                            MAIL HOST
                                        </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input type="text" name="MAIL_HOST" class="form-control" value="{{env('MAIL_HOST')}}" />
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <input name="types[]" type="hidden" value="MAIL_PORT" />

                                    <div class="col-md-2">
                                        <label for="exampleInputEmail1">
                                            MAIL PORT
                                        </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input type="text" name="MAIL_PORT" class="form-control" value="{{env('MAIL_PORT')}}" />
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <input name="types[]" type="hidden" value="MAIL_ENCRYPTION" />

                                    <div class="col-md-2">
                                        <label for="exampleInputEmail1">
                                            MAIL ENCRYPTION
                                        </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input type="text" name="MAIL_ENCRYPTION" class="form-control" value="{{env('MAIL_ENCRYPTION')}}" />
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <input name="types[]" type="hidden" value="MAIL_USERNAME" />

                                    <div class="col-md-2">
                                        <label for="exampleInputEmail1">
                                            MAIL USERNAME
                                        </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input type="text" name="MAIL_USERNAME" class="form-control" value="{{env('MAIL_USERNAME')}}" />
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <input name="types[]" type="hidden" value="MAIL_PASSWORD" />

                                    <div class="col-md-2">
                                        <label for="exampleInputEmail1">
                                            MAIL PASSWORD
                                        </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input type="password" name="MAIL_PASSWORD" class="form-control" value="{{env('MAIL_PASSWORD')}}" />
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <input name="types[]" type="hidden" value="MAIL_FROM_ADDRESS" />

                                    <div class="col-md-2">
                                        <label for="exampleInputEmail1">
                                            MAIL FROM ADDRESS
                                        </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input type="text" name="MAIL_FROM_ADDRESS" class="form-control" value="{{env('MAIL_FROM_ADDRESS')}}" />
                                    </div>
                                </div>
                            </div>
                            <div id="mailgun">
                                <div class="row row-xs align-items-center mg-b-20">
                                    <input name="types[]" type="hidden" value="MAILGUN_DOMAIN" />

                                    <div class="col-md-2">
                                        <label for="exampleInputEmail1">
                                            MAILGUN DOMAIN
                                        </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input type="text" name="MAILGUN_DOMAIN" class="form-control" value="{{env('MAILGUN_DOMAIN')}}" />
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <input name="types[]" type="hidden" value="MAILGUN_SECRET" />

                                    <div class="col-md-2">
                                        <label for="exampleInputEmail1">
                                            MAILGUN SECRET
                                        </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input type="text" name="MAILGUN_SECRET" class="form-control" value="{{env('MAILGUN_SECRET')}}" />
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                    class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Submit
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            checkMailDriver();
        });

        function checkMailDriver() {
            var selectElement = document.querySelector('select[name=MAIL_DRIVER]');
            var mailgunElement = document.getElementById('mailgun');
            var smtpElement = document.getElementById('smtp');

            selectElement.addEventListener("change", function() {
                if (selectElement.value === 'mailgun') {
                    mailgunElement.style.display = 'block';
                    smtpElement.style.display = 'none';
                } else {
                    mailgunElement.style.display = 'none';
                    smtpElement.style.display = 'block';
                }
            });

            if (selectElement.value === 'mailgun') {
                mailgunElement.style.display = 'block';
                smtpElement.style.display = 'none';
            } else {
                mailgunElement.style.display = 'none';
                smtpElement.style.display = 'block';
            }
        }
    </script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('Backend_Files/js/select2.js') }}"></script>
    <script src="{{ URL::asset('Backend_Files/js/advanced-form-elements.js') }}"></script>

    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('Backend_Files/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('Backend_Files/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('Backend_Files/plugins/notify/js/notifit-custom.js')}}"></script>


    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('Backend_Files/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{URL::asset('Backend_Files/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{URL::asset('Backend_Files/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('Backend_Files/plugins/select2/js/select2.min.js')}}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{URL::asset('Backend_Files/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{URL::asset('Backend_Files/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
    <!-- Ionicons js -->
    <script src="{{URL::asset('Backend_Files/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{URL::asset('Backend_Files/plugins/pickerjs/picker.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('Backend_Files/js/form-elements.js')}}"></script>

@endsection
