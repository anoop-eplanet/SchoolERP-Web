@extends('backEnd.master')
@section('title')
@lang('lang.mark_sheet_report') @lang('lang.student')
@endsection
@section('mainContent')
    <style>
        th {
            border: 1px solid black;
            text-align: center;
        }

        td {
            text-align: center;
        }

        td.subject-name {
            text-align: left;
            padding-left: 10px !important;
        }

        table.marksheet {
            width: 100%;
            border: 1px solid #828bb2 !important;
        }

        table.marksheet th {
            border: 1px solid #828bb2 !important;
        }

        table.marksheet td {
            border: 1px solid #828bb2 !important;
        }

        table.marksheet thead tr {
            border: 1px solid #828bb2 !important;
        }

        table.marksheet tbody tr {
            border: 1px solid #828bb2 !important;
        }

        .studentInfoTable {
            width: 100%;
            padding: 0px !important;
        }

        .studentInfoTable td {
            padding: 0px !important;
            text-align: left;
            padding-left: 15px !important;
        }

        h4 {
            text-align: left !important;
        }

        hr {
            margin: 0px;
        }

        #grade_table th {
            border: 1px solid black;
            text-align: center;
            background: #351681;
            color: white;
        }

        #grade_table td {
            color: black;
            text-align: center !important;
            border: 1px solid black;
        }

    .single-report-admit table tr:last-child td {
    border-bottom: 1px solid #dee2e6 !important ;
    }

    .single-report-admit table tr td {
        border-color: #dee2e6 !important;
        }

.custom_table tbody tr th{
    border-color: #dee2e6 !important;
}
.spacing tr th{
    padding: 3px 10px !important;
    vertical-align: middle;
    border: 1px solid #dee2e6 !important;
}

