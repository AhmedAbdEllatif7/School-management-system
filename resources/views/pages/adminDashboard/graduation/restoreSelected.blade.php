            <!-- استعادة مجموعة صفوف -->
            <div class="modal fade" id="restore_selected" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('students_trans.restore_from_graduation')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                <form action="{{route('restored.selected.from.graduation')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        {{trans('students_trans.sure_restore_seleted')}}
                        <input class="text" type="hidden" id="restore_selected_id" name="restore_selected_id" value="">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{trans('main_trans.cancel')}}</button>
                        <button type="submit" class="btn btn-warning">{{trans('students_trans.restore')}}</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
