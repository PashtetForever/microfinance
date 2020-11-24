@servers(['web' => 'root@92.63.99.149'])

@setup
    $user = 'zaim-dynai';
@endsetup

@story('all')
    test
    derevo
    oazis
    test-dynai
@endstory

@story('prod')
    derevo
    oazis
@endstory

@task('test')
    cd /var/www/zaim-dynai/data/www/zaim-dynai.ru/test/
    echo "Pulling repo..."
    git pull origin master

    echo "Run migrations..."
    /opt/php74/bin/php artisan migrate --force --no-interaction

    echo "Installing composer depencencies..."
    /opt/php74/bin/php /usr/local/bin/composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader --ignore-platform-reqs

    /opt/php74/bin/php artisan view:clear --quiet
    /opt/php74/bin/php artisan cache:clear --quiet
    /opt/php74/bin/php artisan config:cache --quiet
    /opt/php74/bin/php artisan config:clear --quiet
    echo "Cache cleared"

    chown -R {{$user}}:{{$user}} ./*
    chown -R {{$user}}:{{$user}} ./.*

    echo "Run JS building..."
    yarn prod

    echo "Test done"
@endtask

@task('test-dynai')
    cd /var/www/zaim-dynai/data/www/zaim-dynai.ru/cabinet/
    echo "Pulling repo..."
    git pull origin master

    echo "Run migrations..."
    /opt/php74/bin/php artisan migrate --force --no-interaction

    echo "Installing composer depencencies..."
    /opt/php74/bin/php /usr/local/bin/composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader --ignore-platform-reqs

    /opt/php74/bin/php artisan view:clear --quiet
    /opt/php74/bin/php artisan cache:clear --quiet
    /opt/php74/bin/php artisan config:cache --quiet
/opt/php74/bin/php artisan config:clear --quiet
    echo "Cache cleared"

    chown -R {{$user}}:{{$user}} ./*
    chown -R {{$user}}:{{$user}} ./.*

    echo "Run JS building..."
    yarn prod

    echo "Test done"
@endtask

@task('sentimo')
    cd /var/www/zaim-dynai/data/www/sentimo.ispvds.com/cabinet
    echo "Pulling repo..."
    git pull origin master

    echo "Run migrations..."
    /opt/php74/bin/php artisan migrate --force --no-interaction

    echo "Installing composer depencencies..."
    /opt/php74/bin/php /usr/local/bin/composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader --ignore-platform-reqs

    /opt/php74/bin/php artisan view:clear --quiet
    /opt/php74/bin/php artisan cache:clear --quiet
    /opt/php74/bin/php artisan config:cache --quiet
    /opt/php74/bin/php artisan config:clear --quiet
    echo "Cache cleared"

    chown -R {{$user}}:{{$user}} ./*
    chown -R {{$user}}:{{$user}} ./.*

    echo "Run JS building..."
    yarn prod

    echo "Sentimo done"
@endtask

@task('derevo')
    cd /var/www/zaim-dynai/data/www/derevo-denezhnoe.ru/cabinet
    echo "Pulling repo..."
    git pull origin master

    echo "Run migrations..."
    /opt/php74/bin/php artisan migrate --force --no-interaction

    echo "Installing composer depencencies..."
    /opt/php74/bin/php /usr/local/bin/composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader --ignore-platform-reqs

    /opt/php74/bin/php artisan view:clear --quiet
    /opt/php74/bin/php artisan cache:clear --quiet
    /opt/php74/bin/php artisan config:cache --quiet
    /opt/php74/bin/php artisan config:clear --quiet
    echo "Cache cleared"

    chown -R {{$user}}:{{$user}} ./*
    chown -R {{$user}}:{{$user}} ./.*

    echo "Run JS building..."
    yarn prod

    echo "Derevo Done"
@endtask

@task('derevo-test')
    cd /var/www/zaim-dynai/data/www/derevo-denezhnoe.ru/test/
    echo "Pulling repo..."
    git pull origin master

    echo "Run migrations..."
    /opt/php74/bin/php artisan migrate --force --no-interaction

    echo "Installing composer depencencies..."
    /opt/php74/bin/php /usr/local/bin/composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader --ignore-platform-reqs

    /opt/php74/bin/php artisan view:clear --quiet
    /opt/php74/bin/php artisan cache:clear --quiet
    /opt/php74/bin/php artisan config:cache --quiet
    /opt/php74/bin/php artisan config:clear --quiet
    echo "Cache cleared"

    chown -R {{$user}}:{{$user}} ./*
    chown -R {{$user}}:{{$user}} ./.*

    echo "Run JS building..."
    yarn prod

    echo "Derevo Done"
@endtask

@task('oazis')
    cd /var/www/zaim-dynai/data/www/finoazis.ru/cabinet
    echo "Pulling repo..."
    git pull origin master

    echo "Run migrations..."
    /opt/php74/bin/php artisan migrate --force --no-interaction

    echo "Installing composer depencencies..."
    /opt/php74/bin/php /usr/local/bin/composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader --ignore-platform-reqs

    /opt/php74/bin/php artisan view:clear --quiet
    /opt/php74/bin/php artisan cache:clear --quiet
    /opt/php74/bin/php artisan config:cache --quiet
    /opt/php74/bin/php artisan config:clear --quiet
    echo "Cache cleared"

    chown -R {{$user}}:{{$user}} ./*
    chown -R {{$user}}:{{$user}} ./.*

    echo "Run JS building..."
    yarn prod

    echo "Oazis Done"
@endtask

@task('smfv-test')
    cd /var/www/mkk_legatto/data/www/smfv.ru/test
    echo "Pulling repo..."
    git pull origin master

    echo "Run migrations..."
    /opt/php74/bin/php artisan migrate --force --no-interaction

    echo "Installing composer depencencies..."
    /opt/php74/bin/php /usr/local/bin/composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader --ignore-platform-reqs

    /opt/php74/bin/php artisan view:clear --quiet
    /opt/php74/bin/php artisan cache:clear --quiet
    /opt/php74/bin/php artisan config:cache --quiet
    /opt/php74/bin/php artisan config:clear --quiet
    echo "Cache cleared"

    chown -R mkk_legatto:mkk_legatto ./*
    chown -R mkk_legatto:mkk_legatto ./.*

    echo "Run JS building..."
    yarn prod

    echo "Smfv Done"
@endtask
