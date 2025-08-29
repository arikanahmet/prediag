

<?php $__env->startSection('content'); ?>
<div class="p-4">

    <h2 class="text-xl font-bold mb-4">Ön Değerlendirme Sonucu</h2>

    <div class="mb-4">
        <h3 class="font-semibold">Seçilen Şikayetler:</h3>
        <?php if(!empty($symptomNames) && is_array($symptomNames)): ?>
            <ul class="list-disc ml-5 mb-2">
                <?php $__currentLoopData = $symptomNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($name); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <p>Henüz şikayet seçilmedi.</p>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <h3 class="font-semibold">Öneri:</h3>
        <p><?php echo e($recommendation ?? 'Öneri henüz alınmadı.'); ?></p>
    </div>

    <p class="text-sm mt-4 opacity-70">
        * Bu öneri, yapay zeka tarafından sağlanmıştır ve kesin bir teşhis değildir. Lütfen bir sağlık profesyoneline danışın.
    </p>

    <a href="<?php echo e(route('symptoms.index')); ?>" class="mt-4 inline-block bg-brand text-white px-4 py-2 rounded hover:bg-brand-dark">
        Yeni Şikayet Ekle
    </a>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ahmet\OneDrive\Desktop\PreDiag\resources\views/symptoms/recommendation.blade.php ENDPATH**/ ?>