@extends('backEnd.master')
@section('title')
@lang('lang.student_transport_report')
@endsection
@section('mainContent')
@php  @$setting = App\SmGeneralSettings::find(1);  if(!empty(@$setting->currency_symbol)){ @$currency = @$setting->currency_symbol; }else{ @$currency = '$'; }   @endphp 

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.student_transport_report')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.transport')</a>
                <a href="#">@lang('lang.student_transport_report')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria')</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if(session()->has('message-success') != "")
                        @if(session()->has('message-success'))
                        <div class="alert alert-success">
                            {{ session()->get('message-success') }}
                        </div>
                        @endif
                    @endif
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_transport_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                        <option data-display="@lang('lang.select_class')" value="">@lang('lang.select_class')</option>
                                        @foreach($classes as $class)
                                        <option value="{{@$class->id}}"  {{isset($class_id)? (@$class_id == @$class->id? 'selected':''):''}}>{{@$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('class'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('class') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-lg-3 mt-30-md" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                        <option data-display="@lang('lang.select_section')" value="">@lang('lang.select_section')</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                    </div>
                                    @if ($errors->has('section'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('section') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('route') ? ' is-invalid' : '' }}" name="route">
                                        <option data-display="@lang('lang.select_route')" value="">@lang('lang.select_route')</option>
                                        @foreach($routes as $route)
                                            <option value="{{$route->id}}"  {{isset($route_id)? (@$route_id == @$route->id? 'selected':''):''}}>{{@$route->title}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('route'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('route') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('vehicle') ? ' is-invalid' : '' }}" name="vehicle">
                                        <option data-display="@lang('lang.select_vehicle')" value="">@lang('lang.select_vehicle')</option>
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{$vehicle->id}}"  {{isset($vechile_id)? (@$vechile_id == @$vehicle->id? 'selected':''):''}}>{{@$vehicle->vehicle_no}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('vehicle'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('vehicle') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        @lang('lang.search')
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
       
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-30">@lang('lang.student_transport_report')</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    @if(session()->has('message-danger') != "")
                                    <tr>
                                        <td colspan="9">
                                            @if(session()->has('message-danger'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('message-danger') }}
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>@lang('lang.class_Sec')</th>
                                        <th>@lang('lang.admission') @lang('lang.no')</th>
                                        <th>@lang('lang.student') @lang('lang.name')</th>
                                        <th>@lang('lang.mobile')</th>
                                        <th>@lang('lang.father_name')</th>
                                        <th>@lang('lang.father_phone')</th>
                                        <th>@lang('lang.mother_name')</th>
                                        <th>@lang('lang.mother_phone')</th>
                                        <th>@lang('lang.route_title')</th>
                                        <th>@lang('lang.vehicle') @lang('lang.number')</th>
                                        <th>@lang('lang.driver') @lang('lang.name')</th>
                                        <th>@lang('lang.driver') @lang('lang.contact')</th>
                                        <th>@lang('lang.fare')({{generalSetting()->currency_symbol}})</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>{{ @$student->className != ""? @$student->className->class_name:""}} ({{@$student->section->section_name}})<input type="hidden" name="id[]" value="{{@$student->student_id}}"></td>
                                        <td>{{ @$student->admission_no}}</td>
                                        <td>{{ @$student->full_name}}</td>
                                        <td>{{ @$student->mobile}}</td>
                                        <td>{{ @$student->parents !=""?@$student->parents->fathers_name:""}}</td>
                                        <td>{{ @$student->parents !=""?@$student->parents->fathers_mobile:""}}</td>
                                        <td>{{ @$student->parents !=""?@$student->parents->mothers_name:""}}</td>
                                        <td>{{ @$student->parents !=""?@$student->parents->mothers_mobile:""}}</td>
                                        <td>{{ @$student->route !=""?@$student->route->title:""}}</td>
                                        <td>{{ @$student->vehicle !=""?@$student->vehicle->vehicle_no:""}}</td>
                                        <td>{{ @$student->vehicle !=""?@$student->vehicle->driver->full_name:""}}</td>
                                        <td>{{ @$student->vehicle !=""?@$student->vehicle->driver->mobile:""}}</td>
                                        <td>{{ @$student->vehicle !=""?@$student->route->far:""}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
