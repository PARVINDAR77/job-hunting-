@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="mb-4">
    <h2>Dashboard</h2>
    <p class="text-muted">
        Welcome back! Here's what's happening with your store.
    </p>
</div>


<!-- Dashboard Cards -->

<div class="row g-4">

    <div class="col-md-3">

        <div class="dashboard-card">

            <p class="text-muted mb-1">
                Total Orders
            </p>

            <h2>125</h2>

            <small class="text-success">
                ↑ 12% this month
            </small>

        </div>

    </div>


    <div class="col-md-3">

        <div class="dashboard-card">

            <p class="text-muted mb-1">
                Total Products
            </p>

            <h2>250</h2>

            <small class="text-success">
                ↑ 8 new products
            </small>

        </div>

    </div>


    <div class="col-md-3">

        <div class="dashboard-card">

            <p class="text-muted mb-1">
                Total Users
            </p>

            <h2>1,250</h2>

            <small class="text-success">
                ↑ 15% this month
            </small>

        </div>

    </div>


    <div class="col-md-3">

        <div class="dashboard-card">

            <p class="text-muted mb-1">
                Total Revenue
            </p>

            <h2>₹85,500</h2>

            <small class="text-success">
                ↑ 20% this month
            </small>

        </div>

    </div>

</div>


<!-- Recent Orders -->

<div class="dashboard-card mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4>Recent Orders</h4>

        <a href="#" class="btn btn-primary">
            View All
        </a>

    </div>


    <div class="table-responsive">

        <table class="table table-hover">

            <thead>

                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td>#1001</td>
                    <td>Rahul</td>
                    <td>iPhone 15</td>
                    <td>₹70,000</td>
                    <td>
                        <span class="badge bg-success">
                            Completed
                        </span>
                    </td>
                </tr>


                <tr>
                    <td>#1002</td>
                    <td>Amit</td>
                    <td>Gaming Headset</td>
                    <td>₹3,500</td>
                    <td>
                        <span class="badge bg-warning">
                            Pending
                        </span>
                    </td>
                </tr>


                <tr>
                    <td>#1003</td>
                    <td>Priya</td>
                    <td>Women's Jacket</td>
                    <td>₹2,999</td>
                    <td>
                        <span class="badge bg-info">
                            Processing
                        </span>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection