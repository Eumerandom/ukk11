start   : 10.23
end     : 10.30

> ### kustomisasi tampilan dashboard
``` php
    protected static ?string $navigationLabel = 'Siswa';
    protected static ?string $navigationGroup = 'Internship Management';
    protected static ?int $navigationSort = 3;

```

> ### memindah navigation role
``` bash
php artisan vendor:publish --tag="filament-shield-translations"
```