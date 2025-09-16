<?php

namespace EcoCredit\EcoCreditModule\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class EcoCreditModuleProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function boot()
    {
        // Register views from the submodule
        $this->loadViewsFrom(__DIR__.'/../views', 'eco-credit-module');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Register the Livewire component with an alias
        Livewire::component('transactions-component', \TadgKeatingWebb\EcoCreditModule\Livewire\TransactionsComponent::class);
        Livewire::component('financial-record-component', \TadgKeatingWebb\EcoCreditModule\Livewire\FinancialRecordComponent::class);
        Livewire::component('group-financial-record-component', \TadgKeatingWebb\EcoCreditModule\Livewire\GroupFinancialRecordComponent::class);
        Livewire::component('transaction-modal', \TadgKeatingWebb\EcoCreditModule\Livewire\TransactionModal::class);
        Livewire::component('delete-transaction-modal', \TadgKeatingWebb\EcoCreditModule\Livewire\DeleteTransactionModal::class);
    }
}
