<!-- Company -->
    <!-- full company support is enabled and this user is not a superadmin -->
@if (($snipeSettings->full_multiple_companies_support=='1') && (!Auth::user()->isSuperUser()))
    <!-- full company support is enabled and this user isn't a superadmin -->
    <div class="form-group">
    {{ Form::label($fieldname, $translated_name, array('class' => 'col-md-3 control-label')) }}
        <div class="col-md-6">
             <select class="js-data-ajax" data-endpoint="companies" disabled="true" data-placeholder="{{ trans('general.select_company') }}" name="{{ $fieldname }}" style="width: 100%" id="company_select" aria-label="{{ $fieldname }}">
                               <option selected="selected"  role="option" aria-selected="true">
                        {{ (\App\Models\Company::find($user->company_id)) ? \App\Models\Company::find($user->company_id)->name : '' }}
                    </option>
             </select>
        </div>
    </div>

@else
    <!-- full company support is disabled or this user is a superadmin -->
    <div id="{{ $fieldname }}" class="form-group{{ $errors->has($fieldname) ? ' has-error' : '' }}">
        {{ Form::label($fieldname, $translated_name, array('class' => 'col-md-3 control-label')) }}
        <div class="col-md-6">
            <select class="js-data-ajax" data-endpoint="companies" data-placeholder="{{ trans('general.select_company') }}" name="{{ $fieldname }}" style="width: 100%" id="company_select">
                @if ($company_id = Request::old($fieldname, (isset($item)) ? $item->{$fieldname} : ''))
                    <option value="{{ $company_id }}" selected="selected">
                        {{ (\App\Models\Company::find($company_id)) ? \App\Models\Company::find($company_id)->name : '' }}
                    </option>
                @else
                    <option value="">{{ trans('general.select_company') }}</option>
                @endif
            </select>
        </div>
        {!! $errors->first($fieldname, '<div class="col-md-8 col-md-offset-3"><span class="alert-msg"><i class="fa fa-times"></i> :message</span></div>') !!}

    {!! $errors->first($fieldname, '<div class="col-md-8 col-md-offset-3"><span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span></div>') !!}
    </div>

@endif
