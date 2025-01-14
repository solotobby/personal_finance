@section('scripts')
<script>
    $(document).ready(function() {
        // When category is changed, load types dynamically
        $('#category_id').change(function() {
            var categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: '/get-types/' + categoryId, // Ensure this route is correct
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#type_id').empty();
                        $('#type_id').append('<option value="">Select One</option>'); // Add default option

                        // Add options for types
                        $.each(data, function(key, value) {
                            $('#type_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function() {
                        alert('Error fetching types.');
                    }
                });
            } else {
                $('#type_id').empty();
                $('#type_id').append('<option value="">Select One</option>');
            }
        });
    });
</script>
@endsection

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="POST" action="{{ url('transactions') }}">
                        @csrf

                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="amount" placeholder="Amount" class="form-control" id="recipient-name" required>
                                <label for="recipient-name">{{ __('Amount') }}</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control" id="recipient-name" required>
                                <label for="recipient-name">{{ __('Name') }}</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach($categories as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                <label for="recipient-name">{{ __('Transaction Category') }}</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <select name="type_id" id="type_id" class="form-control" required>
                                    <option value="">Select One</option>
                                </select>
                                <label for="recipient-name">{{ __('Transaction Type') }}</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="datetime-local" name="date" class="form-control" id="recipient-name" required>
                                <label for="recipient-name" class="col-form-label">{{ __('Pick Date') }}</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form">
                                <label for="message-text">{{ __('Description') }}</label>
                                <textarea class="form-control" name="description" id="message-text" required></textarea>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-info m-b-xs">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
