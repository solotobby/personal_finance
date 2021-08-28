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
                                <select name="category_id" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach($categories as $cate)
                                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endforeach
                                </select>
                                <label for="recipient-name">{{ __('Type') }}</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="datetime-local" name="transaction_date" class="form-control" id="recipient-name" required>
                                <label for="recipient-name" class="col-form-label">{{ __('Pick Date') }}</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" name="description" id="message-text" required></textarea>
                                <label for="message-text">{{ __('Message:') }}</label>
                            </div>
                        </div>
                            
                        <div class="d-grid">
                        <button type="submit" class="btn btn-info m-b-xs">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>