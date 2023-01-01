
@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Admin')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
  @include('panels.flash')
      <!-- Greetings Card starts -->
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-congratulations">
          <div class="card-body text-center">
            <img
              src="{{asset('images/elements/decore-left.png')}}"
              class="congratulations-img-left"
              alt="card-img-left"
            />
            <img
              src="{{asset('images/elements/decore-right.png')}}"
              class="congratulations-img-right"
              alt="card-img-right"
            />
            <div class="avatar avatar-xl bg-primary shadow">
              <div class="avatar-content">
                <div class="brand-logo">
                    <div class="avatar">
                      <img
                        src="{{asset('images/logo/logo.png')}}"
                        alt="avatar"
                        width="80"
                        height="80"
                      />
                    </div>
                    <div class="avatar">
                      <img
                        src="{{asset('images/logo/spsi.png')}}"
                        alt="avatar"
                        width="80"
                        height="80"
                      />
                    </div>
                  </div>
              </div>
            </div>
            <div class="text-center">
              <h1 class="mb-1 text-white">SPSI</h1>
              <h1 class="mb-1 text-white">PT. DIAMOND INTERNASIONAL INDONESIA</h1>
              <p class="card-text m-auto w-75">
                Siap Melindungi Anda!
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Greetings Card ends -->
      <div class="col-lg-12 col-sm-12 col-12">
        <button class="dt-button add-new btn btn-primary mb-2"  aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-slide-in"><span>Tambah Informasi</span></button>
        <div class="card">
          <div class="card-header bg-light-primary flex-column align-items-start">
            <div class="row col-12">
                <div class="col-lg-1 col-2">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                          <i data-feather="bell" class="font-medium-5"></i>
                        </div>
                      </div>
                </div>
                <div class="col-lg-11 col-10 my-auto">
                    <p class="h4 card-text">Informasi Terkini</p>
                </div>
            </div>
          </div>
          <div class="card-body" bis_skin_checked="1">
            @foreach ($data as $datas)
            <?php 
              $k = array_rand($val);
              $timestamp = strtotime($datas->tanggal);
              $day = $result = substr(date('l', $timestamp), 0, 3);
            ?>
              <div class="card card-user-timeline mb-0">
                <div class="card-body pb-0">
                    <ul class="timeline ms-50">
                      <li class="timeline-item pb-0">
                          <span class="timeline-point timeline-point-{{$val[$k]}} timeline-point-indicator"></span>
                          <div class="timeline-event">
                            <div class="card card-developer-meetup pt-0 ps-0 mb-0">
                                <div class="card-body  pt-0 ps-0 pb-0">
                                  <div class="meetup-header d-flex align-items-center  pt-0 ps-0">
                                    <div class="meetup-day">
                                      <h6 class="mb-0 text-uppercase">{{$day}}</h6>
                                      <h4 class="mb-0">{{date('d',$timestamp)}}</h4>
                                      <h6 class="mb-0">{{date('Y',$timestamp)}}</h6>
                                    </div>
                                    <div class="my-auto">
                                      <h5 class="card-title mb-25">{{$datas->judul}}</h5>
                                      <p class="card-text mb-0">{{$datas->isi}}</p>
                                      @if ($datas->foto)
                                        <a class="d-flex flex-row p-1 align-items-center" onclick="viewImage('{{$datas->foto}}','{{$datas->judul}}')">
                                          <img class="me-1" src="http://spsi.test/images/icons/jpg.png" alt="data.json" height="18">
                                          <span class="mb-0 h6 badge badge-light-primary badge-glow">buka lampiran</span>
                                        </a>
                                      @else
                                        <span class="mb-0 h6 badge badge-light-secondary">tidak ada lampiran</span>
                                      @endif
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                      </li>
                    </ul>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
       <!-- Modal to add new user starts-->
      <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
        <div class="modal-dialog">
          <form class="add-new-user modal-content pt-0" enctype="multipart/form-data" method="POST" action="{{route('informasi-add-admin')}}">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Informasi</h5>
            </div>
            <div class="modal-body flex-grow-1">
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-title">Judul Informasi</label>
                <input
                  type="text"
                  class="form-control dt-title"
                  id="basic-icon-default-title"
                  placeholder="Rapat"
                  name="info_judul"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-document">Isi</label>
                <textarea
                  type="text"
                  id="basic-icon-default-document"
                  class="form-control dt-document"
                  placeholder="Isi Informasi"
                  name="info_isi"></textarea>
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-calendar">Tanggal dibuat</label>
                <input
                  type="date"
                  id="basic-icon-default-calendar"
                  class="form-control dt-date"
                  placeholder="12/02/2022"
                  name="info_tanggal"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-email">Infromasi gambar</label>
                <input
                  type="file"
                  id="basic-icon-default-file"
                  class="form-control dt-file"
                  placeholder="upload image"
                  name="info_file"
                />
              </div>
              <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
              <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
      <div class="disabled-backdrop-ex">
        <!-- Button trigger modal -->
        <button type="button" class="d-none btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#backdrop" id="img_button">
          Disabled Backdrop
        </button>
        <!-- Modal -->
        <div
          class="modal modal-primary fade text-start"
          id="backdrop"
          tabindex="-1"
          aria-labelledby="myModalLabel4"
          data-bs-backdrop="false"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel4">Disabled Backdrop</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-center">
                <img src="" alt="" id="img_modal" title="" class="img-fluid"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script>
    function viewImage(image,judul){
      var locat = "{{ asset('/storage/images/') }}"+"/"+image;
      $("#myModalLabel4").html(judul);
      $('#img_button').trigger('click');
      $("#img_modal").attr("src",locat);
    }
  </script>

@endsection
