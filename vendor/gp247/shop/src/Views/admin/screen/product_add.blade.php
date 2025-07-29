@extends('gp247-core::layout')

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header with-border">
                <h2 class="card-title">{{ $title_description??'' }}</h2>
                <div class="card-tools">
                    <div class="btn-group float-right mr-5">
                        <a target=_new href="{{ gp247_route_admin('admin_product.index') }}" class="btn  btn-flat btn-default" title="List">
                            <i class="fa fa-list"></i><span class="hidden-xs"> {{ gp247_language_render('admin.back_list') }}</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->


            <!-- form start -->
            <form action="{{ gp247_route_admin('admin_product.create') }}" method="post" name="form_name" accept-charset="UTF-8" 
                class="form-horizontal" id="form-main" enctype="multipart/form-data">
                <input type="hidden" name="kind" value="{{ $product_kind }}">

                @if (gp247_config_admin('product_kind'))
                    <div id="start-add" class="d-flex d-flex justify-content-center mb-3 kind-{{ $product_kind }}">
                        <div style="width: 300px;text-align: center; z-index:999">
                            <b>{{ gp247_language_render('product.kind') }}:</b> {{ $kinds[$product_kind]??'' }}
                        </div>
                    </div>    
                @endif

                <div id="main-add" class="card-body">
                        {{-- descriptions --}}
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
                                <div
                                    class="form-group row {{ $errors->has('descriptions.'.$code.'.name') ? ' text-red' : '' }}">
                                    <label for="{{ $code }}__name"
                                        class="col-sm-2 col-form-label">{{ gp247_language_render('product.name') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                            </div>
                                            <input type="text" id="{{ $code }}__name" name="descriptions[{{ $code }}][name]"
                                                value="{{ old('descriptions.'.$code.'.name') }}"
                                                class="form-control input-sm {{ $code.'__name' }}" placeholder="" />
                                        </div>
                                        @if ($errors->has('descriptions.'.$code.'.name'))
                                        <span class="form-text">
                                            <i class="fa fa-info-circle"></i>
                                            {{ $errors->first('descriptions.'.$code.'.name') }}
                                        </span>
                                        @else
                                            <span class="form-text">
                                                <i class="fa fa-info-circle"></i> {{ gp247_language_render('admin.max_c',['max'=>200]) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div
                                    class="form-group row   {{ $errors->has('descriptions.'.$code.'.keyword') ? ' text-red' : '' }}">
                                    <label for="{{ $code }}__keyword"
                                        class="col-sm-2 col-form-label">{{ gp247_language_render('product.keyword') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                            </div>
                                            <input type="text" id="{{ $code }}__keyword"
                                                name="descriptions[{{ $code }}][keyword]"
                                                value="{{ old('descriptions.'.$code.'.keyword') }}"
                                                class="form-control input-sm {{ $code.'__keyword' }}" placeholder="" />
                                        </div>
                                        @if ($errors->has('descriptions.'.$code.'.keyword'))
                                        <span class="form-text">
                                            <i class="fa fa-info-circle"></i>
                                            {{ $errors->first('descriptions.'.$code.'.keyword') }}
                                        </span>
                                        @else
                                            <span class="form-text">
                                                <i class="fa fa-info-circle"></i> {{ gp247_language_render('admin.max_c',['max'=>200]) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div
                                    class="form-group row {{ $errors->has('descriptions.'.$code.'.description') ? ' text-red' : '' }}">
                                    <label for="{{ $code }}__description"
                                        class="col-sm-2 col-form-label">{{ gp247_language_render('product.description') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                                    <div class="col-sm-8">
                                            <textarea id="{{ $code }}__description"
                                                name="descriptions[{{ $code }}][description]"
                                                class="form-control input-sm {{ $code.'__description' }}" placeholder="" />{{ old('descriptions.'.$code.'.description') }}</textarea>
                                        @if ($errors->has('descriptions.'.$code.'.description'))
                                        <span class="form-text">
                                            <i class="fa fa-info-circle"></i>
                                            {{ $errors->first('descriptions.'.$code.'.description') }}
                                        </span>
                                        @else
                                            <span class="form-text">
                                                <i class="fa fa-info-circle"></i> {{ gp247_language_render('admin.max_c',['max'=>300]) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                @if ($product_kind == GP247_PRODUCT_SINGLE || $product_kind == GP247_PRODUCT_BUILD)
                                <!--<div class="form-group row kind  {{ $errors->has('descriptions.'.$code.'.content') ? ' text-red' : '' }}">-->
                                <!--    <label for="{{ $code }}__content" class="col-sm-2 col-form-label">-->
                                <!--        {{ gp247_language_render('product.content') }}-->
                                <!--    </label>-->
                                <!--    <div class="col-sm-8">-->
                                <!--        <textarea id="{{ $code }}__content" class="editor"-->
                                <!--            name="descriptions[{{ $code }}][content]">-->
                                <!--                {!! old('descriptions.'.$code.'.content') !!}-->
                                <!--            </textarea>-->
                                <!--        @if ($errors->has('descriptions.'.$code.'.content'))-->
                                <!--        <span class="form-text">-->
                                <!--            <i class="fa fa-info-circle"></i>-->
                                <!--            {{ $errors->first('descriptions.'.$code.'.content') }}-->
                                <!--        </span>-->
                                <!--        @endif-->
                                <!--    </div>-->
                                <!--</div>-->
                                @endif
                                
                                <hr>
<h5 class="mb-3 text-primary">Product usp section</h5>

@for ($i = 0; $i < 4; $i++)
<div class="usp-block border p-3 mb-3 rounded bg-light">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">USP #{{ $i + 1 }} Name</label>
        <div class="col-sm-8">
            <input type="text" name="usps[{{ $i }}][name]" value="{{ old('usps.'.$i.'.name') }}"
                   class="form-control" placeholder="Enter USP title">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">USP #{{ $i + 1 }} Image</label>
        <div class="col-sm-8">
            <input type="file" name="usps[{{ $i }}][image]" class="form-control-file">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">USP #{{ $i + 1 }} Content</label>
        <div class="col-sm-8">
            <textarea name="usps[{{ $i }}][content]" rows="2" class="form-control"
                      placeholder="Enter USP description">{{ old('usps.'.$i.'.content') }}</textarea>
        </div>
    </div>
</div>
@endfor

<hr>
<h5 class="text-primary">What You Got </h5>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Heading</label>
    <div class="col-sm-8">
        <input type="text" name="descriptions[{{ $code }}][what_heading]" value="{{ old("descriptions.$code.what_heading", $descriptions[$code]['what_heading'] ?? '') }}" class="form-control">
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Subheading</label>
    <div class="col-sm-8">
        <input type="text" name="descriptions[{{ $code }}][what_subheading]" value="{{ old("descriptions.$code.what_subheading", $descriptions[$code]['what_subheading'] ?? '') }}" class="form-control">
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Image</label>
    <div class="col-sm-8">
        <input type="file" name="descriptions[{{ $code }}][what_image]" class="form-control-file">
        <input type="hidden" name="descriptions[{{ $code }}][what_imageold]" value="{{ $descriptions[$code]['what_image'] ?? '' }}">
        @if (!empty($descriptions[$code]['what_image']))
            <img src="{{ asset($descriptions[$code]['what_image']) }}" alt="" height="60">
        @endif
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">List Items</label>
    <div class="col-sm-8">
        <div class="what-items-list">
            @php
                $items = old("descriptions.$code.what_items", $descriptions[$code]['what_items'] ?? []);
                if (is_string($items)) $items = json_decode($items, true);
            @endphp

            @foreach ($items as $index => $item)
                <div class="input-group mb-2">
                    <input type="text" name="descriptions[{{ $code }}][what_items][]" class="form-control" value="{{ $item }}" placeholder="Item text">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger btn-remove-item">×</button>
                    </div>
                </div>
            @endforeach

            <div class="input-group mb-2">
                <input type="text" name="descriptions[{{ $code }}][what_items][]" class="form-control" placeholder="New item">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger btn-remove-item">×</button>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-sm btn-primary mt-2 btn-add-item">Add New Item</button>
    </div>
</div>
                           <hr>
<h5 class="mb-3 text-primary">Frustrated with Product Issues?</h5>

@for ($i = 0; $i < 4; $i++)
<div class="usp-block border p-3 mb-3 rounded bg-light">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Frustrated #{{ $i + 1 }} Name</label>
        <div class="col-sm-8">
            <input type="text" name="frus[{{ $i }}][name]" value="{{ old('frus.'.$i.'.name') }}"
                   class="form-control" placeholder="Enter Frustrated title">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Frustrated #{{ $i + 1 }} Image</label>
        <div class="col-sm-8">
            <input type="file" name="frus[{{ $i }}][image]" class="form-control-file">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Frustrated #{{ $i + 1 }} Content</label>
        <div class="col-sm-8">
            <textarea name="frus[{{ $i }}][content]" rows="2" class="form-control"
                      placeholder="Enter Frustrated description">{{ old('frus.'.$i.'.content') }}</textarea>
        </div>
    </div>
</div>
@endfor

<hr>

<!--faq-->

@php
    $faqItems = old("descriptions.$code.faq", []);
    if (is_string($faqItems)) $faqItems = json_decode($faqItems, true);
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
                        
                        
                        
                        {{-- //descriptions --}}


                        {{-- select category --}}
                        <div class="form-group row kind  {{ $errors->has('category') ? ' text-red' : '' }}">
                            @php
                            $listCate = [];
                            if (is_array(old('category'))) {
                                foreach(old('category') as $value){
                                    $listCate[] = $value;
                                }
                            }
                            @endphp
                            <label for="category" class="col-sm-2 col-form-label">
                                {{ gp247_language_render('admin.product.select_category') }}
                            </label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                <select class="form-control input-sm category select2" multiple="multiple"
                                    data-placeholder="{{ gp247_language_render('admin.product.select_category') }}"
                                    name="category[]">
                                    <option value=""></option>
                                    @foreach ($categories as $k => $v)
                                    <option value="{{ $k }}"
                                        {{ (count($listCate) && in_array($k, $listCate))?'selected':'' }}>{{ $v }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <a target=_new href="{{ gp247_route_admin('admin_category.index') }}" class="btn  btn-flat" title="New">
                                        <i class="fa fa-plus" title="{{ gp247_language_render('action.add') }}"></i>
                                     </a>
                                </div>
                                </div>
                                @if ($errors->has('category'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('category') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //select category --}}


@if (gp247_store_check_multi_partner_installed() ||  gp247_store_check_multi_store_installed())
                            {{-- select shop_store --}}
                            <div class="form-group row kind  {{ $errors->has('shop_store') ? ' text-red' : '' }}">
                                @php
                                $listStore = [];
                                if (is_array(old('shop_store'))) {
                                    foreach(old('shop_store') as $value){
                                        $listStore[] = $value;
                                    }
                                }
                                @endphp
                                <label for="shop_store" class="col-sm-2 col-form-label">
                                    {{ gp247_language_render('admin.select_store') }}
                                </label>
                                <div class="col-sm-8">
                                    <select class="form-control shop_store select2" 
                                    @if (gp247_store_check_multi_store_installed())
                                        multiple="multiple"
                                    @endif
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



                        {{-- images --}}
                        <div class="form-group row kind  {{ $errors->has('image') ? ' text-red' : '' }}">
                            <label for="image" class="col-sm-2 col-form-label">
                                {{ gp247_language_render('product.image') }}
                            </label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="image" name="image" value="{!! old('image') !!}"
                                        class="form-control input-sm image" placeholder="" />
                                    <div class="input-group-append">
                                        <span class="btn btn-primary lfm" data-input="image" data-preview="preview_image" data-type="product">
                                            <i class="fas fa-image"></i> {{gp247_language_render('action.choose_image')}}
                                        </span>
                                    </div>
                                </div>
                                @if ($errors->has('image'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('image') }}
                                </span>
                                @endif
                                <div id="preview_image" class="img_holder">
                                    @if (old('image'))
                                        <img src="{{ gp247_file(old('image')) }}">
                                    @endif
                                    
                                </div>

                                @if (!empty(old('sub_image')))
                                @foreach (old('sub_image') as $key => $sub_image)
                                @if ($sub_image)
                                <div class="group-image">
                                    <div class="input-group"><input type="text" id="sub_image_{{ $key }}"
                                            name="sub_image[]" value="{!! $sub_image !!}"
                                            class="form-control input-sm sub_image" placeholder="" /><span
                                            class="input-group-btn"><span><a data-input="sub_image_{{ $key }}"
                                                    data-preview="preview_sub_image_{{ $key }}" data-type="product"
                                                    class="btn btn-flat btn-primary lfm"><i
                                                        class="fa fa-image"></i>
                                                    {{gp247_language_render('action.choose_image')}}</a></span><span
                                                title="Remove" class="btn btn-flat btn-danger removeImage"><i
                                                    class="fa fa-times"></i></span></span></div>
                                    <div id="preview_sub_image_{{ $key }}" class="img_holder"><img
                                            src="{{ gp247_file($sub_image) }}"></div>
                                </div>

                                @endif
                                @endforeach
                                @endif

                                <button type="button" id="add_sub_image" class="btn btn-flat btn-success">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{ gp247_language_render('admin.product.add_sub_image') }}
                                </button>
                            </div>
                        </div>
                        {{-- //images --}}

                        {{-- sku --}}
                        <div class="form-group row kind  {{ $errors->has('sku') ? ' text-red' : '' }}">
                            <label for="sku" class="col-sm-2 col-form-label">{{ gp247_language_render('product.sku') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" style="width: 100px;" id="sku" name="sku"
                                        value="{!! old('sku')??'' !!}" class="form-control input-sm sku"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('sku'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('sku') }}
                                </span>
                                @else
                                <span class="form-text">
                                    {{ gp247_language_render('product.sku_validate') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //sku --}}


                        {{-- alias --}}
                        <div class="form-group row kind  {{ $errors->has('alias') ? ' text-red' : '' }}">
                            <label for="alias" class="col-sm-2 col-form-label">{!! gp247_language_render('product.alias') !!}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text"  id="alias" name="alias"
                                        value="{!! old('alias')??'' !!}" class="form-control input-sm alias"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('alias'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('alias') }}
                                </span>
                                @else
                                <span class="form-text">
                                    {{ gp247_language_render('product.alias_validate') }}
                                </span>
                                @endif
                            </div>
                        </div>
                     
@if (gp247_config_admin('product_price') && ($product_kind == GP247_PRODUCT_SINGLE || $product_kind == GP247_PRODUCT_BUILD))
                        {{-- price --}}
                        <div class="form-group row kind   {{ $errors->has('price') ? ' text-red' : '' }}">
                            <label for="price" class="col-sm-2 col-form-label">{{ gp247_language_render('product.price') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="number" step="0.01" min="0" style="width: 100px;" id="price" name="price"
                                        value="{!! old('price')??0 !!}" class="form-control input-sm price"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('price'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('price') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //price --}}
@endif



                        {{-- sort --}}
                        <div class="form-group row   {{ $errors->has('sort') ? ' text-red' : '' }}">
                            <label for="sort" class="col-sm-2 col-form-label">{{ gp247_language_render('admin.product.sort') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="number" min="0" style="width: 100px;" id="sort" name="sort"
                                        value="{!! old('sort')??0 !!}" class="form-control input-sm sort"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('sort'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('sort') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //sort --}}


                        {{-- status --}}
                        <div class="form-group row ">
                            <label for="status" class="col-sm-2 col-form-label">{{ gp247_language_render('product.status') }}</label>
                            <div class="col-sm-8">
                                @if (old())
                                <input class="checkbox" type="checkbox" name="status" {{ ((old('status') ==='on')?'checked':'')}}>
                                @else
                                <input class="checkbox" type="checkbox" name="status" checked>
                                @endif

                            </div>
                        </div>
                        {{-- //status --}}

                        {{-- approve --}}
                        <div class="form-group row ">
                            <label for="approve" class="col-sm-2 col-form-label">{{ gp247_language_render('product.approve') }}</label>
                            <div class="col-sm-8">
                                @if (old())
                                <input class="checkbox" type="checkbox" name="approve" {{ ((old('approve') ==='on')?'checked':'')}}>
                                @else
                                <input class="checkbox" type="checkbox" name="approve" checked>
                                @endif
                            </div>
                        </div>
                        {{-- //approve --}}

@if (gp247_config_admin('product_attribute') && ($product_kind == GP247_PRODUCT_SINGLE))
                        {{-- List product attributes --}}

                        @if (!empty($attributeGroup))

                        @php
                        $dataAtt = old('attribute');
                        @endphp


                        <hr class="kind ">
                        <div class="form-group kind  row">
                            <div class="col-sm-2">
                                <label>{{ gp247_language_render('product.attribute') }} (<a target=_new href="{{ gp247_route_admin('admin_attribute_group.index') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>)</label>
                            </div>
                            <div class="col-sm-8">
                                @foreach ($attributeGroup as $attGroupId => $attName)
                                <table width="100%">
                                    <tr>
                                        <td colspan="3"><p><b>{{ $attName }}:</b></p></td>
                                    </tr>
                                    <tr>
                                        <td>{{ gp247_language_render('admin.product.add_attribute_place') }}</td>
                                        <td>{{ gp247_language_render('admin.product.add_price_place') }}</td>
                                    </tr>
                                @if (!empty($dataAtt[$attGroupId]['name']))
                                    @foreach ($dataAtt[$attGroupId]['name'] as $key => $attValue)
                                        @php
                                        $newHtml = str_replace('attribute_group', $attGroupId, $htmlProductAtrribute);
                                        $newHtml = str_replace('attribute_value', $attValue, $newHtml);
                                        $newHtml = str_replace('add_price_value', $dataAtt[$attGroupId]['add_price'][$key], $newHtml);
                                        @endphp
                                        {!! $newHtml !!}
                                    @endforeach
                                @endif
                                    <tr>
                                        <td colspan="3"><br><button type="button"
                                                class="btn btn-flat btn-success add_attribute"
                                                data-id="{{ $attGroupId }}">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                {{ gp247_language_render('admin.product.add_attribute') }}
                                            </button><br><br></td>
                                    </tr>
                                </table>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        {{-- //end List product attributes --}}
@endif


@if ($product_kind == GP247_PRODUCT_BUILD)

                    <hr class="kind kind2">
                    {{-- List product build --}}
                    <div class="form-group row kind kind1 {{ $errors->has('productBuild') ? ' text-red' : '' }}">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-8">
                            <label>{{ gp247_language_render('admin.product.select_product_in_build') }}</label>
                        </div>
                    </div>

                    <div
                        class="form-group row kind kind1 {{ ($errors->has('productBuild') || $errors->has('productBuildQty'))? ' text-red' : '' }}">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-8">

                            @if (old('productBuild'))
                            @foreach (old('productBuild') as $key => $pID)
                            @if ( $pID && old('productBuildQty')[$key])
                            @php
                            $newHtml = str_replace('value="'.$pID.'"', 'value="'.$pID.'" selected',
                            $htmlSelectBuild);
                            $newHtml = str_replace('name="productBuildQty[]" value="1" min=1',
                            'name="productBuildQty[]" value="'.old('productBuildQty')[$key].'"', $newHtml);
                            @endphp
                            {!! $newHtml !!}
                            @endif
                            @endforeach
                            @endif
                            <button type="button" id="add_product_in_build" class="btn btn-flat btn-success">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                {{ gp247_language_render('admin.product.add_product') }}
                            </button>
                            @if ($errors->has('productBuild') || $errors->has('productBuildQty'))
                            <span class="form-text">
                                <i class="fa fa-info-circle"></i> {{ $errors->first('productBuild') }}
                            </span>
                            @endif

                        </div>
                    </div>
                    {{-- //end List product build --}}
@endif




@if ($product_kind == GP247_PRODUCT_GROUP)

                    <hr class="kind">
                    {{-- List product in groups --}}
                    <div class="form-group row kind kind2 {{ $errors->has('productInGroup') ? ' text-red' : '' }}">
                        
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-8"><label>{{ gp247_language_render('admin.product.select_product_in_group') }}</label>
                        </div>
                    </div>
                    <div class="form-group row kind kind2 {{ $errors->has('productInGroup') ? ' text-red' : '' }}">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            @if (old('productInGroup'))
                            @foreach (old('productInGroup') as $pID)
                            @if ($pID)
                            @php
                            $newHtml = str_replace('value="'.$pID.'"', 'value="'.$pID.'" selected',
                            $htmlSelectGroup);
                            @endphp
                            {!! $newHtml !!}
                            @endif
                            @endforeach
                            @endif
                            <button type="button" id="add_product_in_group" class="btn btn-flat btn-success">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                {{ gp247_language_render('admin.product.add_product') }}
                            </button>
                            @if ($errors->has('productInGroup'))
                            <span class="form-text">
                                <i class="fa fa-info-circle"></i> {{ $errors->first('productInGroup') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    {{-- //end List product in groups --}}
@endif


                @includeIf('gp247-core::component.render_form_custom_field', ['object' => $product])
                {{-- //Custom fields --}}


                </div>

                <!-- /.card-body -->


                <div class="card-footer kind   row" id="card-footer">
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
<style>
    #start-add {
        margin: 20px;
    }
    #start-add.kind-0 {
        background-color: #fff;
        padding: 10px;
        font-size: 20px;
        color: black;
    }
    #start-add.kind-1 {
        background-color: #17a2b8;
        padding: 10px;
        font-size: 20px;
        color: white;
    }
    #start-add.kind-2 {
        background-color: #ffc107;
        padding: 10px;
        font-size: 20px;
        color: white;
    }
    
</style>

@endpush

@push('scripts')
@include('gp247-core::component.ckeditor_js')

<script type="text/javascript">

$("[name='tag']").change(function() {
    if($(this).val() == '{{ GP247_TAG_DOWNLOAD }}') {
        $('#download_path').show();
    } else {
        $('#download_path').hide();
    }
});


// Add sub images
var id_sub_image = {{ old('sub_image')?count(old('sub_image')):0 }};
$('#add_sub_image').click(function(event) {
    id_sub_image +=1;
    $(this).before(
    '<div class="group-image">'
    +'<div class="input-group">'
    +'  <input type="text" id="sub_image_'+id_sub_image+'" name="sub_image[]" value="" class="form-control input-sm sub_image" placeholder=""  />'
    +'  <div class="input-group-append">'
    +'  <span data-input="sub_image_'+id_sub_image+'" data-preview="preview_sub_image_'+id_sub_image+'" data-type="product" class="btn btn-flat btn-primary lfm">'
    +'      <i class="fa fa-image"></i> {{gp247_language_render('action.choose_image')}}'
    +'  </span>'
    + ' </div>'
    +'<span title="Remove" class="btn btn-flat btn-danger removeImage"><i class="fa fa-times"></i></span>'
    +'</div>'
    +'<div id="preview_sub_image_'+id_sub_image+'" class="img_holder"></div>'
    +'</div>');
    $('.removeImage').click(function(event) {
        $(this).closest('div').remove();
    });
    $('.lfm').filemanager();
});
    $('.removeImage').click(function(event) {
        $(this).closest('.group-image').remove();
    });
//end sub images

// Select product attributes
$('.add_attribute').click(function(event) {
    var htmlProductAtrribute = '{!! $htmlProductAtrribute ??'' !!}';
    var attGroup = $(this).attr("data-id");
    htmlProductAtrribute = htmlProductAtrribute.replace(/attribute_group/gi, attGroup);
    htmlProductAtrribute = htmlProductAtrribute.replace("attribute_value", "");
    htmlProductAtrribute = htmlProductAtrribute.replace("add_price_value", "0");
    $(this).closest('tr').before(htmlProductAtrribute);
    $('.removeAttribute').click(function(event) {
        $(this).closest('tr').remove();
    });
});
$('.removeAttribute').click(function(event) {
    $(this).closest('tr').remove();
});
//end select attributes
// image
// with plugin options
// $("input.image").fileinput({"browseLabel":"Browse","cancelLabel":"Cancel","showRemove":true,"showUpload":false,"dropZoneEnabled":false});

/* process_form(); */

@if ($product_kind == GP247_PRODUCT_BUILD)
// Select product in build
$('#add_product_in_build').click(function(event) {
    var htmlSelectBuild = '{!! str_replace("\n", "", $htmlSelectBuild) !!}';
    $(this).before(htmlSelectBuild);
    $('.select2').select2();
    $('.removeproductBuild').click(function(event) {
        $(this).closest('table').remove();
    });
});
$('.removeproductBuild').click(function(event) {
    $(this).closest('table').remove();
});
//end select in build
@endif

@if ($product_kind == GP247_PRODUCT_GROUP)
// Select product in group
$('#add_product_in_group').click(function(event) {
    var htmlSelectGroup = '{!! str_replace("\n", "", $htmlSelectGroup) !!}';
    $(this).before(htmlSelectGroup);
    $('.select2').select2();
    $('.removeproductInGroup').click(function(event) {
        $(this).closest('table').remove();
    });
});
$('.removeproductInGroup').click(function(event) {
    $(this).closest('table').remove();
});
//end select in group
@endif

$('textarea.editor').ckeditor(
    {
        filebrowserImageBrowseUrl: '{{ gp247_route_admin('admin.home').'/'.config('lfm.url_prefix') }}?type=product',
        filebrowserImageUploadUrl: '{{ gp247_route_admin('admin.home').'/'.config('lfm.url_prefix') }}/upload?type=product&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '{{ gp247_route_admin('admin.home').'/'.config('lfm.url_prefix') }}?type=files',
        filebrowserUploadUrl: '{{ gp247_route_admin('admin.home').'/'.config('lfm.url_prefix') }}/upload?type=file&_token={{csrf_token()}}',
        filebrowserWindowWidth: '900',
        filebrowserWindowHeight: '500'
    }
);

// Handle promotion section visibility
$(document).ready(function() {
    $('#promotion_use').on('ifChecked', function(event){
        $('.promotion-section').show();
    });

    $('#promotion_use').on('ifUnchecked', function(event){
        $('.promotion-section').hide();
    });

});

</script>



<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-add-item').forEach(btn => {
        btn.addEventListener('click', function () {
            const container = btn.closest('.form-group').querySelector('.what-items-list');
            const newInput = document.createElement('div');
            newInput.classList.add('input-group', 'mb-2');
            newInput.innerHTML = `
                <input type="text" name="${container.querySelector('input').name}" class="form-control" placeholder="New item">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger btn-remove-item">×</button>
                </div>
            `;
            container.appendChild(newInput);
        });
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-remove-item')) {
            e.target.closest('.input-group').remove();
        }
    });
});
</script>
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