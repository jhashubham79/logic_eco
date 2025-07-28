@extends('gp247-core::layout')

@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header with-border">
                <h2 class="card-title">{{ $title_description??'' }}</h2>

                <div class="card-tools">
                    <div class="btn-group float-right mr-5">
                        <a href="{{ gp247_route_admin('admin_page.index') }}" class="btn  btn-flat btn-default" title="List"><i
                                class="fa fa-list"></i><span class="hidden-xs"> {{ gp247_language_render('admin.back_list') }}</span></a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main"
                enctype="multipart/form-data">

                <div class="card-body">
                    <div class="fields-group">

                @php
                $descriptions = $page ? $page->descriptions->keyBy('lang')->toArray():[];
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

                        <div
                            class="form-group row  {{ $errors->has('descriptions.'.$code.'.title') ? ' text-red' : '' }}">
                            <label for="{{ $code }}__title"
                                class="col-sm-2 col-form-label">{{ gp247_language_render('admin.page.title') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" id="{{ $code }}__title" name="descriptions[{{ $code }}][title]"
                                        value="{{ old('descriptions.'.$code.'.title',($descriptions[$code]['title']??'')) }}"
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
                                class="col-sm-2 col-form-label">{{ gp247_language_render('admin.page.keyword') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" id="{{ $code }}__keyword"
                                        name="descriptions[{{ $code }}][keyword]"
                                        value="{{ old('descriptions.'.$code.'.keyword',($descriptions[$code]['keyword']??'')) }}"
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


   @if(
    ($page->id ?? null) == '9f6721bb-7c1e-433d-89b3-c5b7290e5980' || 
    ($page->alias ?? null) == 'home'
     )

    {{-- Home Page Specific Fields --}}
    {{-- Heading --}}
    <div class="form-group row {{ $errors->has('descriptions.'.$code.'.heading') ? ' text-red' : '' }}">
        <label for="{{ $code }}__heading" class="col-sm-2 col-form-label">
            Heading <span class="seo" title="Heading"><i class="fa fa-header" aria-hidden="true"></i></span>
        </label>
        <div class="col-sm-8">
            <input type="text" id="{{ $code }}__heading"
                name="descriptions[{{ $code }}][heading]"
                value="{{ old('descriptions.'.$code.'.heading', ($descriptions[$code]['heading'] ?? '')) }}"
                class="form-control" placeholder="Enter heading" />
            @if ($errors->has('descriptions.'.$code.'.heading'))
                <span class="form-text">
                    <i class="fa fa-info-circle"></i> {{ $errors->first('descriptions.'.$code.'.heading') }}
                </span>
            @endif
        </div>
    </div>

    {{-- Sub Heading --}}
    <div class="form-group row {{ $errors->has('descriptions.'.$code.'.subheading') ? ' text-red' : '' }}">
        <label for="{{ $code }}__subheading" class="col-sm-2 col-form-label">
            Subheading <span class="seo" title="Subheading"><i class="fa fa-paragraph" aria-hidden="true"></i></span>
        </label>
        <div class="col-sm-8">
            <input type="text" id="{{ $code }}__subheading"
                name="descriptions[{{ $code }}][subheading]"
                value="{{ old('descriptions.'.$code.'.subheading', ($descriptions[$code]['subheading'] ?? '')) }}"
                class="form-control" placeholder="Enter subheading" />
            @if ($errors->has('descriptions.'.$code.'.subheading'))
                <span class="form-text">
                    <i class="fa fa-info-circle"></i> {{ $errors->first('descriptions.'.$code.'.subheading') }}
                </span>
            @endif
        </div>
    </div>

    {{-- Button Text --}}
    <div class="form-group row {{ $errors->has('descriptions.'.$code.'.button_text') ? ' text-red' : '' }}">
        <label for="{{ $code }}__button_text" class="col-sm-2 col-form-label">
            Button Text <span class="seo" title="Button Text"><i class="fa fa-font" aria-hidden="true"></i></span>
        </label>
        <div class="col-sm-8">
            <input type="text" id="{{ $code }}__button_text"
                name="descriptions[{{ $code }}][button_text]"
                value="{{ old('descriptions.'.$code.'.button_text', ($descriptions[$code]['button_text'] ?? '')) }}"
                class="form-control" placeholder="Enter button text" />
            @if ($errors->has('descriptions.'.$code.'.button_text'))
                <span class="form-text">
                    <i class="fa fa-info-circle"></i> {{ $errors->first('descriptions.'.$code.'.button_text') }}
                </span>
            @endif
        </div>
    </div>

    {{-- Button Link --}}
    <div class="form-group row {{ $errors->has('descriptions.'.$code.'.button_link') ? ' text-red' : '' }}">
        <label for="{{ $code }}__button_link" class="col-sm-2 col-form-label">
            Button Link <span class="seo" title="Button Link"><i class="fa fa-link" aria-hidden="true"></i></span>
        </label>
        <div class="col-sm-8">
            <input type="url" id="{{ $code }}__button_link"
                name="descriptions[{{ $code }}][button_link]"
                value="{{ old('descriptions.'.$code.'.button_link', ($descriptions[$code]['button_link'] ?? '')) }}"
                class="form-control" placeholder="Enter button link (URL)" />
            @if ($errors->has('descriptions.'.$code.'.button_link'))
                <span class="form-text">
                    <i class="fa fa-info-circle"></i> {{ $errors->first('descriptions.'.$code.'.button_link') }}
                </span>
            @endif
        </div>
    </div>

{{-- Find Your Fix Section --}}
<div class="form-group row {{ $errors->has('descriptions.'.$code.'.find_title') ? ' text-red' : '' }}">
    <label for="{{ $code }}__find_title" class="col-sm-2 col-form-label">
        Find Your Fix Title
    </label>
    <div class="col-sm-8">
        <input type="text" id="{{ $code }}__find_title"
            name="descriptions[{{ $code }}][find_title]"
            value="{{ old('descriptions.'.$code.'.find_title', $descriptions[$code]['find_title'] ?? '') }}"
            class="form-control" placeholder="Enter title" />
        @if ($errors->has('descriptions.'.$code.'.find_title'))
            <span class="form-text">
                <i class="fa fa-info-circle"></i> {{ $errors->first('descriptions.'.$code.'.find_title') }}
            </span>
        @endif
    </div>
</div>

<div class="form-group row {{ $errors->has('descriptions.'.$code.'.find_content') ? ' text-red' : '' }}">
    <label for="{{ $code }}__find_content" class="col-sm-2 col-form-label">
        Find Your Fix Content
    </label>
    <div class="col-sm-8">
        <textarea id="{{ $code }}__find_content"
            name="descriptions[{{ $code }}][find_content]"
            rows="4"
            class="form-control"
            placeholder="Enter content">{{ old('descriptions.'.$code.'.find_content', $descriptions[$code]['find_content'] ?? '') }}</textarea>
        @if ($errors->has('descriptions.'.$code.'.find_content'))
            <span class="form-text">
                <i class="fa fa-info-circle"></i> {{ $errors->first('descriptions.'.$code.'.find_content') }}
            </span>
        @endif
    </div>
</div>


{{-- Budget Friendly Section --}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Budget Friendly Heading</label>
    <div class="col-sm-8">
        <input type="text" name="descriptions[{{ $code }}][budget_heading]" class="form-control"
               value="{{ old("descriptions.$code.budget_heading", $descriptions[$code]['budget_heading'] ?? '') }}"
               placeholder="Enter heading">
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Budget Friendly Content</label>
    <div class="col-sm-8">
        <textarea name="descriptions[{{ $code }}][budget_content]" class="form-control" rows="3"
                  placeholder="Enter content">{{ old("descriptions.$code.budget_content", $descriptions[$code]['budget_content'] ?? '') }}</textarea>
    </div>
</div>

@for ($i = 1; $i <= 3; $i++)
    {{-- Budget Card {{ $i }} Image --}}
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Card {{ $i }} Image</label>
        <div class="col-sm-8">
            @php
                $imageKey = "budget_card_{$i}_icon";
                $imageVal = old("descriptions.$code.$imageKey", $descriptions[$code][$imageKey] ?? '');
            @endphp

            @if (!empty($imageVal))
                <div class="mb-2">
                    <img src="{{ url('uploads/' . $imageVal) }}" style="max-height: 80px;">
                </div>
            @endif

            <input type="file" name="{{ $imageKey }}_{{ $code }}" class="form-control mb-1" />
            <input type="hidden" name="descriptions[{{ $code }}][{{ $imageKey }}]" value="{{ $imageVal }}">
            <small class="text-muted">Upload image or leave to keep existing</small>
        </div>
    </div>

    {{-- Card Title --}}
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Card {{ $i }} Title</label>
        <div class="col-sm-8">
            <input type="text" name="descriptions[{{ $code }}][budget_card_{{ $i }}_title]" class="form-control"
                   value="{{ old("descriptions.$code.budget_card_{$i}_title", $descriptions[$code]["budget_card_{$i}_title"] ?? '') }}"
                   placeholder="Enter title">
        </div>
    </div>

    {{-- Card Subtitle --}}
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Card {{ $i }} Subtitle</label>
        <div class="col-sm-8">
            <input type="text" name="descriptions[{{ $code }}][budget_card_{{ $i }}_subtitle]" class="form-control"
                   value="{{ old("descriptions.$code.budget_card_{$i}_subtitle", $descriptions[$code]["budget_card_{$i}_subtitle"] ?? '') }}"
                   placeholder="Enter subtitle">
        </div>
    </div>
@endfor



  
    {{-- FAQs Section --}}
{{-- FAQs Section --}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        FAQs <span class="seo" title="Frequently Asked Questions"><i class="fa fa-question-circle"></i></span>
    </label>
    <div class="col-sm-8">
        <div id="faq-wrapper-{{ $code }}"></div>

        <button type="button" class="btn btn-sm btn-primary mt-2" onclick="addFaq('{{ $code }}')">
            <i class="fa fa-plus"></i> Add FAQ
        </button>

        {{-- Hidden textarea to store JSON --}}
        <textarea name="descriptions[{{ $code }}][faqs]" id="faqs-json-{{ $code }}" class="d-none">
            {{ old('descriptions.'.$code.'.faqs', is_string($descriptions[$code]['faqs'] ?? '') ? $descriptions[$code]['faqs'] : json_encode($descriptions[$code]['faqs'] ?? [])) }}
        </textarea>
    </div>
</div>





@endif


                        <div
                            class="form-group row  {{ $errors->has('descriptions.'.$code.'.description') ? ' text-red' : '' }}">
                            <label for="{{ $code }}__description"
                                class="col-sm-2 col-form-label">{{ gp247_language_render('admin.page.description') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                    <textarea id="{{ $code }}__description"
                                        name="descriptions[{{ $code }}][description]"
                                        class="form-control {{ $code.'__description' }}" placeholder="" >{{  old('descriptions.'.$code.'.description',($descriptions[$code]['description']??''))  }}</textarea>
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


                        <div
                            class="form-group row {{ $errors->has('descriptions.'.$code.'.content') ? ' text-red' : '' }}">
                            <label for="{{ $code }}__content"
                                class="col-sm-2 col-form-label">{{ gp247_language_render('admin.page.content') }}</label>
                            <div class="col-sm-8">
                                <textarea id="{{ $code }}__content" class="editor"
                                    name="descriptions[{{ $code }}][content]">
                                        {!! old('descriptions.'.$code.'.content',($descriptions[$code]['content']??'')) !!}
                                    </textarea>
                                @if ($errors->has('descriptions.'.$code.'.content'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('descriptions.'.$code.'.content') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        
                        </div>
                    </div>

                    @endforeach

                        <div class="form-group row  {{ $errors->has('image') ? ' text-red' : '' }}">
                            <label for="image" class="col-sm-2 col-form-label">{{ gp247_language_render('admin.page.image') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="image" name="image"
                                        value="{!! old('image',($page['image']??'')) !!}"
                                        class="form-control input-sm image" placeholder="" />
                                        <div class="input-group-append">
                                            <a data-input="image" data-preview="preview_image" data-type="page"
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
                                    @if (old('image',($page['image']??'')))
                                    <img src="{{ gp247_file(old('image',($page['image']??''))) }}">
                                    @endif

                                </div>
                            </div>
                        </div>


                        <div class="form-group row  {{ $errors->has('alias') ? ' text-red' : '' }}">
                            <label for="alias"
                                class="col-sm-2 col-form-label">{!! gp247_language_render('admin.page.alias') !!}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" id="alias" name="alias" value="{!! old('alias',($page['alias']??'')) !!}"
                                        class="form-control alias" placeholder="" />
                                </div>
                                @if ($errors->has('alias'))
                                <span class="form-text">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('alias') }}
                                </span>
                                @endif
                            </div>
                        </div>

@if (gp247_store_check_multi_partner_installed() ||  gp247_store_check_multi_store_installed())
                        {{-- select shop_store --}}
                        @php
                        $listStore = [];
                        
                        if (function_exists('gp247_get_list_store_of_page_detail')) {
                                $oldData = gp247_get_list_store_of_page_detail($page['id'] ?? '');
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

                        <div class="form-group row ">
                            <label for="status" class="col-sm-2 col-form-label">{{ gp247_language_render('admin.page.status') }}</label>
                            <div class="col-sm-8">
                                <input class="checkbox" type="checkbox" name="status"
                                    {{ old('status',(empty($page['status'])?0:1))?'checked':''}}>
                            </div>
                        </div>
                        {{-- Custom fields --}}
                        @includeIf('gp247-core::component.render_form_custom_field', ['object' => $page])
                        {{-- //Custom fields --}}

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

@endpush

@push('scripts')
@include('gp247-core::component.ckeditor_js')


<script type="text/javascript">
    $(document).ready(function() {
    $('.select2').select2()
});

</script>

<script type="text/javascript">
    $('textarea.editor').ckeditor(
    {
        filebrowserImageBrowseUrl: '{{ gp247_route_admin('admin.home').'/'.config('lfm.url_prefix') }}?type=page',
        filebrowserImageUploadUrl: '{{ gp247_route_admin('admin.home').'/'.config('lfm.url_prefix') }}/upload?type=page&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '{{ gp247_route_admin('admin.home').'/'.config('lfm.url_prefix') }}?type=files',
        filebrowserUploadUrl: '{{ gp247_route_admin('admin.home').'/'.config('lfm.url_prefix') }}/upload?type=file&_token={{csrf_token()}}',
        filebrowserWindowWidth: '900',
        filebrowserWindowHeight: '500'
    }
);
</script>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        const lang = @json($code);
        const wrapper = document.getElementById(`faq-wrapper-${lang}`);
        const faqsJsonField = document.getElementById(`faqs-json-${lang}`);

        let faqs = [];

        // Parse stored JSON FAQs (safe fallback)
        try {
            const val = faqsJsonField.value.trim();
            faqs = val ? JSON.parse(val) : [];
        } catch (e) {
            console.error('Invalid FAQ JSON:', e);
            faqs = [];
        }

        // Render existing FAQs (on edit)
        if (Array.isArray(faqs)) {
            faqs.forEach(faq => renderFaqBlock(lang, faq.question, faq.answer));
        }

        // Sync JSON back into hidden textarea before submit
        const form = wrapper.closest('form');
        if (form) {
            form.addEventListener('submit', function () {
                const data = [];
                wrapper.querySelectorAll('.faq-item').forEach(el => {
                    const question = el.querySelector('.faq-question').value;
                    const answer = el.querySelector('.faq-answer').value;
                    if (question.trim() || answer.trim()) {
                        data.push({ question: question.trim(), answer: answer.trim() });
                    }
                });
                faqsJsonField.value = JSON.stringify(data);
            });
        }
    });

    function addFaq(lang) {
        renderFaqBlock(lang, '', '');
    }

    function renderFaqBlock(lang, question = '', answer = '') {
        const wrapper = document.getElementById(`faq-wrapper-${lang}`);
        const block = document.createElement('div');
        block.className = 'faq-item border rounded p-3 mb-2 bg-light position-relative';

        block.innerHTML = `
             <button type="button" class="btn-close position-absolute top-0 end-0 m-2 p-1" onclick="this.parentElement.remove()" aria-label="Remove">
        <span aria-hidden="true" style="font-size: 14px;">&times;</span>
    </button>
    </br>
    

           </br>
            <div class="form-group mb-2">
                <label>Question</label>
                <input type="text" class="form-control faq-question" value="${escapeHtml(question)}" />
            </div>
            <div class="form-group">
                <label>Answer</label>
                <textarea class="form-control faq-answer" rows="2">${escapeHtml(answer)}</textarea>
            </div>
        `;
        wrapper.appendChild(block);
    }

    function escapeHtml(text) {
        if (typeof text !== 'string') return '';
        return text.replace(/&/g, "&amp;")
                   .replace(/</g, "&lt;")
                   .replace(/>/g, "&gt;")
                   .replace(/"/g, "&quot;")
                   .replace(/'/g, "&#039;");
    }
</script>


@push('scripts')

@endpush

@endpush