@extends('layouts.backend')

@section('content')
<div class="content">
  <h2>إستيراد قائمة الطبلة</h2>
  <form action="{{ route('users-import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label>ملف Excel</label>
      <div class="custom-file">
        <input type="file" class="custom-file-input"
          data-toggle="custom-file-input" id="users_excel" name="users_excel"
          accept=".xls,.xlsx">
        <label class="custom-file-label" for="users_excel">اختر ملف</label>
      </div>
    </div>
    <input type="submit" class="btn btn-primary" value="إرسال">
  </form>
</div>

@endsection
