@extends('gp247-core::layout')

@section('main')
@php
    $id = empty($id) ? 0 : $id;
@endphp
<div class="row">

  <div class="col-md-5">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{!! $title_action !!}</h3>
        @if ($layout == 'edit')
        <div class="btn-group float-right" style="margin-right: 5px">
            <a href="{{ gp247_route_admin('admin_brand.index') }}" class="btn  btn-flat btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs"> {{ gp247_language_render('admin.back_list') }}</span></a>
        </div>
      @endif
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main">
        <div class="card-body">

          <div class="form-group row {{ $errors->has('name') ? ' text-red' : '' }}">
            <label for="name" class="col-sm-2 col-form-label">{{ gp247_language_render('admin.brand.name') }}</label>
            <div class="col-sm-10 ">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                </div>
                <input type="text" id="name" name="name" value="{{ old()?old('name'):$brand['name']??'' }}" class="form-control name {{ $errors->has('name') ? ' is-invalid' : '' }}">
              </div>

              @if ($errors->has('name'))
              <span class="text-sm">
                <i class="fa fa-info-circle"></i> {{ $errors->first('name') }}
              </span>
              @endif

            </div>
          </div>

          <div class="form-group row {{ $errors->has('alias') ? ' text-red' : '' }}">
            <label for="alias" class="col-sm-2 col-form-label">{!! gp247_language_render('admin.brand.alias') !!}</label>
            <div class="col-sm-10 ">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                </div>
                <input type="text" id="alias" name="alias" value="{{ old()?old('alias'):$brand['alias']??'' }}" class="form-control alias {{ $errors->has('alias') ? ' is-invalid' : '' }}">
              </div>

              @if ($errors->has('alias'))
              <span class="text-sm">
                <i class="fa fa-info-circle"></i> {{ $errors->first('alias') }}
              </span>
              @endif

            </div>
          </div>

          <div class="form-group row {{ $errors->has('url') ? ' text-red' : '' }}">
            <label for="url" class="col-sm-2 col-form-label">{!! gp247_language_render('admin.brand.url') !!}</label>
            <div class="col-sm-10 ">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                </div>
                <input type="text" id="url" name="url" value="{{ old()?old('url'):$brand['url']??'' }}" class="form-control url {{ $errors->has('url') ? ' is-invalid' : '' }}">
              </div>

              @if ($errors->has('url'))
              <span class="text-sm">
                <i class="fa fa-info-circle"></i> {{ $errors->first('url') }}
              </span>
              @endif

            </div>
          </div>


          <div class="form-group row {{ $errors->has('image') ? ' text-red' : '' }}">
            <label for="image" class="col-sm-2 col-form-label">{!! gp247_language_render('admin.brand.image') !!}</label>
            <div class="col-sm-10 ">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                </div>
                <input type="text" id="image" name="image" value="{!! old()?old('image'):$brand['image']??'' !!}" class="form-control image {{ $errors->has('image') ? ' is-invalid' : '' }}">
                <div class="input-group-append">
                  <span data-input="image" data-preview="preview_image" data-type="brand"
                      class="btn btn-primary lfm"><i class="fa fa-image"></i>  {{gp247_language_render('action.choose_image')}}</span>
                </div>
              </div>
              <div id="preview_image" class="img_holder"><img
                src="{{ gp247_file(old('image',$brand['image']??'images/no-image.jpg')) }}">
              </div>
              @if ($errors->has('image'))
              <span class="text-sm">
                <i class="fa fa-info-circle"></i> {{ $errors->first('image') }}
              </span>
              @endif

            </div>
          </div>

          <div class="form-group row {{ $errors->has('sort') ? ' text-red' : '' }}">
            <label for="sort" class="col-sm-2 col-form-label">{!! gp247_language_render('admin.brand.sort') !!}</label>
            <div class="col-sm-10 ">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                </div>
                <input type="number" id="sort" name="sort" min=0 value="{!! old()?old('sort'):$brand['sort']??0 !!}" class="form-control sort {{ $errors->has('sort') ? ' is-invalid' : '' }}">
              </div>

              @if ($errors->has('sort'))
              <span class="text-sm">
                <i class="fa fa-info-circle"></i> {{ $errors->first('sort') }}
              </span>
              @endif

            </div>
          </div>

          <div class="form-group row {{ $errors->has('status') ? ' text-red' : '' }}">
            <label for="status" class="col-sm-2 col-form-label">{!! gp247_language_render('admin.brand.status') !!}</label>
            <div class="col-sm-10 ">
              <div class="input-group mb-3">
                <input class="checkbox" type="checkbox" id="status" name="status"
                    class="form-control input {{ $errors->has('status') ? ' is-invalid' : '' }}" placeholder="" {!!
                      old('status',(empty($brand['status'])?0:1))?'checked':''!!}/>
              </div>

              @if ($errors->has('status'))
              <span class="text-sm">
                <i class="fa fa-info-circle"></i> {{ $errors->first('status') }}
              </span>
              @endif

            </div>
          </div>

        {{-- Custom fields --}}
        @includeIf('gp247-core::component.render_form_custom_field', ['object' => $brand])
        {{-- //Custom fields --}}


        </div>
        <!-- /.card-body -->
        @csrf
        <div class="card-footer">
          <button type="reset" class="btn btn-warning">{{ gp247_language_render('action.reset') }}</button>
          <button type="submit" class="btn btn-primary float-right">{{ gp247_language_render('action.submit') }}</button>
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
  </div>


  <div class="col-md-7">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-th-list"></i> {!! $title ?? '' !!}</h3>
      </div>

      <div class="card-body p-0">
            <section id="pjax-container" class="table-list">
              <div class="box-body table-responsivep-0" >
                 <table class="table table-hover box-body text-wrap table-bordered">
                    <thead>
                       <tr>
                        @if (!empty($removeList))
                        <th></th>
                        @endif
                        @foreach ($listTh as $key => $th)
                            <th>{!! $th !!}</th>
                        @endforeach
                       </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataTr as $keyRow => $tr)
                            <tr class="{{ (request('id') == $keyRow) ? 'active': '' }}">
                                @if (!empty($removeList))
                                <td>
                                  <input class="checkbox" type="checkbox" class="grid-row-checkbox" data-id="{{ $keyRow }}">
                                </td>
                                @endif
                                @foreach ($tr as $key => $trtd)
                                    <td>{!! $trtd !!}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                 </table>

                 <div class="block-pagination clearfix m-10">
                  <div class="ml-3 float-left">
                    {!! $resultItems??'' !!}
                  </div>
                  <div class="pagination pagination-sm mr-3 float-right">
                    {!! $pagination??'' !!}
                  </div>
                </div>


              </div>
             </section>
    </div>



    </div>
  </div>

</div>
</div>
@endsection


@push('styles')
{!! $css ?? '' !!}
@endpush

@push('scripts')
    {{-- //Pjax --}}
   <script src="{{ gp247_file('GP247/Core/plugin/jquery.pjax.js')}}"></script>

  <script type="text/javascript">

    $('.grid-refresh').click(function(){
      $.pjax.reload({container:'#pjax-container'});
    });

      $(document).on('submit', '#button_search', function(event) {
        $.pjax.submit(event, '#pjax-container')
      })

    $(document).on('pjax:send', function() {
      $('#loading').show()
    })
    $(document).on('pjax:complete', function() {
      $('#loading').hide()
    })

    // tag a
    $(function(){
     $(document).pjax('a.page-link', '#pjax-container')
    })


    $(document).ready(function(){
    // does current browser support PJAX
      if ($.support.pjax) {
        $.pjax.defaults.timeout = 2000; // time in milliseconds
      }
    });


  </script>
    {{-- //End pjax --}}


<script type="text/javascript">
{{-- sweetalert2 --}}
var selectedRows = function () {
    var selected = [];
    $('.grid-row-checkbox:checked').each(function(){
        selected.push($(this).data('id'));
    });

    return selected;
}

$('.grid-trash').on('click', function() {
  var ids = selectedRows().join();
  deleteItem(ids);
});

  function deleteItem(ids){
  Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: true,
  }).fire({
    title: '{{ gp247_language_render('action.delete_confirm') }}',
    text: "",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: '{{ gp247_language_render('action.confirm_yes') }}',
    confirmButtonColor: "#DD6B55",
    cancelButtonText: '{{ gp247_language_render('action.confirm_no') }}',
    reverseButtons: true,

    preConfirm: function() {
        return new Promise(function(resolve) {
            $.ajax({
                method: 'post',
                url: '{{ $urlDeleteItem ?? '' }}',
                data: {
                  ids:ids,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                    if(data.error == 1){
                      alertMsg('error', data.msg, '{{ gp247_language_render('action.warning') }}');
                      $.pjax.reload('#pjax-container');
                      return;
                    }else{
                      alertMsg('success', data.msg);
                      window.location.replace('{{ gp247_route_admin('admin_brand.index') }}');
                    }

                }
            });
        });
    }

  }).then((result) => {
    if (result.value) {
      alertMsg('success', '{{ gp247_language_render('action.delete_confirm_deleted_msg') }}', '{{ gp247_language_render('action.delete_confirm_deleted') }}');
    } else if (
      // Read more about handling dismissals
      result.dismiss === Swal.DismissReason.cancel
    ) {
      // swalWithBootstrapButtons.fire(
      //   'Cancelled',
      //   'Your imaginary file is safe :)',
      //   'error'
      // )
    }
  })
}
{{--/ sweetalert2 --}}


</script>

{!! $js ?? '' !!}
@endpush
