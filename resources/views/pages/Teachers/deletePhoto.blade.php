<!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete_img{{$image->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('teacher_trans.delete')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('delete.teacher.photo')}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="id" value="{{$image->id}}">

                    <input type="hidden" name="teacher_name" value="{{$image->imageable->name}}">
                    <input type="hidden" name="teacher_id" value="{{$image->imageable->id}}">

                    <input type="text" readonly value="{{trans('Students_trans.Delete_attachment_tilte')}}" class="form-control">

                    @if($teacher->images->isNotEmpty())
                        <img src="{{ asset('attachments/teachers/' . $teacher->email . '/' . $image->filename) }}" alt="Teacher Image" 
                        style="max-width:200px">
                    @else
                        <p>No image available for this teacher.</p>
                    @endif

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('Students_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
