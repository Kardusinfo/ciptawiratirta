<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="dashboard-page">
            <h4 class="welcome-title text-uppercase"><?php echo e(__('Welcome :name!', ['name' => Auth::user()->nameOrEmail])); ?></h4>
        </div>
        <br>
        <div class="row">
            <?php if(!empty($top_cards)): ?>
                <?php $__currentLoopData = $top_cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-<?php echo e($card['size']); ?> col-md-<?php echo e($card['size_md']); ?>">
                        <div class="dashboard-report-card card <?php echo e($card['class']); ?>">
                            <div class="card-content">
                                <span class="card-title"><?php echo e($card['title']); ?></span>
                                <span class="card-amount"><?php echo e($card['amount']); ?></span>
                                <span class="card-desc"><?php echo e($card['desc']); ?></span>
                            </div>
                            <div class="card-media">
                                <i class="<?php echo e($card['icon']); ?>"></i>
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="dashboard-report-card card pink">
                        <div class="card-content">
                            <span class="card-title">Applicants</span>
                            <span class="card-amount">8</span>
                            <span class="card-desc">Total Applicants</span>
                        </div>
                        <div class="card-media">
                            <i class="icon ion-ios-paper"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="dashboard-report-card card info">
                        <div class="card-content">
                            <span class="card-title">Messages</span>
                            <span class="card-amount">2</span>
                            <span class="card-desc">Total Messages</span>
                        </div>
                        <div class="card-media">
                            <i class="icon ion-md-chatboxes"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="dashboard-report-card card success">
                        <div class="card-content">
                            <span class="card-title">Bookmark</span>
                            <span class="card-amount">0</span>
                            <span class="card-desc">Total Bookmark</span>
                        </div>
                        <div class="card-media">
                            <i class="icon ion-ios-heart"></i>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-lg-6 mb-3">
                    <div class="panel">
                        <div class="panel-title d-flex justify-content-between align-items-center">
                            <strong><?php echo e(is_admin() ? __('Total Pendaftar') : __('Your Profile Views')); ?></strong>
                            <div id="reportrange"
                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                        <div class="panel-body">
                            <canvas id="earning_chart"></canvas>
                            <script>
                                var views_chart_data = <?php echo json_encode($views_chart_data); ?>;
                            </script>
=======
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        <br>
        <?php if(Auth::user()->role_id == 1): ?>
            
        <?php else: ?>
            <div class="row">
                <div class="col-md-12 col-lg-6 mb-3 ">
                    <div class="panel ">
                        <div class="panel-title d-flex justify-content-between align-items-center alert alert-warning">
                            <strong>Warning!</strong>

                        </div>
                        
                        <div class="panel-body">
                            Complete your profile and upload your cv with your application first <br> <br>
                            <a href="/user/profile" class="btn btn-info">
                                <span class="btn-title">Next</span>
                            </a>
