
{{-- get classrooms of selected grade --}}
<script>
    $(document).ready(function () {
        $('select[name="from_grade_id"]').on('change', function () {
            var from_grade_id = $(this).val();
            if (from_grade_id) {
                $.ajax({
                    url: "{{ URL::to('get-classrooms') }}/" + from_grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="from_classroom_id"]').empty();
                        $('select[name="from_classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="from_classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


{{-- get sections of selected classroom --}}
<script>
    $(document).ready(function () {
        $('select[name="from_classroom_id"]').on('change', function () {
            var from_classroom_id = $(this).val();
            if (from_classroom_id) {
                $.ajax({
                    url: "{{ URL::to('get-sections') }}/" + from_classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="from_section_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="from_section_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>






{{--for new promotion --}}

{{-- get classrooms of selected grade --}}
<script>
    $(document).ready(function () {
        $('select[name="to_grade_id"]').on('change', function () {
            var to_grade_id = $(this).val();
            if (to_grade_id) {
                $.ajax({
                    url: "{{ URL::to('get-new-classrooms') }}/" + to_grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="to_classroom_id"]').empty();
                        $('select[name="to_classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="to_classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>







{{--for new promotion --}}

{{-- get sections of selected classroom --}}
<script>
    $(document).ready(function () {
        $('select[name="to_classroom_id"]').on('change', function () {
            var to_classroom_id = $(this).val();
            if (to_classroom_id) {
                $.ajax({
                    url: "{{ URL::to('get-new-sections') }}/" + to_classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="to_section_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="to_section_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
