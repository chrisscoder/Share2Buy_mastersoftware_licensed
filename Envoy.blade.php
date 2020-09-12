@servers(['web' => 'modsvarcto@138.68.182.99'])

@story('deploy', ['on' => 'web'])
  staging
  down
@endstory

@task('staging', ['on' => 'web'])
  cd /var/www/staging.modsvar.com
  sudo php artisan down
@endtask

@task('production', ['on' => 'web'])
  cd /var/www/modsvar.com
@endtask

@task('down', ['on' => 'web'])
  ls
@endtask

@task('git', ['on' => 'web'])
  @if ($branch)
    sudo git pull origin {{ $branch }}
    sudo git checkout {{ $branch }}
  @endif
@endtask

@task('composer', ['on' => 'web'])
  sudo composer dump-autoload -o
  sudo composer install --no-dev --prefer-dist --optimize-autoloader
@endtask

@task('permission', ['on' => 'web'])
  sudo chgrp -R www-data storage bootstrap/cache public/upload
  sudo chmod -R ug+rwx storage bootstrap/cache public/upload
@endtask

@task('optimize', ['on' => 'web'])
  sudo php artisan clear-compiled
  sudo php artisan cache:clear
  sudo php artisan config:clear
  sudo php artisan route:clear
  sudo php artisan optimize
  sudo php artisan config:cache
  sudo php artisan route:cache
  sudo php artisan migrate
@endtask

@task('up', ['on' => 'web'])
  sudo php artisan up
@endtask

@finished
    @slack('https://hooks.slack.com/services/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', '#deployment', 'Envoy task ran successfully')
@endfinished
