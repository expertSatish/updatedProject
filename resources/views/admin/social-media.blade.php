@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">

    <div class="br-pageheader pd-y-15 pd-l-20">

        <div class="col-md-6">

            <nav class="breadcrumb pd-0 mg-0 tx-12">

              <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>

              <span class="breadcrumb-item active">Social Media</span>

            </nav>

        </div>

        <div class="col-md-6">

            <div class="pull-right">

                

            </div>

        </div>

    </div>



      <div class="br-pagebody">

      <div class="row row-sm mg-t-20">

          <div class="col-sm-5">

            <div class="card shadow-base bd-0">

              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">

                <h6 class="card-title tx-uppercase tx-12 mg-b-0">Add Social Media</h6>

                <span class="tx-12 tx-uppercase">{{date('F d, Y')}}</span>

              </div><!-- card-header -->

              <div class="card-body justify-content-between align-items-center">

                <form method="post" action="{{route('admin.save-social-media')}}" enctype="multipart/form-data">

                    @csrf

                    <div class="row">

                        <div class="col-lg-12">

                            <div class="form-group">

                            <label>Platform <span class="error">*</span></label>

                            <select class="form-control" name="platform">

                                <option value="">Choose Platform</option>

                                <option value="facebook">Facebook</option>

                                <option value="twitter">Twitter</option>

                                <option value="linkedin">Linkedin</option>

                                <option value="instagram">Instagram</option>

                                <option value="pinterest">Pinterest</option>

                                <option value="youtube">Youtube</option>

                            </select>

                            @error('platform')<span class="error">{{$message}}<span> @enderror

                            </div>

                        </div>

                        <div class="col-lg-12">

                            <div class="form-group">

                            <label>URL Link <span class="error">*</span></label>

                            <textarea class="form-control" name="link" placeholder="Please enter url here..."></textarea>

                            @error('link')<span class="error">{{$message}}<span> @enderror

                            </div>

                        </div>

                       <div class="col-12">
                        <button type="submit" id="svbtn" onclick="$('#svbtn').hide();$('#prcbtn').show();" class="btn btn-info">Confirm & Proceed</button>

                        <button type="button" id="prcbtn" style="display:none;" disabled class="btn btn-info"><i class="fa fa-spinner"></i> Processing...</button>

                       </div>

                        
                    </div><!-- form-layout-footer -->

                </form>

              </div><!-- card-body -->

            </div><!-- card -->

          </div><!-- col-4 -->



          <div class="col-sm-7 mg-t-20 mg-sm-t-5">

            <div class="card shadow-base bd-0">

              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">

                <h6 class="card-title tx-uppercase tx-12 mg-b-0">Social Media List</h6>

                <span class="tx-12 tx-uppercase">{{date('F d, Y')}}</span>

              </div><!-- card-header -->

              <div class="card-body justify-content-between align-items-center">

                    <div class="table-wrapper">

                        <table class="table table-bordered table-colored table-dark w-100">

                          <thead>

                              <tr>

                                  <th>Icon</th>

                                  <th>Link</th>

                                  <th>Status</th>

                                  <th>Action</th>

                              </tr>

                          </thead>

                          <tbody>

                            @foreach($lists as $list)

                            <tr>

                                <td>

                                  @if($list->title=='facebook') <i class="fab fa-facebook"></i> @endif

                                  @if($list->title=='twitter') <i class="fab fa-twitter"></i> @endif

                                  @if($list->title=='linkedin') <i class="fab fa-linkedin"></i> @endif

                                  @if($list->title=='instagram') <i class="fab fa-instagram"></i> @endif

                                  @if($list->title=='pinterest') <i class="fab fa-pinterest"></i> @endif

                                  @if($list->title=='youtube') <i class="fab fa-youtube"></i> @endif

                                </td>

                                <td>{{$list->link}}</td>

                                <td>

                                    @if($list->status==0)

                                    <a href="{{route('admin.socialmediastatus',['status'=>1,'id'=>$list->id])}}" class="btn btn-outline-danger btn-icon rounded-circle" data-toggle="tooltip" data-placement="top" title="Category Activate"><div><i class="fa fa-thumbs-down"></i></div></a>

                                    @else

                                    <a href="{{route('admin.socialmediastatus',['status'=>0,'id'=>$list->id])}}" class="btn btn-outline-success btn-icon rounded-circle" data-toggle="tooltip" data-placement="top" title="Category Dectivate"><div><i class="fa fa-thumbs-up"></i></div></a>

                                    @endif

                                </td>

                                <td class="pd-r-0-force tx-center">

                                    <div class="dropdown TAction show">

                                        <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="true"><i

                                                class="fa fa-ellipsis-v"></i></a>

                                        <ul class="dropdown-menu" x-placement="bottom-end">

                                            <li><a href="#editmodal" data-toggle="modal" onclick="getEditData('{{$list->title}}','{{$list->link}}','{{$list->id}}')"><div><i class="fa fa-pencil"></i> Edit</div></a>

                                            </li>

                                            <li><a href="javascript:void(0)" onclick="RemoveRecord({{$list->id}})"><div><i class="fa fa-trash"></i> Remove</div></a>

                                                </li>

                                        </ul>

                                    </div>

                                </td>

                            </tr>  

                            @endforeach                          

                          </tbody>

                        </table>

                        {{$lists->links()}}

                    </div>

              </div><!-- card-body -->

            </div><!-- card -->

          </div><!-- col-4 -->

          

        </div><!-- row -->

      </div>

   

</div>

<form method="post" action="{{route('admin.social-media-remove')}}" id="RemoveForm">@csrf<input type="hidden" name="removeId" id="removeId"></form>

<div id="editmodal" class="modal fade">

  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content bd-0 tx-14">

        <form method="post" action="{{route('admin.update-social-media')}}">

            @csrf

            <input type="hidden" name="editId">

            <div class="modal-header pd-x-20">

                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Edit Social Media</h6>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body pd-20">

                <div class="row mg-b-20">

                    <div class="col-lg-12">

                        <div class="form-group">

                            <label>Platform <span class="error">*</span></label>

                            <select class="form-control" name="edit_platform" required>

                                <option value="">Choose Platform</option>

                                <option value="facebook">Facebook</option>

                                <option value="twitter">Twitter</option>

                                <option value="linkedin">Linkedin</option>

                                <option value="instagram">Instagram</option>

                                <option value="pinterest">Pinterest</option>

                                <option value="youtube">Youtube</option>

                            </select>

                            @error('edit_platform')<span class="error">{{$message}}<span> @enderror

                        </div>

                    </div>

                    <div class="col-lg-12">

                        <div class="form-group">

                            <label>URL Link <span class="error">*</span></label>

                            <textarea class="form-control" name="edit_link" required placeholder="Please enter url here..."></textarea>

                            @error('edit_link')<span class="error">{{$message}}<span> @enderror

                        </div>

                    </div>

                </div>

            </div>

            <div class="modal-footer justify-content-center">

                <button type="submit" id="Msvbtn" onclick="$('#Msvbtn').hide();$('#Mprcbtn').show();" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Update & Proceed</button>

                <button type="button" disabled id="Mprcbtn" style="display:none;" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-spinner"></i> Processing...</button>

                <button type="button" class="btn btn-dark tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>

            </div>

        </form>

    </div>

  </div><!-- modal-dialog -->

</div>

@endsection
@push('css')

<title>Social Media Management : {{project()}}</title>

<link href="{{asset('admin/lib/select2/css/select2.min.css')}}" rel="stylesheet">



<link href="{{asset('admin/lib/SpinKit/spinkit.css')}}" rel="stylesheet">
<style>
table *{overflow-wrap: break-word;
  word-wrap: break-word;
  -ms-word-break: break-all;
  word-break: break-all;
  word-break: break-word;
  -ms-hyphens: auto;
  -moz-hyphens: auto;
  -webkit-hyphens: auto;
  hyphens: auto;}
</style>
@endpush

@push('js')

<script src="{{asset('admin/lib/datatables/jquery.dataTables.js')}}"></script>



<script src="{{asset('admin/lib/select2/js/select2.min.js')}}"></script>



<script>

    $(document).ready(function(){

        $('.select2-container').css('width','100%');

        $('#datatable1').DataTable({

            responsive: true,

            language: {

            searchPlaceholder: 'Search...',

            sSearch: '',

            lengthMenu: '_MENU_ items/page',

            }

        });

        $('#datatable2').DataTable({

            bLengthChange: false,

            searching: false,

            responsive: true

        });

        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

    });

    function RemoveRecord(Id){

        if(confirm("Are you sure! You want to remove this record.")){

            $('#removeId').val(Id);

            $('#RemoveForm').submit();

        }

    }

    function getEditData(title,link,Id){

        $('select[name=edit_platform]').val(title);

        $('textarea[name=edit_link]').val(link);

        $('input[name=editId]').val(Id);

    }

    imgInp.onchange = evt => {

        const [file] = imgInp.files

        if (file) {

        defaultimg.src = URL.createObjectURL(file)

        }

    }

  

</script>   

@endpush