>>>>>>> origin/back
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 ">
                    <div class="panel">
                        <div class="panel-title d-flex justify-content-between">
                            <strong><?php echo e(__('Notifications')); ?></strong>
                        </div>
                        <div class="panel-body">
                            <ul class="dropdown-list-items p-0">
                                <?php $rows = $notifications ?>
                                <?php echo $__env->make('Core::admin.notification.notification-loop-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
        <?php else: ?>
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="dashboard-report-card card purple">
                        <div class="card-content">
                            <span class="card-title">Jobs</span>
                            <span class="card-amount">2</span>
                            <span class="card-desc">Applied Jobs</span>
                        </div>
                        <div class="card-media">
                            <i class="icon ion-ios-briefcase"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="dashboard-report-card card info">
                        <div class="card-content">
                            <span class="card-title">Messages</span>
                            <span class="card-amount">2</span>
                            <span class="card-desc">Total Messages</span>
                        </div>
                        <div class="card-media">
                            <i class="icon ion-md-chatboxes"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="dashboard-report-card card success">
                        <div class="card-content">
                            <span class="card-title">Bookmark</span>
                            <span class="card-amount">0</span>
                            <span class="card-desc">Total Bookmark</span>
                        </div>
                        <div class="card-media">
                            <i class="icon ion-ios-heart"></i>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-lg-6 mb-3 ">
                    <div class="panel ">
                        <div class="panel-title d-flex justify-content-between align-items-center alert alert-warning">
                            <strong>Warning!</strong>

                        </div>
                        
                        <div class="panel-body">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div><br>
                            Complete your profile and upload your cv with your application first<br> <br>
                            
                            <div class="custom-class">
                                <input name="progress" class="progress" type="checkbox" value="17" id="customCheck1">
                                <label for="customCheck1">Name</label><br>
                                <input name="progress" class="progress" type="checkbox" value="34" id="customCheck1">
                                <label for="customCheck1">First Name</label><br>
                                <input name="progress" class="progress" type="checkbox" value="51"
                                    id="customCheck1">
                                <label for="customCheck1">Last Name</label><br>
                                <input name="progress" class="progress" type="checkbox" value="68"
                                    id="customCheck1">
                                <label for="customCheck1">Avatar ID</label><br>
                                <input name="progress" class="progress" type="checkbox" value="85"
                                    id="customCheck1">
                                <label for="customCheck1">City</label><br>
                                <input name="progress" class="progress" type="checkbox" value="99"
                                    id="customCheck1">
                                <label for="customCheck1">Gender</label><br>
                            </div>
                            <a href="/user/profile" class="btn btn-info">
                                <span class="btn-title">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 ">
                    <div class="panel">
                        <div class="panel-title d-flex justify-content-between">
                            <strong><?php echo e(__('Notifications')); ?></strong>
                        </div>
                        <div class="panel-body">
                            <ul class="dropdown-list-items p-0">
                                <?php $rows = $notifications ?>
                                <?php echo $__env->make('Core::admin.notification.notification-loop-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <br>
=======
        <?php endif; ?>
        <br>
        <div class="row">
            
            
        </div>
>>>>>>> origin/back
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script.body'); ?>
    <script src="<?php echo e(url('libs/chart_js/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(url('libs/daterange/moment.min.js')); ?>"></script>
    <script>
        var ctx = document.getElementById('earning_chart').getContext('2d');

        window.myMixedChart = new Chart(ctx, {
            type: 'line',
            data: views_chart_data,
            options: {
                layout: {
                    padding: 10,
                },

                legend: {
                    display: false
                },
                title: {
                    display: false
                },

                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: false
                        },
                        gridLines: {
                            borderDash: [6, 10],
                            color: "#d8d8d8",
                            lineWidth: 1,
                        },
                        ticks: {
                            beginAtZero: true,
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        },
                    }],
                },

                tooltips: {
                    backgroundColor: '#333',
                    titleFontSize: 13,
                    titleFontColor: '#fff',
                    bodyFontColor: '#fff',
                    bodyFontSize: 13,
                    displayColors: false,
                    xPadding: 10,
                    yPadding: 10,
                    intersect: false
                }
            }
        });

        var start = moment().startOf('week');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            "alwaysShowCalendars": true,
            "opens": "left",
            "showDropdowns": true,
            ranges: {
                '<?php echo e(__('Today')); ?>': [moment(), moment()],
                '<?php echo e(__('Yesterday')); ?>': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '<?php echo e(__('Last 7 Days')); ?>': [moment().subtract(6, 'days'), moment()],
                '<?php echo e(__('Last 30 Days')); ?>': [moment().subtract(29, 'days'), moment()],
                '<?php echo e(__('This Month')); ?>': [moment().startOf('month'), moment().endOf('month')],
                '<?php echo e(__('Last Month')); ?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')],
                '<?php echo e(__('This Year')); ?>': [moment().startOf('year'), moment().endOf('year')],
                '<?php echo e(__('This Week')); ?>': [moment().startOf('week'), end]
            }
        }, cb).on('apply.daterangepicker', function(ev, picker) {
            // Reload Earning JS
            $.ajax({
                url: '<?php echo e(route('admin.reloadChart')); ?>',
                data: {
                    chart: 'views',
                    from: picker.startDate.format('YYYY-MM-DD'),
                    to: picker.endDate.format('YYYY-MM-DD'),
                },
                dataType: 'json',
                type: 'post',
                success: function(res) {
                    if (res.status) {
                        window.myMixedChart.data = res.data;
                        window.myMixedChart.update();
                    }
                }
            })
        });
        cb(start, end);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/failamir/Sites/localhost/superio200/modules/Dashboard/Views/index.blade.php ENDPATH**/ ?>