            <!-- استعادة مجموعة صفوف -->
            <div class="modal fade" id="revert_all_selected" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('students_trans.revert_seletecd_promotion')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                <form action="{{route('revert.selected.promotions')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        {{trans('students_trans.sure_revert_seleted')}}
                        <input class="text" type="hidden" id="revert_seleted_id" name="revert_seleted_id" value=''>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                        <button  class="btn btn-warning">{{trans('Students_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