.spacing tr td{
    padding: 0px 40px !important;
    vertical-align: middle;
}


    </style>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.mark_sheet_report') @lang('lang.student') </h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.reports')</a>
                    <a href="#">@lang('lang.mark_sheet_report') @lang('lang.student')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria')</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'mark_sheet_report_student', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                    <div class="row">
                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                        <div class="col-lg-3 mt-30-md md_mb_20">
                            <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}"
                                    name="exam">
                                <option data-display="@lang('lang.select_exam') *" value="">@lang('lang.select_exam')
                                    *
                                </option>
                                @foreach($exams as $exam)
                                    <option value="{{$exam->id}}" {{isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''}}>{{$exam->title}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('exam'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('exam') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-lg-3 mt-30-md md_mb_20">
                            <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}"
                                    id="select_class" name="class">
                                <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class')
                                    *
                                </option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}" {{isset($class_id)? ($class_id == $class->id? 'selected':''):''}}>{{$class->class_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('class'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('class') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-lg-3 mt-30-md md_mb_20" id="select_section_div">
                            <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                <option data-display="@lang('lang.select_section') *" value="">@lang('lang.select_section') *</option>
                            </select>
                            <div class="pull-right loader loader_style" id="select_section_loader">
                                <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                            </div>
                            @if($errors->has('section'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-lg-3 mt-30-md md_mb_20" id="select_student_div">
                            <select class="w-100 bb niceSelect form-control{{ $errors->has('student') ? ' is-invalid' : '' }}"
                                    id="select_student" name="student">
                                <option data-display="@lang('lang.select_student') *"
                                        value="">@lang('lang.select_student') *
                                </option>
                            </select>
                            <div class="pull-right loader loader_style" id="select_student_loader">
                                <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                            </div>
                            @if ($errors->has('student'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('student') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="col-lg-12 mt-20 text-right">
                            <button type="submit" class="primary-btn small fix-gr-bg">
                                <span class="ti-search"></span>
                                @lang('lang.search')
                            </button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>


    @if(isset($mark_sheet))
    
        <style>
            * {
                margin: 0;
                padding: 0;
            }

            body {
                font-size: 12px;
                font-family: 'Poppins', sans-serif;
            }

            .student_marks_table {
                width: 100%;
                margin: 30px auto 0 auto;
                padding-left: 10px;
                padding-right: 5px;
            }

            .text_center {
                text-align: center;
            }

            p {
                margin: 0;
                font-size: 12px;
                text-transform: capitalize;
            }

            ul {
                margin: 0;
                padding: 0;
            }

            li {
                list-style: none;
            }

            td {
                border: 1px solid #726E6D;
                padding: .3rem;
                text-align: center;
            }

            th {
                border: 1px solid #726E6D;
                text-transform: capitalize;
                text-align: center;
                padding: .5rem;
                white-space: nowrap;
            }

            thead {
                font-weight: bold;
                text-align: center;
                color: #415094;
                font-size: 10px
            }

            .custom_table {
                width: 100%;
            }

            table.custom_table thead th {
                padding-right: 0;
                padding-left: 0;
            }

            table.custom_table thead tr > th {
                border: 0;
                padding: 0;
            }

            /* tr:last-child td {
                border: 0 !important;
            }
            tr:nth-last-child(2) td {
                border: 0 !important;
            }
            tr:nth-last-child(3) td {
                border: 0 !important;
            } */

            table.custom_table thead tr th .fees_title {
                font-size: 12px;
                font-weight: 600;
                border-top: 1px solid #726E6D;
                padding-top: 10px;
                margin-top: 10px;
            }

            .border-top {
                border-top: 0 !important;
            }

            .border_full {
                border: 1px solid black !important;
            }

            .border_bottom {
                border-bottom: 1px solid black !important;
            }

            .border_top {
                border-top: 1px solid black !important;
            }

            .custom_table th ul li {
            }

            .custom_table th ul li p {
                margin-bottom: 10px;
                font-weight: 500;
                font-size: 14px;
            }

            /* tbody td p{
              text-align: right;
            } */
            tbody td {
                padding: 0.8rem;
            }

            table {
                border-spacing: 10px;
                width: 65%;
                margin: auto;
            }

            .fees_pay {
                text-align: center;
            }

            .border-0 {
                border: 0 !important;
            }

            .copy_collect {
                text-align: center;
                font-weight: 500;
                color: #000;
            }

            .copyies_text {
                display: flex;
                justify-content: space-between;
                margin: 30px 0;
            }

            .copyies_text li {
                text-transform: capitalize;
                color: #000;
                font-weight: 500;
                border-top: 1px dashed #ddd;
            }

            .text_left {
                text-align: left;
            }

            .italic_text {
            }

            .student_info {

            }

            .student_info li {
                display: flex;
            }

            .info_details {
                display: flex;
                flex-wrap: wrap;
                margin-top: 30px;
                margin-bottom: 30px;
            }

            .info_details li > p {
                flex-basis: 20%;
            }

            .info_details li {
                display: flex;
                flex-basis: 50%;
            }

            .school_name {
                text-align: center;
            }

            .numbered_table_row {
                display: flex;
                justify-content: space-between;
                margin-top: 40px;
                align-items: center;
            }

            .numbered_table_row thead {
                border: 1px solid #415094
            }

            .numbered_table_row h3 {
                font-size: 24px;
                text-transform: uppercase;
                margin-top: 15px;
                font-weight: 500;
                display: inline-block;
                border-bottom: 2px solid #415094;
            }

            .ingle-report-admit .numbered_table_row td {
                border: 1px solid #726E6D;
                padding: .4rem;
                font-weight: 400;
                color: #415094;
            }

            .table#grade_table_new th {
                border: 1px solid #726E6D !important;
                padding: .6rem !important;
                font-weight: 600;
                color: #415094;
                font-size: 10px;
            }

            td.border-top.border_left_hide {
                border-left: 0;
                text-align: left;
                font-weight: 600;
            }

            .devide_td {
                padding: 0;
            }

            .devide_td p {
                border-bottom: 1px solid #415094;
            }

            .ssc_text {
                font-size: 20px;
                font-weight: 500;
                color: #415094;
                margin-bottom: 20px;
            }

            table#grade_table_new td {
                padding: 0 !important;
                font-size: 8px;
            }

            table#grade_table_new {
                border-bottom: 1px solid #726E6D !important;
            }

            .student_info {
                flex: 70% 0 0;
            }

            .marks_wrap_area {
                display: flex;
                align-items: center;
            }

            .numbered_table_row {
                display: flex;
                justify-content: center;
                margin-top: 40px;
                align-items: center;
            }

    #grade_table th {
    text-align: center;
    color: #415094;
    background: #f2f2f2;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    border-top: 0px;
    padding: 5px 4px;
    border: 1px solid #a2a6c5;
    border-color: #dee2e6 !important;
}

