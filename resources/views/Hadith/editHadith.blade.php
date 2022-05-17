@extends('Hadith.hadith')
@section('title', 'edit')


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
    label{
        font-size: 30px;
        font-weight: 700;
        color: #575757;
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

    <h1 class="text-center rounded pb-3">تعديل حديث</h1>

    <form action="{{route('hadiths.update', $hadith->id )}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row mb-3">
            <label for="sanad" class="col-sm-2 col-form-label">سند الحديث</label>
            <input type="text" name="sanad" class="form-control py-3" id="sanad" value="{{$hadith->sanad}}">
        </div>
        <div class="row mb-3">
            <label for="matn" class="col-sm-2 col-form-label">متن الحديث</label>
            <input type="text"  name="matn"  class="form-control py-3" id="matn" value="{{$hadith->matn}}">
        </div>
        <div class="row mb-3">
            <label for="description" class="col-sm-2 col-form-label">شرح الحديث</label>
            <input type="text"  name="description"  class="form-control py-3" id="description" value="{{$hadith->description}}">
        </div>
        <div class="row mb-3">
            <label for="source" class="col-sm-2 col-form-label">مصدر الحديث</label>
            <input type="text" name="source"  class="form-control py-3" id="source" value="{{$hadith->source}}">
        </div>
        <div class="row mb-4">
            <label for="degree" class="col-sm-2 col-form-label">درجةالحديث</label>
            <input type="text" name="degree"  class="form-control py-3" id="degree" value="{{$hadith->degree}}">
        </div>
        <div class="row mb-4">
            <label for="cluster_id" class="col-sm-2 col-form-label"> المستوى التابع له الحديث</label>
            <input type="text" name="cluster_id" class="form-control py-3" id="cluster_id" value="{{$hadith->cluster_id}}">
        </div>
        <button type="submit" class="btn btn-primary">حفظ الحديث</button>
        </form>

</div>
@endsection
