@extends('admin.admin_dashboard')

@section('title', 'Create Professional Service')

@section('body')


 <!-- Container-fluid starts-->
        <div class="container-fluid">
            <a href="{{ route('admin.professional.all') }}" class="btn btn-primary fs-5 mb-2">All Professional Service</a>
            <div class="row"> 
              <div class="col-12"> 
                <div class="card"> 
                  <div class="card-header">
                    <h5>Professional Form</h5>
                  </div>
                  <div class="card-body">
                    <div class="row g-xl-5 g-3">
                     
                      <div class="col-xxl-12 col-xl-12 box-col-12 position-relative">
                        <div class="tab-content" id="add-product-pills-tabContent">
                          <div class="tab-pane fade show active" id="detail-product" role="tabpanel" aria-labelledby="detail-product-tab">
                            <div class="sidebar-body">
                            <form action="{{ route('admin.professional.store') }}" method="POST" class="row g-2">
                                @csrf
                                <label class="form-label col-12 m-0" for="validationServer01"> Title <span class="txt-danger"> *</span></label>
                                <div class="col-12 custom-input mb-1">
                                  <input class="form-control is-invalid"  name="title" id="validationServer01" type="text" required="">
                                  <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-12 mb-2"> 
                                    <p>Description</p>
                                    <textarea type="text" name="description" class="form-control" id="descriptionInput"></textarea>
                                
                                </div>

                                
                               <div class="row g-3 custom-input">
                                  <div class="col-sm-6"> 
                                    <label class="form-label" for="exampleFormControlInput1"> Follower/React Count <span class="txt-danger">*</span></label>
                                    <input class="form-control" name="react_count" id="exampleFormControlInput1" type="text">
                                  </div>
                                  <div class="col-sm-6"> 
                                    <label class="form-label" for="exampleFormControlInput1">Selling price <span class="txt-danger">*</span></label>
                                    <input class="form-control" name="price" id="exampleFormControlInput1" type="number">
                                  </div>
                                
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Professional Service</button>
                                </div>

                              </form>
                              
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
          </div>
          <!-- Container-fluid Ends-->





@endsection