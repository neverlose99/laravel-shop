@extends('layouts.admin') {{-- Sử dụng layout admin mới --}}

@section('title', 'Admin Dashboard') {{-- Đặt tiêu đề riêng cho trang này --}}

@section('content')
    {{-- Phần này sẽ được đặt vào @yield('content') trong layouts/admin.blade.php --}}
    <div class="main-content-inner">
        <div class="main-content-wrap">

            {{-- Phần Widgets ở trên --}}
            <div class="tf-section-2 mb-30">
                <div class="flex gap20 flex-wrap-mobile">
                    {{-- Cột Widget bên trái --}}
                    <div class="w-half">
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg"><i class="icon-shopping-bag"></i></div>
                                    <div>
                                        <div class="body-text mb-2">Total Orders</div>
                                        {{-- Thay bằng biến $totalOrders sau khi có logic --}}
                                        <h4>3</h4> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wg-chart-default mb-20">
                           <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg"><i class="icon-dollar-sign"></i></div>
                                    <div>
                                        <div class="body-text mb-2">Total Amount</div>
                                         {{-- Thay bằng biến $totalAmount sau khi có logic --}}
                                        <h4>$481.34</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wg-chart-default mb-20">
                           <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg"><i class="icon-shopping-bag"></i></div>
                                    <div>
                                        <div class="body-text mb-2">Pending Orders</div>
                                         {{-- Thay bằng biến $pendingOrders sau khi có logic --}}
                                        <h4>3</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wg-chart-default">
                           <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg"><i class="icon-dollar-sign"></i></div>
                                    <div>
                                        <div class="body-text mb-2">Pending Orders Amount</div>
                                         {{-- Thay bằng biến $pendingAmount sau khi có logic --}}
                                        <h4>$481.34</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Cột Widget bên phải --}}
                    <div class="w-half">
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg"><i class="icon-shopping-bag"></i></div>
                                    <div>
                                        <div class="body-text mb-2">Delivered Orders</div>
                                         {{-- Thay bằng biến $deliveredOrders sau khi có logic --}}
                                        <h4>0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="wg-chart-default mb-20">
                           <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg"><i class="icon-dollar-sign"></i></div>
                                    <div>
                                        <div class="body-text mb-2">Delivered Orders Amount</div>
                                         {{-- Thay bằng biến $deliveredAmount sau khi có logic --}}
                                        <h4>$0.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wg-chart-default mb-20">
                           <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg"><i class="icon-shopping-bag"></i></div>
                                    <div>
                                        <div class="body-text mb-2">Canceled Orders</div>
                                        {{-- Thay bằng biến $canceledOrders sau khi có logic --}}
                                        <h4>0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wg-chart-default">
                           <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg"><i class="icon-dollar-sign"></i></div>
                                    <div>
                                        <div class="body-text mb-2">Canceled Orders Amount</div>
                                        {{-- Thay bằng biến $canceledAmount sau khi có logic --}}
                                        <h4>$0.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Biểu đồ (Nếu bạn muốn thêm vào trang này) --}}
                {{-- <div class="wg-box mt-30">
                     <h5>Earnings revenue</h5>
                     <div id="line-chart-8"></div>
                </div> --}}
            </div>

            {{-- Phần Bảng Recent Orders --}}
            <div class="tf-section mb-30">
                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Recent orders</h5>
                        {{-- Link đến trang danh sách đơn hàng (cần tạo route sau) --}}
                        <div class="dropdown default">
                            <a class="btn btn-secondary dropdown-toggle" href="#"> 
                                <span class="view-all">View all</span>
                            </a>
                        </div>
                    </div>
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 80px">OrderNo</th>
                                        <th>Name</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Tax</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Order Date</th>
                                        <th class="text-center">Total Items</th>
                                        <th class="text-center">Delivered On</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Lặp qua các đơn hàng $recentOrders sau khi có logic --}}
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">Divyansh Kumar</td>
                                        <td class="text-center">1234567891</td>
                                        <td class="text-center">$172.00</td>
                                        <td class="text-center">$36.12</td>
                                        <td class="text-center">$208.12</td>
                                        <td class="text-center"><span class="badge bg-warning text-dark">ordered</span></td> {{-- Dùng badge cho status --}}
                                        <td class="text-center">2024-07-11 00:54:14</td>
                                        <td class="text-center">2</td>
                                        <td></td>
                                        <td class="text-center">
                                            {{-- Link xem chi tiết đơn hàng (cần tạo route sau) --}}
                                            <a href="#">
                                                <div class="list-icon-function view-icon">
                                                    <div class="item eye"><i class="icon-eye"></i></div>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                    {{-- Thêm các dòng đơn hàng khác --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    {{-- Nếu trang dashboard cần chạy code JS đặc biệt (ví dụ: vẽ biểu đồ), thêm vào đây --}}
    {{-- Ví dụ: Code ApexCharts nếu bạn đã thêm HTML cho nó
    <script>
     (function ($) {
         // ... (code JS vẽ biểu đồ từ file gốc) ...
        
     })(jQuery);
    </script>
     --}}
@endpush