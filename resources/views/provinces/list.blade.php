@extends('master')
@section('title', 'Provinces-List')
@section('content')

@section('head-script')
    @parent
@endsection

<div class="bd-example">
    <div class="card text-dark bg-light mb-3">
        <div class="card-header">Header</div>
        <div class="card-body">
            <h5 class="card-title">Light card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>

            <div class="row">
                <div class="col">
                    <div class="container">
                        <div class="input-group mb-3">
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <a id="add-provine" class="btn btn-outline-primary" type="button"
                                   data-bs-toggle="modal" data-bs-target="#add-province-modal">
                                    <i class="bi bi-plus-lg" aria-hidden="true"></i>
                                    Add province
                                </a>
                                <a href="{{ route('provinces.showDeleted') }}" id=""
                                   class="btn btn-outline-primary" type="button">
                                    <i class="bi bi-archive" aria-hidden="true"></i>
                                    Deleted Provinces
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                </div>
                <div class="col">
                    <div class="container">
                        <div class="input-group mb-3">
                            <input id="myInputTextField" type="text" class="form-control" placeholder="Search here..."
                                   aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button id="searchSubmit" class="btn btn-outline-secondary" type="button"
                                    id="button-addon2">
                                <i class="bi bi-search" aria-hidden="true"></i>
                                Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <div class="container">
                    <div class="container-fluid">
                        @include('partials.flash-message')
                    </div>

                    <table id="dataTable" class="table table-hover table-bordered">
                        <thead class="table-primary">
                        <tr>
                            <th class="text-center align-middle" scope="col">M??</th>
                            <th class="text-center align-middle" scope="col">T??n t???nh th??nh</th>
                            <th class="text-center align-middle" scope="col">Tr???ng th??i</th>
                            <th class="text-center align-middle" scope="col">Ng??y t???o</th>
                            <th class="text-center align-middle" scope="col">Ng??y s???a</th>
                            <th class="text-center align-middle" scope="col">Ng??y xo??</th>
                            <th class="text-center align-middle" scope="col">Ch???c n??ng</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($provinces as $province)
                            <tr>
                                <td class="text-center align-middle">{{ $province->province_id }}</td>
                                <td class="align-middle">{{ $province->province_name }}</td>
                                <td class="text-center align-middle">
                                    @switch($province->province_active_status )
                                        @case(1)
                                        <i class="bi bi-unlock text-primary"></i>
                                        @break
                                        @case(0)
                                        <i class="bi bi-lock text-danger"></i>
                                        @break
                                    @endswitch
                                </td>
                                <td class="align-middle text-center">{{ $province->created_at }}</td>
                                <td class="align-middle text-center">{{ $province->updated_at }}</td>
                                <td class="align-middle text-center">{{ $province->deleted_at }}</td>
                                <td class="align-middle text-center">
                                    <a class="btn btn-outline-primary" href="{{route('provinces.edit', $province->province_id)}}">
                                        <i class="bi bi-pencil-square"></i>
                                        S???a
                                    </a>

                                    <a class="btn btn-outline-danger" href="{{route('provinces.delete', $province->province_id)}}" onclick="return confirm('Ch???c l?? xo??')"
                                       href="">
                                        <i class="bi bi-lock"></i>
                                        Kho??
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="table-primary">
                        <tr>
                            <th class="text-center align-middle" scope="col">M??</th>
                            <th class="text-center align-middle" scope="col">T??n t???nh th??nh</th>
                            <th class="text-center align-middle" scope="col">Tr???ng th??i</th>
                            <th class="text-center align-middle" scope="col">Ng??y t???o</th>
                            <th class="text-center align-middle" scope="col">Ng??y s???a</th>
                            <th class="text-center align-middle" scope="col">Ng??y xo??</th>
                            <th class="text-center align-middle" scope="col">Ch???c n??ng</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@include('provinces.add')

@section('footer-script')
    @parent
@endsection

@section('page-script')
    <script>
        $(document).ready(function () {
            oTable = $('#dataTable').DataTable({
                "dom": '<"top">lrt<"bottom"pi><"clear">',
                "order": [[3, "desc"], [4, "desc"], [5, "desc"]]
            });

            $('#searchSubmit').on('click', function () {
                //alert($("#myInputTextField").val());
                oTable.search($("#myInputTextField").val()).draw();
            });

            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function () {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()

            $('#add-province-modal').on('hidden.bs.modal', function (e) {
                $(this)
                    .find("input,textarea")
                    .val('')
                    .end()
                    .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
            })
        });
    </script>
@endsection

@endsection

