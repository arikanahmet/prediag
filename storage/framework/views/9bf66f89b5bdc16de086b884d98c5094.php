

<?php $__env->startSection('content'); ?>
<div class="p-4">

    <h2 class="text-xl font-bold mb-4">Şikayet Seçimi</h2>

    <form method="POST" action="<?php echo e(route('symptoms.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="mb-4">
            <?php $__currentLoopData = $symptoms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $symptom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center mb-2">
                    <input type="checkbox" name="symptoms[]" value="<?php echo e($symptom->id); ?>" id="symptom<?php echo e($symptom->id); ?>"
                        class="mr-2"
                        <?php if(isset($symptomNames) && in_array($symptom->name, $symptomNames)): ?> checked <?php endif; ?>
                    >
                    <label for="symptom<?php echo e($symptom->id); ?>"><?php echo e($symptom->name); ?></label>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mb-4">
            <label for="notes" class="block mb-1 font-semibold">Ek Not (opsiyonel)</label>
            <textarea name="notes" id="notes" rows="3" class="w-full p-2 border rounded text-black"></textarea>
        </div>

        <button type="submit" class="bg-brand text-white px-4 py-2 rounded hover:bg-brand-dark">
            Gönder ve AI Önerisi Al
        </button>
    </form>

    <?php if(isset($recommendation)): ?>
        <div class="mt-6 p-4 bg-gray-100 text-black rounded">
            <h3 class="font-semibold mb-2">Ön Değerlendirme Sonucu</h3>

            <div class="mb-2">
                <h4 class="font-semibold">Seçilen Şikayetler:</h4>
                <ul class="list-disc ml-5">
                    <?php $__currentLoopData = $symptomNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($name); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold">Öneri:</h4>
                <p><?php echo e($recommendation); ?></p>
            </div>

            <p class="text-sm mt-4 opacity-70">
                * Bu öneri, yapay zeka tarafından sağlanmıştır ve kesin bir teşhis değildir. Lütfen bir sağlık profesyoneline danışın.
            </p>
        </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ahmet\OneDrive\Desktop\PreDiag\resources\views/symptoms/index.blade.php ENDPATH**/ ?>