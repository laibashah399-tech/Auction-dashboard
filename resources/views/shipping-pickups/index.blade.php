@extends('layouts.app')

@section('content')

<style>
    .shipping-page {
        background: #f6f8fb;
        min-height: calc(100vh - 70px);
        padding: 28px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
    }

    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: #172033;
        margin: 0;
    }

    .page-subtitle {
        color: #7b8496;
        margin: 6px 0 0;
        font-size: 14px;
    }

    .btn-add {
        background: #2563eb;
        color: white;
        border: none;
        padding: 11px 18px;
        border-radius: 9px;
        font-weight: 600;
        text-decoration: none;
        transition: .2s;
    }

    .btn-add:hover {
        background: #1d4ed8;
        color: white;
        transform: translateY(-1px);
    }

    /* Statistics */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 26px;
    }

    .stat-card {
        background: white;
        border: 1px solid #e9edf3;
        border-radius: 14px;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .04);
    }

    .stat-info small {
        color: #8a93a3;
        font-size: 13px;
        font-weight: 500;
    }

    .stat-info h3 {
        margin: 7px 0 0;
        font-size: 25px;
        font-weight: 700;
        color: #172033;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .blue {
        background: #eaf2ff;
        color: #2563eb;
    }

    .orange {
        background: #fff4df;
        color: #f59e0b;
    }

    .purple {
        background: #f2eaff;
        color: #7c3aed;
    }

    .green {
        background: #e8f8ef;
        color: #16a34a;
    }

    .cyan {
        background: #e6f8fb;
        color: #0891b2;
    }

    .red {
        background: #feecec;
        color: #dc2626;
    }

    /* Main Card */

    .records-card {
        background: white;
        border: 1px solid #e9edf3;
        border-radius: 15px;
        box-shadow: 0 3px 14px rgba(15, 23, 42, .04);
        overflow: hidden;
    }

    .records-header {
        padding: 20px 22px;
        border-bottom: 1px solid #edf0f4;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .records-title {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
        color: #172033;
    }

    .records-count {
        color: #8a93a3;
        font-size: 13px;
        margin-top: 4px;
    }

    .search-box {
        width: 230px;
        border: 1px solid #e0e5ec;
        border-radius: 8px;
        padding: 9px 12px;
        outline: none;
        font-size: 13px;
    }

    .search-box:focus {
        border-color: #2563eb;
    }

    /* Table */

    .table-container {
        overflow-x: auto;
    }

    .shipping-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .shipping-table thead {
        background: #f8fafc;
    }

    .shipping-table th {
        padding: 13px 18px;
        text-align: left;
        color: #7b8496;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        border-bottom: 1px solid #edf0f4;
    }

    .shipping-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #f0f2f5;
        color: #374151;
        font-size: 13px;
        vertical-align: middle;
    }

    .shipping-table tbody tr {
        transition: .15s;
    }

    .shipping-table tbody tr:hover {
        background: #fafcff;
    }

    .record-id {
        color: #2563eb;
        font-weight: 700;
    }

    .bidder-name {
        font-weight: 600;
        color: #202938;
    }

    .lot-number {
        background: #f1f5f9;
        padding: 5px 9px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        color: #475569;
    }

    .shipping-type {
        color: #64748b;
        font-weight: 500;
    }

    /* Status */

    .status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-pending {
        background: #fff7e6;
        color: #d97706;
    }

    .status-processing {
        background: #eef2ff;
        color: #4f46e5;
    }

    .status-shipped {
        background: #eaf4ff;
        color: #2563eb;
    }

    .status-ready {
        background: #f3eefe;
        color: #7c3aed;
    }

    .status-delivered {
        background: #eaf8ef;
        color: #16a34a;
    }

    .status-default {
        background: #f1f5f9;
        color: #64748b;
    }

    .cost {
        font-weight: 700;
        color: #172033;
    }

    /* Actions */

    .action-buttons {
        display: flex;
        gap: 7px;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 13px;
        transition: .2s;
    }

    .view-btn {
        background: #eef5ff;
        color: #2563eb;
    }

    .edit-btn {
        background: #fff7e8;
        color: #d97706;
    }

    .action-btn:hover {
        transform: translateY(-1px);
    }

    /* Empty */

    .empty-state {
        text-align: center;
        padding: 55px 20px;
    }

    .empty-icon {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: #eef4ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 23px;
    }

    .empty-state h5 {
        color: #172033;
        margin-bottom: 6px;
    }

    .empty-state p {
        color: #8a93a3;
        font-size: 13px;
    }

    /* Pagination */

    .pagination-wrapper {
        padding: 16px 20px;
        border-top: 1px solid #edf0f4;
    }

    /* Responsive */

    @media (max-width: 1100px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 650px) {
        .shipping-page {
            padding: 18px;
        }

        .page-header {
            align-items: flex-start;
            gap: 15px;
            flex-direction: column;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .records-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 14px;
        }

        .search-box {
            width: 100%;
        }
    }
</style>


