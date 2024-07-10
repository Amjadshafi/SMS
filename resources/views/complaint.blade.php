<!DOCTYPE html>
<html lang="en">

<head>

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      @media (min-width: 1025px) {
        .h-custom {
          height: 100vh !important;
        }
      }

      .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
      }

      .card-registration .select-arrow {
        top: 13px;
      }

      .gradient-custom-2 {
        /* fallback for old browsers */
        background: #a1c4fd;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1))
      }

      .bg-indigo {
        background-color: lightblue;
      }

      @media (min-width: 992px) {
        .card-registration-2 .bg-indigo {
          border-top-right-radius: 15px;
          border-bottom-right-radius: 15px;
        }
      }

      @media (max-width: 991px) {
        .card-registration-2 .bg-indigo {
          border-bottom-left-radius: 15px;
          border-bottom-right-radius: 15px;
        }
      }
    </style>
    <title>Complain Management</title>
    <?php
    $base_url = asset('public') . '/';
    ?>
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{ $base_url.'theme/plugins/material/css/materialdesignicons.min.css' }}" />
    <link rel="stylesheet" href="{{ $base_url.'theme/plugins/simplebar/simplebar.css' }}" />

    <!-- PLUGINS CSS STYLE -->
    <link rel="stylesheet" href="{{ $base_url.'theme/plugins/nprogress/nprogress.css' }}" />


    <!-- MONO CSS -->
    <link rel="stylesheet" href="{{ $base_url.'theme/css/style.css' }}" />
    <!-- FAVICON -->
    <link href="images/favicon.png" rel="shortcut icon" />

    <script src="plugins/nprogress/nprogress.js"></script>
  </head>

</head>

