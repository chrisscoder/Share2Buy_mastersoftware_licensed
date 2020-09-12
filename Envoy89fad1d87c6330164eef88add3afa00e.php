<?php $branch = isset($branch) ? $branch : null; ?>
<?php $task = isset($task) ? $task : null; ?>
<?php $__container->servers(['web' => 'modsvarcto@138.68.182.99']); ?>

<?php $__container->startTask('foo', ['on' => 'web']); ?>
cd /var/www/staging.modsvar.com
ls
<?php $__container->endTask(); ?>

<?php $_vars = get_defined_vars(); $__container->finished(function() use ($_vars) { extract($_vars); 
     if (! isset($task)) $task = null; Laravel\Envoy\Slack::make('https://hooks.slack.com/services/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', '#deployment', 'Envoy '.<?php echo $task; ?>.' ran successfully')->task($task)->send();
}); ?>

<?php /* <?php $__container->startTask('deploy', ['on' => 'web']); ?>

    <?php if ($branch): ?>
      sudo git pull origin <?php echo $branch; ?>

      sudo git checkout <?php echo $branch; ?>

    <?php endif; ?>

    sudo composer dump-autoload -o
    sudo composer install --no-dev --prefer-dist --optimize-autoloader
    sudo chgrp -R www-data storage bootstrap/cache public/upload
    sudo chmod -R ug+rwx storage bootstrap/cache public/upload
    sudo php artisan clear-compiled
    sudo php artisan cache:clear
    sudo php artisan config:clear
    sudo php artisan route:clear
    sudo php artisan optimize
    sudo php artisan config:cache
    sudo php artisan route:cache
    sudo php artisan migrate
    sudo php artisan up

<?php $__container->endTask(); ?> */ ?>
