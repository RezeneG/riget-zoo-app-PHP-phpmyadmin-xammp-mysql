const CACHE = 'rza-demo-v1';
const toCache = [
  '/rza_project/public/',
  '/rza_project/public/index.html',
  '/rza_project/public/booking.js'
];
self.addEventListener('install', e => {
  e.waitUntil(caches.open(CACHE).then(c => c.addAll(toCache)));
});
self.addEventListener('fetch', e => {
  e.respondWith(caches.match(e.request).then(r => r || fetch(e.request)));
});