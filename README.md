# Riget Zoo Adventures - Starter Project (XAMPP)

This starter contains:
- `rza_schema.sql` - MySQL schema to import via phpMyAdmin
- `public/index.php` - simple router entrypoint
- `src/config.php` - DB configuration
- `src/db.php` - PDO helper
- `src/auth.php` - basic auth helpers (register/login)
- `src/booking_ticket.php` - sample ticket booking endpoint
- `proposal.md` and `design_docs.md` - proposal and design docs
- `rza_summary.pdf` - PDF summary of the proposal

Instructions:
1. Install XAMPP and start Apache + MySQL.
2. Open phpMyAdmin and import `rza_schema.sql` into MySQL.
3. Copy the `public` and `src` folders into your XAMPP `htdocs/rza_project` directory.
4. Update `src/config.php` with your DB credentials.
5. Access `http://localhost/rza_project/public/` in your browser.



## Additional setup

Run `php src/seed_user.php` to insert a demo user with a hashed password into the DB (ensure src/config.php DB creds are correct).

To run PHPUnit locally, install dependencies via Composer and run `vendor/bin/phpunit`.

Stripe integration: see `src/payments_stripe.php` for a sample server-side PaymentIntent creation - replace with stripe-php SDK usage and your API keys in production.
