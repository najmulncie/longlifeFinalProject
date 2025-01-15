@extends('admin.admin_dashboard')

@section('title', 'Create Premium')

@section('body')


 <!-- Container-fluid starts-->
        <div class="container-fluid">
            <a href="{{ route('admin.premium.all') }}" class="btn btn-primary fs-5 mb-2">All Premium</a>
            <div class="row"> 
              <div class="col-12"> 
                <div class="card"> 
                  <div class="card-header">
                    <h5>Premium Form</h5>
                  </div>
                  <div class="card-body">
                    <div class="row g-xl-5 g-3">
                     
                      <div class="col-xxl-12 col-xl-12 box-col-12 position-relative">
                        <div class="tab-content" id="add-product-pills-tabContent">
                          <div class="tab-pane fade show active" id="detail-product" role="tabpanel" aria-labelledby="detail-product-tab">
                            <div class="sidebar-body">
                            <form action="{{ route('admin.premium.store') }}" method="POST" enctype="multipart/form-data" class="row g-2">
                                @csrf
                                <label class="form-label col-12 m-0" for="validationServer01">Premium Title <span class="txt-danger"> *</span></label>
                                <div class="col-12 custom-input mb-1">
                                  <input class="form-control is-invalid"  name="title" id="validationServer01" type="text" required="">
                                  <div class="valid-feedback">Looks good!</div>
                                  <div class="invalid-feedback">A Premium name is required and recommended to be unique.</div>
                                </div>
                                <div class="col-12 mb-2"> 
                                        <p>Description</p>
                                        <textarea type="text" name="description" class="form-control" id="descriptionInput"></textarea>
                                
                                </div>

                                <div class="product-upload">
                                <p>Premium Image </p>
                                  <div class="dz-message needsclick dropzone dropzone-light bg-light-primary" id="multiFileUpload">
                                    <svg>
                                      <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#file-upload"></use>
                                    </svg>
                                    <h5>Drag your image here, or <a class="txt-primary" href="#!">browser</a></h5><span class="note needsclick">SVG,PNG,JPG or GIF</span>
                                        <input type="file" name="image_path" class="form-controll-file">
                                    </div>
                              </div>

                               <div class="row g-3 custom-input">
                                  <div class="col-sm-6"> 
                                    <label class="form-label" for="exampleFormControlInput1">Initial cost <span class="txt-danger">*</span></label>
                                    <input class="form-control" name="initial_cost" id="exampleFormControlInput1" type="number">
                                  </div>
                                  <div class="col-sm-6"> 
                                    <label class="form-label" for="exampleFormControlInput1">Selling price <span class="txt-danger">*</span></label>
                                    <input class="form-control" name="selling_price" id="exampleFormControlInput1" type="number">
                                  </div>
                                
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Premium</button>
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