<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Print Order</title>
    <link rel="stylesheet" href="css/invoice.css">
</head>
<body>
    <div class="container">

    <header class="invoice-header">
        <h1>Invoice</h1>
        <address contenteditable>
            <p>Name</p>
            <p>Addresse<br>Manhattan, NY 10031</p>
            <p>(800) 555-1234</p>
        </address>
        <span>
            <img alt="" src="/images/restopro.png"><input type="file" accept="image/*">
        </span>
    </header>
    <article>
        <h1>Recipient</h1>
            <address contenteditable>
                <p>Some Company<br>c/o Some Guy</p>
            </address>
        <table class="meta">
            <tr>
                <th><span contenteditable>Invoice #</span></th>
                <td><span contenteditable>101138</span></td>
            </tr>
            <tr>
                <th><span contenteditable>Date</span></th>
                <td class="date"><span contenteditable></span></td>
            </tr>
            <tr>
                <th><span contenteditable>Amount Due</span></th>
                <td><span id="prefix" contenteditable>$</span><span>600.00</span></td>
            </tr>
        </table>
        <table class="inventory">
            <thead>
                <tr>
                    <th><span contenteditable>Item</span></th>
                    <th><span contenteditable>Description</span></th>
                    <th><span contenteditable>Rate</span></th>
                    <th><span contenteditable>Quantity</span></th>
                    <th><span contenteditable>Price</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a class="cut"></a><span contenteditable>Front End Consultation</span></td>
                    <td><span contenteditable>Experience Review</span></td>
                    <td><span data-prefix>$</span><span contenteditable>150.00</span></td>
                    <td><span contenteditable>4</span></td>
                    <td><span data-prefix>$</span><span>600.00</span></td>
                </tr>
            </tbody>
        </table>
        <a class="add">+</a>
        <table class="balance">
            <tr>
                <th><span contenteditable>Total</span></th>
                <td><span data-prefix>$</span><span>600.00</span></td>
            </tr>
            <tr>
                <th><span contenteditable>Amount Paid</span></th>
                <td><span data-prefix>$</span><span contenteditable>0.00</span></td>
            </tr>
            <tr>
                <th><span contenteditable>Balance Due</span></th>
                <td><span data-prefix>$</span><span>600.00</span></td>
            </tr>
        </table>
    </article>
    <aside>
        <h1><span contenteditable>Additional Notes</span></h1>
        <div contenteditable>
            <p>A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>
        </div>
    </aside>
</div>
<button class="btn btn-success">Print</button>
<script src="/js/invoice.js"></script>
<script>
    (function() {
        let date = new Date().toDateString();
        let html = document.querySelector('.date');

        html.textContent = date;

        document.querySelector('button').addEventListener('click', print);

        function print() {
            window.print();
        }
    })();
</script>
</body>
</html>