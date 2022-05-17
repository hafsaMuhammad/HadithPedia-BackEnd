@extends('HadithQuestion.Question')
@section('title', 'Add new')


@section('style')

<style>
    form {
        direction: rtl;
    }
    h1{
        font-size: 40px;
        font-weight: 300;
        background-color:#575757 ;
        color: #b3ecd9;
        border: 1px solid #fffff0;
    }
    .form-control{
        border: 1px solid #575757;
    }
    .btn{
        color: #b3ecd9;
        background-color: #575757;
        border: 1px solid #575757;
    }
    .form-control:focus, .btn:focus, .btn:active {
        box-shadow: 5px 5px 5px -5px #575757;
        border: 1px solid #575757;
    }
    .btn:focus, .btn:hover, .btn:active {
        color: #575757;
        background-color: #b3ecd9;
        border: 1px solid #575757;
        font-weight: 700
    }
    .alert{
        color:#b3ecd9;
        font-size: 18px;
        background-color:#575757;
        text-align: center;
    }
</style>

@endsection



@if (Session::has('msg'))
    <div class="alert mb-0" role="alert">
        {{Session::get('msg')}}
    </div>
@endif








@section('content')

<div class="container mt-5">

    <h1 class="text-center rounded pb-3">إضافة سؤال جديد</h1>

    <form action="{{route('hadithQuestions.store')}}" method="POST">
        @csrf
        <div class="row mb-3">
            <label for="question" class="col-sm-2 col-form-label"></label>
            <input type="text" name="question" placeholder="أدخل السؤال.." class="form-control py-3" id="question">
        </div>
        <div class="row mb-3">
            <label for="choiceA" class="col-sm-2 col-form-label"></label>
            <input type="text"  name="choiceA"  placeholder="أدخل الخيار الأول.." class="form-control py-3" id="choiceA">
        </div>
        <div class="row mb-3">
            <label for="choiceB" class="col-sm-2 col-form-label"></label>
            <input type="text"  name="choiceB"  placeholder="أدخل الخيار الثاني.." class="form-control py-3" id="choiceB">
        </div>
        <div class="row mb-3">
            <label for="choiceC" class="col-sm-2 col-form-label"></label>
            <input type="text" name="choiceC" placeholder="أدخل الخيار الثالث.." class="form-control py-3" id="choiceC">
        </div>
        <div class="row mb-4">
            <label for="correct" class="col-sm-2 col-form-label"></label>
            <input type="text" name="correct" placeholder="أدخل إجابة السؤال الصحيحة.." class="form-control py-3" id="correct">
        </div>
        <div class="row mb-4">
            <label for="hadith_id" class="col-sm-2 col-form-label"></label>
            <input type="text" name="hadith_id" placeholder="أدخل رقم الحديث التابع للسؤال.." class="form-control py-3" id="hadith_id">
        </div>
        <button type="submit" class="btn btn-primary">حفظ السؤال</button>
        </form>

</div>
@endsection
