
Riget Zoo Adventures - Design Documents
======================================

1. Overview
-----------
This document provides design artefacts to guide developers and stakeholders in implementing the RZA digital solution. It includes UI wireframes, ERD/table schemas, API endpoints, algorithm pseudocode, and test strategy.

2. UI / Visual Designs
----------------------
(See textual wireframes in earlier deliverable. Implemented pages: index.html (demo), booking flows.)

3. ERD & Data Schemas
---------------------
Included in rza_schema.sql (users, bookings, zoo_tickets, rooms, room_inventory, payments, loyalty_accounts, educational_resources, ticket_capacity).

4. API Design
-------------
Key endpoints (sample list):
- POST /api/register
- POST /api/login
- POST /api/tickets/book
- GET /api/tickets/availability
- GET /api/hotel/availability
- POST /api/hotel/book
- POST /api/payments/charge
- GET /api/user/bookings
- GET /api/education/resources
- POST /api/admin/bookings/{id}/update

Authentication: session cookies or JWT; admin routes require role checks.

5. Algorithms (pseudocode)
--------------------------
(Include the five algorithms from the proposal: room locking, ticket capacity, loyalty, search scoring, service-worker caching.)

6. Front-end sample
-------------------
A simple demo front-end `public/index.html` provides booking forms for tickets and hotel with JavaScript to call the API endpoints. The app registers a service worker for PWA offline caching.

7. Test strategy
----------------
(See earlier test plan: unit, integration, system, performance, security, accessibility, UAT.)

8. Deployment & dev notes
-------------------------
- Use environment-based config (src/config.php)
- Use HTTPS in production (Let's Encrypt)
- Use payment gateway sandbox keys in staging
- Run automated test suite in CI (GitHub Actions, GitLab CI, etc.)

9. Handover
-----------
Provide README and SQL dump; document admin credentials; provide sample seed data for demo usage.
