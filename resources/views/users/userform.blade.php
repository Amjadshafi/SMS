@extends('layouts.app-master')
@section('pageTitle')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Sign in</title>
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #f093fb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to bottom right, rgba(240, 147, 251, 1), rgba(245, 87, 108, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to bottom right, rgba(240, 147, 251, 1), rgba(245, 87, 108, 1))
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

        /* second form */
    </style>
</head>

<body>

</body>

</html>

<!-- User Signup Page -->
<section class="">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-10">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="mb-4 pb-2 pb-md-0 mb-md-5 row justify-content-center align-items-center"><b>User Signup Page</b></h1>
                        <form>
                          @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">

                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="firstName">First Name</label>
                                        <input type="text" id="firstName" class="form-control form-control-md" required />
                                    </div>

                                </div>
                                <div class="col-md-6 mb-4">

                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="lastName">Last Name</label>
                                        <input type="text" id="lastName" class="form-control form-control-md" required />

                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">

                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="emailAddress">Email</label>
                                        <input type="email" id="emailAddress" class="form-control form-control-md" required />

                                    </div>

                                </div>
                                <div class="col-md-6 mb-4 pb-2">

                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                        <input type="tel" id="phoneNumber" name="complaint_phone_no" class="form-control form-control-md" required />

                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 d-flex align-items-center">

                                    <div data-mdb-input-init class="form-outline datepicker w-100">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea id="Address" name="Address" rows="2" cols="30" required>
                                         </textarea>


                                    </div>

                                </div>
                                <div class="col-md-6 mb-4">
                                    <div data-mdb-input-init class="form-outline datepicker w-100">
                                        <label for="country" class="form-label">Country</label>
                                        <input type="country" class="form-control form-control-md" id="country" required />

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 d-flex align-items-center">

                                    <div data-mdb-input-init class="form-outline datepicker w-100">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control form-control-md" id="City" required />

                                    </div>

                                </div>
                                <div class="col-md-6 mb-4">
                                    <div data-mdb-input-init class="form-outline datepicker w-100">
                                        <label for="Zip/Postal" class="form-label">Zip/Postal Code</label>
                                        <input type="Zip/Postal" class="form-control form-control-md" id="Zip/Postal" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 d-flex align-items-center">

                                    <div data-mdb-input-init class="form-outline datepicker w-100">
                                        <label for="ID" class="form-label">Registration ID</label>
                                        <input type="text" class="form-control form-control-md" id="ID" required />

                                    </div>

                                </div>
                                <div class="col-md-6 mb-4">
                                    <div data-mdb-input-init class="form-outline datepicker w-100">
                                        <label for="passport" class="form-label">Passport No.</label>
                                        <input type="passport" class="form-control form-control-md" id="passport" required />
                                    </div>
                                </div>
                            </div>
                            <div class="mt-0 pt-0">
                                <!-- <input data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-ms" type="submit" value="Signup"></a> -->
                                <div class="mt-4">
                                    <a href="#" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-ms">Signup</a>
                                </div>
                            </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection