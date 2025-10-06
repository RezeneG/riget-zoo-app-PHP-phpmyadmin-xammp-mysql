
Riget Zoo Adventures (RZA) - Detailed Proposal
==============================================

Prepared for: Riget Zoo Adventures (RZA)
Prepared by: [Your Company Name]
Date: 2025-10-03

1. Executive summary
--------------------
Riget Zoo Adventures (RZA) combines a safari-style wildlife experience, an on-site hotel, and educational visits. This proposal outlines a digital solution to centralize information, improve visitor experience, enable reliable bookings for zoo tickets and hotel stays, and support educational resources and accessibility. The recommended solution is a responsive web application (PWA-capable) using PHP + MySQL backend, JavaScript/HTML/CSS frontend, and integration with a PCI-compliant payment gateway.

2. Business context & objectives
-------------------------------
- Increase direct online ticket & hotel bookings (reduce third-party fees).
- Improve operational efficiency for staff through an admin dashboard.
- Enhance educational offering with downloadable, curriculum-mapped resources.
- Provide accessible, inclusive digital experiences per WCAG 2.1 AA.
- Implement a loyalty scheme to boost repeat visits and lifetime value.

3. Stakeholders
---------------
- RZA Owners / Management
- Front-desk & Ticketing Staff
- Education Coordinators / Teachers
- Hotel Operations Team
- Marketing & CRM Team
- End customers (families, schools, tourists, guests with accessibility needs)

4. Scope & features
-------------------
Core features:
- Public information pages (zoo, hotel, plan visit)
- Availability checking & booking for zoo tickets (single/group)
- Hotel room availability & booking system
- User accounts: registration, profile, manage bookings
- Loyalty & rewards: points accrual and redemption
- Admin dashboard: manage bookings, rooms, resources, reports
- Educational resources library: downloadable curriculum-aligned packs
- Accessibility toolkit: theme toggle, font scaling, keyboard navigation
- Notifications: booking confirmation, reminders, receipts (email)
- Payment integration (3rd party) and secure handling

Out of scope for initial MVP (recommend phased roadmap):
- Full PMS two-way sync (can be added via adapter)
- Native mobile apps (PWA recommended instead)
- Advanced AR tours (phase 2)

5. Functional & non-functional requirements
-------------------------------------------
(See included FR and NFR lists in original proposal. Implementation will honor security, scalability, maintainability, privacy, and accessibility requirements.)

6. Architecture overview
------------------------
- Presentation: Responsive frontend + PWA service worker
- API: RESTful PHP endpoints secured with sessions/JWT
- Persistence: MySQL (phpMyAdmin for management)
- Integrations: Payment gateway, SMTP for emails, analytics
- Dev/Deployment: XAMPP for local dev; LAMP or cloud VM for production

7. Data model & key tables
--------------------------
Core tables: users, bookings, zoo_tickets, rooms, room_inventory, payments, loyalty_accounts, educational_resources, ticket_capacity.

8. KPI targets
--------------
- Online booking conversion: >5%
- Average page load: <3s
- Hotel occupancy (peak season): >70%
- Loyalty uptake: >20% of registered users within 6 months
- WCAG compliance: Pass AA audit

9. Risk management
------------------
(See original risk & mitigations; include PCI, GDPR, double-booking, scalability, accessibility testing.)

10. Roadmap & timeline (high level)
-----------------------------------
Phase 0 (2 weeks): Discovery, requirements & UX wireframes.
Phase 1 (6-8 weeks): MVP implementation (ticket + hotel booking, account, payments via sandbox, admin dashboard, educational library, accessibility features).
Phase 2 (4-6 weeks): Loyalty program, reporting, PWA polish, load testing, UAT.
Phase 3 (ongoing): Integrations (PMS), mobile app, AR features.

11. Costs & resources (estimate)
--------------------------------
Provide estimates based on developer days — omitted in this document; available on request.

Appendices
----------
- Research notes (hardware/software, emerging tech, guidelines)
- ERD & schema (see rza_schema.sql)
- Test plan (see design_docs.md)
