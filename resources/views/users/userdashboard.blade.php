@extends('layouts.app-master')
@section('pageTitle')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint</title>
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
</head>
<body>
    
</body>
</html>
<section class="h-100 h-custom gradient-custom-2">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="p-5">
                <h2 class="fw-normal mb-5 mt-5 text-center">Applicant Details</h2>

                  <div class="mb-4 pb-2">
                   
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline">
                      <label class="form-label" for="form3Examplev2">First name</label>
                        <input type="text"  value="{{ old('name') }}" id="form3Examplev2" class="form-control form-control-lg" />
                        
                      </div>

                    </div>
                    <div class="col-md-6 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline">
                      <label class="form-label" for="form3Examplev3">Last name</label>
                        <input type="text" value="{{ old('name') }}" id="form3Examplev3" class="form-control form-control-lg" />
                        
                      </div>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline">
                      <label class="form-label" for="form3Examplev2">Email</label>
                        <input type="email" value="{{ old('name') }}" id="form3Examplev2" class="form-control form-control-lg" />
                        
                      </div>

                    </div>
                    <div class="col-md-6 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline">
                      <label class="form-label" for="form3Examplev3">Phone</label>
                        <input type="phone" value="{{ old('name') }}" id="form3Examplev3" class="form-control form-control-lg" />
                        
                      </div>

                    </div>
                  </div>
                  <!-- <div class="row">
                    <div class="col-md-6 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline">
                      <label class="form-label" for="form3Examplev2">Address</label>
                        <input type="text" id="form3Examplev2" class="form-control form-control-lg" />
                        
                      </div>

                    </div>
                    <div class="col-md-6 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline">
                      <label class="form-label" for="form3Examplev3">Zip Code</label>
                        <input type="text" id="form3Examplev3" class="form-control form-control-lg" />
                        
                      </div>

                    </div>
                  </div> -->
                  <div class="row">
                    <div class="col-md-6 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline">
                      <label class="form-label" for="form3Examplev2">City</label>
                        <input type="text" value="{{ old('name') }}" id="form3Examplev2" class="form-control form-control-lg" />
                        
                      </div>

                    </div>
                    <div class="col-md-6 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline">
                      <label class="form-label" for="form3Examplev3">Country</label>
                        <input type="text" value="{{ old('name') }}" id="form3Examplev3" class="form-control form-control-lg" />
                        
                      </div>

                    </div>
                  </div>

                  <div class="mb-4 pb-2">
                    <div data-mdb-input-init class="form-outline">
                    <label class="form-label" for="form3Examplev4">Address</label>
                    <textarea value="{{ old('name') }}" id="w3review" name="w3review" rows="3" cols="58">
                    </textarea> 
                      
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
                  <h2 class="fw-normal mb-5 mt-5 text-center">Accused Details</h2>

                  <div class="mb-4 pb-2">
                    <div data-mdb-input-init class="form-outline form-white">
                    <label class="form-label" for="form3Examplea2">Accused Name</label>
                      <input type="text" value="{{ old('name') }}" id="form3Examplea2" class="form-control form-control-lg" />
                      @if ($errors->has('accused_name'))
                        <span class="text-danger text-left">{{ $errors->first('accused_name') }}</span>
                    @endif
                      
                    </div>
                  </div>

                  <div class="mb-4 pb-2">
                    <div data-mdb-input-init class="form-outline form-white">
                    <label class="form-label" for="form3Examplea3">Accused Department</label>
                      <input type="text" id="form3Examplea3" class="form-control form-control-lg" />
                      @if ($errors->has('Accused Department'))
                        <span class="text-danger text-left">{{ $errors->first('Accused Department') }}</span>
                    @endif
                      
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline form-white">
                      <label class="form-label" for="form3Examplea4">City</label>
                        <input type="text" value="{{ old('name') }}" id="form3Examplea4" class="form-control form-control-lg" />
                        @if ($errors->has('City'))
                        <span class="text-danger text-left">{{ $errors->first('City') }}</span>
                    @endif
                        
                      </div>

                    </div>
                    <div class="col-md-7 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline form-white">
                      <label class="form-label" for="form3Examplea5">Country</label>
                        <input type="text" value="{{ old('name') }}"  id="form3Examplea5" class="form-control form-control-lg" />
                        @if ($errors->has('Country'))
                        <span class="text-danger text-left">{{ $errors->first('Country') }}</span>
                    @endif
                        
                      </div>

                    </div>
                  </div>

                  <div class="mb-4 pb-2">
                    <div data-mdb-input-init class="form-outline form-white">
                    <label class="form-label" for="form3Examplea6">Accident Place</label>
                      <input type="text" id="form3Examplea6" class="form-control form-control-lg" />
                      @if ($errors->has('Accident Place'))
                        <span class="text-danger text-left">{{ $errors->first('Accident Place') }}</span>
                    @endif
                      
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline form-white">
                      <label class="form-label" for="form3Examplea7">Accident Date & Time</label>
                      <input type="time" id="appt" name="appt" min="09:00" max="18:00" required />
                      <input type="date" id="start" name="trip-start" value="2024-01-01" min="2018-01-01" max="2030-12-31" />
                      @if ($errors->has('Accident Date & Time'))
                        <span class="text-danger text-left">{{ $errors->first('Accident Date & Time') }}</span>
                    @endif
                        
                      </div>

                    </div>
                    <div class="col-md-7 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline form-white">
                      <label class="form-label" for="form3Examplea8">Accidental Evidence</label>
                      <input type="file" id="form3Examplea8" accept="application/pdf" multiple="multiple" class="form-control form-control-lg" />
                      @if ($errors->has('Accidental Evidence'))
                        <span class="text-danger text-left">{{ $errors->first('Accidental Evidence') }}</span>
                    @endif
                        
                      </div>

                    </div>
                  </div>

                  <div class="mb-4">
                    <div data-mdb-input-init class="form-outline form-white">
                    <label class="form-label" for="form3Examplea9">Complaint</label>
                    <textarea id="w3review" name="w3review" rows="3" cols="58">
                    </textarea> 
                    @if ($errors->has('Complaint'))
                        <span class="text-danger text-left">{{ $errors->first('Complaint') }}</span>
                    @endif
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-start mb-4 pb-3">
                    <input class="form-check-input me-3" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label text-black" for="form2Example3">
                      I do accept the <a href="#!" class="text-black"><u>Terms and Conditions</u></a> of submited this complaint.
                    </label>
                  </div>

                  <button type="submit" class="btn btn-primary">{{ __("trans.Submit")}}</button>
                <a href="" class="btn btn-secondary">{{ __("trans.Back")}}</a>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection