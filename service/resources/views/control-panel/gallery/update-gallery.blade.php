@include('control-panel.inc.header')



<body class="nav-md">

<div class="container body">

<div class="main_container">

  

      @include('control-panel.inc.side-menu')

    

    

  <div class="right_col" role="main">

    <div class="row"> 

  

        @if(session()->has('success_msg'))  <?php echo Helper::SuccessAlert(session()->get('success_msg')); ?>  @endif



        @if(session()->has('error_msg'))  <?php echo Helper::ErrorAlert(session()->get('error_msg')); ?>  @endif

      

    </div>



<div class="row">



  <!--------------------table data start-------------------------->     



  <div class="col-md-12 col-sm-12 col-xs-12">



    <div class="x_panel">



      <div class="x_title">

 

        <h2>Update Our Clients </h2>

           

          <a href="{{url('control-panel/our-clients')}}"  class="btn btn-danger pull-right" ><i class="fa fa-arrow-left"></i> Back</a>

           

        <div class="clearfix"></div>



      </div>



      <div class="x_content">



   

    <form method="post" action="{{url('control-panel/edit-our-clients')}}" enctype="multipart/form-data">

    

    @csrf

      <input type="hidden" name="Id" id="EditId" value="{{$data->id}}">



      <div class="modal-body" style="max-height:338px;overflow:auto;">



        <div class="row">



          <div class="col-md-3" style="display: none;">

             <span>Gallery Type</span>

             <select class="form-control" name="type" id="type" onchange="getTypeData(this.value)">

                <option value="image" <?php if($data->type=='image'){ echo "selected"; } ?> >Image</option>

                <option value="youtube" <?php if($data->type=='youtube'){ echo "selected"; } ?> >Youtube</option>

             </select>

          </div>



        <div id="imagebox" style="display:<?php if($data->type!='image'){echo"none"; }?>"> 



          <div class="col-md-4">

            <span>Best Image Size 500 * 500 px</span>

            <input type="hidden" class="form-control" name="preimage" id="Editservice" value="{{$data->title}}">

            <input type="file" class="form-control" name="eimage" onchange="getImage(this)" >

          </div>

          <div class="col-md-2">
            <img style="margin-top: 5px;" id="blash" src="{{asset('resources/assets/uploads/gallery/'.$data->title)}}" width="100%">

          </div>



          <div class="col-md-5">

            <span>Image Alt</span>

            <input type="text" class="form-control" name="alt" id="alt" value="{{$data->alt}}">

           </div>

           <br>

          
        </div> 



        <div id="videobox" style="display:<?php if($data->type!='youtube'){echo"none"; }?>">  

          <div class="col-md-9">

            <span>Youtube Url</span>

            <input type="text" class="form-control" name="youtube" id="youtube" value="{{$data->title}}">

           </div>

        </div>   



        </div> 



      </div>

      <div class="modal-footer">

        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>

      </div>



   </form>







      </div>



    </div>



  </div>     



</div>



</div>



 </div>

        </div>

   

    <footer> @include('control-panel.inc.footer') </footer>

   

</body>





<script>





  function getTypeData(data)

  {

      if(data=='youtube')

      {

         $('#videobox').show();

         $('#imagebox').hide();

      }

      else

      {

         $('#imagebox').show();

         $('#videobox').hide();

      }

  }

  function getImage(input)
   {
    if (input.files && input.files[0]) {

        var reader = new FileReader();



        reader.onload = function (e) {

            $('#blash').attr('src', e.target.result);

        }



        reader.readAsDataURL(input.files[0]);

        }
   }

</script>





