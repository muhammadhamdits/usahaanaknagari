@extends('../layout/app')

@section('head')
{!! $map['js'] !!}
@endsection

@section('content')
<div class="row">
    <section class="col-lg-12 connectedSortable">
        <div class="card">
            <div class="card-body">
                {!! $map['html'] !!}
            </div>
        </div>
    </section>
</div>
@endsection
