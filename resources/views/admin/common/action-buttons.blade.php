<span data-toggle="tooltip" title="Delete {{$section_title}}" data-trigger="hover">
        <button class="btn btn-sm btn-danger deleteRecord" data-id="{{$id}}" type="button" data-url="{{ url('admin/'.$section_name.'/'.$id) }}" data-section="{{$section_name}}_table">
            <i class="fa fa-trash"></i>
        </button>
    </span>

<div class="btn-group btn-group-sm">
        <a href="{{ url('admin/'.$section_name.'/'.$id.'/edit') }}" title="Edit {{$section_title}}" class="btn btn-sm btn-info tip ">
            <i class="fa fa-edit"></i>
        </a>
    </div>

@section('jquery')


@endsection