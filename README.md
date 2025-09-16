bash -lc 'set -e
cd /var/www/html/eco-credit-module-clean
cat > README.md <<"MD"
# Eco Credit Module for OpenImpact

A Laravel package that provides a simple credits/savings ledger for individuals and groups. It ships Livewire components, Blade views, and a `transactions` table migration to track:

- Loans, fees, interest, penalties, and repayments for loan accounts
- Deposits and withdrawals for savings accounts
- Per-user and per-group summaries (counts, totals, balances)

The module is framework-native (Laravel + Livewire v3) and UI-ready with modals for creating, editing, and deleting transactions.


## Requirements

- PHP 8.1+
- Laravel 10+ (tested with 10/11)
- Livewire 3 (`livewire/livewire`)
- Livewire UI Modal (`livewire-ui/modal`)


## Installation

1) Install dependencies (if your app does not have them yet):

```bash
composer require livewire/livewire:^3.0 livewire-ui/modal:^2.0
```

2) Require this package:

```bash
composer require tadg-keating-webb/eco-credit-module:dev-main
```

If the repository is not yet on Packagist, add a VCS repository entry to your app's `composer.json` first:

```json
"repositories": [
  { "type": "vcs", "url": "https://github.com/tadg-keating-webb/eco-credit-module" }
]
```

3) Ensure your app layout includes Livewire assets and the Livewire UI Modal root element:

```blade
<!doctype html>
<html>
<head>
    @livewireStyles
</head>
<body>
    {{-- Your content --}}

    @livewireScripts
    <livewire:livewire-ui-modal />
</body>
</html>
```

4) Run database migrations:

```bash
php artisan migrate
```

This creates the `transactions` table used by the module.


## What the package registers

- Service provider: `TadgKeatingWebb\\EcoCreditModule\\Providers\\EcoCreditModuleProvider`
  - Loads package views under the namespace `eco-credit-module::`
  - Loads package migrations
  - Registers Livewire components:
    - `transactions-component`
    - `financial-record-component`
    - `group-financial-record-component`
    - `transaction-modal`
    - `delete-transaction-modal`

No manual provider registration is needed thanks to Laravel package discovery.


## Data model

The package defines a `Transaction` Eloquent model and migration for a `transactions` table:

- `id` (bigint)
- `type` (string)
- `transaction_type` (string) — distinguishes the account category: `loan` or `saving`
- `amount` (decimal 10,2)
- `date` (string; expected format `YYYY-MM-DD`)
- `user_id` (foreign id)
- `created_at` / `updated_at`

Semantics by account type:

- For `loan` accounts, `type` can be: `loan`, `fee`, `interest`, `penalty`, `repay`
  - Balance calculation treats `repay` as positive (reduces debt), all others as negative (increases debt)
- For `saving` accounts, `type` can be: `deposit`, `withdrawal`
  - Balance calculation treats `deposit` as positive, `withdrawal` as negative


## Provided UI components

The package includes Blade views and Livewire components for listing and managing transactions and summaries.

### 1) Transactions list (loans or savings)

Component alias: `transactions-component`

Props:
- `userId` (int, required): ID of the related user
- `type` (string, required): `loan` or `saving`

Renders one of:
- `eco-credit-module::livewire.loans-component`
- `eco-credit-module::livewire.savings-component`

Usage examples:

```blade
{{-- Loan account for a user --}}
<livewire:transactions-component :user-id="$user->id" type="loan" />

{{-- Savings account for a user --}}
<livewire:transactions-component :user-id="$user->id" type="saving" />
```

Each list view includes:
- Current balance header
- Table of transactions with running balance
- Actions per row: Edit / Delete (open modals)
- A "Create Record" button (opens the appropriate modal)

The list updates itself when it receives the `refresh-transactions` event.


### 2) User financial summary

Component alias: `financial-record-component`

Props:
- `userId` (int, required)

Renders `eco-credit-module::livewire.financial-record-component` with:
- `currentLoanSize` (negative means outstanding debt)
- `openLoanAtPresent` (boolean)
- `amountOfLoansIssued`
- Totals: `totalLoanAmount`, `totalFeeAmount`, `totalInterestAmount`, `totalPenaltyAmount`

Usage:

```blade
<livewire:financial-record-component :user-id="$user->id" />
```

This summary listens for `refresh-transactions` and recomputes when transactions change.


### 3) Group financial summary

Component alias: `group-financial-record-component`

Props:
- `users` (Illuminate\\Support\\Collection of models with `id`)

Renders `eco-credit-module::livewire.group-financial-record-component` with group totals and counts across all provided users.

Usage:

```blade
<livewire:group-financial-record-component :users="$groupMembers" />
```


### 4) Transaction modals (create/edit, delete)

- `transaction-modal` — create or edit a transaction
  - Arguments: `userId` (int), `type` (`loan`|`saving`), optional `transaction` (id for editing)
  - On save: persists via the internal `TransactionForm` and dispatches `refresh-transactions`

- `delete-transaction-modal` — confirm deletion
  - Argument: `transaction` (id)
  - On delete: removes the record and dispatches `refresh-transactions`

If you need to open a modal manually (the provided list views already do this):

```html
<script>
    // Livewire v3 syntax
    Livewire.dispatch('openModal', {
        component: 'transaction-modal',
        arguments: { userId: 1, type: 'loan' }
    })
</script>
```

Make sure your layout contains `<livewire:livewire-ui-modal />`.


## Programmatic API

Model: `TadgKeatingWebb\\EcoCreditModule\\Models\\Transaction`

```php
use TadgKeatingWebb\\EcoCreditModule\\Models\\Transaction;

Transaction::create([
    'user_id' => $userId,
    'type' => 'deposit',            // or loan/fee/interest/penalty/repay/withdrawal
    'amount' => 1000,
    'date' => '2025-01-15',
    'transaction_type' => 'saving',  // or 'loan'
]);
```


## View customization

Views are loaded under the namespace `eco-credit-module::`. To override in your app, copy the corresponding view into:

```
resources/views/vendor/eco-credit-module/livewire/*.blade.php
```

For example, to customize the loans list, create:

```
resources/views/vendor/eco-credit-module/livewire/loans-component.blade.php
```


## Notes and caveats

- Authorization: the package does not implement authorization. Ensure only permitted users can view/create/edit/delete transactions in your app.
- Dates: `date` is stored as a string; use `YYYY-MM-DD` for consistency and correct ordering.
- Assets: some views reference icons like `/images/system/overflow-icon.svg`. Provide these assets or adjust the views.
- Events: components listen for `refresh-transactions` to refresh lists and summaries after create/edit/delete.
- Migration down(): the current `down` method drops a `savings` table; if you need to roll back, adjust to drop `transactions` instead (or run manual SQL).


## Development

- Run migrations in your test app and interact with the components via Blade, as shown above.
- The service provider auto-discovers; no manual registration needed.
- There are no published config files yet.

## License

MIT License

Copyright (c) 2025 Open Impact contributors

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