<body class="bg-light-gray" id="body">


  <header class="main-header" id="header">
    <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
      <!-- Sidebar toggle button -->
      <span class="page-title ml-7">{{ __("trans.Register Your Complaint")}}</span>
      <div class="navbar-right ">
        <div class="btn-group mr-7" role="group" aria-label="Basic example">
          @foreach($available_locales as $locale_name => $available_locale)
          @if($available_locale === $current_locale)
          <button type="button" class="btn btn-primary">
            <i class="mdi mdi-check-circle"></i> {{ $locale_name }}
          </button>
          @else
          <a class="btn btn-primary" href="{{ route('language', ['locale' => $available_locale]) }}">
            <i class="mdi mdi-check-circle-outline"></i> {{ $locale_name }}
          </a>
          @endif

          @endforeach
        </div>

      </div>
    </nav>


  </header>


  @if(Session::get('success', false))
  <?php $data = Session::get('success'); ?>
  @if (is_array($data))
  @foreach ($data as $msg)
  <div class="alert alert-success" role="alert">
    <i class="fa fa-check"></i>
    {{ $msg }}
  </div>
  @endforeach
  @else
  <div class="alert alert-success" role="alert">
    <i class="fa fa-check"></i>
    {{ $data }}
  </div>
  @endif
  @endif
  <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
    <div class="d-flex flex-column justify-content-between">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
          <div class="card card-default mb-0">
            <div class="card-header pb-0">
              <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                <!-- <a class="w-auto pl-0" href="/index.html">
                        <img src="images/logo.png" alt="Mono">
                        <span class="brand-name text-dark">MONO</span>
                      </a> -->
              </div>
            </div>
            <div class="card-body px-5 pb-5 pt-0">

              <body>
                <form action="{{route('storecomplaint')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="container py-0 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                      <div class="col-12">
                        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                          <div class="card-body p-0">
                            <div class="row g-0">
                              <div class="col-lg-6">
                                <div class="p-5">
                                  <h2 class="fw-normal mb-5 mt-5 text-center">{{__('trans.Applicant Details')}}</h2>
                                  <div class="mb-4 pb-2">
                                    <div data-mdb-input-init class="form-outline">
                                      <label class="form-label" for="category_id">{{__('trans.Select the Complaint Category')}}</label>
                                      <select name="category_id" id="category_id" class="form-control form-control-lg" required>
                                        <option value="">{{__('trans.Select the Complaint Category')}}</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">

                                      <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="form3Examplev2">{{__('trans.First name')}}</label>
                                        <input type="text" name="complaint_fname" value="{{ old('name') }}" id="complaint_fname" class="form-control form-control-lg" required />

                                      </div>

                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">

                                      <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="form3Examplev3">{{__('trans.Last name')}}</label>
                                        <input type="text" name="complaint_lname" value="{{ old('complaint_lname') }}" id="complaint_lname" class="form-control form-control-lg" required />

                                      </div>

                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">

                                      <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="form3Examplev2">{{__('trans.Email')}}</label>
                                        <input type="email" name="complaint_email" value="{{ old('complaint_email') }}" id="complaint_email" class="form-control form-control-lg" required />

                                      </div>

                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">

                                      <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="form3Examplev3">{{__('trans.Phone No')}}</label>
                                        <input type="phone" name="complaint_phone_no" value="{{ old('complaint_phone_no') }}" id="complaint_phone_no" class="form-control form-control-lg" required />

                                      </div>

                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">

                                      <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="form3Examplev2">{{__('trans.City')}}</label>
                                        <input type="text" name="complaint_city" value="{{ old('name') }}" id="complaint_city" class="form-control form-control-lg" required />

                                      </div>

                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">

                                      <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="form3Examplev3">{{__('trans.Country')}}</label>
                                        <input type="text" name="complaint_country" value="{{ old('name') }}" id="complaint_country" class="form-control form-control-lg" required />

                                      </div>

                                    </div>
                                  </div>

                                  <div class="mb-4 pb-2">
                                    <div data-mdb-input-init class="form-outline">
                                      <label class="form-label" for="form3Examplev4">{{__('trans.Address')}}</label>
                                      <textarea value="{{ old('name') }}" name="complaint_address" id="complaint_address" rows="3" cols="58" required></textarea>

                                    </div>
                                  </div>


                                  <div class="row">
                                    <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">

                                      <!-- <div data-mdb-input-init class="form-outline">
                      <label class="form-label" for="form3Examplev5">Bussines Arena</label>
                        <input type="text" id="form3Examplev5" class="form-control form-control-lg" /> 
                      </div> -->

                                    </div>

                                  </div>

                                </div>
                              </div>
                              <div class="col-lg-6 bg-indigo text-white">
                                <div class="p-5">
                                  <h2 class="fw-normal mb-5 mt-5 text-center">{{__('trans.Accused Details')}}</h2>
                                  <div class="mb-4 pb-2">
                                    <div data-mdb-input-init class="form-outline">
                                      <label class="form-label" for="complaint_country">{{__('trans.Select the Organizaion')}}</label>
                                      <select name="organization_id" id="organization_id" class="form-control form-control-lg" required>
                                        <option value="">{{__('trans.Select the Organizaion')}}</option>
                                        @foreach($organizations as $org)
                                        <option value="{{$org['id']}}">{{$org['name']}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="mb-4 pb-2">
                                    <div data-mdb-input-init class="form-outline form-white">
                                      <label class="form-label" for="form3Examplea2">{{__('trans.Accused Name')}}</label>
                                      <input type="text" value="{{ old('name') }}" name="accused_name" id="accused_name" class="form-control form-control-lg" required />
                                      @if ($errors->has('accused_name'))
                                      <span class="text-danger text-left">{{ $errors->first('accused_name') }}</span>
                                      @endif

                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-5 mb-4 pb-2">

                                      <div data-mdb-input-init class="form-outline form-white">
                                        <label class="form-label" for="form3Examplea4">{{__('trans.Accused Department')}}</label>
                                        <input type="text" name="accused_department" value="{{ old('name') }}" id="accused_department" class="form-control form-control-lg" required />
                                        @if ($errors->has('Accused Department'))
                                        <span class="text-danger text-left">{{ $errors->first('Accused Department') }}</span>
                                        @endif

                                      </div>

                                    </div>
                                    <div class="col-md-7 mb-4 pb-2">

                                      <div data-mdb-input-init class="form-outline form-white">
                                        <label class="form-label" for="form3Examplea5">{{__('trans.Email')}}</label>
                                        <input type="text" name="accused_email" value="{{ old('name') }}" id="accused_email" class="form-control form-control-lg" required />
                                        @if ($errors->has('Email'))
                                        <span class="text-danger text-left">{{ $errors->first('Email') }}</span>
                                        @endif

                                      </div>

                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-5 mb-4 pb-2">

                                      <div data-mdb-input-init class="form-outline form-white">
                                        <label class="form-label" for="form3Examplea4">{{__('trans.City')}}</label>
                                        <input type="text" name="accused_city" value="{{ old('name') }}" id="accused_city" class="form-control form-control-lg" required />
                                        @if ($errors->has('City'))
                                        <span class="text-danger text-left">{{ $errors->first('City') }}</span>
                                        @endif

                                      </div>

                                    </div>
                                    <div class="col-md-7 mb-4 pb-2">

                                      <div data-mdb-input-init class="form-outline form-white">
                                        <label class="form-label" for="form3Examplea5">{{__('trans.Country')}}</label>
                                        <input type="text" name="accused_country" value="{{ old('name') }}" id="accused_country" class="form-control form-control-lg" required />
                                        @if ($errors->has('Country'))
                                        <span class="text-danger text-left">{{ $errors->first('Country') }}</span>
                                        @endif

                                      </div>

                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-5 mb-4 pb-2">

                                      <div data-mdb-input-init class="form-outline form-white">
                                        <label class="form-label" for="form3Examplea4">{{__('trans.Accident Place')}}</label>
                                        <input type="text" name="accident_place" value="{{ old('name') }}" id="accident_place" class="form-control form-control-lg" required />
                                        @if ($errors->has('Accident Place'))
                                        <span class="text-danger text-left">{{ $errors->first('Accident Place') }}</span>
                                        @endif

                                      </div>

                                    </div>
                                    <div class="col-md-7 mb-4 pb-2">

                                      <div data-mdb-input-init class="form-outline form-white">
                                        <label class="form-label" for="form3Examplea5">{{__('trans.Accused Phone No.')}}</label>
                                        <input type="text" name="accused_phone_no" value="{{ old('name') }}" id="accused_phone_no" class="form-control form-control-lg" required />
                                        @if ($errors->has('Accused Phone No.'))
                                        <span class="text-danger text-left">{{ $errors->first('Accused Phone No.') }}</span>
                                        @endif

                                      </div>

                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-5 mb-4 pb-2">

                                      <div data-mdb-input-init class="form-outline form-white">
                                        <label class="form-label" for="form3Examplea7">{{__('trans.Accident Date & Time')}}</label>
                                        <!-- <input type="time" id="appt" name="appt" min="09:00" max="18:00" required /> -->
                                        <input type="date" id="accident_date" name="accident_date" value="2024-01-01" min="2018-01-01" max="2030-12-31" />
                                        @if ($errors->has('Accident Date & Time'))
                                        <span class="text-danger text-left">{{ $errors->first('Accident Date & Time') }}</span>
                                        @endif

                                      </div>

                                    </div>
                                    <div class="col-md-7 mb-4 pb-2">

                                      <div data-mdb-input-init class="form-outline form-white">
                                        <label class="form-label" for="form3Examplea8">{{__('trans.Accidental Evidence')}}</label>
                                        <input type="file" id="form3Examplea8" name="File" accept="application/pdf" multiple="multiple" class="form-control form-control-lg" required />
                                        @if ($errors->has('Accidental Evidence'))
                                        <span class="text-danger text-left">{{ $errors->first('Accidental Evidence') }}</span>
                                        @endif

                                      </div>

                                    </div>
                                  </div>

                                  <div class="mb-4">
                                    <div data-mdb-input-init class="form-outline form-white">
                                      <label class="form-label" for="form3Examplea9">{{__('trans.Complaint')}}</label>
                                      <textarea id="complaint_body" name="complaint_body" rows="3" cols="58" required></textarea>
                                      @if ($errors->has('Complaint'))
                                      <span class="text-danger text-left">{{ $errors->first('Complaint') }}</span>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="form-check d-flex justify-content-start mb-4 pb-3">
                                    <input class="form-check-input me-3" type="checkbox" value="" id="form2Example3c" />
                                    <label class="form-check-label text-black" for="form2Example3">
                                      {{__('trans.Idoacceptthe')}} <a href="#!" class="text-black"><u>{{__('trans.Terms and Conditions')}}</u></a> {{__('trans.ofsubmitedthiscomplaint')}}.
                                    </label>
                                  </div>

                                  <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-pill mb-4">{{__('trans.Submit')}}</button>
                                    <a href="{{ route('complaint.index') }}" class="btn btn-primary btn-pill mb-4">{{ __("trans.Back")}}</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>
</html>