<div class="shipping-page">

    {{-- Page Header --}}
    <div class="page-header">

        <div>
            <h1 class="page-title">
                Shipping & Pickup
            </h1>

            <p class="page-subtitle">
                Manage deliveries, shipments and customer pickups
            </p>
        </div>

        <a href="{{ route('shipping-pickups.create') }}" class="btn-add">
            + Add Record
        </a>

    </div>


    {{-- Statistics --}}
    <div class="stats-grid">

        {{-- Total --}}
        <div class="stat-card">
            <div class="stat-info">
                <small>Total Records</small>
                <h3>{{ $totalRecords }}</h3>
            </div>

            <div class="stat-icon blue">
                ⇄
            </div>
        </div>


        {{-- Pending --}}
        <div class="stat-card">
            <div class="stat-info">
                <small>Pending</small>
                <h3>{{ $pending }}</h3>
            </div>

            <div class="stat-icon orange">
                ◷
            </div>
        </div>


        {{-- Processing --}}
        <div class="stat-card">
            <div class="stat-info">
                <small>Processing</small>
                <h3>{{ $processing }}</h3>
            </div>

            <div class="stat-icon purple">
                ↻
            </div>
        </div>


        {{-- Shipped --}}
        <div class="stat-card">
            <div class="stat-info">
                <small>Shipped</small>
                <h3>{{ $shipped }}</h3>
            </div>

            <div class="stat-icon cyan">
                ↑
            </div>
        </div>


        {{-- Ready --}}
        <div class="stat-card">
            <div class="stat-info">
                <small>Ready for Pickup</small>
                <h3>{{ $readyForPickup }}</h3>
            </div>

            <div class="stat-icon purple">
                ✓
            </div>
        </div>


        {{-- Delivered --}}
        <div class="stat-card">
            <div class="stat-info">
                <small>Delivered</small>
                <h3>{{ $delivered }}</h3>
            </div>

            <div class="stat-icon green">
                ✓
            </div>
        </div>


        {{-- Shipping Cost --}}
        <div class="stat-card">
            <div class="stat-info">
                <small>Total Shipping Cost</small>
                <h3>
                    {{ number_format($totalShippingCost, 2) }}
                </h3>
            </div>

            <div class="stat-icon red">
                $
            </div>
        </div>

    </div>


    {{-- Records --}}
    <div class="records-card">

        <div class="records-header">

            <div>
                <h3 class="records-title">
                    Shipping Records
                </h3>

                <div class="records-count">
                    Showing all shipping & pickup transactions
                </div>
            </div>

            <input
                type="text"
                class="search-box"
                placeholder="Search records..."
                id="shipmentSearch"
            >

        </div>


        <div class="table-container">

            <table class="shipping-table" id="shipmentTable">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Bidder</th>
                        <th>Lot</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Shipping Cost</th>
                        <th>Actions</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($shipments as $shipment)

                        @php
                            $statusClass = match($shipment->status) {
                                'pending' => 'status-pending',
                                'processing' => 'status-processing',
                                'shipped' => 'status-shipped',
                                'ready_for_pickup' => 'status-ready',
                                'delivered' => 'status-delivered',
                                default => 'status-default',
                            };
                        @endphp

                        <tr>

                            <td>
                                <span class="record-id">
                                    #{{ $shipment->id }}
                                </span>
                            </td>


                            <td>
                                <span class="bidder-name">
                                    {{ $shipment->bidder->name ?? 'N/A' }}
                                </span>
                            </td>


                            <td>
                                <span class="lot-number">
                                    {{ $shipment->lot->lot_number ?? 'N/A' }}
                                </span>
                            </td>


                            <td>
                                <span class="shipping-type">
                                    {{ ucfirst(str_replace('_', ' ', $shipment->type ?? 'N/A')) }}
                                </span>
                            </td>


                            <td>

                                <span class="status {{ $statusClass }}">

                                    <span class="status-dot"></span>

                                    {{ ucfirst(str_replace('_', ' ', $shipment->status)) }}

                                </span>

                            </td>


                            <td>

                                <span class="cost">
                                    {{ number_format($shipment->shipping_cost ?? 0, 2) }}
                                </span>

                            </td>


                            <td>

                                <div class="action-buttons">

                                    <a
                                        href="{{ route('shipping-pickups.show', $shipment) }}"
                                        class="action-btn view-btn"
                                        title="View"
                                    >
                                        👁
                                    </a>


                                    <a
                                        href="{{ route('shipping-pickups.edit', $shipment) }}"
                                        class="action-btn edit-btn"
                                        title="Edit"
                                    >
                                        ✎
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        ⇄
                                    </div>

                                    <h5>No Shipping Records</h5>

                                    <p>
                                        There are currently no shipping or pickup records.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($shipments->hasPages())

            <div class="pagination-wrapper">
                {{ $shipments->links() }}
            </div>

        @endif

    </div>

</div>


<script>

document.getElementById('shipmentSearch').addEventListener('keyup', function () {

    let searchValue = this.value.toLowerCase();

    let rows = document.querySelectorAll('#shipmentTable tbody tr');

    rows.forEach(function (row) {

        let text = row.innerText.toLowerCase();

        row.style.display =
            text.includes(searchValue) ? '' : 'none';

    });

});

</script>

@endsection

