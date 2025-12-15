Storing uploaded files (avatars)
--------------------------------

This project stores user-uploaded avatars on the `public` disk (storage/app/public).

Steps to enable and verify:

1) Ensure the `public` disk is configured in `config/filesystems.php` (Laravel default).

2) Create the storage symlink so files stored on the `public` disk are served from `/storage`:

```bash
php artisan storage:link
```

3) When users upload an avatar the app stores it with `Storage::disk('public')->putFile('avatars', $file)` and saves the path in the `users.avatar` column. The file will then be web-accessible at `/storage/avatars/<filename>`.

4) Make sure your webserver allows serving the `/storage` path.
