document.addEventListener('DOMContentLoaded', () => {
  const today = new Date().toISOString().slice(0,10);
  document.getElementById('ticket_date').value = today;
  document.getElementById('start_date').value = today;
  const tomorrow = new Date(Date.now()+86400000).toISOString().slice(0,10);
  document.getElementById('end_date').value = tomorrow;

  document.getElementById('buy_ticket').addEventListener('click', async ()=>{
    const date = document.getElementById('ticket_date').value;
    const qty = parseInt(document.getElementById('ticket_qty').value,10);
    const resp = await fetch('/rza_project/public/api/tickets/book', {
      method:'POST',
      headers:{'Content-Type':'application/json'},
      body: JSON.stringify({user_id:1, visit_date: date, ticket_type:'adult', quantity: qty})
    });
    const data = await resp.json();
    document.getElementById('ticket_result').textContent = JSON.stringify(data, null, 2);
  });

  document.getElementById('book_room').addEventListener('click', async ()=>{
    const room = parseInt(document.getElementById('room_id').value,10);
    const start = document.getElementById('start_date').value;
    const end = document.getElementById('end_date').value;
    const resp = await fetch('/rza_project/public/api/hotel/book', {
      method:'POST',
      headers:{'Content-Type':'application/json'},
      body: JSON.stringify({user_id:1, room_id: room, start_date: start, end_date: end})
    });
    const data = await resp.json();
    document.getElementById('hotel_result').textContent = JSON.stringify(data, null, 2);
  });

  // register service worker
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/rza_project/public/service-worker.js').catch(console.error);
  }
});