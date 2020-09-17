@servers(['web' => 'root@92.63.99.149'])

@task('list', ['on' => 'web'])
ls -l
@endtask
