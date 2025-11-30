<div>
    
    <?php echo $__env->make('layouts.partials.page-title', [
        'title' => 'Dashboard',
        'breadcrumbs' => [
            ['label' => 'Admin'],
            ['label' => 'Dashboard']
        ]
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <div class="mb-3">
        <p class="text-muted mb-0">Gambaran umum bisnis kosan Anda</p>
    </div>

    
    <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1 mb-4">
        
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
                            <h3 class="mb-2 fw-normal"><?php echo e($stats['total_rooms']); ?></h3>
                            <p class="mb-0 text-muted">Total Kamar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
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
                            <h3 class="mb-2 fw-normal"><?php echo e($stats['available_rooms']); ?></h3>
                            <p class="mb-0 text-muted">Kamar Tersedia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
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
                            <h3 class="mb-2 fw-normal"><?php echo e($stats['total_tenants']); ?></h3>
                            <p class="mb-0 text-muted">Total Penyewa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
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
                            <h3 class="mb-2 fw-normal"><?php echo e($stats['active_bookings']); ?></h3>
                            <p class="mb-0 text-muted">Booking Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1 mb-4">
        
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
                            <h3 class="mb-2 fw-normal"><?php echo e($stats['unpaid_bills']); ?></h3>
                            <p class="mb-0 text-muted">Tagihan Belum Dibayar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
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
                            <h3 class="mb-2 fw-normal">Rp <?php echo e(number_format($stats['total_revenue'] / 1000000, 1, ',', '.')); ?>M</h3>
                            <p class="mb-0 text-muted">Total Pendapatan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        
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
                            <h3 class="mb-2 fw-normal"><?php echo e($stats['pending_proofs']); ?></h3>
                            <p class="mb-0 text-muted">Bukti Bayar Tertunda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
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
                            <h3 class="mb-2 fw-normal"><?php echo e($stats['active_complaints']); ?></h3>
                            <p class="mb-0 text-muted">Keluhan Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        
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

    
    <div class="row">
        
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
                                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><small class="font-monospace"><?php echo e($booking->booking_code); ?></small></td>
                                    <td><?php echo e($booking->user->name); ?></td>
                                    <td><?php echo e($booking->room->name); ?></td>
                                    <td>
                                        <span class="badge <?php echo e(status_badge_class($booking->status)); ?>"><?php echo e(format_status($booking->status)); ?></span>
                                    </td>
                                    <td><small><?php echo e($booking->created_at->diffForHumans()); ?></small></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i data-lucide="inbox" class="d-block mx-auto mb-2" style="width: 48px; height: 48px;"></i>
                                        Belum ada booking
                                    </td>
                                </tr>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--[if BLOCK]><![endif]--><?php if($recentBookings->count() > 0): ?>
                <div class="card-footer">
                    <a href="<?php echo e(route('admin.bookings.manage')); ?>" class="btn btn-sm btn-soft-primary">Lihat Semua <i data-lucide="arrow-right" class="icon-dual icon-xs ms-1"></i></a>
                </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>

        
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
                                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $recentComplaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(Str::limit($complaint->title, 25)); ?></td>
                                    <td><?php echo e($complaint->user->name); ?></td>
                                    <td><?php echo e($complaint->room->name); ?></td>
                                    <td>
                                        <span class="badge <?php echo e(status_badge_class($complaint->status)); ?>"><?php echo e(format_status($complaint->status)); ?></span>
                                    </td>
                                    <td><small><?php echo e($complaint->created_at->diffForHumans()); ?></small></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i data-lucide="inbox" class="d-block mx-auto mb-2" style="width: 48px; height: 48px;"></i>
                                        Belum ada keluhan
                                    </td>
                                </tr>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--[if BLOCK]><![endif]--><?php if($recentComplaints->count() > 0): ?>
                <div class="card-footer">
                    <a href="<?php echo e(route('admin.complaints.manage')); ?>" class="btn btn-sm btn-soft-primary">Lihat Semua <i data-lucide="arrow-right" class="icon-dual icon-xs ms-1"></i></a>
                </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>

    
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
                                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $pendingProofs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($proof->user->name); ?></td>
                                    <td><small class="font-monospace"><?php echo e($proof->bill->bill_code); ?></small></td>
                                    <td>Rp <?php echo e(number_format($proof->bill->total_amount, 0, ',', '.')); ?></td>
                                    <td><small><?php echo e($proof->created_at->format('d M Y H:i')); ?></small></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.billing.manage')); ?>" class="btn btn-sm btn-soft-primary">
                                            <i data-lucide="eye" class="icon-dual icon-xs me-1"></i> Verifikasi
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i data-lucide="inbox" class="d-block mx-auto mb-2" style="width: 48px; height: 48px;"></i>
                                        Tidak ada bukti pembayaran yang perlu diverifikasi
                                    </td>
                                </tr>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Revenue Chart (Area Chart)
            var revenueOptions = {
                series: [{
                    name: 'Pendapatan',
                    data: <?php echo json_encode($revenueChartData, 15, 512) ?>
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
                    categories: <?php echo json_encode($revenueChartLabels, 15, 512) ?>
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
                    <?php echo e($roomStatusData['tersedia']); ?>,
                    <?php echo e($roomStatusData['terisi']); ?>,
                    <?php echo e($roomStatusData['sudah_dipesan']); ?>,
                    <?php echo e($roomStatusData['pemeliharaan']); ?>

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
                    data: <?php echo json_encode($bookingTrendData, 15, 512) ?>
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
                    categories: <?php echo json_encode($bookingTrendLabels, 15, 512) ?>
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
    <?php $__env->stopPush(); ?>
</div>

```
<?php /**PATH D:\file-belajar-website-IDN\final-project-smstr1\resources\views/livewire/admin/dashboard.blade.php ENDPATH**/ ?>