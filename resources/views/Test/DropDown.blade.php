<!doctype html>
<html lang="en">

<head>
    <title>  Dropdown </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-sm-12 col-12 m-auto">
                <div class="card shadow">
                    <div class="card-header">
                        
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label> Department </label>
                            <select class="form-control" name="department" id="department">
                                <option value="" selected disabled> Select </option>
                                @forelse ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }} </option>
                                @empty
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Division </label>
                            <select class="form-control" name="division" id="division">
                                <option> Select </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/script.js') }}"></script>
</body>

<script>
$("#language").change(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    const langId = $(this).val();

    $.ajax({
        type: "POST",
        url: "divisions",
        data: {
            Depart_ID: Depart_ID,
        },
        success: function (result) {
            $("#division").empty();
            $("#division").append(
                '<option selected disabled value="">Select</option>'
            );

            if (result && result?.status === "success") {
                result?.data?.map((framework) => {
                    const divisions = `<option value='${framework?.id}'> ${division?.name} </option>`;
                    $("#division").append(frameworks);
                });
            }
        },
        error: function (result) {
            console.log("error", result);
        },
    });
});
</script>
</html>