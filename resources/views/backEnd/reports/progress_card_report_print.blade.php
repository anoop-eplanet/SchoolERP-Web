<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('lang.progress_card_report')</title>
    <style>
        body{
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact !important;
            color-adjust: exact;
        }
        table {
            border-collapse: collapse;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            color: #00273d;
        }
        .invoice_wrapper{
            max-width: 1200px;
            margin: auto;
            background: #fff;
            padding: 20px;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        .border_none{
            border: 0px solid transparent;
            border-top: 0px solid transparent !important;
        }
        .invoice_part_iner{
            background-color: #fff;
        }
        .invoice_part_iner h4{
            font-size: 30px;
            font-weight: 500;
            margin-bottom: 40px;
    
        }
        .invoice_part_iner h3{
            font-size:25px;
            font-weight: 500;
            margin-bottom: 5px;
    
        }
        .table_border thead{
            background-color: #F6F8FA;
        }
        .table td, .table th {
            padding: 5px 0;
            vertical-align: top;
            border-top: 0 solid transparent;
            color: #79838b;
        }
        .table td , .table th {
            padding: 5px 0;
            vertical-align: top;
            border-top: 0 solid transparent;
            color: #79838b;
        }
        .table_border tr{
            border-bottom: 1px solid #000 !important;
        }
        th p span, td p span{
            color: #212E40;
        }
        .table th {
            color: #00273d;
            font-weight: 300;
            border-bottom: 1px solid #f1f2f3 !important;
            background-color: #fafafa;
        }
        p{
            font-size: 14px;
        }
        h5{
            font-size: 12px;
            font-weight: 500;
        }
        h6{
            font-size: 10px;
            font-weight: 300;
        }
        .mt_40{
            margin-top: 40px;
        }
        .table_style th, .table_style td{
            padding: 20px;
        }
        .invoice_info_table td{
            font-size: 10px;
            padding: 0px;
        }
        .invoice_info_table td h6{
            color: #6D6D6D;
            font-weight: 400;
            }

        .text_right{
            text-align: right;
        }
        .virtical_middle{
            vertical-align: middle !important;
        }
        .thumb_logo {
            max-width: 120px;
        }
        .thumb_logo img{
            width: 100%;
        }
        .line_grid{
            display: grid;
            grid-template-columns: 140px auto;
            grid-gap: 10px;
        }
        .line_grid span{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .line_grid span:first-child{
            font-weight: 600;
            color: #79838b;
        }
        p{
            margin: 0;
        }
        .font_18 {
            font-size: 18px;
        }
        .mb-0{
            margin-bottom: 0;
        }
        .mb_30{
            margin-bottom: 30px !important;
        }
        .border_table thead tr th {
            padding: 12px 10px;
        }
        .border_table tbody tr td {
            border-bottom: 1px solid rgba(0, 0, 0,.05);
            text-align: center;
            padding: 10px;
        }
        .logo_img{
            display: flex;
            align-items: center;
        }
        .logo_img h3{
            font-size: 25px;
            margin-bottom: 5px;
            color: #79838b;
        }
        .logo_img h5{
            font-size: 14px;
            margin-bottom: 0;
            color: #79838b;
        }
        .company_info{
            margin-left: 20px;
        }
        .table_title{
            text-align: center;
        }
        .table_title h3{
            font-size: 35px;
            font-weight: 600;
            text-transform: uppercase;
            padding-bottom: 3px;
            display: inline-block;
            margin-bottom: 40px;
            color: #79838b;
        }
        .gray_header_table thead th{
            background: #515151 !important;
            color: #fff;
            border: 1px solid #515151;
        }
        .gray_header_table{
            border: 1px solid #DDDDDD;
        }
        .gray_header_table tbody td, .gray_header_table tbody th {
            border: 1px solid #DDDDDD;
        }
        .gray_header_table tbody tr:nth-of-type(2n+1) td {
            background-color: #EEEEEE !important;
        }
        .max-width-400{
            width: 400px;
        }
        .max-width-500{
            width: 500px;
        }
        .ml_auto{
            margin-left: auto;
            margin-right: 0;
        }
        .mr_auto{
            margin-left: 0;
            margin-right: auto;
        }
    </style>
</head>
<script>
        var is_chrome = function () { return Boolean(window.chrome); }
        if(is_chrome) 
        {
           window.print();
        //    setTimeout(function(){window.close();}, 10000); 
        }
        else
        {
           window.print();
        //    window.close();
        }
</script>
@php
$generalSetting= App\SmGeneralSettings::where('school_id', Auth::user()->school_id)->first();
if(!empty($generalSetting)){
    $school_name =$generalSetting->school_name;
    $site_title =$generalSetting->site_title;
    $school_code =$generalSetting->school_code;
    $address =$generalSetting->address;
    $phone =$generalSetting->phone; 
}
@endphp
<body onLoad="loadHandler();">
    <div class="invoice_wrapper">
        <!-- invoice print part here -->
        <div class="invoice_print mb_30">
            <div class="container">
                <div class="invoice_part_iner">
                    <table class="table border_bottom mb_30" >
                        <thead>
                            <td>
                                <div class="logo_img">
                                    <div class="thumb_logo">
                                        <img  src="{{asset('/')}}{{generalSetting()->logo }}" alt="">
                                    </div>
                                    <div class="company_info">
                                        <h3>{{isset($school_name)?$school_name:'Infix School Management ERP'}}</h3>
                                        <h5>{{isset($address)?$address:'Infix School Address'}}</h5>
                                    </div>
                                </div>
                            </td>
                        </thead>
                    </table>
                    <div class="table_title">
                        <h3>@lang('lang.progress_card_report')</h3>
                    </div>
                    <!-- middle content  -->
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                   <!-- single table  -->
                                   <table class="mb_30 max-width-500 mr_auto">
                                       <tbody>
                                           <tr>
                                               <td>
                                                <p class="line_grid" >
                                                    <span>
                                                        <span>@lang('lang.student_name')</span>
                                                        <span>:</span>
                                                    </span>
                                                    {{$student_detail->full_name}}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="line_grid" >
                                                    <span>
                                                        <span>@lang('lang.class')</span>
                                                        <span>:</span>
                                                    </span>
                                                    {{@$studentDetails->class_name}}
                                                </p>
                                            </td>
                                           </tr>
                                           <tr>
                                                
                                                <td>
                                                    <p class="line_grid" >
                                                        <span>
                                                            <span>@lang('lang.roll_no')</span>
                                                            <span>:</span>
                                                        </span>
                                                        {{$student_detail->roll_no}}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="line_grid" >
                                                        <span>
                                                            <span>@lang('lang.section')</span>
                                                            <span>:</span>
                                                        </span>
                                                        {{ $studentDetails->section_name }}
                                                    </p>
                                                </td>
                                           </tr>
                                           <tr>
                                                
                                                <td>
                                                    <p class="line_grid" >
                                                        <span>
                                                            <span>@lang('lang.admission_no')</span>
                                                            <span>:</span>
                                                        </span>
                                                        {{$student_detail->admission_no}}
                                                    </p>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                           </tr>
                                       </tbody>
                                   </table>
                                   <!--/ single table  -->
                                </td>
                                <td>
                                    <!-- single table  -->
                                    @if(@$marks_grade)
                                    <table class="table border_table gray_header_table mb_30 max-width-400 ml_auto" >
                                        <thead>
                                            <tr>
                                                <th>@lang('lang.starting')</th>
                                                <th>@lang('lang.ending')</th>
                                                <th>@lang('lang.gpa')</th>
                                                <th>@lang('lang.grade')</th>
                                                <th>@lang('lang.evalution')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($marks_grade as $d)
                                                <tr>
                                                    <td>{{$d->percent_from}}</td>
                                                    <td>{{$d->percent_upto}}</td>
                                                    <td>{{$d->gpa}}</td>
                                                    <td>{{$d->grade_name}}</td>
                                                    <td>{{$d->description}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                    <!--/ single table  -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- invoice print part end -->
        
        <table class="table border_table gray_header_table mb_30" >
            <thead>
                <tr>
                    <th rowspan="2">@lang('lang.subjects')</th>
                    @foreach($assinged_exam_types as $assinged_exam_type)
                    @php
                        $exam_type = App\SmExamType::examType($assinged_exam_type);
                    @endphp
                    <th colspan="4">{{$exam_type->title}}</th>
                    @endforeach
                    <th rowspan="2">@lang('lang.total')</th>
                </tr>
                <tr>
                    @foreach($assinged_exam_types as $assinged_exam_type)
                        <th>@lang('lang.full') @lang('lang.mark')</th>
                        <th>@lang('lang.marks')</th>
                        <th>@lang('lang.grade')</th>
                        <th>@lang('lang.gpa')</th>
                    @endforeach
                </tr>
            </thead>
            @php
                $total_fail = 0;
                $total_marks = 0;
                $gpa_with_optional_count=0;
                $gpa_without_optional_count=0;
                $value=0;
                $all_exam_type_full_mark=0;
            @endphp
            <tbody>
                @foreach($subjects as $data)
                <tr>
                    @if ($optional_subject_setup!='' && $student_optional_subject!='')
                            @if ($student_optional_subject->subject_id==$data->subject->id)
                            <td>
                                {{$data->subject !=""?$data->subject->subject_name:""}} (Optional) 
                            </td>
                        @else
                            <td>
                                {{$data->subject !=""?$data->subject->subject_name:""}} 
                            </td>
                        @endif
                    @else
                    <td>
                        {{$data->subject !=""?$data->subject->subject_name:""}} 
                    </td>
                    @endif
                    <?php
                        $totalSumSub= 0;
                        $totalSubjectFail= 0;
                        $TotalSum= 0;
                    foreach($assinged_exam_types as $assinged_exam_type){
                        $mark_parts = App\SmAssignSubject::getNumberOfPart($data->subject_id, $class_id, $section_id, $assinged_exam_type);
                        $result = App\SmResultStore::GetResultBySubjectId($class_id, $section_id, $data->subject_id,$assinged_exam_type ,$student_id);
                        if(!empty($result)){
                            $final_results = App\SmResultStore::GetFinalResultBySubjectId($class_id, $section_id, $data->subject_id,$assinged_exam_type ,$student_id);
                        }
                        $subject_full_mark=subjectFullMark($assinged_exam_type, $data->subject_id);
                        if($result->count()>0){
                            ?>
                            <td>
                                @php
                                    $all_exam_type_full_mark+=$subject_full_mark;
                                @endphp
                                {{$subject_full_mark}}
                            </td>
                                <td>
                                @php
                                    if($final_results != ""){
                                        echo $final_results->total_marks;
                                        $totalSumSub = $totalSumSub + $final_results->total_marks;
                                        $total_marks = $total_marks + $final_results->total_marks;

                                    }else{
                                        echo 0;
                                    }

                                @endphp
                            </td>
                                <td>
                                    @php
                                        if($final_results != ""){
                                            if($final_results->total_gpa_grade == $fail_grade_name->grade_name){
                                                $totalSubjectFail++;
                                                $total_fail++;
                                            }
                                            echo $final_results->total_gpa_grade;
                                        }else{
                                            echo '-';
                                        }
                                        if ($student_optional_subject!='') {
                                                if ($student_optional_subject->subject_id==$data->subject->id) {
                                                    $optional_subject_mark=$final_results->total_marks;
                                                }
                                        }
                                    @endphp
                                </td>
                                <td>
                                    {{number_format($final_results->total_gpa_point,2,'.','')}}
                                </td>
                            <?php
                                }else{ ?>
                                    <td>0</td>
                                    <td>0</td>
                                <?php
                                }
                                    }
                            ?>
                            <td>
                                {{$totalSumSub}}
                            </td>

                </tr>
                @endforeach
                @php
                    $colspan = 4 + count($assinged_exam_types) * 2;
                    if ($optional_subject_setup!='') {
                        $col_for_result=3;
                    } else {
                        $col_for_result=2;
                    }
                @endphp
                <tr>
                    <td><strong>@lang('lang.result')</strong></td>
                    @php
                        $term_base_gpa  = 0;
                        $average_gpa  = 0;
                        $with_percent_average_gpa  = 0;
                        $optional_subject_total_gpa  = 0;
                        $optional_subject_total_above_gpa  = 0;
                        $without_additional_subject_total_gpa  = 0;
                        $with_additional_subject_addition  = 0;
                        $with_optional_percentage  = 0;
                        $total_with_optional_percentage  = 0;
                        $total_with_optional_subject_extra_gpa  = 0;
                        $optional_subject_mark= 0;
                    @endphp
                    @foreach($assinged_exam_types as $assinged_exam_type)
                    @php
                        $exam_type = App\SmExamType::examType($assinged_exam_type);
                        $term_base_gpa=termWiseGpa($assinged_exam_type, $student_id);
                        $with_percent_average_gpa +=$term_base_gpa;

                        $term_base_full_mark=termWiseTotalMark($assinged_exam_type, $student_id);
                        $average_gpa+=$term_base_full_mark;

                        if($optional_subject_setup!='' && $student_optional_subject!=''){

                            $optional_subject_gpa = optionalSubjectFullMark($assinged_exam_type,$student_id,@$optional_subject_setup->gpa_above,"optional_sub_gpa");
                            $optional_subject_total_gpa += $optional_subject_gpa;

                            $optional_subject_above_gpa = optionalSubjectFullMark($assinged_exam_type,$student_id,@$optional_subject_setup->gpa_above,"with_optional_sub_gpa");
                            $optional_subject_total_above_gpa += $optional_subject_above_gpa;

                            $without_subject_gpa = optionalSubjectFullMark($assinged_exam_type,$student_id,@$optional_subject_setup->gpa_above,"without_optional_sub_gpa");
                            $without_additional_subject_total_gpa += $without_subject_gpa;
                            
                            $with_additional_subject_gpa = termWiseAddOptionalMark($assinged_exam_type,$student_id,@$optional_subject_setup->gpa_above);
                            $with_additional_subject_addition += $with_additional_subject_gpa;

                            $with_optional_subject_extra_gpa = termWiseTotalMark($assinged_exam_type,$student_id,"optional_subject");
                            $total_with_optional_subject_extra_gpa += $with_optional_subject_extra_gpa;

                            $with_optional_percentages=termWiseGpa($assinged_exam_type, $student_id,$with_optional_subject_extra_gpa);
                            $total_with_optional_percentage += $with_optional_percentages;
                        }
                    @endphp
                    <td colspan="4"> 
                        <strong>
                            @lang('lang.average') @lang('lang.gpa') : 
                            {{number_format($term_base_full_mark,2,'.','')}}
                            </br>
                            {{$exam_type->title}} ({{$exam_type->percentage}}%) : {{number_format($term_base_gpa,2,'.','')}}
                            @if($optional_subject_setup!='' && $student_optional_subject!='')
                                <hr>
                                @lang('lang.with') @lang('lang.optional') : 
                                {{number_format($with_optional_subject_extra_gpa,2,'.','')}}
                                </br>
                                @lang('lang.with') @lang('lang.optional') ({{$exam_type->percentage}}%) : 
                                {{number_format($with_optional_percentages,2,'.','')}}
                            @endif
                        </strong>
                    </td>
                    @endforeach
                    <td>
                        <strong>
                            {{number_format($average_gpa,2,'.','')}}
                            </br>
                            {{number_format($with_percent_average_gpa, 2, '.', '')}}
                            @if($optional_subject_setup!='' && $student_optional_subject!='')
                                <hr>
                                {{number_format($total_with_optional_subject_extra_gpa, 2, '.', '')}}
                                </br>
                                {{number_format($total_with_optional_percentage, 2, '.', '')}}
                            @endif
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="{{$colspan / $col_for_result - 1}}">
                        @lang('lang.total') @lang('lang.marks')
                    </td>
                    @if ($optional_subject_setup!='' && $student_optional_subject!='')
                        <td colspan="{{$colspan / $col_for_result + 7}}">
                            {{$total_marks}} @lang('lang.out_of') {{$all_exam_type_full_mark}}
                        </td>
                    @else
                        <td colspan="{{$colspan / $col_for_result + 9}}">
                            {{$total_marks}} @lang('lang.out_of') {{$all_exam_type_full_mark}}
                        </td>
                    @endif
                </tr>
                <tr>
                    @if($optional_subject_setup!='' && $student_optional_subject!='')
                        <td colspan="{{$colspan / $col_for_result - 1}}">
                            @lang('lang.optional') @lang('lang.total') @lang('lang.gpa')
                                <hr>
                            @lang('lang.gpa_above') {{@$optional_subject_setup->gpa_above}}
                        </td>
                        <td colspan="{{$colspan / $col_for_result + 7}}">
                            {{$optional_subject_total_gpa}}
                                <hr>
                            {{$optional_subject_total_above_gpa}}
                        </td>
                    @endif
                </tr>
                @php
                if (isset($optional_subject_mark)) {
                    $total_marks_without_optional=$total_marks-$optional_subject_mark;
                    $op_subject_count=count($subjects)-1;
                }else{
                    $total_marks_without_optional=$total_marks;
                    $op_subject_count=count($subjects);
                }
                @endphp
                <tr>
                    <td colspan="{{$colspan / $col_for_result - 1}}">
                        @lang('lang.total') @lang('lang.gpa')
                    </td>
                    @if ($optional_subject_setup!='' && $student_optional_subject!='')
                    <td colspan="4">
                        {{number_format($total_with_optional_percentage,2,'.','')}}
                    </td>
                    <td colspan="3">
                        @lang('lang.without_additional') @lang('lang.grade')
                    </td>
                    <td colspan="2">
                        {{number_format($with_percent_average_gpa,2,'.','')}}
                    </td>
                    @else
                        <td colspan="{{$colspan / $col_for_result + 9}}">
                            {{gradeName(number_format(termWiseFullMark($assinged_exam_types,$student_id),2,'.',''))}}
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="{{$colspan / $col_for_result - 1}}">
                        @lang('lang.total') @lang('lang.grade')
                    </td>
                    @if ($optional_subject_setup!='' && $student_optional_subject!='')
                        <td colspan="4">
                            {{gradeName(number_format($total_with_optional_percentage,2,'.',''))}}
                        </td>
                    <td colspan="3">
                        @lang('lang.without_additional') @lang('lang.gpa')
                    </td>
                    <td colspan="2">
                        {{gradeName(number_format($with_percent_average_gpa,2,'.',''))}}
                    </td>
                    @else
                        <td colspan="{{$colspan / $col_for_result + 9}}">
                            {{number_format(termWiseFullMark($assinged_exam_types,$student_id),2,'.','')}}
                        </td>
                    @endif
                </tr>
                {{-- Remark Start --}}
                <tr>
                    @if($optional_subject_setup!='' && $student_optional_subject!='')
                        <td colspan="{{$colspan / $col_for_result - 1}}">
                            @lang('lang.remarks')
                        </td>
                        <td colspan="{{$colspan / $col_for_result + 7}}">
                            {{remarks(number_format($total_with_optional_percentage,2,'.',''))}}
                        </td>
                    @else
                        <td colspan="{{$colspan / $col_for_result - 1}}">
                            @lang('lang.remarks')
                        </td>
                        <td colspan="{{$colspan / $col_for_result + 9}}">
                            {{remarks(number_format(termWiseFullMark($assinged_exam_types,$student_id),2,'.',''))}}
                        </td>
                    @endif
                </tr>
                {{-- Remark End --}}
            </tbody>
        </table>
    </div>
</body>
</html>