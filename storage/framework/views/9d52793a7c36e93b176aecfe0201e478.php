<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? 'PreDiag'); ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              brand: { DEFAULT: '#0D3B66', dark: '#0A2A4A', light: '#1C5A99' }
            },
          }
        }
      }
    </script>

    <link rel="icon" href="data:,">
</head>
<body class="min-h-screen bg-brand text-white flex items-center justify-center">
    <div class="w-full max-w-md p-6">
        <div class="bg-white text-brand rounded-2xl shadow-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div class="font-bold text-xl">PreDiag</div>
                <div class="text-sm opacity-70">Beta</div>
            </div>

            <?php if($errors->any()): ?>
                <div class="mb-4 rounded-lg bg-red-50 text-red-700 p-3 text-sm">
                    <ul class="list-disc ml-5">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($err); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <p class="text-center text-sm mt-6 opacity-80">
            © <?php echo e(date('Y')); ?> PreDiag — <span class="underline">Ahmet ARIKAN</span>
        </p>
    </div>
</body>
</html>
<?php /**PATH C:\Users\ahmet\OneDrive\Desktop\PreDiag\resources\views/layouts/app.blade.php ENDPATH**/ ?>