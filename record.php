<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoMo Payment Form</title>
    <script>
        let payments = [];

        function addPayment(event) {
            event.preventDefault();
            const form = event.target;
            const payment = {
                id: Date.now(),
                name: form.name.value,
                amount: form.amount.value,
                date: new Date().toLocaleString()
            };
            payments.push(payment);
            form.reset();
            displayPayments();
        }

        function displayPayments() {
            const tableBody = document.getElementById('paymentTableBody');
            tableBody.innerHTML = '';
            payments.forEach((payment) => {
                const row = tableBody.insertRow();
                row.insertCell(0).innerText = payment.name;
                row.insertCell(1).innerText = payment.amount;
                row.insertCell(2).innerText = payment.date;
                const deleteCell = row.insertCell(3);
                const deleteButton = document.createElement('button');
                deleteButton.innerText = 'Delete';
                deleteButton.onclick = () => deletePayment(payment.id);
                deleteCell.appendChild(deleteButton);
            });
        }

        function deletePayment(id) {
            payments = payments.filter(payment => payment.id !== id);
            displayPayments();
        }

        function filterPayments() {
            const filter = document.getElementById('filterInput').value.toLowerCase();
            const tableBody = document.getElementById('paymentTableBody');
            Array.from(tableBody.rows).forEach(row => {
                const name = row.cells[0].innerText.toLowerCase();
                if (name.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</head>
<body>
    <h1>MoMo Payment Form</h1>
    <form onsubmit="addPayment(event)">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required>
        <button type="submit">Submit</button>
    </form>
    <input type="text" id="filterInput" oninput="filterPayments()" placeholder="Filter by name">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="paymentTableBody"></tbody>
    </table>
</body>
</html>