<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table #06</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            margin: 50px auto;
            max-width: 900px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead {
            background-color: #94a58b;
            color: white;
        }
        tbody tr {
            border-bottom: 1px solid #ddd;
        }
        tbody td {
            padding: 10px;
            vertical-align: middle;
        }
        .product-info {
            display: flex;
            align-items: center;
        }
        .product-info img {
            width: 50px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h3 class="text-center">Table #06</h3>
        <p class="text-center">Product List</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Product"></td>
                    <td>Sneakers Shoes 2020 For Men</td>
                    <td>Footwear</td>
                    <td>25</td>
                    <td>$44.99</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Product"></td>
                    <td>Casual Shoes 2021</td>
                    <td>Footwear</td>
                    <td>15</td>
                    <td>$30.99</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Product"></td>
                    <td>Running Shoes Pro</td>
                    <td>Sportswear</td>
                    <td>10</td>
                    <td>$35.50</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Product"></td>
                    <td>Formal Leather Shoes</td>
                    <td>Formal</td>
                    <td>20</td>
                    <td>$76.99</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Product"></td>
                    <td>Sports Sneakers</td>
                    <td>Sportswear</td>
                    <td>30</td>
                    <td>$40.00</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>