<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <form method="POST" action="<?php echo e(route('login.post')); ?>" class="flex flex-col gap-4">
        <?php echo csrf_field(); ?>
        <input type="text" name="tc" placeholder="TC Kimlik No" class="p-2 border rounded text-black" required>
        <input type="email" name="email" placeholder="E-mail" class="p-2 border rounded text-black" required>
        <input type="password" name="password" placeholder="Şifre" class="p-2 border rounded text-black" required>
        <button type="submit" class="bg-brand text-white py-2 rounded hover:bg-brand-dark">Giriş Yap</button>
        <a href="<?php echo e(route('register')); ?>" class="text-center text-sm mt-2 text-brand-dark underline">Kayıt Ol</a>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php /**PATH C:\Users\ahmet\OneDrive\Desktop\PreDiag - Kopya\resources\views/auth/login.blade.php ENDPATH**/ ?>