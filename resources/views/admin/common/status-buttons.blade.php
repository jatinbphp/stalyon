@if ($status == "active")
    <div class="btn-group-horizontal" id="assign_remove_{{$id}}">
        {!! Form::button('<span class="ladda-label">Active</span>', [
            'class' => 'btn btn-success assign_unassign ladda-button',
            'id' => 'remove',
            'data-style' => 'slide-left',
            'data-url' => route('common.changestatus'),
            'data-id' => $id,
            'type' => 'button',
            'data-type' => 'unassign',
            'data-table_name' => $table_name
        ]) !!}
    </div>
    <div class="btn-group-horizontal" id="assign_add_{{$id}}" style="display: none">
        {!! Form::button('<span class="ladda-label">In Active</span>', [
            'class' => 'btn btn-danger assign_unassign ladda-button',
            'data-style' => 'slide-left',
            'data-id' => $id,
            'data-url' => route('common.changestatus'),
            'type' => 'button',
            'data-type' => 'assign',
            'data-table_name' => $table_name
        ]) !!}
    </div>
@else
    <div class="btn-group-horizontal" id="assign_add_{{$id}}">
        {!! Form::button('<span class="ladda-label">In Active</span>', [
            'class' => 'btn btn-danger assign_unassign ladda-button',
            'data-style' => 'slide-left',
            'data-id' => $id,
            'data-url' => route('common.changestatus'),
            'type' => 'button',
            'data-type' => 'assign',
            'data-table_name' => $table_name
        ]) !!}
    </div>
    <div class="btn-group-horizontal" id="assign_remove_{{$id}}" style="display: none">
        {!! Form::button('<span class="ladda-label">Active</span>', [
            'class' => 'btn btn-success assign_unassign ladda-button',
            'id' => 'remove',
            'data-id' => $id,
            'data-style' => 'slide-left',
            'data-url' => route('common.changestatus'),
            'type' => 'button',
            'data-type' => 'unassign',
            'data-table_name' => $table_name
        ]) !!}
    </div>
@endif


@section('jquery')
<script>
   
        $('.assign_unassign').on('click', function(event){

            event.preventDefault(); // Prevent default form submission

            var url = $(this).data('url');
            var id = $(this).data('id');
            var type = $(this).data('type');
            var table_name = $(this).data('table_name');

            $.ajax({
                url: url,
                type: "post",
                data: {
                    'id': id,
                    'type': type,
                    'table_name': table_name,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    alert('success');
                    l.stop(); // Stop Ladda spinner on success

                    // Update UI based on response
                    if (type == 'unassign') {
                        $('#assign_remove_'+id).hide();
                        $('#assign_add_'+id).show();
                    } else {
                        $('#assign_remove_'+id).show();
                        $('#assign_add_'+id).hide();
                    }
                },
                error: function(xhr, status, error){
                    console.error(error); // Log any errors to the console
                }
            });
        });
 
     
</script>
@endsection
