<div>
    {{-- Page Title --}}
    @include('layouts.partials.page-title', [
        'title' => 'Dashboard',
        'breadcrumbs' => [
            ['label' => 'Admin'],
            ['label' => 'Dashboard']
        ]
    ])

    {{-- Admin Dashboard --}}
    <div class="mb-3">
        <p class="text-muted mb-0">Gambaran umum bisnis kosan Anda</p>
    </div>

    {{-- Statistics Cards --}}
    <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1 mb-4">
        {{-- Total Rooms --}}
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar fs-60 avatar-img-size flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle text-primary rounded-circle fs-24">
                                <i data-lucide="home"></i>
                            </span>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-2 fw-normal">{{ $stats['total_rooms'] }}</h3>
                            <p class="mb-0 text-muted">Total Kamar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Available Rooms --}}
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar fs-60 avatar-img-size flex-shrink-0">
                            <span class="avatar-title bg-success-subtle text-success rounded-circle fs-24">
                                <i data-lucide="door-open"></i>
                            </span>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-2 fw-normal">{{ $stats['available_rooms'] }}</h3>
                            <p class="mb-0 text-muted">Kamar Tersedia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Penyewa --}}
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar fs-60 avatar-img-size flex-shrink-0">
                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-24">
                                <i data-lucide="users"></i>
                            </span>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-2 fw-normal">{{ $stats['total_tenants'] }}</h3>
                            <p class="mb-0 text-muted">Total Penyewa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Active Bookings --}}
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar fs-60 avatar-img-size flex-shrink-0">
                            <span class="avatar-title bg-warning-subtle text-warning rounded-circle fs-24">
                                <i data-lucide="calendar-check"></i>
                            </span>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-2 fw-normal">{{ $stats['active_bookings'] }}</h3>
                            <p class="mb-0 text-muted">Booking Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Financial & Complaints Row --}}
    <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1 mb-4">
        {{-- Unpaid Bills --}}
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar fs-60 avatar-img-size flex-shrink-0">
                            <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-24">
                                <i data-lucide="alert-triangle"></i>
                            </span>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-2 fw-normal">{{ $stats['unpaid_bills'] }}</h3>
                            <p class="mb-0 text-muted">Tagihan Belum Dibayar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar fs-60 avatar-img-size flex-shrink-0">
                            <span class="avatar-title bg-success-subtle text-success rounded-circle fs-24">
                                <i data-lucide="wallet"></i>
                            </span>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-2 fw-normal">Rp {{ number_format($stats['total_revenue'] / 1000000, 1, ',', '.') }}M</h3>
                            <p class="mb-0 text-muted">Total Pendapatan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pending Payment Proofs --}}
        {{-- Pending Payment Proofs --}}
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar fs-60 avatar-img-size flex-shrink-0">
                            <span class="avatar-title bg-warning-subtle text-warning rounded-circle fs-24">
                                <i data-lucide="clock"></i>
                            </span>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-2 fw-normal">{{ $stats['pending_proofs'] }}</h3>
                            <p class="mb-0 text-muted">Bukti Bayar Tertunda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Active Complaints --}}
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar fs-60 avatar-img-size flex-shrink-0">
                            <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-24">
                                <i data-lucide="message-square"></i>
                            </span>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-2 fw-normal">{{ $stats['active_complaints'] }}</h3>
                            <p class="mb-0 text-muted">Keluhan Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Section --}}
    <div class="row">
        {{-- Revenue Chart --}}
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Grafik Pendapatan (6 Bulan Terakhir)</h4>
                </div>
                <div class="card-body">
                    <div id="revenue-chart" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>

        {{-- Room Status Donut Chart --}}
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Status Kamar</h4>
                </div>
                <div class="card-body">
                    <div id="room-status-chart" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Booking Trend Chart --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Trend Booking (7 Hari Terakhir)</h4>
                </div>
                <div class="card-body">
                    <div id="booking-trend-chart" style="min-height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Activity Tables --}}
    <div class="row">
        {{-- Recent Bookings --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Booking Terbaru</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode</th>
                                    <th>Penyewa</th>
                                    <th>Kamar</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings as $booking)
                                <tr>
                                    <td><small class="font-monospace">{{ $booking->booking_code }}</small></td>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->room->name }}</td>
                                    <td>
                                        <span class="badge {{ status_badge_class($booking->status) }}">{{ format_status($booking->status) }}</span>
                                    </td>
                                    <td><small>{{ $booking->created_at->diffForHumans() }}</small></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i data-lucide="inbox" class="d-block mx-auto mb-2" style="width: 48px; height: 48px;"></i>
                                        Belum ada booking
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($recentBookings->count() > 0)
                <div class="card-footer">
                    <a href="{{ route('admin.bookings.manage') }}" class="btn btn-sm btn-soft-primary">Lihat Semua <i data-lucide="arrow-right" class="icon-dual icon-xs ms-1"></i></a>
                </div>
                @endif
            </div>
        </div>

        {{-- Recent Complaints --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Keluhan Terbaru</h4>
                </div>
                                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-centered table-hover table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Judul</th>
                                    <th>Penyewa</th>
                                    <th>Kamar</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentComplaints as $complaint)
                                <tr>
                                    <td>{{ Str::limit($complaint->title, 25) }}</td>
                                    <td>{{ $complaint->user->name }}</td>
                                    <td>{{ $complaint->room->name }}</td>
                                    <td>
                                        <span class="badge {{ status_badge_class($complaint->status) }}">{{ format_status($complaint->status) }}</span>
                                    </td>
                                    <td><small>{{ $complaint->created_at->diffForHumans() }}</small></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i data-lucide="inbox" class="d-block mx-auto mb-2" style="width: 48px; height: 48px;"></i>
                                        Belum ada keluhan
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($recentComplaints->count() > 0)
                <div class="card-footer">
                    <a href="{{ route('admin.complaints.manage') }}" class="btn btn-sm btn-soft-primary">Lihat Semua <i data-lucide="arrow-right" class="icon-dual icon-xs ms-1"></i></a>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Pending Payment Proofs --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Bukti Pembayaran Tertunda Verifikasi</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-centered table-hover table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Penyewa</th>
                                    <th>Kode Tagihan</th>
                                    <th>Nominal</th>
                                    <th>Tanggal Upload</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingProofs as $proof)
                                <tr>
                                    <td>{{ $proof->user->name }}</td>
                                    <td><small class="font-monospace">{{ $proof->bill->bill_code }}</small></td>
                                    <td>Rp {{ number_format($proof->bill->total_amount, 0, ',', '.') }}</td>
                                    <td><small>{{ $proof->created_at->format('d M Y H:i') }}</small></td>
                                    <td>
                                        <a href="{{ route('admin.billing.manage') }}" class="btn btn-sm btn-soft-primary">
                                            <i data-lucide="eye" class="icon-dual icon-xs me-1"></i> Verifikasi
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i data-lucide="inbox" class="d-block mx-auto mb-2" style="width: 48px; height: 48px;"></i>
                                        Tidak ada bukti pembayaran yang perlu diverifikasi
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Revenue Chart (Area Chart)
            var revenueOptions = {
                series: [{
                    name: 'Pendapatan',
                    data: @json($revenueChartData)
                }],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                colors: ['#0acf97'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.1,
                    }
                },
                xaxis: {
                    categories: @json($revenueChartLabels)
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            };

            var revenueChart = new ApexCharts(document.querySelector("#revenue-chart"), revenueOptions);
            revenueChart.render();

            // Room Status Chart (Donut Chart)
            var roomStatusOptions = {
                series: [
                    {{ $roomStatusData['tersedia'] }},
                    {{ $roomStatusData['terisi'] }},
                    {{ $roomStatusData['sudah_dipesan'] }},
                    {{ $roomStatusData['pemeliharaan'] }}
                ],
                chart: {
                    type: 'donut',
                    height: 350
                },
                labels: ['Tersedia', 'Terisi', 'Sudah Dipesan', 'Pemeliharaan'],
                colors: ['#0acf97', '#727cf5', '#fa5c7c', '#ffbc00'],
                legend: {
                    position: 'bottom'
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opts) {
                        return opts.w.config.series[opts.seriesIndex];
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%'
                        }
                    }
                }
            };

            var roomStatusChart = new ApexCharts(document.querySelector("#room-status-chart"), roomStatusOptions);
            roomStatusChart.render();

            // Booking Trend Chart (Bar Chart)
            var bookingTrendOptions = {
                series: [{
                    name: 'Booking',
                    data: @json($bookingTrendData)
                }],
                chart: {
                    type: 'bar',
                    height: 300,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        borderRadius: 4
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#727cf5'],
                xaxis: {
                    categories: @json($bookingTrendLabels)
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Booking'
                    }
                },
                fill: {
                    opacity: 1
                }
            };

            var bookingTrendChart = new ApexCharts(document.querySelector("#booking-trend-chart"), bookingTrendOptions);
            bookingTrendChart.render();
        });
    </script>
    @endpush
</div>

```
