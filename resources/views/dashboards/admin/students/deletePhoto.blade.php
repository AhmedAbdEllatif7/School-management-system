<!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete_img{{$image->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('Students_trans.Delete_attachment')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('students.delete.photo')}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="fileName" value="{{$image->filename}}">
                    <input type="hidden" name="studentEmail" value="{{$student->email}}">
                    <input type="hidden" name="studentId" value="{{$student->id}}">

                    <div class="text-center">
                        @if($student->images->isNotEmpty())
                            <img src="{{ asset('attachments/students/' . $student->email . '/' . $image->filename) }}" alt="Teacher Image" class="img-fluid" style="max-width: 200px; display: inline-block;">
                        @else
                            <p>No image available for this student.</p>
                        @endif
                    </div>
                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('Students_trans.Delete_attachment_tilte')}}</h5>
                    <input type="text" name="filename" readonly value="{{$image->filename}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('Students_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
