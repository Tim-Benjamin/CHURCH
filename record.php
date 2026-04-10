<div>
    <h3>MoMo Payments</h3>
    <form id="momoPaymentForm">
        <input type="text" name="name" placeholder="Name" required />
        <input type="text" name="phone_number" placeholder="Phone Number" required />
        <input type="number" name="amount" placeholder="Amount" required />
        <input type="text" name="transaction_id" placeholder="Transaction ID" required />
        <select name="payment_type" required>
            <option value="">Select Payment Type</option>
            <option value="Tithe">Tithe</option>
            <option value="Contribution">Contribution</option>
            <option value="Offering">Offering</option>
        </select>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="date" name="date" required />
        <button type="submit">Submit</button>
    </form>

    <div>
        <h4>All MoMo Payments</h4>
        <table id="momoPaymentsTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Amount</th>
                    <th>Transaction ID</th>
                    <th>Payment Type</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Payment records will be dynamically inserted here -->
            </tbody>
        </table>
        <input type="date" id="startDate" />
        <input type="date" id="endDate" />
        <select id="filterPaymentType">
            <option value="">All types</option>
            <option value="Tithe">Tithe</option>
            <option value="Contribution">Contribution</option>
            <option value="Offering">Offering</option>
        </select>
        <button id="filterBtn">Filter</button>
    </div>
</div>
<script>
    // JavaScript for form submission, table population, filtering, and error handling
    document.getElementById('momoPaymentForm').onsubmit = function(event) {
        event.preventDefault();
        // Handle form submission
        // Show success or error messages accordingly
    };

    document.getElementById('filterBtn').onclick = function() {
        // Handle filtering of the table based on date range and payment type
    };
</script>
