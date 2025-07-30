@extends('gp247-core::layout')

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header with-border">
                <h2 class="card-title">{{ $title_description??'' }}</h2>

                <div class="card-tools">
                    <div class="btn-group float-right mr-5">
                        <a href="{{ gp247_route_admin('admin_category.index') }}" class="btn  btn-flat btn-default" title="List"><i
                                class="fa fa-list"></i><span class="hidden-xs"> {{ gp247_language_render('admin.back_list') }}</span></a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main"
                enctype="multipart/form-data">


                <div class="card-body">
                    @php
                    $descriptions = $category?$category->descriptions->keyBy('lang')->toArray():[];
                    @endphp

                    @foreach ($languages as $code => $language)
                    
                    <div class="card">
                        <div class="card-header with-border">
                            <h3 class="card-title">{{ $language->name }} {!! gp247_image_render($language->icon,'20px','20px', $language->name) !!}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                </div>
                        </div>
                
                        <div class="card-body">

                        <div class="form-group row  {{ $errors->has('descriptions.'.$code.'.title') ? ' text-red' : '' }}">
                            <label for="{{ $code }}__title"
                                class="col-sm-2 col-form-label">{{ gp247_language_render('admin.category.title') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" id="{{ $code }}__title" name="descriptions[{{ $code }}][title]"
                                        value="{{ old()? old('descriptions.'.$code.'.title'):($descriptions[$code]['title']??'') }}"
                                        class="form-control {{ $code.'__title' }}" placeholder="" />
                                </div>
                                @if ($errors->has('descriptions.'.$code.'.title'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('descriptions.'.$code.'.title') }}
                                </span>
                                @else
                                    <span class="form-text">
                                        <i class="fa fa-info-circle"></i> {{ gp247_language_render('admin.max_c',['max'=>200]) }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div
                            class="form-group row  {{ $errors->has('descriptions.'.$code.'.keyword') ? ' text-red' : '' }}">
                            <label for="{{ $code }}__keyword"
                                class="col-sm-2 col-form-label">{{ gp247_language_render('admin.category.keyword') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" id="{{ $code }}__keyword"
                                        name="descriptions[{{ $code }}][keyword]"
                                        value="{{ old()?old('descriptions.'.$code.'.keyword'):($descriptions[$code]['keyword']??'') }}"
                                        class="form-control {{ $code.'__keyword' }}" placeholder="" />
                                </div>
                                @if ($errors->has('descriptions.'.$code.'.keyword'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('descriptions.'.$code.'.keyword') }}
                                </span>
                                @else
                                    <span class="form-text">
                                        <i class="fa fa-info-circle"></i> {{ gp247_language_render('admin.max_c',['max'=>200]) }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div
                            class="form-group row  {{ $errors->has('descriptions.'.$code.'.description') ? ' text-red' : '' }}">
                            <label for="{{ $code }}__description"
                                class="col-sm-2 col-form-label">{{ gp247_language_render('admin.category.description') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                    <textarea type="text" id="{{ $code }}__description" 
                                        name="descriptions[{{ $code }}][description]"
                                        class="form-control {{ $code.'__description' }}" placeholder="" />{{  old()?old('descriptions.'.$code.'.description'):($descriptions[$code]['description']??'')  }}</textarea>
                                @if ($errors->has('descriptions.'.$code.'.description'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('descriptions.'.$code.'.description') }}
                                </span>
                                @else
                                    <span class="form-text">
                                        <i class="fa fa-info-circle"></i> {{ gp247_language_render('admin.max_c',['max'=>300]) }}
                                     </span>
                                @endif
                            </div>
                        </div>
                         <hr>
                        <h5 class="text-primary">Category Image</h5>
                        @for ($i = 1; $i <= 2; $i++)
                        <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category {{ $i }} Image</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="images[{{ $i }}][image]"   class="form-control-file">
                                         <input type="hidden" name="images[{{ $i }}][imageold]" value="{{ ($descriptions[$code]["cat_{$i}_image"] ?? '') }}" class="form-control-file">
                                         
                                        @if (!empty($descriptions[$code]["cat_{$i}_image"]))
                                            <p class="mt-2">Current: <img src="{{ asset($descriptions[$code]["cat_{$i}_image"]) }}" alt="Cat Image {{ $i }}" height="60"></p>
                                        @endif
                                    </div>
                                </div>
                                 @endfor
                                
                                
                                <hr>
                                                       
                                <h5 class="text-primary">Category usp</h5>
                                
                                @for ($i = 1; $i <= 4; $i++)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">USP {{ $i }} Name</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                            name="usps[{{ $i }}][name]"
                                            value="{{ old("descriptions.$code.usp_{$i}_name", ($descriptions[$code]["usp_{$i}_name"] ?? '')) }}"
                                            class="form-control" placeholder="USP {{ $i }} name">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">USP {{ $i }} Content</label>
                                    <div class="col-sm-8">
                                        <textarea name="usps[{{ $i }}][content]" class="form-control"
                                            placeholder="USP {{ $i }} content">{{ old("descriptions.$code.usp_{$i}_content", ($descriptions[$code]["usp_{$i}_content"] ?? '')) }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">USP {{ $i }} Image</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="usps[{{ $i }}][image]"   class="form-control-file">
                                         <input type="hidden" name="usps[{{ $i }}][imageold]" value="{{ ($descriptions[$code]["usp_{$i}_image"] ?? '') }}" class="form-control-file">
                                         
                                        @if (!empty($descriptions[$code]["usp_{$i}_image"]))
                                            <p class="mt-2">Current: <img src="{{ asset($descriptions[$code]["usp_{$i}_image"]) }}" alt="USP Image {{ $i }}" height="60"></p>
                                        @endif
                                    </div>
                                </div>

                                @endfor
                                
                                
                                <hr>
                        
                        
                                @php
                            $faqItems = $descriptions[$code]['faq'] ?? []; // fallback to empty array if not set
                            if (is_string($faqItems)) {
                                $faqItems = json_decode($faqItems, true);
                            }
                        @endphp
                        
                        
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">FAQs</label>
                            <div class="col-sm-8 faq-items-list">
                                @foreach ($faqItems as $index => $faq)
                                    <div class="faq-entry input-group mb-2">
                                        <input type="text" name="descriptions[{{ $code }}][faq][{{ $index }}][question]" class="form-control mr-1" placeholder="Question" value="{{ $faq['question'] ?? '' }}">
                                        <input type="text" name="descriptions[{{ $code }}][faq][{{ $index }}][answer]" class="form-control mr-1" placeholder="Answer" value="{{ $faq['answer'] ?? '' }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger btn-remove-faq">×</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-sm-8 offset-sm-2 mt-2">
                                <button type="button" class="btn btn-sm btn-primary btn-add-faq">Add FAQ</button>
                            </div>
                        </div>
                        
                        
                            </div>
                        </div>
                        @endforeach

                        <div class="form-group row {{ $errors->has('parent') ? ' text-red' : '' }}">
                            <label for="parent"
                                class="col-sm-2 col-form-label">{{ gp247_language_render('admin.category.select_category') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control parent select2" style="width: 100%;" name="parent">
                                    <option value=""></option>
                                    @php
                                    $categories = [0=>'==ROOT==']+ $categories;
                                    @endphp
                                    @foreach ($categories as $k => $v)
                                    <option value="{{ $k }}"
                                    {{ (old('parent', $category['parent']??'') ==$k) ? 'selected':'' }}>{{ $v }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('parent'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('parent') }}
                                </span>
                                @endif
                            </div>
                        </div>



@if (gp247_store_check_multi_store_installed())
                        {{-- select shop_store --}}
                        @php
                        $listStore = [];
                        if (function_exists('gp247_get_list_store_of_category_detail')) {
                                $oldData = gp247_get_list_store_of_category_detail($category['id'] ?? '');
                            } else {
                                $oldData = null;
                            }
                        $shop_store = old('shop_store', $oldData);

                        if(is_array($shop_store)){
                            foreach($shop_store as $value){
                                $listStore[] = $value;
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
                                    @foreach (gp247_store_get_list_code() as $k => $v)
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


                        <div class="form-group row  {{ $errors->has('alias') ? ' text-red' : '' }}">
                            <label for="alias" class="col-sm-2 col-form-label">{!! gp247_language_render('admin.category.alias') !!}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" id="alias" name="alias"
                                        value="{{ old('alias',($category['alias']??'')) }}" class="form-control"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('alias'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('alias') }}
                                </span>
                                @endif
                            </div>
                        </div>                        

                        <div  class="form-group row  {{ $errors->has('image') ? ' text-red' : '' }} d-none">
                            <label for="image" class="col-sm-2 col-form-label">{{ gp247_language_render('admin.category.image') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="image" name="image"
                                        value="{{ old('image',$category['image']??'') }}"
                                        class="form-control input image" placeholder="" />
                                    <div class="input-group-append">
                                        <a data-input="image" data-preview="preview_image" data-type="category"
                                            class="btn btn-primary lfm">
                                            <i class="fa fa-image"></i> {{gp247_language_render('action.choose_image')}}
                                        </a>
                                    </div>
                                </div>
                                @if ($errors->has('image'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('image') }}
                                </span>
                                @endif
                                <div id="preview_image" class="img_holder">
                                    @if (old('image',$category['image']??''))
                                    <img src="{{ gp247_file(old('image',$category['image']??'')) }}">
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="form-group row  {{ $errors->has('sort') ? ' text-red' : '' }}">
                            <label for="sort" class="col-sm-2 col-form-label">{{ gp247_language_render('admin.category.sort') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="number" style="width: 100px;" id="sort" name="sort"
                                        value="{!! old()?old('sort'):$category['sort']??0 !!}" class="form-control sort"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('sort'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('sort') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group  row">
                            <label for="top" class="col-sm-2 col-form-label">{{ gp247_language_render('admin.category.top') }}</label>
                            <div class="col-sm-8">
                                <input class="checkbox" type="checkbox" name="top"
                                    {{ old('top',(empty($category['top'])?0:1))?'checked':''}}>
                            </div>
                            <span class="form-text">
                                <i class="fa fa-info-circle"></i> {{ gp247_language_render('admin.category.top_help') }}
                            </span>
                        </div>

                        <div class="form-group  row">
                            <label for="status" class="col-sm-2 col-form-label">{{ gp247_language_render('admin.category.status') }}</label>
                            <div class="col-sm-8">
                                <input class="checkbox" type="checkbox" name="status"
                                    {{ old('status',(empty($category['status'])?0:1))?'checked':''}}>

                            </div>
                        </div>

                        {{-- Custom fields --}}
                        @includeIf('gp247-core::component.render_form_custom_field', ['object' => $category])
                        {{-- //Custom fields --}}

                </div>



                <!-- /.card-body -->

                <div class="card-footer row" id="card-footer">
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

@endpush

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-add-faq').forEach(btn => {
        btn.addEventListener('click', function () {
            const container = btn.closest('.form-group').querySelector('.faq-items-list');
            const index = container.children.length;
            const lang = btn.closest('.form-group').querySelector('input')?.name?.match(/\[([a-z]{2})\]/)?.[1] || 'en';

            const html = `
                <div class="faq-entry input-group mb-2">
                    <input type="text" name="descriptions[${lang}][faq][${index}][question]" class="form-control mr-1" placeholder="Question">
                    <input type="text" name="descriptions[${lang}][faq][${index}][answer]" class="form-control mr-1" placeholder="Answer">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger btn-remove-faq">×</button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        });
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-remove-faq')) {
            e.target.closest('.faq-entry').remove();
        }
    });
});
</script>
@endpush