            <!-- حذف مجموعة صفوف -->
            <div class="modal fade" id="delete_selected" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('main_trans.delete_selected')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                <form action="{{route('graduation.destroy', 'error')}}" method="POST">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="modal-body">
                        {{trans('main_trans.confirmation_delete_selected_students')}}
                        <input class="text" type="hidden" id="delete_selected_id" name="delete_selected_id" value="">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{trans('main_trans.cancel')}}</button>
                        <button type="submit" class="btn btn-danger">{{trans('main_trans.delete')}}</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
