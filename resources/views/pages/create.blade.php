@extends("layouts/default")

@section("content")
    @if(isset($flash))
        <div class="alert alert-{{$flash->type}} alert-dismissible fade show" role="alert">
            {{$flash->message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="/add-product" method="post">
        {!! csrf_field() !!}
        <input type="text" class="form-control" placeholder="Termék link" name="slug">
        <button class="btn-success btn">Mentés</button>
    </form>
@endsection
