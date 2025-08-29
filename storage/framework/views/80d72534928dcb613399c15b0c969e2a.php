

<?php $__env->startSection('content'); ?>
<div class="p-4">

    <h2 class="text-xl font-bold mb-4">Şikayet Seçimi</h2>

    <form method="POST" action="<?php echo e(route('symptoms.store')); ?>">
        <?php echo csrf_field(); ?>

        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-6">
            <?php $__currentLoopData = $symptoms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $symptom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="relative cursor-pointer">
                    <input type="checkbox" name="symptoms[]" value="<?php echo e($symptom->id); ?>" 
                           class="peer hidden"
                           <?php if(isset($symptomNames) && in_array($symptom->name, $symptomNames)): ?> checked <?php endif; ?>>
                    
                    <div class="p-6 min-h-[120px] flex items-center justify-center text-center 
                                bg-white border border-gray-300 rounded-2xl shadow-sm 
                                peer-checked:bg-brand peer-checked:text-white 
                                transition transform active:scale-95">
                        <?php echo e($symptom->name); ?>

                    </div>
                </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="mb-6">
            <label for="notes" class="block mb-2 font-semibold">Ek Not (opsiyonel)</label>
            <textarea name="notes" id="notes" rows="3" 
                      class="w-full p-3 border border-gray-300 rounded-lg text-black focus:ring-2 focus:ring-brand"></textarea>
        </div>

        
        <button type="submit" 
                class="w-full bg-brand text-white font-semibold py-3 rounded-2xl shadow-md hover:bg-brand-dark transition">
            Gönder ve AI Önerisi Al
        </button>
    </form>

    
    <?php if(isset($recommendation)): ?>
        <div class="mt-8 p-6 bg-gray-100 text-black rounded-2xl shadow">
            <h3 class="text-lg font-bold mb-4">Ön Değerlendirme Sonucu</h3>

            <div class="mb-4">
                <h4 class="font-semibold mb-1">Seçilen Şikayetler:</h4>
                <ul class="list-disc ml-5">
                    <?php $__currentLoopData = $symptomNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($name); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-1">Öneri:</h4>
                <p><?php echo e($recommendation); ?></p>
            </div>

            <p class="text-sm mt-6 opacity-70">
                * Bu öneri, yapay zeka tarafından sağlanmıştır ve kesin bir teşhis değildir. 
                Lütfen bir sağlık profesyoneline danışın.
            </p>
        </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ahmet\OneDrive\Desktop\PreDiag - Kopya\resources\views/symptoms/index.blade.php ENDPATH**/ ?>