#grade_table td {
    text-align: center !important;
    border: 1px solid #a2a6c5;
    color: #828bb2;
    padding: 0 6px;
    font-weight: 400;
    background-color: #fff;
}

</style>
        <section class="student-details">
            <div class="container-fluid p-0">
                <div class="row mt-40">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30">@lang('lang.mark_sheet_report')</h3>
                        </div>
                    </div>
                    <div class="col-lg-8 pull-right">
                        <a href="{{route('mark_sheet_report_print', [$input['exam_id'], $input['class_id'], $input['section_id'], $input['student_id']])}}"
                           class="primary-btn small fix-gr-bg pull-right" target="_blank">
                           <i class="ti-printer"> </i> 
                            @lang('lang.print')
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="single-report-admit">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex">
                                                    <div class=" col-lg-2">
                                                        <img class="logo-img" src="{{ generalSetting()->logo }}" alt="{{generalSetting()->school_name }}">
                                                    </div>
                                                    <div class="col-lg-6 ml-30">
                                                        <h3 class="text-white"> {{isset(generalSetting()->school_name)?generalSetting()->school_name:'Infix School Management ERP'}} </h3>
                                                        <p class="text-white mb-0"> {{isset(generalSetting()->address)?generalSetting()->address:'Infix School Address'}} </p>
                                                        <p class="text-white mb-0">
                                                            @lang('lang.email'): {{isset($email)?$email:'admin@demo.com'}} ,
                                                            @lang('lang.phone'): {{isset(generalSetting()->phone)?generalSetting()->phone:'admin@demo.com'}} </p>
                                                    </div>
                                                    <div class="offset-2">
                                                    </div>
                                                </div>
                                                <div>
                                                    <img class="report-admit-img"  src="{{ file_exists(@$studentDetails->student_photo) ? asset($studentDetails->student_photo) : asset('public/uploads/staff/demo/staff.jpg') }}" width="100" height="100" alt="{{asset($studentDetails->student_photo)}}"> 
                                                </div> 
                                            </div>
                                            {{--Start  Result Table --}}
                                            <div class="student_marks_table">
                                                <table class="custom_table">
                                                    <thead>
                                                    <tr class="numbered_table_row">
                                                        <td class="border-0">
                                                        </td>
                                                        <td class="border-0">
                                                            <div class="school_mark">
                                                                <h3>@lang('lang.academic') @lang('lang.transcript')</h3>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="1" class="text_left">
                                                            <div class="main-title">
                                                                <h2 class="mb-20">
                                                                    {{$student_detail->full_name}}
                                                                </h2>
                                                            </div>
                                                            <div class="marks_wrap_area d-block">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <ul class="student_info">
                                                                        <li>
                                                                            <p>
                                                                                @lang('lang.class') 
                                                                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                                            </p> &nbsp; 
                                                                            <p class="italic_text"> 
                                                                                <strong>  
                                                                                    : {{$student_detail->className->class_name}}
                                                                                </strong>
                                                                            </p>
                                                                        </li>
                                                                        <li>
                                                                            <p>
                                                                                @lang('lang.section')
                                                                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                                            </p> &nbsp; 
                                                                            <p class="italic_text">
                                                                                <strong> 
                                                                                    : {{$student_detail->section->section_name}}
                                                                                </strong>
                                                                            </p>
                                                                        </li>
                                                                        <li>
                                                                            <p>
                                                                                @lang('lang.admission') @lang('lang.no') &nbsp;  &nbsp; 
                                                                            </p> &nbsp; 
                                                                            <p class="italic_text">
                                                                                <strong>
                                                                                    : {{$student_detail->admission_no}}
                                                                                </strong>
                                                                            </p>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <ul class="student_info pull-right">
                                                                            <li>
                                                                                <p>
                                                                                    @lang('lang.roll') @lang('lang.no')&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                                                                </p>&nbsp; 
                                                                                <p>
                                                                                    <strong>
                                                                                        : {{$student_detail->roll_no}}
                                                                                    </strong>
                                                                                </p>
                                                                            </li>
                                                                            <li>
                                                                                <p>
                                                                                    @lang('lang.exam')&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                                                                </p>&nbsp; 
                                                                                <p>  
                                                                                    <strong>
                                                                                        : {{$exam_details->title}}
                                                                                    </strong>  
                                                                                </p>
                                                                            </li>
                                                                            <li>
                                                                                <p>
                                                                                    @lang('lang.date_of_birth')
                                                                                </p>&nbsp; 
                                                                                <p> 
                                                                                    <strong> 
                                                                                        : {{$student_detail->date_of_birth != ""? dateConvert($student_detail->date_of_birth):''}}
                                                                                    </strong>
                                                                                </p>
                                                                            </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-lg-4 text-black"> 
                                                                    @if(@$grades)
                                                                        <table class="table  table-bordered" id="grade_table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>@lang('lang.staring')</th>
                                                                                    <th>@lang('lang.ending')</th>
                                                                                    <th>@lang('lang.gpa')</th>
                                                                                    <th>@lang('lang.grade')</th>
                                                                                    <th>@lang('lang.evalution')</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($grades as $grade_d)
                                                                                    <tr>
                                                                                        <td>{{$grade_d->percent_from}}</td>
                                                                                        <td>{{$grade_d->percent_upto}}</td>
                                                                                        <td>{{$grade_d->gpa}}</td>
                                                                                        <td>{{$grade_d->grade_name}}</td>
                                                                                        <td class="text-left">{{$grade_d->description}}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    @endif 
                                                                </div>
                                                            </div>
                                                                {{--end sm_marks_grades --}}
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                                <table class="custom_table">
                                                    <tbody>
                                                        <tr>
                                                            <th>@lang('lang.sl')</th>
                                                            <th>@lang('lang.subject') @lang('lang.name')</th>
                                                            <th>@lang('lang.total') @lang('lang.mark')</th>
                                                            <th>@lang('lang.highest_marks')</th>
                                                            <th>@lang('lang.obtained_marks')</th>
                                                            <th>@lang('lang.letter') @lang('lang.grade')</th>
                                                            <th>@lang('lang.remarks')</th>
                                                        </tr>
                                                            @php
                                                                $main_subject_total_gpa=0;
                                                                $Optional_subject_count=0;
                                                                    if($optional_subject!=''){
                                                                        $Optional_subject_count=$subjects->count()-1;
                                                                    }else{
                                                                        $Optional_subject_count=$subjects->count();
                                                                    }
                                                                $sum_gpa= 0;  
                                                                $resultCount=1; 
                                                                $subject_count=1; 
                                                                $tota_grade_point=0; 
                                                                $this_student_failed=0; 
                                                                $count=1;
                                                                $total_mark=0;
                                                                $temp_grade=[];
                                                            @endphp
                                                            @foreach($mark_sheet as $data)
                                                            @php
                                                                $temp_grade[]=$data->total_gpa_grade;
                                                                if ($data->subject_id==$optional_subject) { 
                                                                    continue;
                                                                }
                                                            @endphp  
                                                        <tr>
                                                            <td>{{ $count }}</td>
                                                            <td style="text-align: left;padding-left: 15px;">
                                                                <p>
                                                                    {{$data->subject->subject_name}}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p>
                                                                    {{@subjectFullMark($exam_details->id, $data->subject->id )}}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p>{{@subjectHighestMark($exam_type_id, $data->subject->id, $class_id, $section_id)}}</p>
                                                            </td>
                                                            <td>
                                                                <p>
                                                                    {{@$data->total_marks}}
                                                                    @php
                                                                        $total_mark+=@$data->total_marks;
                                                                    @endphp
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p>
                                                                    @php
                                                                        $result = markGpa(@subjectPercentageMark(@$data->total_marks , @subjectFullMark($exam_details->id, $data->subject->id)));
                                                                        $main_subject_total_gpa += $result->gpa;
                                                                    @endphp
                                                                    {{@$data->total_gpa_grade}}
                                                                </p> 
                                                            </td>
                                                            <td>
                                                                <p>
                                                                    {{@$data->teacher_remarks}}
                                                                </p>
                                                            </td>
                                                            @php
                                                                $count++
                                                            @endphp
                                                        </tr>
                                                            @endforeach
                                                        <tr>
                                                            <td colspan="7" class="border-top text-left pl-3">
                                                                <strong>@lang('lang.additional_subject')</strong>
                                                            </td>
                                                        </tr>
                                                            @foreach($mark_sheet as $data)
                                                                @php
                                                                    if ($data->subject_id!=$optional_subject) { 
                                                                        continue;
                                                                    }
                                                                @endphp
                                                        <tr>
                                                            <td class="border-top border_bottom border_top">
                                                                {{ $count }}
                                                            </td>
                                                            <td class="border-top border_bottom text-left">
                                                                <p class="pl-3">
                                                                {{$data->subject->subject_name}}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p>
                                                                    {{@subjectFullMark($exam_details->id, $data->subject->id )}}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p>{{@subjectHighestMark($exam_type_id, $data->subject->id, $class_id, $section_id)}}</p>
                                                            </td>
                                                            <td>
                                                                <p>
                                                                    {{@$data->total_marks}}
                                                                    @php
                                                                        $total_mark+=@$data->total_marks;
                                                                    @endphp
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p>
                                                                    {{@$data->total_gpa_grade}}
                                                                </p>
                                                                <span>
                                                                @php
                                                                    if($data->total_gpa_point > @$optional_subject_setup->gpa_above){
                                                                        $optional_countable_gpa= $data->total_gpa_point - @$optional_subject_setup->gpa_above;
                                                                    }else{
                                                                        $optional_countable_gpa=0;
                                                                    }
                                                                @endphp
                                                            </span>
                                                            </td>
                                                            <td>
                                                                <p>
                                                                    {{@$data->teacher_remarks}}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                            @endforeach
                                                    </tbody>
                                                </table>
                                                </br>
                                                <div class="col-md-4 offset-md-3">
                                                    <table class="table table-bordered">
                                                        <tbody class="spacing">
                                                            <tr>
                                                                <th>@lang('lang.attendance')</th>
                                                                @if(isset($exam_content))
                                                                    <td class="nowrap">
                                                                        <p>{{@$student_attendance}} @lang('lang.of') {{@$total_class_days}}</p>
                                                                    </td>
                                                                    @else
                                                                    <td class="nowrap">
                                                                        <p>@lang('lang.no') @lang('lang.data') @lang('lang.found')</p>
                                                                    </td>
                                                                    @endif
                                                                <th>@lang('lang.total_mark')</th>
                                                                <td>{{@$total_mark}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>@lang('lang.average') @lang('lang.mark')</th>
                                                                <td>
                                                                    @php
                                                                        $average_mark=$total_mark/($Optional_subject_count+1);
                                                                    @endphp
                                                                    {{number_format(@$average_mark, 2, '.', '')}}
                                                                </td>
                                                                <th>@lang('lang.gpa_above') ( {{@$optional_subject_setup->gpa_above}} )</th>
                                                                <td>
                                                                    <p>
                                                                        {{$optional_countable_gpa}}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>@lang('lang.without') @lang('lang.optional')</th>
                                                                    <td>
                                                                        @php
                                                                            $without_optional=$main_subject_total_gpa/$Optional_subject_count;
                                                                        @endphp
                                                                        {{number_format($without_optional, 2,'.','')}}
                                                                    </td>
                                                                <th>@lang('lang.gpa')</th>
                                                                <td>
                                                                    @php
                                                                        $final_result = ($main_subject_total_gpa + $optional_countable_gpa) /$Optional_subject_count;
                                                                        if($final_result >= $maxGrade){
                                                                            echo number_format($maxGrade, 2,'.','');
                                                                        } else {
                                                                            echo number_format($final_result, 2,'.','');
                                                                        }
                                                                    @endphp
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>@lang('lang.grade')</th>
                                                                <td>
                                                                    @php
                                                                        if(in_array($failgpaname->grade_name,$temp_grade)){
                                                                            echo $failgpaname->grade_name;
                                                                        }else{
                                                                            if($final_result >= $maxGrade){
                                                                                $grade_details= App\SmResultStore::remarks($maxGrade);
                                                                            } else {
                                                                                $grade_details= App\SmResultStore::remarks($final_result);
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    {{@$grade_details->grade_name}}
                                                                </td>
                                                                <th>@lang('lang.evaluation')</th>
                                                                <td class="nowrap">
                                                                    @php
                                                                        if(in_array($failgpaname->grade_name,$temp_grade)){
                                                                            echo $failgpaname->description;
                                                                        }else{
                                                                            if($final_result >= $maxGrade){
                                                                                $grade_details= App\SmResultStore::remarks($maxGrade);
                                                                            } else {
                                                                                $grade_details= App\SmResultStore::remarks($final_result);
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <p>{{@$grade_details->description}}</p>
                                                                </td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            
                                            <script>
                                                function myFunction(value, subject) {
                                                    if (value != "") {
                                                        var res = Number(value / subject).toFixed(2);
                                                    } else {
                                                        var res = 0;
                                                    }
                                                    // document.getElementById("main_subject_total_gpa").innerHTML = res;
                                                }
                                                function myFunction2(value, subject , maxGrade) {
                                                    if (value != "") {
                                                            var totalGrade = Number(value / subject).toFixed(2);
                                                            if(totalGrade >= maxGrade){
                                                                var res = Number(maxGrade).toFixed(2);
                                                            } else {
                                                                var res = totalGrade;
                                                            }
                                                    } else {
                                                        var res = 0;
                                                    }
                                                    // document.getElementById("final_result").innerHTML = res;
                                                }
                                                myFunction({{ $main_subject_total_gpa }}, {{ $Optional_subject_count }});
                                                myFunction2( {{ $main_subject_total_gpa +$optional_countable_gpa  }}, {{ $Optional_subject_count }}, {{$maxGrade}});
                                            </script>

                                                @if(isset($exam_content))
                                                    <table style="width:100%" class="border-0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="border-0">
                                                                    <p class="result-date" style="text-align:left; float:left; display:inline-block; margin-top:50px; padding-left: 0;">
                                                                        @lang('lang.date_of_publication_of_result') : 
                                                                        <strong> 
                                                                            {{dateConvert(@$exam_content->publish_date)}}
                                                                        </strong>
                                                                    </p>
                                                                </td>
                                                                <td class="border-0"> 
                                                                    <div class="text-right d-flex flex-column justify-content-end">
                                                                    <div class="thumb text-right">
                                                                        <img src="{{@$exam_content->file}}" width="100px">
                                                                    </div>
                                                                        <p style="text-align:right; float:right; display:inline-block; margin-top:5px;">
                                                                        ({{@$exam_content->title}})
                                                                        </p> 
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
