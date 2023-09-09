@extends('landing-page.komponen.partial')

@section( 'content')
<section class="hero-1 bg-white position-relative d-flex align-items-center justify-content-center overflow-hidden">
    <div class=" container">
        <div class="row ">

            <div class="col-md-12">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title mb-0">Horizontal Form</h4>
                    </div>
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
                        <form>
                            <div class="mb-3 row">
                                <label for="email1" class="col-sm-3 col-form-label">Email:</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email1" placeholder="Enter Your email">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="pwd2" class="col-sm-3 col-form-label">Password:</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="pwd2" placeholder="Enter Your password">
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember me
                                </label>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>



            </div>

        </div>
    </div>
    <!-- end container -->
</section>
@endsection
