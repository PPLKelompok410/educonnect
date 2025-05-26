<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Top Contributors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #E0F7FA;
            font-family: 'Segoe UI', sans-serif;
        }

        h1.title {
            color: #0277BD;
            font-size: 2.8rem;
            font-weight: bold;
        }

        h2.subtitle {
            color: #0277BD;
            margin-bottom: 2rem;
        }

        .podium {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 1.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .card-top {
            width: 200px;
            padding: 1.2rem;
            border-radius: 15px;
            color: #fff;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card-top:hover {
            transform: scale(1.05);
        }

        .card-top .total-value {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 0.5rem;
            color: #fff;
        }

        .gold {
            background: linear-gradient(135deg, #FFD700, #FFC107);
            transform: translateY(-20px);
            
        }

        .silver {
            background: linear-gradient(135deg, #B0BEC5, #90A4AE);
        }

        .bronze {
            background: linear-gradient(135deg, #A1887F, #8D6E63);
        }

        .icon-row i {
            font-size: 1.4rem;
            margin: 0 6px;
        }

        .total-circle {
            background: white;
            color: #0277BD;
            font-weight: bold;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            font-size: 1.1rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .card-horizontal {
            background-color: #ffffff;
            border-left: 8px solid #0288D1;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .card-horizontal .info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .card-horizontal .info i {
            font-size: 1.2rem;
            color: #0288D1;
        }

        .legend {
            margin-top: 2rem;
            padding: 1rem;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            color: #0277BD;
        }

        .legend-item i {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="text-center">
        <h1 class="title">
            <i class="bi bi-trophy-fill"></i> Top Contributors <i class="bi bi-trophy-fill"></i>
        </h1>
        <h2 class="subtitle"><?php echo e(\Carbon\Carbon::now()->translatedFormat('F Y')); ?></h2>
    </div>

    <!-- Top 3 Podium -->
    <div class="podium">
        <?php
            $topThree = $penggunas->take(3);
            $podiumStyles = [
                ['rank' => 2, 'class' => 'silver'],
                ['rank' => 1, 'class' => 'gold'],
                ['rank' => 3, 'class' => 'bronze'],
            ];
            $icons = ['bi-award-fill', 'bi-chat-dots-fill', 'bi-people-fill'];
        ?>

        <?php $__currentLoopData = $podiumStyles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $style): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $pengguna = $topThree[$style['rank'] - 1] ?? null;
            ?>
            <?php if($pengguna): ?>
                <div class="card-top <?php echo e($style['class']); ?>">
                    <h5><i class="bi bi-award"></i> <?php echo e($pengguna->nama ?? 'Tidak diketahui'); ?></h5>
                    <div class="icon-row my-2">
                        <i class="bi bi-journal-text"></i> <?php echo e($pengguna->notes_count); ?>

                        <i class="bi bi-chat-dots"></i> <?php echo e($pengguna->note_comments_count); ?>

                        <i class="bi bi-people"></i> <?php echo e($pengguna->comments_count); ?>

                    </div>
                        <div class="total-value"><?php echo e($pengguna->total_contributions); ?></div>
                    </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Rank 4 - 10 Cards -->
    <?php $rank = 4; ?>
    <?php $__currentLoopData = $penggunas->skip(3)->take(7); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengguna): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card-horizontal">
            <div class="info">
                <strong class="text-primary me-3">#<?php echo e($rank++); ?></strong>
                <div><?php echo e($pengguna->nama ?? 'Tidak diketahui'); ?></div>
            </div>
            <div class="info">
                <i class="bi bi-journal-text"></i> <?php echo e($pengguna->notes_count); ?>

                <i class="bi bi-chat-dots"></i> <?php echo e($pengguna->note_comments_count); ?>

                <i class="bi bi-people"></i> <?php echo e($pengguna->comments_count); ?>

                <div class="total-circle ms-3"><?php echo e($pengguna->total_contributions); ?></div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- Legend -->
    <div class="legend">
        <div class="legend-item"><i class="bi bi-journal-text"></i> Catatan</div>
        <div class="legend-item"><i class="bi bi-chat-dots"></i> Komentar Catatan</div>
        <div class="legend-item"><i class="bi bi-people"></i> Komentar Forum</div>
        <div class="legend-item"><span class="total-circle">#</span> Total Kontribusi</div>
    </div>
</div>
</body>
</html><?php /**PATH C:\Users\user\Documents\Educonnect\top_contributors\resources\views/index.blade.php ENDPATH**/ ?>