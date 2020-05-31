@extends('../layout/app')

@section('css')
<style>
.select2-selection{
    width: 100% !important;
    height: calc(2.25rem + 2px) !important;
}
.select2-selection__arrow{
    height: calc(2.25rem + 2px) !important;
    right: 8px !important;
}
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                {!! formInputRow('Nama Usaha*', 'text', 'nama', 'nama usaha', 'required', old('nama'), $errors->first('nama'), 12) !!}
                {!! formSelect('Jenis Usaha*', 'jenis_usaha_id', $jenisUsahas) !!}
                {!! formInputCol('No. HP', 'time', 'hp', 'No. HP', '', old('hp'), $errors->first('hp'), 'E-Mail', 'time', 'email', 'E-Mail', '', old('email'), $errors->first('email'), 6) !!}
                {!! formInputRow('Nama Usaha*', 'text', 'nama', 'nama usaha', 'required', old('nama'), $errors->first('nama'), 12) !!}
                {!! formText('Alamat', 'alamat', 'required', old('alamat'), $errors->first('alamat'), 12) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $("select").select2();
</script>
@endsection