@extends('gp247-core::layout')

@section('main')
<div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header with-border">
                  <h2 class="card-title">{{ $title_description??'' }}</h2>
  
                  <div class="card-tools">
                      <div class="btn-group float-right mr-5">
                          <a href="{{ gp247_route_admin('admin_news_discount.index') }}" class="btn  btn-flat btn-default" title="List"><i
                                  class="fa fa-list"></i><span class="hidden-xs"> {{gp247_language_render('admin.back_list')}}</span></a>
                      </div>
                  </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main"
                  enctype="multipart/form-data">
  
                  <div class="card-body">
                        <div class="fields-group">


                    <div class="card-body">
                        <div class="fields-group">

                            <div class="form-group  row {{ $errors->has('code') ? ' invalid' : '' }}">
                                <label for="code" class="col-sm-2  control-label">{{ gp247_language_render($appPath.'::lang.code') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clipboard-list"></i></span>
                                        </div>
                                        <input type="text" id="code" name="code" value="{{ old('code', ($discount['code']??'')) }}" class="form-control" placeholder="" />
                                    </div>
                                        @if ($errors->has('code'))
                                            <span class="help-block">
                                                <i class="fa fa-info-circle"></i>  {{ $errors->first('code') }}
                                            </span>
                                        @else
                                            
                                                <i class="fa fa-info-circle"></i>  {{ gp247_language_render($appPath.'::lang.admin.code_helper') }}
                                      
                                        @endif
                                </div>
                            </div>

                            <div class="form-group  row {{ $errors->has('reward') ? ' invalid' : '' }}">
                                <label for="reward" class="col-sm-2  control-label">{{ gp247_language_render($appPath.'::lang.reward') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-file-alt"></i></span>
                                        </div>
                                        <input type="text" id="reward" name="reward" value="{{ old('reward', ($discount['reward']??'')) }}" class="form-control" placeholder="" />
                                    </div>
                                        @if ($errors->has('reward'))
                                            <span class="help-block">
                                                {{ $errors->first('reward') }}
                                            </span>
                                        @endif
                                </div>
                            </div>


                            <div class="form-group  row {{ $errors->has('type') ? ' invalid' : '' }}">
                                <label for="type" class="col-sm-2  control-label">{{ gp247_language_render($appPath.'::lang.type') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <label class="radio-inline"><input type="radio" name="type" value="point" {{ (old('type',$discount['type']??'') == 'point')?'checked':'' }}> Point</label>
                                        &nbsp; 
                                    <label class="radio-inline"><input type="radio" name="type" value="percent" {{ (old('type',$discount['type']??'') == 'percent')?'checked':'' }}> Percent (%)</label>
                                    </div>
                                        @if ($errors->has('type'))
                                            <span class="help-block">
                                                {{ $errors->first('type') }}
                                            </span>
                                        @endif
                                </div>
                            </div>


                            <div class="form-group  row {{ $errors->has('data') ? ' invalid' : '' }}">
                                <label for="data" class="col-sm-2  control-label">{{ gp247_language_render($appPath.'::lang.data') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <input type="text" id="data" name="data" value="{{ old('data', ($discount['data']??'')) }}" class="form-control" placeholder="" />
                                    </div>
                                        @if ($errors->has('data'))
                                            <span class="help-block">
                                                {{ $errors->first('data') }}
                                            </span>
                                        @endif
                                </div>
                            </div>



                            <div class="form-group  row {{ $errors->has('limit') ? ' invalid' : '' }}">
                                <label for="limit" class="col-sm-2  control-label">{{ gp247_language_render($appPath.'::lang.limit') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <input type="number" id="limit" name="limit" value="{{ old('limit', ($discount['limit']??'1')) }}" class="form-control" placeholder="" />
                                    </div>
                                        @if ($errors->has('limit'))
                                            <span class="help-block">
                                                {{ $errors->first('limit') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group  row {{ $errors->has('login') ? ' invalid' : '' }}">
                                <label for="login" class="col-sm-2  control-label">{{ gp247_language_render($appPath.'::lang.login') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="checkbox" class="checkbox" id="login" name="login" {{ old('login',(empty($discount['login'])?0:1))?'checked':''}}  placeholder="" class="check-form" />
                                    </div>
                                        @if ($errors->has('login'))
                                            <span class="help-block">
                                                {{ $errors->first('login') }}
                                            </span>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group  row {{ $errors->has('expires_at') ? ' invalid' : '' }}">
                                <label for="expires_at" class="col-sm-2  control-label">{{ gp247_language_render($appPath.'::lang.expires_at') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar fa-fw"></i></span>
                                        </div>
                                        <input type="text" id="expires_at" name="expires_at" value="{{ old('expires_at', ($discount['expires_at']??'')) }}" class="form-control date_time"  placeholder="yyyy-mm-dd" />
                                    </div>
                                        @if ($errors->has('expires_at'))
                                            <span class="help-block">
                                                {{ $errors->first('expires_at') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

@if (gp247_store_check_multi_partner_installed() ||  gp247_store_check_multi_store_installed())
                            {{-- select shop_store --}}
                            @php
                            $listStore = [];
                            if (function_exists('gp247_store_get_list_store_of_discount_detail')) {
                                $oldData = gp247_store_get_list_store_of_discount_detail($discount['id'] ?? '');
                            } else {
                                $oldData = null;
                            }
                            $shop_store = old('shop_store', $oldData);

                            if(is_array($shop_store)){
                                foreach($shop_store as $value){
                                    $listStore[] = (int)$value;
                                }
                            }
                            @endphp
    
                            <div class="form-group row {{ $errors->has('shop_store') ? ' text-red' : '' }}">
                                <label for="shop_store"
                                    class="col-sm-2 col-form-label">{{ gp247_language_render('admin.select_store') }}</label>
                                <div class="col-sm-8">
                                    <select class="form-control shop_store select2" multiple="multiple"
                                        data-placeholder="{{ gp247_language_render('admin.select_store') }}" style="width: 100%;"
                                        name="shop_store[]">
                                        <option value=""></option>
                                        @foreach (gp247_store_get_list_code_store() as $k => $v)
                                        <option value="{{ $k }}"
                                            {{ (count($listStore) && in_array($k, $listStore))?'selected':'' }}>{{ $v }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('shop_store'))
                                    <span class="form-text">
                                        <i class="fa fa-info-circle"></i> {{ $errors->first('shop_store') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- //select shop_store --}}
@endif


                            <div class="form-group row ">
                                <label for="status" class="col-sm-2 control-label">{{ gp247_language_render($appPath.'::lang.status') }}</label>
                                <div class="col-sm-8">
                                   <input class="checkbox" type="checkbox" name="status"  {{ old('status',(empty($discount['status'])?0:1))?'checked':''}}>
                                </div>
                            </div>

                        </div>
                    </div>

                  <!-- /.card-body -->
  
                  <div class="card-footer row">
                      @csrf
                      <div class="col-md-2">
                      </div>
  
                      <div class="col-md-8">
                          <div class="btn-group float-right">
                              <button type="submit" class="btn btn-primary">{{ gp247_language_render('action.submit') }}</button>
                          </div>
  
                          <div class="btn-group float-left">
                              <button type="reset" class="btn btn-warning">{{ gp247_language_render('action.reset') }}</button>
                          </div>
                      </div>
                  </div>
  
                  <!-- /.card-footer -->
              </form>
          </div>
      </div>
  </div>
@endsection

@push('styles')
      {{-- style css --}}
@endpush

@push('scripts')
      {{-- script --}}
@endpush
