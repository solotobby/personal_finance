@extends('layouts.master')
@section('body-class', '')
@section('styles')
        <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="page-container">
    @include('layouts.components.sidebar', ['page' => 'Staff'])

    <div class="page-content">
        @include('layouts.components.page-header', ['title' => 'Loans'])
        <div class="main-wrapper">

            <div class="row">
               
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="col-lg-3"></div> --}}
                            <div class="col-lg-12">
                                <div class="alert alert-info">
                                    Select a staff to offer Loan
                                </div>
                                @if(session('success'))
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success">
                                                    <p>{{ session('success') }}</p>
                                                    <a class="close" href="#"></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(session('error'))
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger">
                                                    <p>{{ session('error') }}</p>
                                                    <a class="close" href="#"></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                <form method="POST" action="{{ route('process.staff.loan') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="staff_id" class="col-form-label">Staff Name</label>
                                    {{-- <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required > --}}
                                    <select class="form-control" name="staff_id" id="staff_id" required> 
                                        <option value="">Select a Staff</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->id }}">{{ $staff->account_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="amount" class="col-form-label">Amount</label>
                                    <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required >
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="amount" class="col-form-label">Duration</label>
                                    <select class="form-control" name="duration" id="duration" required> 
                                        <option value="">Select Duration</option>
                                            <option value="6">6 months</option>
                                            <option value="12">12 months</option>
                                            <option value="18">18 months</option>
                                            <option value="24">24 months</option>
                                            <option value="36">36 months</option>
                                    </select>
                                    {{-- <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required >
                                   --}}
                                    @error('duration')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror 
                                </div>

                                <div class="form-group">
                                    <label for="amount" class="col-form-label">Monthly Repayment</label>
                                    <input id="repayment" type="text" class="form-control @error('amount') is-invalid @enderror" name="repayment_amount" value="{{ old('repayment_amount') }}" required >
                                    @error('repayment_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                
                                <div id="repaymentSchedule" class="mt-3 mb-3"></div>
                               

                                <div class="form-group mt-3">
                                   <button type="submit" class="btn btn-primary">
                                        Submit
                                   </button>
                                </div>

                            </form>

                           
                            </div>
                            {{-- <div class="col-lg-3"></div> --}}
                        </div>
                    </div>
              
            </div>

        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



@endsection

@section('scripts')

<script>
    $(document).ready(function(){ 

        $('#duration').change(function(){
            var duration = this.value; 
            var amount =  document.getElementById("amount").value;
            var staff_id =  document.getElementById("staff_id").value;

             // Check if amount or staff_id is empty
            if (!amount) {
                alert("Enter an Amount please.");
                return;
            }

            if (!staff_id) {
                alert("Select a Staff please.");
                return;
            }
            var repayment_amount = amount / duration;
            document.getElementById("repayment").value =  Number(repayment_amount.toFixed(1));
            console.log(repayment_amount);

            // Generate and display the repayment schedule in table format
            var repaymentScheduleDiv = document.getElementById("repaymentSchedule");
            repaymentScheduleDiv.innerHTML = "";  // Clear previous content

            // Create table
            var table = document.createElement("table");
            table.style.width = "100%";
            table.setAttribute("border", "1");

            // Create table header
            var header = table.createTHead();
            var headerRow = header.insertRow(0);
            var monthHeader = headerRow.insertCell(0);
            var amountHeader = headerRow.insertCell(1);
            monthHeader.innerHTML = "<b>Month</b>";
            amountHeader.innerHTML = "<b>Repayment Amount ($)</b>";

            // Get the current month
            var currentDate = new Date();
            var currentMonth = currentDate.getMonth();  // 0-based, 0 = January
            var currentYear = currentDate.getFullYear();

            // Add repayment schedule rows to the table
            var monthNames = ["January", "February", "March", "April", "May", "June", 
                            "July", "August", "September", "October", "November", "December"];

            for (var i = 1; i <= duration; i++) {
                // Calculate the month and year for each repayment
                var paymentMonth = (currentMonth + i) % 12;  // Wrap around for months > 11
                var paymentYear = currentYear + Math.floor((currentMonth + i) / 12);

                // Create new row
                var row = table.insertRow(i);

                // Add month/year cell
                var monthCell = row.insertCell(0);
                monthCell.textContent = `${monthNames[paymentMonth]} ${paymentYear}`;

                // Add repayment amount cell
                var amountCell = row.insertCell(1);
                amountCell.textContent = `NGN ${Number(repayment_amount.toFixed(1))}`;
            }

            // Append the table to the div
            repaymentScheduleDiv.appendChild(table);




        });
        
    });
</script>    

@endsection

