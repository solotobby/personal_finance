<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Confirm Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="POST" action="{{ url('make-payment') }}">
                        @csrf

                        {{-- Date Input --}}
                        <div class="form-group mb-3">
                            <label for="date" class="col-form-label">Date</label>
                            <input class="form-control @error('date') is-invalid @enderror"
                                type="month" id="date" name="date"
                                min="2021-01"
                                value="{{ old('date', date('Y-m')) }}" required>
                            <div id="dateHelp" class="form-text">Select Payment Month</div>
                            @error('date')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        {{-- Amount --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="amount" class="form-control" id="amount"
                                    value="{{ old('amount', $staff->salary) }}" required readonly>
                                <label for="amount" style="color: white;">{{ __('Amount (NGN)') }}</label>
                            </div>
                        </div>

                        {{-- Staff Name --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name', $staff->name) }}" required readonly>
                                <label for="name" style="color: white;">{{ __('Name') }}</label>
                            </div>
                        </div>

                        {{-- Staff ID --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="staff_id" class="form-control" id="staff_id"
                                    value="{{ old('staff_id', $staff->staff_id) }}" required readonly>
                                <label for="staff_id" style="color: white;">{{ __('Staff ID') }}</label>
                            </div>
                        </div>

                        {{-- Bank Name --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="bank_name" class="form-control" id="bank_name"
                                    value="{{ old('bank_name', $staff->bank_name) }}" required readonly>
                                <label for="bank_name" style="color: white;">{{ __('Bank Name') }}</label>
                            </div>
                        </div>

                        {{-- Account Number --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="account_number" class="form-control" id="account_number"
                                    value="{{ old('account_number', $staff->account_number) }}" required readonly>
                                <label for="account_number" style="color: white;">{{ __('Account Number') }}</label>
                            </div>
                        </div>

                        {{-- Account Name --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="account_name" class="form-control" id="account_name"
                                    value="{{ old('account_name', $staff->account_name) }}" required readonly>
                                <label for="account_name" style="color: white;">{{ __('Account Name') }}</label>
                            </div>
                        </div>

                        {{-- Payer Name --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="payer_name" class="form-control" id="payer_name"
                                    value="{{ old('payer_name', Auth::user()->hasBusinessAccount() ? Auth::user()->businesses->first()->business_name : Auth::user()->name) }}"
                                    required readonly>
                                <label for="payer_name" style="color: white;">{{ __('Payer Name') }}</label>
                            </div>
                        </div>

                        {{-- Narration (Editable) --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="narration" class="form-control" id="narration"
                                    value="{{ old('narration') }}" required>
                                <label for="narration" style="color: white;">{{ __('Narration') }}</label>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-info m-b-xs">{{ __('Make Payment') }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
