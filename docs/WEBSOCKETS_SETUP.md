WebSockets setup (Laravel WebSockets + Pusher protocol)
-----------------------------------------------------

These steps enable real-time chat using Laravel WebSockets (no external Pusher account required).

1) Install server packages:

   composer require beyondcode/laravel-websockets pusher/pusher-php-server

2) Publish configuration and migrations:

   php artisan vendor:publish --provider="BeyondCode\\LaravelWebSockets\\WebSocketsServiceProvider" --tag="migrations"
   php artisan vendor:publish --provider="BeyondCode\\LaravelWebSockets\\WebSocketsServiceProvider" --tag="config"
   php artisan migrate

3) Configure .env:

   BROADCAST_DRIVER=pusher
   PUSHER_APP_ID=local
   PUSHER_APP_KEY=local
   PUSHER_APP_SECRET=local
   PUSHER_APP_CLUSTER=mt1

4) Run the WebSocket server (in dev):

   php artisan websockets:serve

5) Frontend packages (optional, we use CDN in the admin layout):

   npm install --save laravel-echo pusher-js
   npm run dev

Notes:
- The app already broadcasts `NewGroupMessage` events on channel `group.{id}` and the admin UI listens via Echo.
- If you prefer Pusher's hosted service, replace .env PUSHER_* values with your Pusher credentials and remove the `websockets:serve` step.
