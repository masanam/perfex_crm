<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * get account types
     * @param  integer $id    member group id
     * @param  array  $where
     * @return object
     */
    public function get_account_types()
    {
        $account_types = hooks()->apply_filters('before_get_account_types', [
            [
                'id'             => 1,
                'name'           => _l('acc_accounts_receivable'),
                'order'          => 1,
                ],
            [
                'id'             => 2,
                'name'           => _l('acc_current_assets'),
                'order'          => 2,
                ],
            [
                'id'             => 3,
                'name'           => _l('acc_cash_and_cash_equivalents'),
                'order'          => 3,
                ],
            [
                'id'             => 4,
                'name'           => _l('acc_fixed_assets'),
                'order'          => 4,
                ],
            [
                'id'             => 5,
                'name'           => _l('acc_non_current_assets'),
                'order'          => 5,
                ],
            [
                'id'             => 6,
                'name'           => _l('acc_accounts_payable'),
                'order'          => 6,
                ],
            [
                'id'             => 7,
                'name'           => _l('acc_credit_card'),
                'order'          => 7,
                ],
            [
                'id'             => 8,
                'name'           => _l('acc_current_liabilities'),
                'order'          => 8,
                ],
            [
                'id'             => 9,
                'name'           => _l('acc_non_current_liabilities'),
                'order'          => 9,
                ],
            [
                'id'             => 10,
                'name'           => _l('acc_owner_equity'),
                'order'          => 10,
                ],
            [
                'id'             => 11,
                'name'           => _l('acc_income'),
                'order'          => 11,
                ],
            [
                'id'             => 12,
                'name'           => _l('acc_other_income'),
                'order'          => 12,
                ],
            [
                'id'             => 13,
                'name'           => _l('acc_cost_of_sales'),
                'order'          => 13,
                ],
            [
                'id'             => 14,
                'name'           => _l('acc_expenses'),
                'order'          => 14,
                ],
            [
                'id'             => 15,
                'name'           => _l('acc_other_expense'),
                'order'          => 15,
                ],
            ]);

        usort($account_types, function ($a, $b) {
            return $a['order'] - $b['order'];
        });

        return $account_types;
    }

    /**
     * get account type details
     * @param  integer $id    member group id
     * @param  array  $where
     * @return object
     */
    public function get_account_type_details()
    {
        $account_type_details = hooks()->apply_filters('before_get_account_type_details', [
            [
                'id'                => 1,
                'account_type_id'   => 1,
                'name'              => _l('acc_accounts_receivable'),
                'note'              => _l('acc_accounts_receivable_note'),
                'order'             => 1,
                ],
            [
                'id'                => 2,
                'account_type_id'   => 2,
                'name'              => _l('acc_allowance_for_bad_debts'),
                'note'              => _l('acc_allowance_for_bad_debts_note'),
                'order'             => 2,
                ],
            [
                'id'                => 3,
                'account_type_id'   => 2,
                'name'              => _l('acc_assets_available_for_sale'),
                'note'              => _l('acc_assets_available_for_sale_note'),
                'order'             => 3,
                ],
            [
                'id'                => 4,
                'account_type_id'   => 2,
                'name'              => _l('acc_development_costs'),
                'note'              => _l('acc_development_costs_note'),
                'order'             => 4,
                ],
            [
                'id'                => 141,
                'account_type_id'   => 2,
                'name'              => _l('acc_employee_cash_advances'),
                'note'              => _l('acc_employee_cash_advances_note'),
                'order'             => 5,
                ],
            [
                'id'                => 5,
                'account_type_id'   => 2,
                'name'              => _l('acc_inventory'),
                'note'              => _l('acc_inventory_note'),
                'order'             => 5,
                ],
            [
                'id'                => 6,
                'account_type_id'   => 2,
                'name'              => _l('acc_investments_other'),
                'note'              => _l('acc_investments_other_note'),
                'order'             => 6,
                ],
            [
                'id'                => 7,
                'account_type_id'   => 2,
                'name'              => _l('acc_loans_to_officers'),
                'note'              => _l('acc_loans_to_officers_note'),
                'order'             => 7,
                ],
            [
                'id'                => 8,
                'account_type_id'   => 2,
                'name'              => _l('acc_loans_to_others'),
                'note'              => _l('acc_loans_to_others_note'),
                'order'             => 8,
                ],
            [
                'id'                => 9,
                'account_type_id'   => 2,
                'name'              => _l('acc_loans_to_shareholders'),
                'note'              => _l('acc_loans_to_shareholders_note'),
                'order'             => 9,
                ],
            [
                'id'                => 10,
                'account_type_id'   => 2,
                'name'              => _l('acc_other_current_assets'),
                'note'              => _l('acc_other_current_assets_note'),
                'order'             => 10,
                ],
            [
                'id'                => 11,
                'account_type_id'   => 2,
                'name'              => _l('acc_prepaid_expenses'),
                'note'              => _l('acc_prepaid_expenses_note'),
                'order'             => 11,
                ],
            [
                'id'                => 12,
                'account_type_id'   => 2,
                'name'              => _l('acc_retainage'),
                'note'              => _l('acc_retainage_note'),
                'order'             => 12,
                ],
            [
                'id'                => 13,
                'account_type_id'   => 2,
                'name'              => _l('acc_undeposited_funds'),
                'note'              => _l('acc_undeposited_funds_note'),
                'order'             => 13,
                ],
            [
                'id'                => 14,
                'account_type_id'   => 3,
                'name'              => _l('acc_bank'),
                'note'              => _l('acc_bank_note'),
                'order'             => 14,
                ],
            [
                'id'                => 15,
                'account_type_id'   => 3,
                'name'              => _l('acc_cash_and_cash_equivalents'),
                'note'              => _l('acc_cash_and_cash_equivalents_note'),
                'order'             => 15,
                ],
            [
                'id'                => 16,
                'account_type_id'   => 3,
                'name'              => _l('acc_cash_on_hand'),
                'note'              => _l('acc_cash_on_hand_note'),
                'order'             => 16,
                ],
            [
                'id'                => 17,
                'account_type_id'   => 3,
                'name'              => _l('acc_client_trust_account'),
                'note'              => _l('acc_client_trust_account_note'),
                'order'             => 17,
                ],
            [
                'id'                => 18,
                'account_type_id'   => 3,
                'name'              => _l('acc_money_market'),
                'note'              => _l('acc_money_market_note'),
                'order'             => 18,
                ],
            [
                'id'                => 19,
                'account_type_id'   => 3,
                'name'              => _l('acc_rents_held_in_trust'),
                'note'              => _l('acc_rents_held_in_trust_note'),
                'order'             => 19,
                ],
            [
                'id'                => 20,
                'account_type_id'   => 3,
                'name'              => _l('acc_savings'),
                'note'              => _l('acc_savings_note'),
                'order'             => 20,
                ],
            [
                'id'                => 21,
                'account_type_id'   => 4,
                'name'              => _l('acc_accumulated_depletion'),
                'note'              => _l('acc_accumulated_depletion_note'),
                'order'             => 21,
                ],
            [
                'id'                => 22,
                'account_type_id'   => 4,
                'name'              => _l('acc_accumulated_depreciation_on_property_plant_and_equipment'),
                'note'              => _l('acc_accumulated_depreciation_on_property_plant_and_equipment_note'),
                'order'             => 22,
                ],
            [
                'id'                => 23,
                'account_type_id'   => 4,
                'name'              => _l('acc_buildings'),
                'note'              => _l('acc_buildings_note'),
                'order'             => 23,
                ],
            [
                'id'                => 24,
                'account_type_id'   => 4,
                'name'              => _l('acc_depletable_assets'),
                'note'              => _l('acc_depletable_assets_note'),
                'order'             => 24,
                ],
            [
                'id'                => 25,
                'account_type_id'   => 4,
                'name'              => _l('acc_furniture_and_fixtures'),
                'note'              => _l('acc_furniture_and_fixtures_note'),
                'order'             => 25,
                ],
            [
                'id'                => 26,
                'account_type_id'   => 4,
                'name'              => _l('acc_land'),
                'note'              => _l('acc_land_note'),
                'order'             => 26,
                ],
            [
                'id'                => 27,
                'account_type_id'   => 4,
                'name'              => _l('acc_leasehold_improvements'),
                'note'              => _l('acc_leasehold_improvements_note'),
                'order'             => 27,
                ],
            [
                'id'                => 28,
                'account_type_id'   => 4,
                'name'              => _l('acc_machinery_and_equipment'),
                'note'              => _l('acc_machinery_and_equipment_note'),
                'order'             => 28,
                ],
            [
                'id'                => 29,
                'account_type_id'   => 4,
                'name'              => _l('acc_other_fixed_assets'),
                'note'              => _l('acc_other_fixed_assets_note'),
                'order'             => 29,
                ],
            [
                'id'                => 30,
                'account_type_id'   => 4,
                'name'              => _l('acc_vehicles'),
                'note'              => _l('acc_vehicles_note'),
                'order'             => 30,
                ],
            [
                'id'                => 31,
                'account_type_id'   => 5,
                'name'              => _l('acc_accumulated_amortisation_of_non_current_assets'),
                'note'              => _l('acc_accumulated_amortisation_of_non_current_assets_note'),
                'order'             => 31,
                ],
            [
                'id'                => 32,
                'account_type_id'   => 5,
                'name'              => _l('acc_assets_held_for_sale'),
                'note'              => _l('acc_assets_held_for_sale_note'),
                'order'             => 32,
                ],
            [
                'id'                => 33,
                'account_type_id'   => 5,
                'name'              => _l('acc_deferred_tax'),
                'note'              => _l('acc_deferred_tax_note'),
                'order'             => 33,
                ],
            [
                'id'                => 34,
                'account_type_id'   => 5,
                'name'              => _l('acc_goodwill'),
                'note'              => _l('acc_goodwill_note'),
                'order'             => 34,
                ],
            [
                'id'                => 35,
                'account_type_id'   => 5,
                'name'              => _l('acc_intangible_assets'),
                'note'              => _l('acc_intangible_assets_note'),
                'order'             => 35,
                ],
            [
                'id'                => 36,
                'account_type_id'   => 5,
                'name'              => _l('acc_lease_buyout'),
                'note'              => _l('acc_lease_buyout_note'),
                'order'             => 36,
                ],
            [
                'id'                => 37,
                'account_type_id'   => 5,
                'name'              => _l('acc_licences'),
                'note'              => _l('acc_licences_note'),
                'order'             => 37,
                ],
            [
                'id'                => 38,
                'account_type_id'   => 5,
                'name'              => _l('acc_long_term_investments'),
                'note'              => _l('acc_long_term_investments_note'),
                'order'             => 38,
                ],
            [
                'id'                => 39,
                'account_type_id'   => 5,
                'name'              => _l('acc_organisational_costs'),
                'note'              => _l('acc_organisational_costs_note'),
                'order'             => 39,
                ],
            [
                'id'                => 40,
                'account_type_id'   => 5,
                'name'              => _l('acc_other_non_current_assets'),
                'note'              => _l('acc_other_non_current_assets_note'),
                'order'             => 40,
                ],
            [
                'id'                => 41,
                'account_type_id'   => 5,
                'name'              => _l('acc_security_deposits'),
                'note'              => _l('acc_security_deposits_note'),
                'order'             => 41,
                ],
            [
                'id'                => 42,
                'account_type_id'   => 6,
                'name'              => _l('acc_accounts_payable'),
                'note'              => _l('acc_accounts_payable_note'),
                'order'             => 42,
                ],
            [
                'id'                => 43,
                'account_type_id'   => 7,
                'name'              => _l('acc_credit_card'),
                'note'              => _l('acc_credit_card_note'),
                'order'             => 43,
                ],
            [
                'id'                => 44,
                'account_type_id'   => 8,
                'name'              => _l('acc_accrued_liabilities'),
                'note'              => _l('acc_accrued_liabilities_note'),
                'order'             => 44,
                ],
            [
                'id'                => 45,
                'account_type_id'   => 8,
                'name'              => _l('acc_client_trust_accounts_liabilities'),
                'note'              => _l('acc_client_trust_accounts_liabilities_note'),
                'order'             => 45,
                ],
            [
                'id'                => 46,
                'account_type_id'   => 8,
                'name'              => _l('acc_current_tax_liability'),
                'note'              => _l('acc_current_tax_liability_note'),
                'order'             => 46,
                ],
            [
                'id'                => 47,
                'account_type_id'   => 8,
                'name'              => _l('acc_current_portion_of_obligations_under_finance_leases'),
                'note'              => _l('acc_current_portion_of_obligations_under_finance_leases_note'),
                'order'             => 47,
                ],
            [
                'id'                => 48,
                'account_type_id'   => 8,
                'name'              => _l('acc_dividends_payable'),
                'note'              => _l('acc_dividends_payable_note'),
                'order'             => 48,
                ],
            [
                'id'                => 50,
                'account_type_id'   => 8,
                'name'              => _l('acc_income_tax_payable'),
                'note'              => _l('acc_income_tax_payable_note'),
                'order'             => 50,
                ],
            [
                'id'                => 51,
                'account_type_id'   => 8,
                'name'              => _l('acc_insurance_payable'),
                'note'              => _l('acc_insurance_payable_note'),
                'order'             => 51,
                ],
            [
                'id'                => 52,
                'account_type_id'   => 8,
                'name'              => _l('acc_line_of_credit'),
                'note'              => _l('acc_line_of_credit_note'),
                'order'             => 52,
                ],
            [
                'id'                => 53,
                'account_type_id'   => 8,
                'name'              => _l('acc_loan_payable'),
                'note'              => _l('acc_loan_payable_note'),
                'order'             => 53,
                ],
            [
                'id'                => 54,
                'account_type_id'   => 8,
                'name'              => _l('acc_other_current_liabilities'),
                'note'              => _l('acc_other_current_liabilities_note'),
                'order'             => 54,
                ],
            [
                'id'                => 55,
                'account_type_id'   => 8,
                'name'              => _l('acc_payroll_clearing'),
                'note'              => _l('acc_payroll_clearing_note'),
                'order'             => 55,
                ],
            [
                'id'                => 56,
                'account_type_id'   => 8,
                'name'              => _l('acc_payroll_liabilities'),
                'note'              => _l('acc_payroll_liabilities_note'),
                'order'             => 56,
                ],
            [
                'id'                => 58,
                'account_type_id'   => 8,
                'name'              => _l('acc_prepaid_expenses_payable'),
                'note'              => _l('acc_prepaid_expenses_payable_note'),
                'order'             => 58,
                ],
            [
                'id'                => 59,
                'account_type_id'   => 8,
                'name'              => _l('acc_rents_in_trust_liability'),
                'note'              => _l('acc_rents_in_trust_liability_note'),
                'order'             => 59,
                ],
            [
                'id'                => 60,
                'account_type_id'   => 8,
                'name'              => _l('acc_sales_and_service_tax_payable'),
                'note'              => _l('acc_sales_and_service_tax_payable_note'),
                'order'             => 60,
                ],
            [
                'id'                => 61,
                'account_type_id'   => 9,
                'name'              => _l('acc_accrued_holiday_payable'),
                'note'              => _l('acc_accrued_holiday_payable_note'),
                'order'             => 61,
                ],
            [
                'id'                => 62,
                'account_type_id'   => 9,
                'name'              => _l('acc_accrued_non_current_liabilities'),
                'note'              => _l('acc_accrued_non_current_liabilities_note'),
                'order'             => 62,
                ],
            [
                'id'                => 63,
                'account_type_id'   => 9,
                'name'              => _l('acc_liabilities_related_to_assets_held_for_sale'),
                'note'              => _l('acc_liabilities_related_to_assets_held_for_sale_note'),
                'order'             => 63,
                ],
            [
                'id'                => 64,
                'account_type_id'   => 9,
                'name'              => _l('acc_long_term_debt'),
                'note'              => _l('acc_long_term_debt_note'),
                'order'             => 64,
                ],
            [
                'id'                => 65,
                'account_type_id'   => 9,
                'name'              => _l('acc_notes_payable'),
                'note'              => _l('acc_notes_payable_note'),
                'order'             => 65,
                ],
            [
                'id'                => 66,
                'account_type_id'   => 9,
                'name'              => _l('acc_other_non_current_liabilities'),
                'note'              => _l('acc_other_non_current_liabilities_note'),
                'order'             => 66,
                ],
            [
                'id'                => 67,
                'account_type_id'   => 9,
                'name'              => _l('acc_shareholder_potes_payable'),
                'note'              => _l('acc_shareholder_potes_payable_note'),
                'order'             => 67,
                ],
            [
                'id'                => 68,
                'account_type_id'   => 10,
                'name'              => _l('acc_accumulated_adjustment'),
                'note'              => _l('acc_accumulated_adjustment_note'),
                'order'             => 68,
                ],
            [
                'id'                => 69,
                'account_type_id'   => 10,
                'name'              => _l('acc_dividend_disbursed'),
                'note'              => _l('acc_dividend_disbursed_note'),
                'order'             => 69,
                ],
            [
                'id'                => 70,
                'account_type_id'   => 10,
                'name'              => _l('acc_equity_in_earnings_of_subsidiaries'),
                'note'              => _l('acc_equity_in_earnings_of_subsidiaries_note'),
                'order'             => 70,
                ],
            [
                'id'                => 71,
                'account_type_id'   => 10,
                'name'              => _l('acc_opening_balance_equity'),
                'note'              => _l('acc_opening_balance_equity_note'),
                'order'             => 71,
                ],
            [
                'id'                => 72,
                'account_type_id'   => 10,
                'name'              => _l('acc_ordinary_shares'),
                'note'              => _l('acc_ordinary_shares_note'),
                'order'             => 72,
                ],
            [
                'id'                => 73,
                'account_type_id'   => 10,
                'name'              => _l('acc_other_comprehensive_income'),
                'note'              => _l('acc_other_comprehensive_income_note'),
                'order'             => 73,
                ],
            [
                'id'                => 74,
                'account_type_id'   => 10,
                'name'              => _l('acc_owner_equity'),
                'note'              => _l('acc_owner_equity_note'),
                'order'             => 74,
                ],
            [
                'id'                => 75,
                'account_type_id'   => 10,
                'name'              => _l('acc_paid_in_capital_or_surplus'),
                'note'              => _l('acc_paid_in_capital_or_surplus_note'),
                'order'             => 75,
                ],
            [
                'id'                => 76,
                'account_type_id'   => 10,
                'name'              => _l('acc_partner_contributions'),
                'note'              => _l('acc_partner_contributions_note'),
                'order'             => 76,
                ],
            [
                'id'                => 77,
                'account_type_id'   => 10,
                'name'              => _l('acc_partner_distributions'),
                'note'              => _l('acc_partner_distributions_note'),
                'order'             => 77,
                ],
            [
                'id'                => 78,
                'account_type_id'   => 10,
                'name'              => _l('acc_partner_equity'),
                'note'              => _l('acc_partner_equity_note'),
                'order'             => 78,
                ],
            [
                'id'                => 79,
                'account_type_id'   => 10,
                'name'              => _l('acc_preferred_shares'),
                'note'              => _l('acc_preferred_shares_note'),
                'order'             => 79,
                ],
            [
                'id'                => 80,
                'account_type_id'   => 10,
                'name'              => _l('acc_retained_earnings'),
                'note'              => _l('acc_retained_earnings_note'),
                'order'             => 80,
                ],
            [
                'id'                => 81,
                'account_type_id'   => 10,
                'name'              => _l('acc_share_capital'),
                'note'              => _l('acc_share_capital_note'),
                'order'             => 81,
                ],
            [
                'id'                => 82,
                'account_type_id'   => 10,
                'name'              => _l('acc_treasury_shares'),
                'note'              => _l('acc_treasury_shares_note'),
                'order'             => 82,
                ],
            [
                'id'                => 83,
                'account_type_id'   => 11,
                'name'              => _l('acc_discounts_refunds_given'),
                'note'              => _l('acc_discounts_refunds_given_note'),
                'order'             => 83,
                ],
            [
                'id'                => 84,
                'account_type_id'   => 11,
                'name'              => _l('acc_non_profit_income'),
                'note'              => _l('acc_non_profit_income_note'),
                'order'             => 84,
                ],
            [
                'id'                => 85,
                'account_type_id'   => 11,
                'name'              => _l('acc_other_primary_income'),
                'note'              => _l('acc_other_primary_income_note'),
                'order'             => 85,
                ],
            [
                'id'                => 86,
                'account_type_id'   => 11,
                'name'              => _l('acc_revenue_general'),
                'note'              => _l('acc_revenue_general_note'),
                'order'             => 86,
                ],
            [
                'id'                => 87,
                'account_type_id'   => 11,
                'name'              => _l('acc_sales_retail'),
                'note'              => _l('acc_sales_retail_note'),
                'order'             => 87,
                ],
            [
                'id'                => 88,
                'account_type_id'   => 11,
                'name'              => _l('acc_sales_wholesale'),
                'note'              => _l('acc_sales_wholesale_note'),
                'order'             => 88,
                ],
            [
                'id'                => 89,
                'account_type_id'   => 11,
                'name'              => _l('acc_sales_of_product_income'),
                'note'              => _l('acc_sales_of_product_income_note'),
                'order'             => 89,
                ],
            [
                'id'                => 90,
                'account_type_id'   => 11,
                'name'              => _l('acc_service_fee_income'),
                'note'              => _l('acc_service_fee_income_note'),
                'order'             => 90,
                ],
            [
                'id'                => 91,
                'account_type_id'   => 11,
                'name'              => _l('acc_unapplied_cash_payment_income'),
                'note'              => _l('acc_unapplied_cash_payment_income_note'),
                'order'             => 91,
                ],
            [
                'id'                => 92,
                'account_type_id'   => 12,
                'name'              => _l('acc_dividend_income'),
                'note'              => _l('acc_dividend_income_note'),
                'order'             => 92,
                ],
            [
                'id'                => 93,
                'account_type_id'   => 12,
                'name'              => _l('acc_interest_earned'),
                'note'              => _l('acc_interest_earned_note'),
                'order'             => 93,
                ],
            [
                'id'                => 94,
                'account_type_id'   => 12,
                'name'              => _l('acc_loss_on_disposal_of_assets'),
                'note'              => _l('acc_loss_on_disposal_of_assets_note'),
                'order'             => 94,
                ],
            [
                'id'                => 95,
                'account_type_id'   => 12,
                'name'              => _l('acc_other_investment_income'),
                'note'              => _l('acc_other_investment_income_note'),
                'order'             => 95,
                ],
            [
                'id'                => 96,
                'account_type_id'   => 12,
                'name'              => _l('acc_other_miscellaneous_income'),
                'note'              => _l('acc_other_miscellaneous_income_note'),
                'order'             => 96,
                ],
            [
                'id'                => 97,
                'account_type_id'   => 12,
                'name'              => _l('acc_other_operating_income'),
                'note'              => _l('acc_other_operating_income_note'),
                'order'             => 97,
                ],
            [
                'id'                => 98,
                'account_type_id'   => 12,
                'name'              => _l('acc_tax_exempt_interest'),
                'note'              => _l('acc_tax_exempt_interest_note'),
                'order'             => 98,
                ],
            [
                'id'                => 99,
                'account_type_id'   => 12,
                'name'              => _l('acc_unrealised_loss_on_securities_net_of_tax'),
                'note'              => _l('acc_unrealised_loss_on_securities_net_of_tax_note'),
                'order'             => 99,
                ],
            [
                'id'                => 100,
                'account_type_id'   => 13,
                'name'              => _l('acc_cost_of_labour_cos'),
                'note'              => _l('acc_cost_of_labour_cos_note'),
                'order'             => 100,
                ],
            [
                'id'                => 101,
                'account_type_id'   => 13,
                'name'              => _l('acc_equipment_rental_cos'),
                'note'              => _l('acc_equipment_rental_cos_note'),
                'order'             => 101,
                ],
            [
                'id'                => 102,
                'account_type_id'   => 13,
                'name'              => _l('acc_freight_and_delivery_cos'),
                'note'              => _l('acc_freight_and_delivery_cos_note'),
                'order'             => 102,
                ],
            [
                'id'                => 103,
                'account_type_id'   => 13,
                'name'              => _l('acc_other_costs_of_sales_cos'),
                'note'              => _l('acc_other_costs_of_sales_cos_note'),
                'order'             => 103,
                ],
            [
                'id'                => 104,
                'account_type_id'   => 13,
                'name'              => _l('acc_supplies_and_materials_cos'),
                'note'              => _l('acc_supplies_and_materials_cos_note'),
                'order'             => 104,
                ],
            [
                'id'                => 105,
                'account_type_id'   => 14,
                'name'              => _l('acc_advertising_promotional'),
                'note'              => _l('acc_advertising_promotional_note'),
                'order'             => 105,
                ],
            [
                'id'                => 106,
                'account_type_id'   => 14,
                'name'              => _l('acc_amortisation_expense'),
                'note'              => _l('acc_amortisation_expense_note'),
                'order'             => 106,
                ],
            [
                'id'                => 107,
                'account_type_id'   => 14,
                'name'              => _l('acc_auto'),
                'note'              => _l('acc_auto_note'),
                'order'             => 107,
                ],
            [
                'id'                => 108,
                'account_type_id'   => 14,
                'name'              => _l('acc_bad_debts'),
                'note'              => _l('acc_bad_debts_note'),
                'order'             => 108,
                ],
            [
                'id'                => 109,
                'account_type_id'   => 14,
                'name'              => _l('acc_bank_charges'),
                'note'              => _l('acc_bank_charges_note'),
                'order'             => 109,
                ],
            [
                'id'                => 110,
                'account_type_id'   => 14,
                'name'              => _l('acc_charitable_contributions'),
                'note'              => _l('acc_charitable_contributions_note'),
                'order'             => 110,
                ],
            [
                'id'                => 111,
                'account_type_id'   => 14,
                'name'              => _l('acc_commissions_and_fees'),
                'note'              => _l('acc_commissions_and_fees_note'),
                'order'             => 111,
                ],
            [
                'id'                => 112,
                'account_type_id'   => 14,
                'name'              => _l('acc_cost_of_labour'),
                'note'              => _l('acc_cost_of_labour_note'),
                'order'             => 112,
                ],
            [
                'id'                => 113,
                'account_type_id'   => 14,
                'name'              => _l('acc_dues_and_subscriptions'),
                'note'              => _l('acc_dues_and_subscriptions_note'),
                'order'             => 113,
                ],
            [
                'id'                => 114,
                'account_type_id'   => 14,
                'name'              => _l('acc_equipment_rental'),
                'note'              => _l('acc_equipment_rental_note'),
                'order'             => 114,
                ],
            [
                'id'                => 115,
                'account_type_id'   => 14,
                'name'              => _l('acc_finance_costs'),
                'note'              => _l('acc_finance_costs_note'),
                'order'             => 115,
                ],
            [
                'id'                => 116,
                'account_type_id'   => 14,
                'name'              => _l('acc_income_tax_expense'),
                'note'              => _l('acc_income_tax_expense_note'),
                'order'             => 116,
                ],
            [
                'id'                => 117,
                'account_type_id'   => 14,
                'name'              => _l('acc_insurance'),
                'note'              => _l('acc_insurance_note'),
                'order'             => 117,
                ],
            [
                'id'                => 118,
                'account_type_id'   => 14,
                'name'              => _l('acc_interest_paid'),
                'note'              => _l('acc_interest_paid_note'),
                'order'             => 118,
                ],
            [
                'id'                => 119,
                'account_type_id'   => 14,
                'name'              => _l('acc_legal_and_professional_fees'),
                'note'              => _l('acc_legal_and_professional_fees_note'),
                'order'             => 119,
                ],
            [
                'id'                => 120,
                'account_type_id'   => 14,
                'name'              => _l('acc_loss_on_discontinued_operations_net_of_tax'),
                'note'              => _l('acc_loss_on_discontinued_operations_net_of_tax_note'),
                'order'             => 120,
                ],
            [
                'id'                => 121,
                'account_type_id'   => 14,
                'name'              => _l('acc_management_compensation'),
                'note'              => _l('acc_management_compensation_note'),
                'order'             => 121,
                ],
            [
                'id'                => 122,
                'account_type_id'   => 14,
                'name'              => _l('acc_meals_and_entertainment'),
                'note'              => _l('acc_meals_and_entertainment_note'),
                'order'             => 122,
                ],
            [
                'id'                => 123,
                'account_type_id'   => 14,
                'name'              => _l('acc_office_general_administrative_expenses'),
                'note'              => _l('acc_office_general_administrative_expenses_note'),
                'order'             => 123,
                ],
            [
                'id'                => 124,
                'account_type_id'   => 14,
                'name'              => _l('acc_other_miscellaneous_service_cost'),
                'note'              => _l('acc_other_miscellaneous_service_cost_note'),
                'order'             => 124,
                ],
            [
                'id'                => 125,
                'account_type_id'   => 14,
                'name'              => _l('acc_other_selling_expenses'),
                'note'              => _l('acc_other_selling_expenses_note'),
                'order'             => 125,
                ],
            [
                'id'                => 126,
                'account_type_id'   => 14,
                'name'              => _l('acc_payroll_expenses'),
                'note'              => _l('acc_payroll_expenses_note'),
                'order'             => 126,
                ],
            [
                'id'                => 127,
                'account_type_id'   => 14,
                'name'              => _l('acc_rent_or_lease_of_buildings'),
                'note'              => _l('acc_rent_or_lease_of_buildings_note'),
                'order'             => 127,
                ],
            [
                'id'                => 128,
                'account_type_id'   => 14,
                'name'              => _l('acc_repair_and_maintenance'),
                'note'              => _l('acc_repair_and_maintenance_note'),
                'order'             => 128,
                ],
            [
                'id'                => 129,
                'account_type_id'   => 14,
                'name'              => _l('acc_shipping_and_delivery_expense'),
                'note'              => _l('acc_shipping_and_delivery_expense_note'),
                'order'             => 129,
                ],
            [
                'id'                => 130,
                'account_type_id'   => 14,
                'name'              => _l('acc_supplies_and_materials'),
                'note'              => _l('acc_supplies_and_materials_note'),
                'order'             => 130,
                ],
            [
                'id'                => 131,
                'account_type_id'   => 14,
                'name'              => _l('acc_taxes_paid'),
                'note'              => _l('acc_taxes_paid_note'),
                'order'             => 131,
                ],
            [
                'id'                => 132,
                'account_type_id'   => 14,
                'name'              => _l('acc_travel_expenses_general_and_admin_expenses'),
                'note'              => _l('acc_travel_expenses_general_and_admin_expenses_note'),
                'order'             => 132,
                ],
            [
                'id'                => 133,
                'account_type_id'   => 14,
                'name'              => _l('acc_travel_expenses_selling_expense'),
                'note'              => _l('acc_travel_expenses_selling_expense_note'),
                'order'             => 133,
                ],
            [
                'id'                => 134,
                'account_type_id'   => 14,
                'name'              => _l('acc_unapplied_cash_bill_payment_expense'),
                'note'              => _l('acc_unapplied_cash_bill_payment_expense_note'),
                'order'             => 134,
                ],
            [
                'id'                => 135,
                'account_type_id'   => 14,
                'name'              => _l('acc_utilities'),
                'note'              => _l('acc_utilities_note'),
                'order'             => 135,
                ],
            [
                'id'                => 136,
                'account_type_id'   => 15,
                'name'              => _l('acc_amortisation'),
                'note'              => _l('acc_amortisation_note'),
                'order'             => 136,
                ],
            [
                'id'                => 137,
                'account_type_id'   => 15,
                'name'              => _l('acc_depreciation'),
                'note'              => _l('acc_depreciation_note'),
                'order'             => 137,
                ],
            [
                'id'                => 138,
                'account_type_id'   => 15,
                'name'              => _l('acc_exchange_gain_or_loss'),
                'note'              => _l('acc_exchange_gain_or_loss_note'),
                'order'             => 138,
                ],
            [
                'id'                => 139,
                'account_type_id'   => 15,
                'name'              => _l('acc_other_expense'),
                'note'              => _l('acc_other_expense_note'),
                'order'             => 139,
                ],
            [
                'id'                => 140,
                'account_type_id'   => 15,
                'name'              => _l('acc_penalties_and_settlements'),
                'note'              => _l('acc_penalties_and_settlements_note'),
                'order'             => 140,
                ],
            ]);

        usort($account_type_details, function ($a, $b) {
            return $a['order'] - $b['order'];
        });

        $account_type_details_2 = $this->db->get(db_prefix().'acc_account_type_details')->result_array();

        return array_merge($account_type_details, $account_type_details_2);
    }

    /**
     * add default account
     */
    public function add_default_account(){

        if($this->db->count_all_results(db_prefix().'acc_accounts') > 1){
            return false;
        }

        $accounts = [
            [
                'name' => '',
                'key_name' => 'acc_accounts_receivable',
                'account_type_id' => 1,
                'account_detail_type_id' => 1,
            ],
            [
                'name' => '',
                'key_name' => 'acc_accrued_holiday_payable',
                'account_type_id' => 9,
                'account_detail_type_id' => 61,
            ],
            [
                'name' => '',
                'key_name' => 'acc_accrued_liabilities',
                'account_type_id' => 8,
                'account_detail_type_id' => 44,
            ],
            [
                'name' => '',
                'key_name' => 'acc_accrued_non_current_liabilities',
                'account_type_id' => 9,
                'account_detail_type_id' => 62,
            ],
            [
                'name' => '',
                'key_name' => 'acc_accumulated_depreciation_on_property_plant_and_equipment',
                'account_type_id' => 4,
                'account_detail_type_id' => 22,
            ],
            [
                'name' => '',
                'key_name' => 'acc_allowance_for_bad_debts',
                'account_type_id' => 2,
                'account_detail_type_id' => 2,
            ],
            [
                'name' => '',
                'key_name' => 'acc_amortisation_expense',
                'account_type_id' => 14,
                'account_detail_type_id' => 106,
            ],
            [
                'name' => '',
                'key_name' => 'acc_assets_held_for_sale',
                'account_type_id' => 5,
                'account_detail_type_id' => 32,
            ],
            [
                'name' => '',
                'key_name' => 'acc_available_for_sale_assets_short_term',
                'account_type_id' => 2,
                'account_detail_type_id' => 3,
            ],
            [
                'name' => '',
                'key_name' => 'acc_bad_debts',
                'account_type_id' => 14,
                'account_detail_type_id' => 108,
            ],
            [
                'name' => '',
                'key_name' => 'acc_bank_charges',
                'account_type_id' => 14,
                'account_detail_type_id' => 109,
            ],
            [
                'name' => '',
                'key_name' => 'acc_billable_expense_income',
                'account_type_id' => 11,
                'account_detail_type_id' => 89,
            ],
            [
                'name' => '',
                'key_name' => 'acc_cash_and_cash_equivalents',
                'account_type_id' => 3,
                'account_detail_type_id' => 15,
            ],
            [
                'name' => '',
                'key_name' => 'acc_change_in_inventory_cos',
                'account_type_id' => 13,
                'account_detail_type_id' => 100,
            ],
            [
                'name' => '',
                'key_name' => 'acc_commissions_and_fees',
                'account_type_id' => 14,
                'account_detail_type_id' => 111,
            ],
            [
                'name' => '',
                'key_name' => 'acc_cost_of_sales',
                'account_type_id' => 13,
                'account_detail_type_id' => 104,
            ],
            [
                'name' => '',
                'key_name' => 'acc_deferred_tax_assets',
                'account_type_id' => 5,
                'account_detail_type_id' => 33,
            ],
            [
                'name' => '',
                'key_name' => 'acc_direct_labour_cos',
                'account_type_id' => 13,
                'account_detail_type_id' => 100,
            ],
            [
                'name' => '',
                'key_name' => 'acc_discounts_given_cos',
                'account_type_id' => 13,
                'account_detail_type_id' => 100,
            ],
            [
                'name' => '',
                'key_name' => 'acc_dividend_disbursed',
                'account_type_id' => 10,
                'account_detail_type_id' => 69,
            ],
            [
                'name' => '',
                'key_name' => 'acc_dividend_income',
                'account_type_id' => 12,
                'account_detail_type_id' => 92,
            ],
            [
                'name' => '',
                'key_name' => 'acc_dividends_payable',
                'account_type_id' => 8,
                'account_detail_type_id' => 48,
            ],
            [
                'name' => '',
                'key_name' => 'acc_dues_and_subscriptions',
                'account_type_id' => 14,
                'account_detail_type_id' => 113,
            ],
            [
                'name' => '',
                'key_name' => 'acc_equipment_rental',
                'account_type_id' => 14,
                'account_detail_type_id' => 114,
            ],
            [
                'name' => '',
                'key_name' => 'acc_equity_in_earnings_of_subsidiaries',
                'account_type_id' => 10,
                'account_detail_type_id' => 70,
            ],
            [
                'name' => '',
                'key_name' => 'acc_freight_and_delivery_cos',
                'account_type_id' => 13,
                'account_detail_type_id' => 100,
            ],
            [
                'name' => '',
                'key_name' => 'acc_goodwill',
                'account_type_id' => 5,
                'account_detail_type_id' => 34,
            ],
            [
                'name' => '',
                'key_name' => 'acc_income_tax_expense',
                'account_type_id' => 14,
                'account_detail_type_id' => 116,
            ],
            [
                'name' => '',
                'key_name' => 'acc_income_tax_payable',
                'account_type_id' => 8,
                'account_detail_type_id' => 50,
            ],
            [
                'name' => '',
                'key_name' => 'acc_insurance_disability',
                'account_type_id' => 14,
                'account_detail_type_id' => 117,
            ],
            [
                'name' => '',
                'key_name' => 'acc_insurance_general',
                'account_type_id' => 14,
                'account_detail_type_id' => 117,
            ],
            [
                'name' => '',
                'key_name' => 'acc_insurance_liability',
                'account_type_id' => 14,
                'account_detail_type_id' => 117,
            ],
            [
                'name' => '',
                'key_name' => 'acc_intangibles',
                'account_type_id' => 5,
                'account_detail_type_id' => 35,
            ],
            [
                'name' => '',
                'key_name' => 'acc_interest_expense',
                'account_type_id' => 14,
                'account_detail_type_id' => 118,
            ],
            [
                'name' => '',
                'key_name' => 'acc_interest_income',
                'account_type_id' => 12,
                'account_detail_type_id' => 93,
            ],
            [
                'name' => '',
                'key_name' => 'acc_inventory',
                'account_type_id' => 2,
                'account_detail_type_id' => 5,
            ],
            [
                'name' => '',
                'key_name' => 'acc_inventory_asset',
                'account_type_id' => 2,
                'account_detail_type_id' => 5,
            ],
            [
                'name' => '',
                'key_name' => 'acc_legal_and_professional_fees',
                'account_type_id' => 14,
                'account_detail_type_id' => 119,
            ],
            [
                'name' => '',
                'key_name' => 'acc_liabilities_related_to_assets_held_for_sale',
                'account_type_id' => 9,
                'account_detail_type_id' => 63,
            ],
            [
                'name' => '',
                'key_name' => 'acc_long_term_debt',
                'account_type_id' => 9,
                'account_detail_type_id' => 64,
            ],
            [
                'name' => '',
                'key_name' => 'acc_long_term_investments',
                'account_type_id' => 5,
                'account_detail_type_id' => 38,
            ],
            [
                'name' => '',
                'key_name' => 'acc_loss_on_discontinued_operations_net_of_tax',
                'account_type_id' => 14,
                'account_detail_type_id' => 120,
            ],
            [
                'name' => '',
                'key_name' => 'acc_loss_on_disposal_of_assets',
                'account_type_id' => 12,
                'account_detail_type_id' => 94,
            ],
            [
                'name' => '',
                'key_name' => 'acc_management_compensation',
                'account_type_id' => 14,
                'account_detail_type_id' => 121,
            ],
            [
                'name' => '',
                'key_name' => 'acc_materials_cos',
                'account_type_id' => 13,
                'account_detail_type_id' => 100,
            ],
            [
                'name' => '',
                'key_name' => 'acc_meals_and_entertainment',
                'account_type_id' => 14,
                'account_detail_type_id' => 122,
            ],
            [
                'name' => '',
                'key_name' => 'acc_office_expenses',
                'account_type_id' => 14,
                'account_detail_type_id' => 123,
            ],
            [
                'name' => '',
                'key_name' => 'acc_other_cos',
                'account_type_id' => 13,
                'account_detail_type_id' => 100,
            ],
            [
                'name' => '',
                'key_name' => 'acc_other_comprehensive_income',
                'account_type_id' => 10,
                'account_detail_type_id' => 73,
            ],
            [
                'name' => '',
                'key_name' => 'acc_other_general_and_administrative_expenses',
                'account_type_id' => 14,
                'account_detail_type_id' => 123,
            ],
            [
                'name' => '',
                'key_name' => 'acc_other_operating_income_expenses',
                'account_type_id' => 12,
                'account_detail_type_id' => 97,
            ],
            [
                'name' => '',
                'key_name' => 'acc_other_selling_expenses',
                'account_type_id' => 14,
                'account_detail_type_id' => 125,
            ],
            [
                'name' => '',
                'key_name' => 'acc_other_type_of_expenses_advertising_expenses',
                'account_type_id' => 14,
                'account_detail_type_id' => 105,
            ],
            [
                'name' => '',
                'key_name' => 'acc_overhead_cos',
                'account_type_id' => 13,
                'account_detail_type_id' => 100,
            ],
            [
                'name' => '',
                'key_name' => 'acc_payroll_clearing',
                'account_type_id' => 8,
                'account_detail_type_id' => 55,
            ],
            [
                'name' => '',
                'key_name' => 'acc_payroll_expenses',
                'account_type_id' => 14,
                'account_detail_type_id' => 126,
            ],
            [
                'name' => '',
                'key_name' => 'acc_payroll_liabilities',
                'account_type_id' => 8,
                'account_detail_type_id' => 56,
            ],
            [
                'name' => '',
                'key_name' => 'acc_prepaid_expenses',
                'account_type_id' => 2,
                'account_detail_type_id' => 11,
            ],
            [
                'name' => '',
                'key_name' => 'acc_property_plant_and_equipment',
                'account_type_id' => 4,
                'account_detail_type_id' => 26,
            ],
            [
                'name' => '',
                'key_name' => 'acc_purchases',
                'account_type_id' => 14,
                'account_detail_type_id' => 130,
            ],
            [
                'name' => '',
                'key_name' => 'acc_reconciliation_discrepancies',
                'account_type_id' => 15,
                'account_detail_type_id' => 139,
            ],
            [
                'name' => '',
                'key_name' => 'acc_rent_or_lease_payments',
                'account_type_id' => 14,
                'account_detail_type_id' => 127,
            ],
            [
                'name' => '',
                'key_name' => 'acc_repair_and_maintenance',
                'account_type_id' => 14,
                'account_detail_type_id' => 128,
            ],
            [
                'name' => '',
                'key_name' => 'acc_retained_earnings',
                'account_type_id' => 10,
                'account_detail_type_id' => 80,
            ],
            [
                'name' => '',
                'key_name' => 'acc_revenue_general',
                'account_type_id' => 11,
                'account_detail_type_id' => 86,
            ],
            [
                'name' => '',
                'key_name' => 'acc_sales',
                'account_type_id' => 11,
                'account_detail_type_id' => 89,
            ],
            [
                'name' => '',
                'key_name' => 'acc_sales_retail',
                'account_type_id' => 11,
                'account_detail_type_id' => 87,
            ],
            [
                'name' => '',
                'key_name' => 'acc_sales_wholesale',
                'account_type_id' => 11,
                'account_detail_type_id' => 88,
            ],
            [
                'name' => '',
                'key_name' => 'acc_sales_of_product_income',
                'account_type_id' => 11,
                'account_detail_type_id' => 89,
            ],
            [
                'name' => '',
                'key_name' => 'acc_share_capital',
                'account_type_id' => 10,
                'account_detail_type_id' => 81,
            ],
            [
                'name' => '',
                'key_name' => 'acc_shipping_and_delivery_expense',
                'account_type_id' => 14,
                'account_detail_type_id' => 129,
            ],
            [
                'name' => '',
                'key_name' => 'acc_short_term_debit',
                'account_type_id' => 8,
                'account_detail_type_id' => 54,
            ],
            [
                'name' => '',
                'key_name' => 'acc_stationery_and_printing',
                'account_type_id' => 14,
                'account_detail_type_id' => 123,
            ],
            [
                'name' => '',
                'key_name' => 'acc_subcontractors_cos',
                'account_type_id' => 13,
                'account_detail_type_id' => 100,
            ],
            [
                'name' => '',
                'key_name' => 'acc_supplies',
                'account_type_id' => 14,
                'account_detail_type_id' => 130,
            ],
            [
                'name' => '',
                'key_name' => 'acc_travel_expenses_general_and_admin_expenses',
                'account_type_id' => 14,
                'account_detail_type_id' => 132,
            ],
            [
                'name' => '',
                'key_name' => 'acc_travel_expenses_selling_expense',
                'account_type_id' => 14,
                'account_detail_type_id' => 133,
            ],
            [
                'name' => '',
                'key_name' => 'acc_unapplied_cash_payment_income',
                'account_type_id' => 11,
                'account_detail_type_id' => 91,
            ],
            [
                'name' => '',
                'key_name' => 'acc_uncategorised_asset',
                'account_type_id' => 2,
                'account_detail_type_id' => 10,
            ],
            [
                'name' => '',
                'key_name' => 'acc_uncategorised_expense',
                'account_type_id' => 14,
                'account_detail_type_id' => 124,
            ],
            [
                'name' => '',
                'key_name' => 'acc_uncategorised_income',
                'account_type_id' => 11,
                'account_detail_type_id' => 89,
            ],
            [
                'name' => '',
                'key_name' => 'acc_undeposited_funds',
                'account_type_id' => 2,
                'account_detail_type_id' => 13,
            ],
            [
                'name' => '',
                'key_name' => 'acc_unrealised_loss_on_securities_net_of_tax',
                'account_type_id' => 12,
                'account_detail_type_id' => 99,
            ],
            [
                'name' => '',
                'key_name' => 'acc_utilities',
                'account_type_id' => 14,
                'account_detail_type_id' => 135,
            ],
            [
                'name' => '',
                'key_name' => 'acc_wage_expenses',
                'account_type_id' => 14,
                'account_detail_type_id' => 126,
            ],
            [
                'name' => '',
                'key_name' => 'acc_credit_card',
                'account_type_id' => 7,
                'account_detail_type_id' => 43,
            ],
            [
                'name' => '',
                'key_name' => 'acc_accounts_payable',
                'account_type_id' => 6,
                'account_detail_type_id' => 42,
            ],
        ];

        $affectedRows = $this->db->insert_batch(db_prefix().'acc_accounts',  $accounts);

        if ($affectedRows > 0) {
            $this->db->where('name', 'acc_add_default_account');
            $this->db->update(db_prefix() . 'options', [
                    'value' => 1,
                ]);

            return true;
        }

        return false;
    }

    /**
     * add default account new
     */
    public function add_default_account_new(){
        $this->db->where('key_name != ""');
        $affectedRows = $this->db->update(db_prefix().'acc_accounts',  ['default_account' => 1]);

        if ($affectedRows > 0) {
            $this->db->where('name', 'add_default_account_new');
            $this->db->update(db_prefix() . 'options', [
                    'value' => 1,
                ]);

            return true;
        }

        return false;
    }

    /**
     * update general setting
     *
     * @param      array   $data   The data
     *
     * @return     boolean 
     */
    public function update_general_setting($data){
        $affectedRows = 0;
        if(!isset($data['acc_close_the_books'])){
            $data['acc_close_the_books'] = 0;
        }
        if(!isset($data['acc_enable_account_numbers'])){
            $data['acc_enable_account_numbers'] = 0;
        }
        if(!isset($data['acc_show_account_numbers'])){
            $data['acc_show_account_numbers'] = 0;
        }
       
        if($data['acc_closing_date'] != ''){
            $data['acc_closing_date'] = to_sql_date($data['acc_closing_date']);
        }

        foreach ($data as $key => $value) {
            $this->db->where('name', $key);
            $this->db->update(db_prefix() . 'options', [
                    'value' => $value,
                ]);
            if ($this->db->affected_rows() > 0) {
                $affectedRows++;
            }
        }

        if ($affectedRows > 0) {
            return true;
        }
        return false;
    }

    /**
     * update automatic conversion
     *
     * @param      array   $data   The data
     *
     * @return     boolean 
     */
    public function update_automatic_conversion($data){
        $affectedRows = 0;
        
        if(!isset($data['acc_invoice_automatic_conversion'])){
            $data['acc_invoice_automatic_conversion'] = 0;
        }

        if(!isset($data['acc_payment_automatic_conversion'])){
            $data['acc_payment_automatic_conversion'] = 0;
        }

        if(!isset($data['acc_credit_note_automatic_conversion'])){
            $data['acc_credit_note_automatic_conversion'] = 0;
        }

        if(!isset($data['acc_expense_automatic_conversion'])){
            $data['acc_expense_automatic_conversion'] = 0;
        }

        if(!isset($data['acc_tax_automatic_conversion'])){
            $data['acc_tax_automatic_conversion'] = 0;
        }

        if(!isset($data['acc_payment_expense_automatic_conversion'])){
            $data['acc_payment_expense_automatic_conversion'] = 0;
        }

        foreach ($data as $key => $value) {
            $this->db->where('name', $key);
            $this->db->update(db_prefix() . 'options', [
                    'value' => $value,
                ]);
            if ($this->db->affected_rows() > 0) {
                $affectedRows++;
            }
        }

        if ($affectedRows > 0) {
            return true;
        }
        return false;
    }

    /**
     * get accounts
     * @param  integer $id    member group id
     * @param  array  $where
     * @return object
     */
    public function get_accounts($id = '', $where = [])
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);
            return $this->db->get(db_prefix() . 'acc_accounts')->row();
        }

        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $this->db->where($where);
        $this->db->where('active', 1);
        $this->db->order_by('account_type_id,account_detail_type_id', 'desc');
        $accounts = $this->db->get(db_prefix() . 'acc_accounts')->result_array();

        $account_types = $this->accounting_model->get_account_types();
        $detail_types = $this->accounting_model->get_account_type_details();

        $account_type_name = [];
        $detail_type_name = [];

        foreach ($account_types as $key => $value) {
            $account_type_name[$value['id']] = $value['name'];
        }

        foreach ($detail_types as $key => $value) {
            $detail_type_name[$value['id']] = $value['name'];
        }

        foreach ($accounts as $key => $value) {

            if($acc_show_account_numbers == 1 && $value['number'] != ''){
                $accounts[$key]['name'] = $value['name'] != '' ? $value['number'].' - '.$value['name'] : $value['number'].' - '._l($value['key_name']);
            }else{
                $accounts[$key]['name'] = $value['name'] != '' ? $value['name'] : _l($value['key_name']);
            }
            
            $_account_type_name = isset($account_type_name[$value['account_type_id']]) ? $account_type_name[$value['account_type_id']] : '';
            $_detail_type_name = isset($detail_type_name[$value['account_detail_type_id']]) ? $detail_type_name[$value['account_detail_type_id']] : '';
            $accounts[$key]['account_type_name'] = $_account_type_name;
            $accounts[$key]['detail_type_name'] = $_detail_type_name;
        }

        return $accounts;
    }

    /**
     * add new account
     * @param array $data
     * @return integer
     */
    public function add_account($data)
    {
        if (isset($data['id'])) {
            unset($data['id']);
        }

        if($data['balance_as_of'] != ''){
            $data['balance_as_of'] = to_sql_date($data['balance_as_of']);
        }

        if(isset($data['update_balance'])){
            unset($data['update_balance']);
        }

        $data['balance'] = str_replace(',', '', $data['balance']);
        $this->db->insert(db_prefix() . 'acc_accounts', $data);

        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            if($data['balance'] != 0 && $data['balance'] != ''){
                $node = [];
                $node['account'] = $insert_id;
                $node['ending_balance'] = $data['balance'];
                $node['beginning_balance'] = 0;
                $node['opening_balance'] = 0;
                $node['finish'] = 1;
                if($data['balance_as_of'] != ''){
                    $node['ending_date'] = $data['balance_as_of'];
                }else{
                    $node['ending_date'] = date('Y-m-d');
                }
            
                $this->db->insert(db_prefix().'acc_reconciles', $node);
                $reconcile_id = $this->db->insert_id();

                $this->db->where('account_type_id', 10);
                $this->db->where('account_detail_type_id', 71);
                $account = $this->db->get(db_prefix().'acc_accounts')->row();

                if($account){
                    $node = [];

                    if($data['account_type_id'] == 7 || $data['account_type_id'] == 15 || $data['account_type_id'] == 8 || $data['account_type_id'] == 9){
                        if($data['balance'] > 0){
                            $node['debit'] = $data['balance'];
                            $node['credit'] = 0;
                        }else{
                            $node['debit'] = 0;
                            $node['credit'] = abs($data['balance']);
                        }
                    }else{
                        if($data['balance'] > 0){
                            $node['debit'] = 0;
                            $node['credit'] = $data['balance'];
                        }else{
                            $node['debit'] = abs($data['balance']);
                            $node['credit'] = 0;
                        }
                    }

                    $node['split'] = $insert_id;
                    $node['account'] = $account->id;
                    $node['rel_id'] = 0;
                    $node['rel_type'] = 'deposit';
                    if($data['balance_as_of'] != ''){
                        $node['date'] = $data['balance_as_of'];
                    }else{
                        $node['date'] = date('Y-m-d');
                    }
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();

                    $this->db->insert(db_prefix().'acc_account_history', $node);

                    $node = [];
                    if($data['account_type_id'] == 7 || $data['account_type_id'] == 15 || $data['account_type_id'] == 8 || $data['account_type_id'] == 9){
                        if($data['balance'] > 0){
                            $node['debit'] = 0;
                            $node['credit'] = $data['balance'];
                        }else{
                            $node['debit'] = abs($data['balance']);
                            $node['credit'] = 0;
                        }
                    }else{
                        if($data['balance'] > 0){
                            $node['debit'] = $data['balance'];
                            $node['credit'] = 0;
                        }else{
                            $node['debit'] = 0;
                            $node['credit'] = abs($data['balance']);
                        }
                    }

                    $node['reconcile'] = $reconcile_id;
                    $node['split'] = $account->id;
                    $node['account'] = $insert_id;
                    $node['rel_id'] = 0;
                    $node['rel_type'] = 'deposit';
                    if($data['balance_as_of'] != ''){
                        $node['date'] = $data['balance_as_of'];
                    }else{
                        $node['date'] = date('Y-m-d');
                    }
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();

                    $this->db->insert(db_prefix().'acc_account_history', $node);
                }else{
                    $this->db->insert(db_prefix().'acc_accounts', [
                        'name' => '',
                        'key_name' => 'acc_opening_balance_equity',
                        'account_type_id' => 10,
                        'account_detail_type_id' => 71,
                    ]);

                    $account_id = $this->db->insert_id();

                    if ($account_id) {
                        $node = [];
                        if($data['account_type_id'] == 7 || $data['account_type_id'] == 15 || $data['account_type_id'] == 8 || $data['account_type_id'] == 9){
                            if($data['balance'] > 0){
                                $node['debit'] = $data['balance'];
                                $node['credit'] = 0;
                            }else{
                                $node['debit'] = 0;
                                $node['credit'] = abs($data['balance']);
                            }
                        }else{
                            if($data['balance'] > 0){
                                $node['debit'] = 0;
                                $node['credit'] = $data['balance'];
                            }else{
                                $node['debit'] = abs($data['balance']);
                                $node['credit'] = 0;
                            }
                        }
                        
                        $node['split'] = $insert_id;
                        $node['account'] = $account_id;
                        if($data['balance_as_of'] != ''){
                            $node['date'] = $data['balance_as_of'];
                        }else{
                            $node['date'] = date('Y-m-d');
                        }
                        $node['rel_id'] = 0;
                        $node['rel_type'] = 'deposit';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();

                        $this->db->insert(db_prefix().'acc_account_history', $node);

                        $node = [];
                        if($data['account_type_id'] == 7 || $data['account_type_id'] == 15 || $data['account_type_id'] == 8 || $data['account_type_id'] == 9){
                            if($data['balance'] > 0){
                                $node['debit'] = 0;
                                $node['credit'] = $data['balance'];
                            }else{
                                $node['debit'] = abs($data['balance']);
                                $node['credit'] = 0;
                            }
                        }else{
                            if($data['balance'] > 0){
                                $node['debit'] = $data['balance'];
                                $node['credit'] = 0;
                            }else{
                                $node['debit'] = 0;
                                $node['credit'] = abs($data['balance']);
                            }
                        }
                        
                        $node['reconcile'] = $reconcile_id;
                        $node['split'] = $account_id;
                        $node['account'] = $insert_id;
                        if($data['balance_as_of'] != ''){
                            $node['date'] = $data['balance_as_of'];
                        }else{
                            $node['date'] = date('Y-m-d');
                        }
                        $node['rel_id'] = 0;
                        $node['rel_type'] = 'deposit';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();

                        $this->db->insert(db_prefix().'acc_account_history', $node);
                    }
                }
            }

           
            return $insert_id;
        }

        return false;
    }

    /**
     * update account
     * @param array $data
     * @param integer $id
     * @return integer
     */
    public function update_account($data, $id)
    {
        if (isset($data['id'])) {
            unset($data['id']);
        }

        if($data['balance_as_of'] != ''){
            $data['balance_as_of'] = to_sql_date($data['balance_as_of']);
        }
        $update_balance = 0;
        if(isset($data['update_balance'])){
            $update_balance = $data['update_balance'];
            unset($data['update_balance']);
        }

        $data['balance'] = str_replace(',', '', $data['balance']);
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'acc_accounts', $data);

        if ($this->db->affected_rows() > 0) {
            if($data['balance'] > 0 && $update_balance == 1){
                $node = [];
                $node['account'] = $id;
                $node['ending_balance'] = $data['balance'];
                $node['beginning_balance'] = 0;
                $node['opening_balance'] = 0;
                $node['finish'] = 1;
                if($data['balance_as_of'] != ''){
                    $node['ending_date'] = $data['balance_as_of'];
                }else{
                    $node['ending_date'] = date('Y-m-d');
                }
            
                $this->db->insert(db_prefix().'acc_reconciles', $node);
                $reconcile_id = $this->db->insert_id();

                $this->db->where('account_type_id', 10);
                $this->db->where('account_detail_type_id', 71);
                $account = $this->db->get(db_prefix().'acc_accounts')->row();

                if($account){
                    $node = [];

                    if($data['account_type_id'] == 7 || $data['account_type_id'] == 15 || $data['account_type_id'] == 8 || $data['account_type_id'] == 9){
                        $node['debit'] = $data['balance'];
                        $node['credit'] = 0;

                    }else{
                        $node['debit'] = 0;
                        $node['credit'] = $data['balance'];
                    }

                    $node['split'] = $id;
                    $node['account'] = $account->id;

                    if($data['balance_as_of'] != ''){
                        $node['date'] = $data['balance_as_of'];
                    }else{
                        $node['date'] = date('Y-m-d');
                    }

                    $node['rel_id'] = 0;
                    $node['rel_type'] = 'deposit';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $this->db->insert(db_prefix().'acc_account_history', $node);

                    $node = [];
                    if($data['account_type_id'] == 7 || $data['account_type_id'] == 15 || $data['account_type_id'] == 8 || $data['account_type_id'] == 9){
                        $node['debit'] = 0;
                        $node['credit'] = $data['balance'];
                    }else{
                        $node['debit'] = $data['balance'];
                        $node['credit'] = 0;
                    }

                    $node['reconcile'] = $reconcile_id;
                    $node['split'] = $account->id;
                    $node['account'] = $id;
                    $node['rel_id'] = 0;

                    if($data['balance_as_of'] != ''){
                        $node['date'] = $data['balance_as_of'];
                    }else{
                        $node['date'] = date('Y-m-d');
                    }
                    $node['rel_type'] = 'deposit';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();

                    $this->db->insert(db_prefix().'acc_account_history', $node);
                }else{
                    $this->db->insert(db_prefix().'acc_accounts', [
                        'name' => '',
                        'key_name' => 'acc_opening_balance_equity',
                        'account_type_id' => 10,
                        'account_detail_type_id' => 71,
                    ]);

                    $account_id = $this->db->insert_id();

                    if ($account_id) {
                        $node = [];
                        if($data['account_type_id'] == 7 || $data['account_type_id'] == 15 || $data['account_type_id'] == 8 || $data['account_type_id'] == 9){
                            $node['debit'] = $data['balance'];
                            $node['credit'] = 0;
                        }else{
                            $node['debit'] = 0;
                            $node['credit'] = $data['balance'];
                        }
                        
                        $node['split'] = $id;
                        $node['account'] = $account_id;
                        $node['rel_id'] = 0;
                        if($data['balance_as_of'] != ''){
                            $node['date'] = $data['balance_as_of'];
                        }else{
                            $node['date'] = date('Y-m-d');
                        }
                        $node['rel_type'] = 'deposit';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();

                        $this->db->insert(db_prefix().'acc_account_history', $node);

                        $node = [];
                        if($data['account_type_id'] == 7 || $data['account_type_id'] == 15 || $data['account_type_id'] == 8 || $data['account_type_id'] == 9){
                            $node['debit'] = 0;
                            $node['credit'] = $data['balance'];
                        }else{
                            $node['debit'] = $data['balance'];
                            $node['credit'] = 0;
                        }
                        
                        $node['reconcile'] = $reconcile_id;
                        $node['split'] = $account_id;
                        $node['account'] = $id;
                        $node['rel_id'] = 0;
                        if($data['balance_as_of'] != ''){
                            $node['date'] = $data['balance_as_of'];
                        }else{
                            $node['date'] = date('Y-m-d');
                        }
                        $node['rel_type'] = 'deposit';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();

                        $this->db->insert(db_prefix().'acc_account_history', $node);
                    }
                }
            }

            return true;
        }

        return false;
    }

    /**
     * Get the data account to choose from.
     *
     * @return     array  The product group select.
     */
    public function get_data_account_to_select() {

        $accounts = $this->get_accounts();
        $acc_enable_account_numbers = get_option('acc_enable_account_numbers');
        $acc_show_account_numbers = get_option('acc_show_account_numbers');
        $list_accounts = [];

        $account_types = $this->accounting_model->get_account_types();
        $account_type_name = [];

        foreach ($account_types as $key => $value) {
            $account_type_name[$value['id']] = $value['name'];
        }

        foreach ($accounts as $key => $account) {
            $note = [];
            $note['id'] = $account['id'];

            $_account_type_name = isset($account_type_name[$account['account_type_id']]) ? $account_type_name[$account['account_type_id']] : '';
           
            $note['label'] = $account['name'].' - '.$_account_type_name;

            $list_accounts[] = $note;
        }
        return $list_accounts;
    }

    /**
     * add account history
     * @param array $data
     * @return boolean
     */
    public function add_account_history($data){
        $this->db->where('rel_id', $data['id']);
        $this->db->where('rel_type', $data['type']);
        $this->db->delete(db_prefix().'acc_account_history');

        $data['amount'] = str_replace(',', '', $data['amount']);

        $data_insert = [];
        if($data['type'] == 'invoice'){
            $this->load->model('invoices_model');
            $invoice = $this->invoices_model->get($data['id']);

            $this->load->model('currencies_model');
            $currency = $this->currencies_model->get_base_currency();

            $currency_converter = 0;
            if($invoice->currency_name != $currency->name){
                $currency_converter = 1;
            }

            $payment_account = $data['payment_account'];
            $deposit_to = $data['deposit_to'];
            $invoice_payment_account = get_option('acc_invoice_payment_account');
            $invoice_deposit_to = get_option('acc_invoice_deposit_to');
            $item_amount = $data['item_amount'];
            $paid = 0;
            if($invoice->status == 2){
                $paid = 1;
            }

            foreach ($invoice->items as $value) {
                $item = $this->get_item_by_name($value['description']);
                $item_id = 0;
                if(isset($item->id)){
                    $item_id = $item->id;
                }

                $item_total = $value['qty'] * $value['rate'];
                if(isset($data['exchange_rate'])){
                    $item_total = round(($value['qty'] * $value['rate']) * $data['exchange_rate'], 2);
                }elseif($currency_converter == 1){
                    $item_total = round($this->currency_converter($invoice->currency_name, $currency->name, $value['qty'] * $value['rate']), 2);
                }

                if(isset($payment_account[$value['id']])) {
                    $node = [];
                    $node['itemable_id'] = $value['id'];
                    $node['split'] = $payment_account[$value['id']];
                    $node['account'] = $deposit_to[$value['id']];
                    $node['debit'] = $item_total;
                    $node['paid'] = $paid;
                    $node['date'] = $invoice->date;
                    $node['item'] = $item_id;
                    $node['customer'] = $invoice->clientid;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['itemable_id'] = $value['id'];
                    $node['split'] = $deposit_to[$value['id']];
                    $node['paid'] = $paid;
                    $node['date'] = $invoice->date;
                    $node['item'] = $item_id;
                    $node['account'] = $payment_account[$value['id']];
                    $node['customer'] = $invoice->clientid;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }else{
                    $node = [];
                    $node['itemable_id'] = $value['id'];
                    $node['split'] = $invoice_payment_account;
                    $node['account'] = $invoice_deposit_to;
                    $node['date'] = $invoice->date;
                    $node['item'] = $item_id;
                    $node['debit'] = $item_total;
                    $node['customer'] = $invoice->clientid;
                    $node['paid'] = $paid;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['itemable_id'] = $value['id'];
                    $node['split'] = $invoice_deposit_to;
                    $node['customer'] = $invoice->clientid;
                    $node['account'] = $invoice_payment_account;
                    $node['date'] = $invoice->date;
                    $node['item'] = $item_id;
                    $node['paid'] = $paid;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }
            }

            if(get_option('acc_tax_automatic_conversion') == 1){
                $tax_payment_account = get_option('acc_tax_payment_account');
                $tax_deposit_to = get_option('acc_tax_deposit_to');

                $items = get_items_table_data($invoice, 'invoice', 'html', true);
                foreach($items->taxes() as $tax){
                    $t = explode('|', $tax['tax_name']);
                    $tax_name = '';
                    $tax_rate = 0;
                    if(isset($t[0])){
                        $tax_name = $t[0];
                    }
                    if(isset($t[1])){
                        $tax_rate = $t[1];
                    }

                    $this->db->where('name', $tax_name);
                    $this->db->where('taxrate', $tax_rate);
                    $_tax = $this->db->get(db_prefix().'taxes')->row();

                    $total_tax = $tax['total_tax'];
                    if(isset($data['exchange_rate'])){
                        $total_tax = round($tax['total_tax'] * $data['exchange_rate'], 2);
                    }elseif($currency_converter == 1){
                        $total_tax = round($this->currency_converter($invoice->currency_name, $currency->name, $tax['total_tax']), 2);
                    }

                    if($_tax){
                        $tax_mapping = $this->get_tax_mapping($_tax->id);

                        if($tax_mapping){
                            $node = [];
                            $node['itemable_id'] = 0;
                            $node['split'] = $tax_mapping->payment_account;
                            $node['account'] = $tax_mapping->deposit_to;
                            $node['tax'] = $_tax->id;
                            $node['item'] = 0;
                            $node['date'] = $invoice->date;
                            $node['paid'] = $paid;
                            $node['debit'] = $total_tax;
                            $node['customer'] = $invoice->clientid;
                            $node['credit'] = 0;
                            $node['description'] = '';
                            $node['rel_id'] = $data['id'];
                            $node['rel_type'] = 'invoice';
                            $node['datecreated'] = date('Y-m-d H:i:s');
                            $node['addedfrom'] = get_staff_user_id();
                            $data_insert[] = $node;

                            $node = [];
                            $node['itemable_id'] = 0;
                            $node['split'] = $tax_mapping->deposit_to;
                            $node['customer'] = $invoice->clientid;
                            $node['account'] = $tax_mapping->payment_account;
                            $node['tax'] = $_tax->id;
                            $node['item'] = 0;
                            $node['date'] = $invoice->date;
                            $node['paid'] = $paid;
                            $node['debit'] = 0;
                            $node['credit'] = $total_tax;
                            $node['description'] = '';
                            $node['rel_id'] = $data['id'];
                            $node['rel_type'] = 'invoice';
                            $node['datecreated'] = date('Y-m-d H:i:s');
                            $node['addedfrom'] = get_staff_user_id();
                            $data_insert[] = $node;
                        }else{
                            $node = [];
                            $node['itemable_id'] = 0;
                            $node['split'] = $tax_payment_account;
                            $node['account'] = $tax_deposit_to;
                            $node['tax'] = $_tax->id;
                            $node['item'] = 0;
                            $node['date'] = $invoice->date;
                            $node['paid'] = $paid;
                            $node['debit'] = $total_tax;
                            $node['customer'] = $invoice->clientid;
                            $node['credit'] = 0;
                            $node['description'] = '';
                            $node['rel_id'] = $data['id'];
                            $node['rel_type'] = 'invoice';
                            $node['datecreated'] = date('Y-m-d H:i:s');
                            $node['addedfrom'] = get_staff_user_id();
                            $data_insert[] = $node;

                            $node = [];
                            $node['itemable_id'] = 0;
                            $node['split'] = $tax_deposit_to;
                            $node['customer'] = $invoice->clientid;
                            $node['date'] = $invoice->date;
                            $node['account'] = $tax_payment_account;
                            $node['tax'] = $_tax->id;
                            $node['item'] = 0;
                            $node['paid'] = $paid;
                            $node['debit'] = 0;
                            $node['credit'] = $total_tax;
                            $node['description'] = '';
                            $node['rel_id'] = $data['id'];
                            $node['rel_type'] = 'invoice';
                            $node['datecreated'] = date('Y-m-d H:i:s');
                            $node['addedfrom'] = get_staff_user_id();
                            $data_insert[] = $node;
                        }
                    }else{
                        $node = [];
                        $node['itemable_id'] = 0;
                        $node['split'] = $tax_payment_account;
                        $node['account'] = $tax_deposit_to;
                        $node['item'] = 0;
                        $node['tax'] = 0;
                        $node['date'] = $invoice->date;
                        $node['paid'] = $paid;
                        $node['debit'] = $total_tax;
                        $node['customer'] = $invoice->clientid;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $data['id'];
                        $node['rel_type'] = 'invoice';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['itemable_id'] = 0;
                        $node['split'] = $tax_deposit_to;
                        $node['customer'] = $invoice->clientid;
                        $node['account'] = $tax_payment_account;
                        $node['date'] = $invoice->date;
                        $node['tax'] = 0;
                        $node['item'] = 0;
                        $node['paid'] = $paid;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $data['id'];
                        $node['rel_type'] = 'invoice';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }
                }
            }
        }elseif($data['type'] == 'loss_adjustment'){

            $this->load->model('warehouse/warehouse_model');
            $loss_adjustment = $this->warehouse_model->get_loss_adjustment($data['id']);
            $loss_adjustment_detail = $this->warehouse_model->get_loss_adjustment_detailt_by_masterid($data['id']);

            $this->load->model('currencies_model');
            $currency = $this->currencies_model->get_base_currency();

            $payment_account = $data['payment_account'];
            $deposit_to = $data['deposit_to'];
            $item_amount = $data['item_amount'];

            $decrease_payment_account = get_option('acc_wh_decrease_payment_account');
            $decrease_deposit_to = get_option('acc_wh_decrease_deposit_to');
            $increase_payment_account = get_option('acc_wh_increase_payment_account');
            $increase_deposit_to = get_option('acc_wh_increase_deposit_to');


            foreach ($loss_adjustment_detail as $value) {
                if($value['current_number'] < $value['loss_adjustment']){
                    $loss_adjustment_payment_account = $increase_payment_account;
                    $loss_adjustment_deposit_to = $increase_deposit_to;
                }else{
                    $loss_adjustment_payment_account = $decrease_payment_account;
                    $loss_adjustment_deposit_to = $decrease_deposit_to;
                }

                $item_id = $value['items'];
                $item_total = $item_amount[$item_id];

                if(isset($payment_account[$item_id])) {
                    $node = [];
                    $node['split'] = $payment_account[$item_id];
                    $node['account'] = $deposit_to[$item_id];
                    $node['debit'] = $item_total;
                    $node['date'] = date('Y-m-d', strtotime($loss_adjustment->time));
                    $node['item'] = $item_id;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $deposit_to[$item_id];
                    $node['date'] = date('Y-m-d', strtotime($loss_adjustment->time));
                    $node['item'] = $item_id;
                    $node['account'] = $payment_account[$item_id];
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }else{
                    $node = [];
                    $node['split'] = $loss_adjustment_payment_account;
                    $node['account'] = $loss_adjustment_deposit_to;
                    $node['date'] = date('Y-m-d', strtotime($loss_adjustment->time));
                    $node['item'] = $item_id;
                    $node['debit'] = $item_total;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $loss_adjustment_deposit_to;
                    $node['account'] = $loss_adjustment_payment_account;
                    $node['date'] = date('Y-m-d', strtotime($loss_adjustment->time));
                    $node['item'] = $item_id;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }
            }
        }elseif($data['type'] == 'stock_export'){

            $this->load->model('warehouse/warehouse_model');
            $goods_delivery = $this->warehouse_model->get_goods_delivery($data['id']);
            $goods_delivery_detail = $this->warehouse_model->get_goods_delivery_detail($data['id']);

            $this->load->model('currencies_model');
            $currency = $this->currencies_model->get_base_currency();

            $payment_account = $data['payment_account'];
            $deposit_to = $data['deposit_to'];
            $stock_export_payment_account = get_option('acc_wh_stock_export_payment_account');
            $stock_export_deposit_to = get_option('acc_wh_stock_export_deposit_to');
            $item_amount = $data['item_amount'];

            foreach ($goods_delivery_detail as $value) {
                $item_id = $value['commodity_code'];
                $item_total = $item_amount[$item_id];

                if(isset($payment_account[$item_id])) {
                    $node = [];
                    $node['split'] = $payment_account[$item_id];
                    $node['account'] = $deposit_to[$item_id];
                    $node['debit'] = $item_total;
                    $node['date'] = $goods_delivery->date_c;
                    $node['item'] = $item_id;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $deposit_to[$item_id];
                    $node['date'] = $goods_delivery->date_c;
                    $node['item'] = $item_id;
                    $node['account'] = $payment_account[$item_id];
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }else{
                    $node = [];
                    $node['split'] = $stock_export_payment_account;
                    $node['account'] = $stock_export_deposit_to;
                    $node['date'] = $goods_delivery->date_c;
                    $node['item'] = $item_id;
                    $node['debit'] = $item_total;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $stock_export_deposit_to;
                    $node['account'] = $stock_export_payment_account;
                    $node['date'] = $goods_delivery->date_c;
                    $node['item'] = $item_id;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }
                if(get_option('acc_tax_automatic_conversion') == 1 && $value['tax_id'] != 0){
                    $tax_payment_account = get_option('acc_expense_tax_payment_account');
                    $tax_deposit_to = get_option('acc_expense_tax_deposit_to');

                    $total_tax = $value['total_money'] - $item_total;

                    $tax_mapping = $this->get_tax_mapping($value['tax_id']);

                    if($tax_mapping){
                        $node = [];
                        $node['split'] = $tax_mapping->payment_account;
                        $node['account'] = $tax_mapping->deposit_to;
                        $node['tax'] = $value['tax_id'];
                        $node['item'] = 0;
                        $node['date'] = $goods_delivery->date_c;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $data['id'];
                        $node['rel_type'] = $data['type'];
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_mapping->deposit_to;
                        $node['account'] = $tax_mapping->payment_account;
                        $node['tax'] = $value['tax_id'];
                        $node['item'] = 0;
                        $node['date'] = $goods_delivery->date_c;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $data['id'];
                        $node['rel_type'] = $data['type'];
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }else{
                        $node = [];
                        $node['split'] = $tax_payment_account;
                        $node['account'] = $tax_deposit_to;
                        $node['tax'] = $value['tax_id'];
                        $node['item'] = 0;
                        $node['date'] = $goods_delivery->date_c;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $data['id'];
                        $node['rel_type'] = $data['type'];
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_deposit_to;
                        $node['date'] = $goods_delivery->date_c;
                        $node['account'] = $tax_payment_account;
                        $node['tax'] = $value['tax_id'];
                        $node['item'] = 0;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $data['id'];
                        $node['rel_type'] = $data['type'];
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }
                }
            }
        }elseif($data['type'] == 'stock_import'){

            $this->load->model('warehouse/warehouse_model');
            $goods_receipt = $this->warehouse_model->get_goods_receipt($data['id']);
            $goods_receipt_detail = $this->warehouse_model->get_goods_receipt_detail($data['id']);

            $this->load->model('currencies_model');
            $currency = $this->currencies_model->get_base_currency();

            $payment_account = $data['payment_account'];
            $deposit_to = $data['deposit_to'];
            $stock_import_payment_account = get_option('acc_wh_stock_import_payment_account');
            $stock_import_deposit_to = get_option('acc_wh_stock_import_deposit_to');
            $item_amount = $data['item_amount'];

            foreach ($goods_receipt_detail as $value) {
                $item_id = $value['commodity_code'];
                $item_total = $item_amount[$item_id];

                if(isset($payment_account[$item_id])) {
                    $node = [];
                    $node['split'] = $payment_account[$item_id];
                    $node['account'] = $deposit_to[$item_id];
                    $node['debit'] = $item_total;
                    $node['date'] = $goods_receipt->date_c;
                    $node['item'] = $item_id;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $deposit_to[$item_id];
                    $node['date'] = $goods_receipt->date_c;
                    $node['item'] = $item_id;
                    $node['account'] = $payment_account[$item_id];
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }else{
                    $node = [];
                    $node['split'] = $stock_import_payment_account;
                    $node['account'] = $stock_import_deposit_to;
                    $node['date'] = $goods_receipt->date_c;
                    $node['item'] = $item_id;
                    $node['debit'] = $item_total;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $stock_import_deposit_to;
                    $node['account'] = $stock_import_payment_account;
                    $node['date'] = $goods_receipt->date_c;
                    $node['item'] = $item_id;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }
                if(get_option('acc_tax_automatic_conversion') == 1 && $value['tax'] != 0){
                    $tax_payment_account = get_option('acc_expense_tax_payment_account');
                    $tax_deposit_to = get_option('acc_expense_tax_deposit_to');

                    $total_tax = $value['tax_money'];

                    $tax_mapping = $this->get_tax_mapping($value['tax']);

                    if($tax_mapping){
                        $node = [];
                        $node['split'] = $tax_mapping->payment_account;
                        $node['account'] = $tax_mapping->deposit_to;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['date'] = $goods_receipt->date_c;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $data['id'];
                        $node['rel_type'] = $data['type'];
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_mapping->deposit_to;
                        $node['account'] = $tax_mapping->payment_account;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['date'] = $goods_receipt->date_c;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $data['id'];
                        $node['rel_type'] = $data['type'];
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }else{
                        $node = [];
                        $node['split'] = $tax_payment_account;
                        $node['account'] = $tax_deposit_to;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['date'] = $goods_receipt->date_c;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $data['id'];
                        $node['rel_type'] = $data['type'];
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_deposit_to;
                        $node['date'] = $goods_receipt->date_c;
                        $node['account'] = $tax_payment_account;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $data['id'];
                        $node['rel_type'] = $data['type'];
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }
                }
            }
        }elseif($data['type'] == 'purchase_order'){
            $this->load->model('purchase/purchase_model');
            $purchase_order = $this->purchase_model->get_pur_order($data['id']);
            $purchase_order_detail = $this->purchase_model->get_pur_order_detail($data['id']);

            $this->load->model('currencies_model');
            $currency = $this->currencies_model->get_base_currency();

            $payment_account = $data['payment_account'];
            $deposit_to = $data['deposit_to'];
            
            $expense_payment_account = get_option('acc_pur_order_payment_account');
            $expense_deposit_to = get_option('acc_pur_order_deposit_to');

            $item_amount = $data['item_amount'];
            foreach ($purchase_order_detail as $value) {
                $item_id = $value['item_code'];
                $item_total = $item_amount[$item_id];

                if(isset($payment_account[$item_id])) {

                    $node = [];
                    $node['split'] = $payment_account[$item_id];
                    $node['account'] = $deposit_to[$item_id];
                    $node['debit'] = $item_total;
                    $node['date'] = $purchase_order->order_date;
                    $node['item'] = $item_id;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $deposit_to[$item_id];
                    $node['date'] = $purchase_order->order_date;
                    $node['item'] = $item_id;
                    $node['account'] = $payment_account[$item_id];
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }else{
                    $node = [];
                    $node['split'] = $expense_payment_account;
                    $node['account'] = $expense_deposit_to;
                    $node['date'] = $purchase_order->order_date;
                    $node['item'] = $item_id;
                    $node['debit'] = $item_total;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $expense_deposit_to;
                    $node['account'] = $expense_payment_account;
                    $node['date'] = $purchase_order->order_date;
                    $node['item'] = $item_id;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $data['id'];
                    $node['rel_type'] = $data['type'];
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }
                if(get_option('acc_tax_automatic_conversion') == 1 && $value['tax'] > 0){
                    $tax_payment_account = get_option('acc_expense_tax_payment_account');
                    $tax_deposit_to = get_option('acc_expense_tax_deposit_to');

                    $total_tax = $value['total'] - $value['into_money'];

                    $tax_mapping = $this->get_tax_mapping($value['tax']);

                    if($tax_mapping){
                        $node = [];
                        $node['split'] = $tax_mapping->payment_account;
                        $node['account'] = $tax_mapping->deposit_to;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['date'] = $purchase_order->order_date;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $data['id'];
                        $node['rel_type'] = $data['type'];
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_mapping->deposit_to;
                        $node['account'] = $tax_mapping->payment_account;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['date'] = $purchase_order->order_date;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $data['id'];
                        $node['rel_type'] = $data['type'];
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }else{
                        $node = [];
                        $node['split'] = $tax_payment_account;
                        $node['account'] = $tax_deposit_to;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['date'] = $purchase_order->order_date;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $data['id'];
                        $node['rel_type'] = $data['type'];
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_deposit_to;
                        $node['date'] = $purchase_order->order_date;
                        $node['account'] = $tax_payment_account;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $data['id'];
                        $node['rel_type'] = $data['type'];
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }
                }
            }

        }elseif ($data['type'] == 'payslip') {
            $date = date('Y-m-d');

                $node = [];
                $node['split'] = $data['payment_account_insurance'];
                $node['account'] = $data['deposit_to_insurance'];
                $node['debit'] = $data['total_insurance'];
                $node['date'] = $date;
                $node['credit'] = 0;
                $node['tax'] = 0;
                $node['description'] = '';
                $node['rel_id'] = $data['id'];
                $node['rel_type'] = $data['type'];
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $node['payslip_type'] = 'total_insurance';
                $data_insert[] = $node;

                $node = [];
                $node['split'] = $data['deposit_to_insurance'];
                $node['account'] = $data['payment_account_insurance'];
                $node['date'] = $date;
                $node['tax'] = 0;
                $node['debit'] = 0;
                $node['credit'] = $data['total_insurance'];
                $node['description'] = '';
                $node['rel_id'] = $data['id'];
                $node['rel_type'] = $data['type'];
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $node['payslip_type'] = 'total_insurance';
                $data_insert[] = $node;

                $node = [];
                $node['split'] = $data['payment_account_tax_paye'];
                $node['account'] = $data['deposit_to_tax_paye'];
                $node['debit'] = $data['tax_paye'];
                $node['date'] = $date;
                $node['credit'] = 0;
                $node['tax'] = 0;
                $node['description'] = '';
                $node['rel_id'] = $data['id'];
                $node['rel_type'] = $data['type'];
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $node['payslip_type'] = 'tax_paye';
                $data_insert[] = $node;

                $node = [];
                $node['split'] = $data['deposit_to_tax_paye'];
                $node['account'] = $data['payment_account_tax_paye'];
                $node['date'] = $date;
                $node['tax'] = 0;
                $node['debit'] = 0;
                $node['credit'] = $data['tax_paye'];
                $node['description'] = '';
                $node['rel_id'] = $data['id'];
                $node['rel_type'] = $data['type'];
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $node['payslip_type'] = 'tax_paye';
                $data_insert[] = $node;

                $node = [];
                $node['split'] = $data['payment_account_net_pay'];
                $node['account'] = $data['deposit_to_net_pay'];
                $node['debit'] = $data['net_pay'];
                $node['date'] = $date;
                $node['credit'] = 0;
                $node['tax'] = 0;
                $node['description'] = '';
                $node['rel_id'] = $data['id'];
                $node['rel_type'] = $data['type'];
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $node['payslip_type'] = 'net_pay';
                $data_insert[] = $node;

                $node = [];
                $node['split'] = $data['deposit_to_net_pay'];
                $node['account'] = $data['payment_account_net_pay'];
                $node['date'] = $date;
                $node['tax'] = 0;
                $node['debit'] = 0;
                $node['credit'] = $data['net_pay'];
                $node['description'] = '';
                $node['rel_id'] = $data['id'];
                $node['rel_type'] = $data['type'];
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $node['payslip_type'] = 'net_pay';
                $data_insert[] = $node;

        }elseif($data['type'] == 'opening_stock'){
            $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

            $date_financial_year = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.date('Y')));

            $date = date('Y-m-d');

            $node = [];
            $node['split'] = $data['payment_account'];
            $node['account'] = $data['deposit_to'];
            $node['debit'] = $data['amount'];
            $node['date'] = $date;
            $node['credit'] = 0;
            $node['tax'] = 0;
            $node['description'] = '';
            $node['rel_id'] = $data['id'];
            $node['rel_type'] = $data['type'];
            $node['datecreated'] = date('Y-m-d H:i:s');
            $node['addedfrom'] = get_staff_user_id();
            $data_insert[] = $node;

            $node = [];
            $node['split'] = $data['deposit_to'];
            $node['account'] = $data['payment_account'];
            $node['date'] = $date;
            $node['tax'] = 0;
            $node['debit'] = 0;
            $node['credit'] = $data['amount'];
            $node['description'] = '';
            $node['rel_id'] = $data['id'];
            $node['rel_type'] = $data['type'];
            $node['datecreated'] = date('Y-m-d H:i:s');
            $node['addedfrom'] = get_staff_user_id();
            $data_insert[] = $node;
        }else{
            $customer = 0;
            $date = date('Y-m-d');
            $description = '';
            
            if($data['type'] == 'payment'){
                $this->load->model('payments_model');
                $this->load->model('invoices_model');
                $payment = $this->payments_model->get($data['id']);
                $date = $payment->date;
                $invoice = $this->invoices_model->get($payment->invoiceid);

                $this->automatic_invoice_conversion($payment->invoiceid);
                
                $customer = $invoice->clientid;

                $this->load->model('currencies_model');
                $currency = $this->currencies_model->get_base_currency();

                if(isset($data['exchange_rate'])){
                    $data['amount'] = round($data['amount'] * $data['exchange_rate'], 2);
                }elseif($invoice->currency_name != $currency->name){
                    $data['amount'] = round($this->currency_converter($invoice->currency_name, $currency->name, $data['amount']), 2);
                }
            }elseif ($data['type'] == 'expense') {
                $this->load->model('expenses_model');
                $expense = $this->expenses_model->get($data['id']);
                $date = $expense->date;
                $customer = $expense->clientid;

                $this->load->model('currencies_model');
                $currency = $this->currencies_model->get_base_currency();

                if(isset($data['exchange_rate'])){
                    $data['amount'] = round($data['amount'] * $data['exchange_rate'], 2);
                }elseif($expense->currency_data->name != $currency->name){
                    $data['amount'] = round($this->currency_converter($expense->currency_data->name, $currency->name, $data['amount']), 2);
                }

                if(get_option('acc_tax_automatic_conversion') == 1){
                    $tax_payment_account = get_option('acc_tax_payment_account');
                    $tax_deposit_to = get_option('acc_tax_deposit_to');

                    if($expense->tax > 0){
                        $this->db->where('id', $expense->tax);
                        $tax = $this->db->get(db_prefix().'taxes')->row();
                        $total_tax = 0;
                        if($tax){
                            $total_tax = ($tax->taxrate/100) * $data['amount'];
                        }
                        $tax_mapping = $this->get_tax_mapping($expense->tax);
                        if($tax_mapping){
                            $node = [];
                            $node['split'] = $tax_mapping->expense_payment_account;
                            $node['account'] = $tax_mapping->expense_deposit_to;
                            $node['tax'] = $expense->tax;
                            $node['debit'] = $total_tax;
                            $node['credit'] = 0;
                            $node['customer'] = $expense->clientid;
                            $node['date'] = $expense->date;
                            $node['description'] = '';
                            $node['rel_id'] = $data['id'];
                            $node['rel_type'] = 'expense';
                            $node['datecreated'] = date('Y-m-d H:i:s');
                            $node['addedfrom'] = get_staff_user_id();
                            $data_insert[] = $node;

                            $node = [];
                            $node['split'] = $tax_mapping->expense_deposit_to;
                            $node['customer'] = $expense->clientid;
                            $node['account'] = $tax_mapping->expense_payment_account;
                            $node['tax'] = $expense->tax;
                            $node['date'] = $expense->date;
                            $node['debit'] = 0;
                            $node['credit'] = $total_tax;
                            $node['description'] = '';
                            $node['rel_id'] = $data['id'];
                            $node['rel_type'] = 'expense';
                            $node['datecreated'] = date('Y-m-d H:i:s');
                            $node['addedfrom'] = get_staff_user_id();
                            $data_insert[] = $node;
                        }else{
                            $node = [];
                            $node['split'] = $tax_payment_account;
                            $node['account'] = $tax_deposit_to;
                            $node['tax'] = $expense->tax;
                            $node['date'] = $expense->date;
                            $node['debit'] = $total_tax;
                            $node['customer'] = $expense->clientid;
                            $node['credit'] = 0;
                            $node['description'] = '';
                            $node['rel_id'] = $data['id'];
                            $node['rel_type'] = 'expense';
                            $node['datecreated'] = date('Y-m-d H:i:s');
                            $node['addedfrom'] = get_staff_user_id();
                            $data_insert[] = $node;

                            $node = [];
                            $node['split'] = $tax_deposit_to;
                            $node['customer'] = $expense->clientid;
                            $node['account'] = $tax_payment_account;
                            $node['date'] = $expense->date;
                            $node['tax'] = $expense->tax;
                            $node['debit'] = 0;
                            $node['credit'] = $total_tax;
                            $node['description'] = '';
                            $node['rel_id'] = $data['id'];
                            $node['rel_type'] = 'expense';
                            $node['datecreated'] = date('Y-m-d H:i:s');
                            $node['addedfrom'] = get_staff_user_id();
                            $data_insert[] = $node;
                        }
                    }

                    if($expense->tax2 > 0){
                        $this->db->where('id', $expense->tax2);
                        $tax = $this->db->get(db_prefix().'taxes')->row();
                        $total_tax = 0;
                        if($tax){
                            $total_tax = ($tax->taxrate/100) * $data['amount'];
                        }
                        $tax_mapping = $this->get_tax_mapping($expense->tax2);
                        if($tax_mapping){
                            $node = [];
                            $node['split'] = $tax_mapping->expense_payment_account;
                            $node['account'] = $tax_mapping->expense_deposit_to;
                            $node['tax'] = $expense->tax2;
                            $node['debit'] = $total_tax;
                            $node['credit'] = 0;
                            $node['customer'] = $expense->clientid;
                            $node['date'] = $expense->date;
                            $node['description'] = '';
                            $node['rel_id'] = $expense_id;
                            $node['rel_type'] = 'expense';
                            $node['datecreated'] = date('Y-m-d H:i:s');
                            $node['addedfrom'] = get_staff_user_id();
                            $data_insert[] = $node;

                            $node = [];
                            $node['split'] = $tax_mapping->expense_deposit_to;
                            $node['customer'] = $expense->clientid;
                            $node['account'] = $tax_mapping->expense_payment_account;
                            $node['tax'] = $expense->tax2;
                            $node['date'] = $expense->date;
                            $node['debit'] = 0;
                            $node['credit'] = $total_tax;
                            $node['description'] = '';
                            $node['rel_id'] = $expense_id;
                            $node['rel_type'] = 'expense';
                            $node['datecreated'] = date('Y-m-d H:i:s');
                            $node['addedfrom'] = get_staff_user_id();
                            $data_insert[] = $node;
                        }else{
                            $node = [];
                            $node['split'] = $tax_payment_account;
                            $node['account'] = $tax_deposit_to;
                            $node['tax'] = $expense->tax2;
                            $node['date'] = $expense->date;
                            $node['debit'] = $total_tax;
                            $node['customer'] = $expense->clientid;
                            $node['credit'] = 0;
                            $node['description'] = '';
                            $node['rel_id'] = $expense_id;
                            $node['rel_type'] = 'expense';
                            $node['datecreated'] = date('Y-m-d H:i:s');
                            $node['addedfrom'] = get_staff_user_id();
                            $data_insert[] = $node;

                            $node = [];
                            $node['split'] = $tax_deposit_to;
                            $node['customer'] = $expense->clientid;
                            $node['account'] = $tax_payment_account;
                            $node['date'] = $expense->date;
                            $node['tax'] = $expense->tax2;
                            $node['debit'] = 0;
                            $node['credit'] = $total_tax;
                            $node['description'] = '';
                            $node['rel_id'] = $expense_id;
                            $node['rel_type'] = 'expense';
                            $node['datecreated'] = date('Y-m-d H:i:s');
                            $node['addedfrom'] = get_staff_user_id();
                            $data_insert[] = $node;
                        }
                    }
                }
            }elseif($data['type'] == 'banking'){
                $banking = $this->get_transaction_banking($data['id']);
                if($banking){
                    $date = $banking->date;
                    $description = $banking->description;
                }
            }elseif($data['type'] == 'purchase_payment'){
                $this->load->model('purchase/purchase_model');
                $payment = $this->purchase_model->get_payment_pur_invoice($data['id']);
                $date = $payment->date;
                $data['amount'] = $payment->amount;
            }

            $node = [];
            $node['split'] = $data['payment_account'];
            $node['account'] = $data['deposit_to'];
            $node['debit'] = $data['amount'];
            $node['customer'] = $customer;
            $node['date'] = $date;
            $node['credit'] = 0;
            $node['tax'] = 0;
            $node['description'] = $description;
            $node['rel_id'] = $data['id'];
            $node['rel_type'] = $data['type'];
            $node['datecreated'] = date('Y-m-d H:i:s');
            $node['addedfrom'] = get_staff_user_id();
            $data_insert[] = $node;

            $node = [];
            $node['split'] = $data['deposit_to'];
            $node['account'] = $data['payment_account'];
            $node['customer'] = $customer;
            $node['date'] = $date;
            $node['tax'] = 0;
            $node['debit'] = 0;
            $node['credit'] = $data['amount'];
            $node['description'] = $description;
            $node['rel_id'] = $data['id'];
            $node['rel_type'] = $data['type'];
            $node['datecreated'] = date('Y-m-d H:i:s');
            $node['addedfrom'] = get_staff_user_id();
            $data_insert[] = $node;
        }

        $affectedRows = $this->db->insert_batch(db_prefix().'acc_account_history', $data_insert);
            
        if ($affectedRows > 0) {
            return true;
        }

        return false;
    }

    /**
     * add transfer
     * @param array $data
     * @return boolean
     */
    public function add_transfer($data){
        if(isset($data['id'])){
            unset($data['id']);
        }
        $data['date'] = to_sql_date($data['date']);
        if(get_option('acc_close_the_books') == 1){
            if(strtotime($data['date']) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                return 'close_the_book';
            }
        }
        $data['transfer_amount'] = str_replace(',', '', $data['transfer_amount']);
        $data['datecreated'] = date('Y-m-d H:i:s');
        $data['addedfrom'] = get_staff_user_id();

        $this->db->insert(db_prefix().'acc_transfers', $data);
        $insert_id = $this->db->insert_id();
        
        if($insert_id){
            $node = [];
            $node['split'] = $data['transfer_funds_to'];
            $node['account'] = $data['transfer_funds_from'];
            $node['debit'] = 0;
            $node['date'] = $data['date'];
            $node['credit'] = $data['transfer_amount'];
            $node['rel_id'] = $insert_id;
            $node['rel_type'] = 'transfer';
            $node['datecreated'] = date('Y-m-d H:i:s');
            $node['addedfrom'] = get_staff_user_id();

            $this->db->insert(db_prefix().'acc_account_history', $node);

            $node = [];
            $node['split'] = $data['transfer_funds_from'];
            $node['account'] = $data['transfer_funds_to'];
            $node['debit'] = $data['transfer_amount'];
            $node['date'] = $data['date'];
            $node['credit'] = 0;
            $node['rel_id'] = $insert_id;
            $node['rel_type'] = 'transfer';
            $node['datecreated'] = date('Y-m-d H:i:s');
            $node['addedfrom'] = get_staff_user_id();

            $this->db->insert(db_prefix().'acc_account_history', $node);

            return true;
        }

        return false;
    }

    /**
     * add journal entry
     * @param array $data 
     * @return boolean
     */
    public function add_journal_entry($data){
        $journal_entry = json_decode($data['journal_entry']);
        unset($data['journal_entry']);

        $data['journal_date'] = to_sql_date($data['journal_date']);

        if(get_option('acc_close_the_books') == 1){
            if(strtotime($data['journal_date']) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                return 'close_the_book';
            }
        }
        
        $data['datecreated'] = date('Y-m-d H:i:s');
        $data['addedfrom'] = get_staff_user_id();
        
        $this->db->insert(db_prefix().'acc_journal_entries', $data);
        $insert_id = $this->db->insert_id();
        
        if($insert_id){
            $data_insert = [];

            foreach ($journal_entry as $key => $value) {
                if($value[0] != ''){
                    $node = [];
                    $node['account'] = $value[0];
                    $node['date'] = $data['journal_date'];
                    $node['debit'] = $value[1];
                    $node['credit'] = $value[2];
                    $node['description'] = $value[3];
                    $node['rel_id'] = $insert_id;
                    $node['rel_type'] = 'journal_entry';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();

                    $data_insert[] = $node;
                }
            }
            
            $this->db->insert_batch(db_prefix().'acc_account_history', $data_insert);

            return true;
        }

        return false;
    }

    /**
     * get data balance sheet
     * @param  array $data_filter
     * @return array           
     */
    public function get_data_balance_sheet($data_filter){
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 1){
                $data_accounts['accounts_receivable'][] = $value;
            }
            if($value['account_type_id'] == 2){
                $data_accounts['current_assets'][] = $value;
            }
            if($value['account_type_id'] == 3){
                $data_accounts['cash_and_cash_equivalents'][] = $value;
            }
            if($value['account_type_id'] == 4){
                $data_accounts['fixed_assets'][] = $value;
            }
            if($value['account_type_id'] == 5){
                $data_accounts['non_current_assets'][] = $value;
            }
            if($value['account_type_id'] == 6){
                $data_accounts['accounts_payable'][] = $value;
            }
            if($value['account_type_id'] == 7){
                $data_accounts['credit_card'][] = $value;
            }
            if($value['account_type_id'] == 8){
                $data_accounts['current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 9){
                $data_accounts['non_current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 10){
                $data_accounts['owner_equity'][] = $value;
            }

            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    $child_account = $this->get_data_balance_sheet_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $accounting_method, $acc_show_account_numbers);

                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                        $data_report[$data_key][] = ['name' => $name, 'amount' => $credits - $debits, 'child_account' => $child_account];
                        $total += $credits - $debits;
                    }else{
                        $data_report[$data_key][] = ['name' => $name, 'amount' => $debits - $credits, 'child_account' => $child_account];
                        $total += $debits - $credits;
                    }

                }
            }
            $data_total[$data_key] = $total;
        }

        $data_total_2 = [];
        foreach ($data_accounts as $data_key => $data_account) {
            if($data_key != 'income' && $data_key != 'other_income' && $data_key != 'cost_of_sales' && $data_key != 'expenses' && $data_key != 'other_expenses'){
                continue;
            }
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                            $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                        }else{
                            $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                        }


                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7){
                        $total += $credits - $debits;
                    }else{
                        $total += $debits - $credits;
                    }

                }
            }
            $data_total_2[$data_key] = $total;
        }

        $income = $data_total_2['income'] + $data_total_2['other_income'];
        $expenses = $data_total_2['expenses'] + $data_total_2['other_expenses'] + $data_total_2['cost_of_sales'];
        $net_income = $income - $expenses;

        return ['data' => $data_report, 'total' => $data_total, 'from_date' => $from_date, 'to_date' => $to_date, 'net_income' => $net_income];
        
    }

    /**
     * get data balance sheet comparison
     * @param  array $data_filter 
     * @return array           
     */
    public function get_data_balance_sheet_comparison($data_filter){
        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }
        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $last_from_date = date('Y-m-d', strtotime($from_date.' - 1 year'));
        $last_to_date = date('Y-m-d', strtotime($to_date.' - 1 year'));
        $this_year = date('Y', strtotime($to_date));
        $last_year = date('Y', strtotime($last_to_date));

        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 1){
                $data_accounts['accounts_receivable'][] = $value;
            }
            if($value['account_type_id'] == 2){
                $data_accounts['current_assets'][] = $value;
            }
            if($value['account_type_id'] == 3){
                $data_accounts['cash_and_cash_equivalents'][] = $value;
            }
            if($value['account_type_id'] == 4){
                $data_accounts['fixed_assets'][] = $value;
            }
            if($value['account_type_id'] == 5){
                $data_accounts['non_current_assets'][] = $value;
            }
            if($value['account_type_id'] == 6){
                $data_accounts['accounts_payable'][] = $value;
            }
            if($value['account_type_id'] == 7){
                $data_accounts['credit_card'][] = $value;
            }
            if($value['account_type_id'] == 8){
                $data_accounts['current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 9){
                $data_accounts['non_current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 10){
                $data_accounts['owner_equity'][] = $value;
            }

            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }
        
        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            $py_total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;

                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date_format(datecreated, \'%Y-%m-%d\') >= "' . $last_from_date . '" and date_format(datecreated, \'%Y-%m-%d\') <= "' . $last_to_date . '")');
                    $py_account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $py_credits = $py_account_history->credit != '' ? $py_account_history->credit : 0;
                    $py_debits = $py_account_history->debit != '' ? $py_account_history->debit : 0;

                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    $child_account = $this->get_data_balance_sheet_comparison_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $last_from_date, $last_to_date, $accounting_method, $acc_show_account_numbers);
                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                        $data_report[$data_key][] = ['name' => $name, 'amount' => ($credits - $debits), 'py_amount' => ($py_credits - $py_debits), 'child_account' => $child_account];
                        $total += $credits - $debits;
                        $py_total += $py_credits - $py_debits;
                    }else{
                        $data_report[$data_key][] = ['name' => $name, 'amount' => ($debits - $credits), 'py_amount' => ($py_debits - $py_credits), 'child_account' => $child_account];
                        $total += $debits - $credits;
                        $py_total += $py_debits - $py_credits;
                    }
                }
            }
            $data_total[$data_key] = ['this_year' => $total, 'last_year' => $py_total];
        }

        $data_total_2 = [];
        foreach ($data_accounts as $data_key => $data_account) {
            if($data_key != 'income' && $data_key != 'other_income' && $data_key != 'cost_of_sales' && $data_key != 'expenses' && $data_key != 'other_expenses'){
                continue;
            }
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date_format(datecreated, \'%Y-%m-%d\') >= "' . $last_from_date . '" and date_format(datecreated, \'%Y-%m-%d\') <= "' . $last_to_date . '")');
                    $py_account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $py_credits = $py_account_history->credit != '' ? $py_account_history->credit : 0;
                    $py_debits = $py_account_history->debit != '' ? $py_account_history->debit : 0;

                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7){
                        $total += $credits - $debits;
                        $py_total += $py_credits - $py_debits;
                    }else{
                        $total += $debits - $credits;
                        $py_total += $py_debits - $py_credits;
                    }

                }
            }
            $data_total_2[$data_key] = ['this_year' => $total, 'last_year' => $py_total];
        }
        
        $this_income = $data_total_2['income']['this_year'] + $data_total_2['other_income']['this_year'];
        $this_expenses = $data_total_2['expenses']['this_year'] + $data_total_2['other_expenses']['this_year'] + $data_total_2['cost_of_sales']['this_year'];
        $this_net_income = $this_income - $this_expenses;

        $last_income = $data_total_2['income']['last_year'] + $data_total_2['other_income']['last_year'];
        $last_expenses = $data_total_2['expenses']['last_year'] + $data_total_2['other_expenses']['last_year'] + $data_total_2['cost_of_sales']['last_year'];
        $last_net_income = $last_income - $last_expenses;

        return ['data' => $data_report, 'total' => $data_total, 'this_year' => $this_year, 'last_year' => $last_year, 'from_date' => $from_date, 'to_date' => $to_date, 'this_net_income' => $this_net_income, 'last_net_income' => $last_net_income];
    }

    /**
     * get data balance sheet detail
     * @param  array $data_filter 
     * @return array           
     */
    public function get_data_balance_sheet_detail($data_filter){
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }
        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }
        
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 1){
                $data_accounts['accounts_receivable'][] = $value;
            }
            if($value['account_type_id'] == 2){
                $data_accounts['current_assets'][] = $value;
            }
            if($value['account_type_id'] == 3){
                $data_accounts['cash_and_cash_equivalents'][] = $value;
            }
            if($value['account_type_id'] == 4){
                $data_accounts['fixed_assets'][] = $value;
            }
            if($value['account_type_id'] == 5){
                $data_accounts['non_current_assets'][] = $value;
            }
            if($value['account_type_id'] == 6){
                $data_accounts['accounts_payable'][] = $value;
            }
            if($value['account_type_id'] == 7){
                $data_accounts['credit_card'][] = $value;
            }
            if($value['account_type_id'] == 8){
                $data_accounts['current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 9){
                $data_accounts['non_current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 10){
                $data_accounts['owner_equity'][] = $value;
            }

            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            if($data_key != 'income' && $data_key != 'other_income' && $data_key != 'cost_of_sales' && $data_key != 'expenses' && $data_key != 'other_expenses'){
            $data_report[$data_key] = [];
            $total = 0;
            $balance_total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }

                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $this->db->order_by('date', 'asc');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
                    $node = [];
                    $balance = 0;
                    $amount = 0;
                    foreach ($account_history as $v) {
                        if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 10 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                            $am = $v['credit'] - $v['debit'];
                        }else{
                            $am = $v['debit'] - $v['credit'];
                        }

                        $node[] =   [
                                        'date' => date('Y-m-d', strtotime($v['date'])),
                                        'type' => _l($v['rel_type']),
                                        'description' => $v['description'],
                                        'debit' => $v['debit'],
                                        'credit' => $v['credit'],
                                        'amount' => $am,
                                        'balance' => $balance + $am,
                                    ];
                            $amount += $am;
                            $balance += $am;
                    }

                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    $child_account = $this->get_data_balance_sheet_detail_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $accounting_method, $acc_show_account_numbers);
                    
                    $data_report[$data_key][] = ['account' => $val['id'], 'name' => $name, 'amount' => $amount, 'balance' => $balance, 'details' => $node, 'child_account' => $child_account];


                    $total += $amount;
                    $balance_total += $balance;
                }
            }
            $data_total[$data_key] = ['amount' => $total, 'balance' => $balance_total];
            }
        }
        $data_total_2 = [];
        foreach ($data_accounts as $data_key => $data_account) {
            if($data_key != 'income' && $data_key != 'other_income' && $data_key != 'cost_of_sales' && $data_key != 'expenses' && $data_key != 'other_expenses'){
                continue;
            }
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7){
                        $total += $credits - $debits;
                    }else{
                        $total += $debits - $credits;
                    }

                }
            }
            $data_total_2[$data_key] = $total;
        }

        $income = $data_total_2['income'] + $data_total_2['other_income'];
        $expenses = $data_total_2['expenses'] + $data_total_2['other_expenses'] + $data_total_2['cost_of_sales'];
        $net_income = $income - $expenses;

        return ['data' => $data_report, 'total' => $data_total, 'from_date' => $from_date, 'to_date' => $to_date, 'net_income' => $net_income];
        
    }

    /**
     * get data balance sheet summary
     * @param  array $data_filter 
     * @return array           
     */
    public function get_data_balance_sheet_summary($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }
        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 1){
                $data_accounts['accounts_receivable'][] = $value;
            }
            if($value['account_type_id'] == 2){
                $data_accounts['current_assets'][] = $value;
            }
            if($value['account_type_id'] == 3){
                $data_accounts['cash_and_cash_equivalents'][] = $value;
            }
            if($value['account_type_id'] == 4){
                $data_accounts['fixed_assets'][] = $value;
            }
            if($value['account_type_id'] == 5){
                $data_accounts['non_current_assets'][] = $value;
            }
            if($value['account_type_id'] == 6){
                $data_accounts['accounts_payable'][] = $value;
            }
            if($value['account_type_id'] == 7){
                $data_accounts['credit_card'][] = $value;
            }
            if($value['account_type_id'] == 8){
                $data_accounts['current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 9){
                $data_accounts['non_current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 10){
                $data_accounts['owner_equity'][] = $value;
            }

            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }
        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    $child_account = $this->get_data_balance_sheet_summary_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $accounting_method, $acc_show_account_numbers);
                    
                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                        $data_report[$data_key][] = ['name' => $name, 'amount' => $credits - $debits, 'child_account' => $child_account];
                        $total += $credits - $debits;
                    }else{
                        $data_report[$data_key][] = ['name' => $name, 'amount' => $debits - $credits, 'child_account' => $child_account];
                        $total += $debits - $credits;
                    }
                }
            }
            $data_total[$data_key] = $total;
        }

        $income = $data_total['income'] + $data_total['other_income'];
        $expenses = $data_total['expenses'] + $data_total['other_expenses'] + $data_total['cost_of_sales'];
        $net_income = $income - $expenses;

        return ['data' => $data_report, 'total' => $data_total, 'from_date' => $from_date, 'to_date' => $to_date, 'net_income' => $net_income];
        
    }

    /**
     * get data custom summary report
     * @param  array $data_filter 
     * @return array           
     */
    public function get_data_custom_summary_report($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $display_rows_by = 'income_statement';
        $display_columns_by = 'total_only';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        if(isset($data_filter['display_rows_by'])){
            $display_rows_by = $data_filter['display_rows_by'];
        }

        if(isset($data_filter['display_columns_by'])){
            $display_columns_by = $data_filter['display_columns_by'];
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_accounts = [];
        $headers = [];
        if($display_rows_by == 'total_only'){
            $headers[] = _l('total');
        }elseif ($display_rows_by == 'months') {
            $start = $month = strtotime($from_date);
            $end = strtotime($to_date);

            while($month < $end)
            {
                $headers[] = date('', $month);
                $month = strtotime("+1 month", $month);
            }
        }

        if($display_rows_by == 'income_statement'){
            foreach ($account_type_details as $key => $value) {
                if($value['account_type_id'] == 11){
                    $data_accounts['income'][] = $value;
                }

                if($value['account_type_id'] == 12){
                    $data_accounts['other_income'][] = $value;
                }

                if($value['account_type_id'] == 13){
                    $data_accounts['cost_of_sales'][] = $value;
                }

                if($value['account_type_id'] == 14){
                    $data_accounts['expenses'][] = $value;
                }

                if($value['account_type_id'] == 15){
                    $data_accounts['other_expenses'][] = $value;
                }
            }

            foreach ($data_accounts as $data_key => $data_account) {
                $data_report[$data_key] = [];
                foreach ($data_account as $key => $value) {
                    $this->db->where('active', 1);
                    $this->db->where('(parent_account is null or parent_account = 0)');
                    $this->db->where('account_detail_type_id', $value['id']);
                    $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                    foreach ($accounts as $val) {
                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('account', $val['id']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                        if($acc_show_account_numbers == 1 && $val['number'] != ''){
                            $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                        }else{
                            $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                        }


                        $child_account = $this->get_data_custom_summary_recursive([
                            'child_account' => [],
                            'account_id' => $val['id'],
                            'account_type_id' => $value['account_type_id'],
                            'from_date' => $from_date,
                            'to_date' => $to_date,
                            'accounting_method' => $accounting_method,
                            'acc_show_account_numbers' => $acc_show_account_numbers,
                            'display_rows_by' => $display_rows_by,
                            'display_columns_by' => $display_columns_by,
                        ]);

                        if($display_columns_by == 'total_only'){
                            if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                                $data_report[$data_key][] = ['name' => $name, 'amount' => $credits - $debits, 'child_account' => $child_account];
                            }else{
                                $data_report[$data_key][] = ['name' => $name, 'amount' => $debits - $credits, 'child_account' => $child_account];
                            }
                        }
                    }
                }
            }
        }elseif ($display_rows_by == 'customers') {
            $clients = $this->clients_model->get();
            $headers = [];

            foreach ($clients as $key => $value) {
                $columns = [];
                if($display_columns_by == 'total_only'){
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('customer', $value['userid']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    $columns[] = $debits - $credits;
                }elseif ($display_columns_by == 'months') {
                    $start = $month = strtotime($from_date);
                    $end = strtotime($to_date);

                    while($month < $end)
                    {
                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('customer', $value['userid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                        $columns[] = $debits - $credits;
                        $month = strtotime("+1 month", $month);
                    }
                }

                $data_report[] = ['name' => $value['company'], 'columns' => $columns];
            }
        }

        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date, 'display_rows_by' => $display_rows_by, 'display_columns_by' => $display_columns_by];
        
    }

    /**
     * get data profit and loss as of total income
     * @param  array $data_filter
     * @return array             
     */
    public function get_data_profit_and_loss_as_of_total_income($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_percent = [];

        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        $total = 0;
        foreach ($data_accounts['income'] as $value) {
            $this->db->where('active', 1);
            $this->db->where('account_detail_type_id', $value['id']);
            $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
            foreach ($accounts as $val) {
                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                $this->db->where('account', $val['id']);
                if($accounting_method == 'cash'){
                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                }
                $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                $debits = $account_history->debit != '' ? $account_history->debit : 0;
                if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                    $total += $credits - $debits;
                }else{
                    $total += $debits - $credits;
                }
            }
        }
        $data_total['income'] = $total;

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            $percent = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;

                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }

                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                        $r_am = $credits - $debits;
                        $total += $credits - $debits;
                    }else{
                        $r_am = $debits - $credits;
                        $total += $debits - $credits;
                    }

                    $child_account = $this->get_data_profit_and_loss_as_of_total_income_recursive([], $data_total['income'], $val['id'], $value['account_type_id'], $from_date, $to_date, $accounting_method, $acc_show_account_numbers);

                    if($data_total['income'] != 0){
                        $data_report[$data_key][] = ['name' => $name, 'amount' => $r_am, 'percent' => round((($r_am) / $data_total['income']) * 100, 2), 'child_account' => $child_account];
                    }else{
                        $data_report[$data_key][] = ['name' => $name, 'amount' => $r_am, 'percent' => 0, 'child_account' => $child_account];
                    }
                }
            }
            $data_total[$data_key] = $total;
            if($data_total['income'] != 0){
                $data_percent[$data_key] = round(($total / $data_total['income']) * 100, 2);
            }else{
                $data_percent[$data_key] = 0;
            }
        }

        return ['data' => $data_report, 'total' => $data_total, 'percent' => $data_percent, 'from_date' => $from_date, 'to_date' => $to_date];
        
    }

    /**
     * get data profit and loss comparison
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_profit_and_loss_comparison($data_filter){
        $this_year = date('Y');
        $last_year = $this_year - 1;
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $last_from_date = date('Y-m-d', strtotime($from_date.' - 1 year'));
        $last_to_date = date('Y-m-d', strtotime($to_date.' - 1 year'));
        $this_year = date('Y', strtotime($to_date));
        $last_year = date('Y', strtotime($last_to_date));

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_this_year = [];
        $data_last_year = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            $py_total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;

                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date_format(datecreated, \'%Y-%m-%d\') >= "' . $last_from_date . '" and date_format(datecreated, \'%Y-%m-%d\') <= "' . $last_to_date . '")');
                    $py_account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $py_credits = $py_account_history->credit != '' ? $py_account_history->credit : 0;
                    $py_debits = $py_account_history->debit != '' ? $py_account_history->debit : 0;

                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    $child_account = $this->get_data_profit_and_loss_comparison_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $last_from_date, $last_to_date, $accounting_method, $acc_show_account_numbers);

                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                        $data_report[$data_key][] = ['name' => $name, 'this_year' => $credits - $debits, 'last_year' => $py_credits - $py_debits, 'child_account' => $child_account];
                    }else{
                        $data_report[$data_key][] = ['name' => $name, 'this_year' => $debits - $credits, 'last_year' => $py_debits - $py_credits, 'child_account' => $child_account];
                    }
                }
            }
        }

        return ['data' => $data_report, 'this_year_header' => $this_year, 'last_year_header' => $last_year, 'from_date' => $from_date, 'to_date' => $to_date];
        
    }

    /**
     * get data profit and loss detail
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_profit_and_loss_detail($data_filter){
        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }
        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $accounts = $this->accounting_model->get_accounts();

        $account_name = [];

        foreach ($accounts as $key => $value) {
            $account_name[$value['id']] = $value['name'];
        }

        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            $balance_total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $this->db->order_by('date', 'asc');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
                    $node = [];
                    $balance = 0;
                    $amount = 0;
                    foreach ($account_history as $v) {
                        if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                            $am = $v['credit'] - $v['debit'];
                        }else{
                            $am = $v['debit'] - $v['credit'];
                        }
                        $node[] =   [
                                        'date' => date('Y-m-d', strtotime($v['date'])),
                                        'type' => _l($v['rel_type']),
                                        'split' => $v['split'] != 0 ? (isset($account_name[$v['split']]) ? $account_name[$v['split']] : '') : '-Split-',
                                        'description' => $v['description'],
                                        'customer' => $v['customer'],
                                        'amount' => $am,
                                        'balance' => $balance + $am,
                                    ];
                        $amount += $am;
                        $balance += $am;
                    }

                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }

                    $child_account = $this->get_data_profit_and_loss_detail_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $accounting_method, $acc_show_account_numbers);

                    $data_report[$data_key][] = ['account' => $val['id'], 'name' => $name, 'amount' => $amount, 'balance' => $balance, 'details' => $node, 'child_account' => $child_account];

                    $total += $amount;
                    $balance_total += $balance;
                }
            }
            $data_total[$data_key] = ['amount' => $total, 'balance' => $balance_total];
        }
        
        return ['data' => $data_report, 'total' => $data_total, 'from_date' => $from_date, 'to_date' => $to_date];
        
    }

    /**
     * get data profit and loss year to date comparison
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_profit_and_loss_year_to_date_comparison($data_filter){
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }
        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $last_from_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.date('Y')));
        $last_to_date = $to_date;

        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;

                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date_format(datecreated, \'%Y-%m-%d\') >= "' . $last_from_date . '" and date_format(datecreated, \'%Y-%m-%d\') <= "' . $last_to_date . '")');
                    $py_account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $py_credits = $py_account_history->credit != '' ? $py_account_history->credit : 0;
                    $py_debits = $py_account_history->debit != '' ? $py_account_history->debit : 0;

                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    $child_account = $this->get_data_profit_and_loss_year_to_date_comparison_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $last_from_date, $last_to_date, $accounting_method, $acc_show_account_numbers);
                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                        $data_report[$data_key][] = ['name' => $name, 'this_year' => $credits - $debits, 'last_year' => $py_credits - $py_debits, 'child_account' => $child_account];
                    }else{
                        $data_report[$data_key][] = ['name' => $name, 'this_year' => $debits - $credits, 'last_year' => $py_debits - $py_credits, 'child_account' => $child_account];
                    }
                }
            }
        }
        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date, 'last_from_date' => $last_from_date, 'last_to_date' => $last_to_date];
        
    }

    /**
     * get data profit and loss
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_profit_and_loss($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }
        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }
        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                   
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    $child_account = $this->get_data_profit_and_loss_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $accounting_method, $acc_show_account_numbers);

                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                        $data_report[$data_key][] = ['name' => $name, 'amount' => $credits - $debits, 'child_account' => $child_account];
                    }else{
                        $data_report[$data_key][] = ['name' => $name, 'amount' => $debits - $credits, 'child_account' => $child_account];
                    }
                }
            }
        }
        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
        
    }

    /**
     * get data statement of cash flows
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_statement_of_cash_flows($data_filter){
        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        $data_accounts['cash_flows_from_operating_activities'] = [];
        $data_accounts['cash_flows_from_financing_activities'] = [];
        $data_accounts['cash_flows_from_investing_activities'] = [];
        $data_accounts['cash_and_cash_equivalents_at_beginning_of_year'] = [];

        foreach ($account_type_details as $key => $value) {
            if(isset($value['statement_of_cash_flows'])){
                $data_accounts[$value['statement_of_cash_flows']][] = $value;
                continue;
            }

            if($value['account_type_id'] == 1){
                $data_accounts['accounts_receivable'][] = $value;
            }
            if($value['account_type_id'] == 2){
                if($value['id'] == 13){
                    $data_accounts['current_assets_3'][] = $value;
                }elseif($value['id'] == 3 || $value['id'] == 6){
                    $data_accounts['current_assets_2'][] = $value;
                }else{
                    $data_accounts['current_assets_1'][] = $value;
                }
            }
            if($value['account_type_id'] == 3){
                $data_accounts['cash_and_cash_equivalents'][] = $value;
            }
            if($value['account_type_id'] == 4){
                if($value['id'] == 21 || $value['id'] == 26){
                    $data_accounts['fixed_assets_2'][] = $value;
                }else{
                    $data_accounts['fixed_assets_1'][] = $value;
                }
            }
            if($value['account_type_id'] == 5){
                if($value['id'] != 31){
                    $data_accounts['non_current_assets_2'][] = $value;
                }else{
                    $data_accounts['non_current_assets_1'][] = $value;
                }
            }
            if($value['account_type_id'] == 6){
                $data_accounts['accounts_payable'][] = $value;
            }
            if($value['account_type_id'] == 7){
                $data_accounts['credit_card'][] = $value;
            }
            if($value['account_type_id'] == 8){
                $data_accounts['current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 9){
                if($value['id'] != 63 && $value['id'] != 64){
                    $data_accounts['non_current_liabilities_2'][] = $value;
                }else{
                    $data_accounts['non_current_liabilities_1'][] = $value;
                }
            }
            if($value['account_type_id'] == 10){
                $data_accounts['owner_equity'][] = $value;
            }

            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    if($val['id'] == 13){
                        $this->db->where('(rel_type != "invoice" and rel_type != "expense" and rel_type != "payment")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $this->db->where('account', $val['id']);
                    
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    $child_account = $this->get_data_statement_of_cash_flows_recursive([], $val['id'], $value['account_type_id'], $value['id'], $from_date, $to_date, $acc_show_account_numbers);

                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 10 || $value['account_type_id'] == 8 || $value['account_type_id'] == 7 || $value['account_type_id'] == 4 || $value['account_type_id'] == 5 || $value['account_type_id'] == 6 || $value['account_type_id'] == 2 || $value['account_type_id'] == 9 || $value['account_type_id'] == 1){
                        $data_report[$data_key][] = ['account_detail_type_id' => $value['id'], 'name' => $name, 'amount' => $credits - $debits, 'child_account' => $child_account];
                        $total += $credits - $debits;
                    }else{
                        $data_report[$data_key][] = ['account_detail_type_id' => $value['id'], 'name' => $name, 'amount' => $debits - $credits, 'child_account' => $child_account];
                        $total += $debits - $credits;
                    }
                }
            }
            $data_total[$data_key] = $total;
        }

        $income = $data_total['income'] + $data_total['other_income'];
        $expenses = $data_total['expenses'] + $data_total['other_expenses'] + $data_total['cost_of_sales'];
        $net_income = $income - $expenses;

        return ['data' => $data_report, 'total' => $data_total, 'net_income' => $net_income, 'from_date' => $from_date, 'to_date' => $to_date];
        
    }
    
    /**
     * get data statement of changes in equity
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_statement_of_changes_in_equity($data_filter){
        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }
        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 10){
                $data_accounts['owner_equity'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                            $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                        }else{
                            $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                        }

                    
                    $child_account = $this->get_data_statement_of_changes_in_equity_recursive([], $val['id'], $from_date, $to_date, $accounting_method, $acc_show_account_numbers);

                    $data_report[$data_key][] = ['account_detail_type_id' => $value['id'], 'name' => $name, 'amount' => $credits - $debits, 'child_account' => $child_account];
                    $total += $credits - $debits;

                }
            }
            $data_total[$data_key] = $total;
        }

        return ['data' => $data_report, 'total' => $data_total, 'from_date' => $from_date, 'to_date' => $to_date];
    }

    /**
     * get data deposit detail
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_deposit_detail($data_filter){
        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 1){
                $data_accounts['accounts_receivable'][] = $value;
            }
            if($value['account_type_id'] == 2){
                $data_accounts['current_assets'][] = $value;
            }
            if($value['account_type_id'] == 3){
                $data_accounts['cash_and_cash_equivalents'][] = $value;
            }
            if($value['account_type_id'] == 4){
                $data_accounts['fixed_assets'][] = $value;
            }
            if($value['account_type_id'] == 5){
                $data_accounts['non_current_assets'][] = $value;
            }
            if($value['account_type_id'] == 6){
                $data_accounts['accounts_payable'][] = $value;
            }
            if($value['account_type_id'] == 7){
                $data_accounts['credit_card'][] = $value;
            }
            if($value['account_type_id'] == 8){
                $data_accounts['current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 9){
                $data_accounts['non_current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 10){
                $data_accounts['owner_equity'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            $balance_total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $this->db->where('account', $val['id']);
                    $this->db->where('((rel_type = "payment" and debit > 0) or (rel_type = "deposit"  and credit > 0))');
                    $this->db->order_by('date', 'asc');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
                    $node = [];
                    $balance = 0;
                    $amount = 0;
                    foreach ($account_history as $v) {
                        if($value['account_type_id'] == 10 || $value['account_type_id'] == 9 || $value['account_type_id'] == 8 || $value['account_type_id'] == 7){
                            $amount += $v['credit'] - $v['debit'];
                            $am = ($v['credit'] - $v['debit']);
                        }else{
                            $amount += $v['debit'] - $v['credit'];
                            $am = ($v['debit'] - $v['credit']);
                        }

                        $node[] =   [
                                        'date' => date('Y-m-d', strtotime($v['date'])),
                                        'type' => _l($v['rel_type']),
                                        'description' => $v['description'],
                                        'customer' => $v['customer'],
                                        'debit' => $v['debit'],
                                        'credit' => $v['credit'],
                                        'amount' =>  $am,
                                    ];
                    }

                    $child_account = $this->get_data_deposit_detail_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $acc_show_account_numbers);

                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }

                    $data_report[$data_key][] = ['account' => $val['id'], 'name' => $name, 'amount' => $amount, 'details' => $node, 'child_account' => $child_account];

                    $total += $amount;
                    $balance_total += $balance;
                }
            }
            $data_total[$data_key] = ['amount' => $total, 'balance' => $balance_total];
        }

        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
        
    }

    /**
     * get data income by customer summary
     * @return array
     */
    public function get_data_income_by_customer_summary($data_filter){
        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }
        
        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }
        $list_customer = [];
        foreach ($data_accounts as $data_key => $data_account) {
            $total = [];
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit, customer');
                    $this->db->group_by('customer');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $this->db->where('(customer != 0)');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }

                    $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();

                    foreach ($account_history as $v) {
                        $credits = $v['credit'] != '' ? $v['credit'] : 0;
                        $debits = $v['debit'] != '' ? $v['debit'] : 0;

                        if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                            $amount = $credits - $debits;
                        }else{
                            $amount = $debits - $credits;
                        }

                        if(isset($total[$v['customer']])){
                            $total[$v['customer']] += $amount;
                        }else{
                            $total[$v['customer']] = $amount;
                        }

                        if(!in_array($v['customer'], $list_customer)){
                            $list_customer[] = $v['customer'];
                        }
                    }
                }
            }
            $data_total[$data_key] = $total;
        }

        return ['list_customer' => $list_customer, 'total' => $data_total, 'from_date' => $from_date, 'to_date' => $to_date];
    }

    /**
     * get data check detail
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_check_detail($data_filter){
        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 3){
                $data_accounts['cash_and_cash_equivalents'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->where('account', $val['id']);
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $this->db->where('rel_type', 'expense');
                    $this->db->order_by('date', 'asc');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();

                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }

                    $data_report[$data_key][] = ['account_detail_type_id' => $value['id'], 'name' => $name, 'details' => $account_history];
                }
            }
        }
        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
        
    }

    /**
     * get data account list
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_account_list($data_filter){
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $account_types = $this->get_account_types();
        $detail_types = $this->get_account_type_details();

        $account_type_name = [];
        $detail_type_name = [];

        foreach ($account_types as $key => $value) {
            $account_type_name[$value['id']] = $value['name'];
        }

        foreach ($detail_types as $key => $value) {
            $detail_type_name[$value['id']] = $value['name'];
        }


        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 1){
                $data_accounts['accounts_receivable'][] = $value;
            }
            if($value['account_type_id'] == 2){
                $data_accounts['current_assets'][] = $value;
            }
            if($value['account_type_id'] == 3){
                $data_accounts['cash_and_cash_equivalents'][] = $value;
            }
            if($value['account_type_id'] == 4){
                $data_accounts['fixed_assets'][] = $value;
            }
            if($value['account_type_id'] == 5){
                $data_accounts['non_current_assets'][] = $value;
            }
            if($value['account_type_id'] == 6){
                $data_accounts['accounts_payable'][] = $value;
            }
            if($value['account_type_id'] == 7){
                $data_accounts['credit_card'][] = $value;
            }
            if($value['account_type_id'] == 8){
                $data_accounts['current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 9){
                $data_accounts['non_current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 10){
                $data_accounts['owner_equity'][] = $value;
            }

            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    $child_account = $this->get_data_account_list_recursive([], $val['id'], $value['account_type_id'], $account_type_name, $detail_type_name, $acc_show_account_numbers);

                    $_account_type_name = isset($account_type_name[$val['account_type_id']]) ? $account_type_name[$val['account_type_id']] : '';
                    $_detail_type_name = isset($detail_type_name[$val['account_detail_type_id']]) ? $detail_type_name[$val['account_detail_type_id']] : '';
                    
                    $data_report[$data_key][] = ['description' => $val['description'], 'type' => $_account_type_name, 'detail_type' => $_detail_type_name, 'name' => $name, 'amount' => $debits - $credits, 'child_account' => $child_account];
                    $total += $debits - $credits;
                }
            }
            $data_total[$data_key] = $total;
        }

        return ['data' => $data_report, 'total' => $data_total];
    }
    
    /**
     * get data general ledger 
     * @return array
     */
    public function get_data_general_ledger($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }
        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $accounts = $this->accounting_model->get_accounts();

        $account_name = [];

        foreach ($accounts as $key => $value) {
            $account_name[$value['id']] = $value['name'];
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 1){
                $data_accounts['accounts_receivable'][] = $value;
            }
            if($value['account_type_id'] == 2){
                $data_accounts['current_assets'][] = $value;
            }
            if($value['account_type_id'] == 3){
                $data_accounts['cash_and_cash_equivalents'][] = $value;
            }
            if($value['account_type_id'] == 4){
                $data_accounts['fixed_assets'][] = $value;
            }
            if($value['account_type_id'] == 5){
                $data_accounts['non_current_assets'][] = $value;
            }
            if($value['account_type_id'] == 6){
                $data_accounts['accounts_payable'][] = $value;
            }
            if($value['account_type_id'] == 7){
                $data_accounts['credit_card'][] = $value;
            }
            if($value['account_type_id'] == 8){
                $data_accounts['current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 9){
                $data_accounts['non_current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 10){
                $data_accounts['owner_equity'][] = $value;
            }
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            $balance_total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->order_by('date', 'asc');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
                    $node = [];
                    $balance = 0;
                    $amount = 0;
                    foreach ($account_history as $v) {
                        if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 10 || $value['account_type_id'] == 9 || $value['account_type_id'] == 8 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                            $am = $v['credit'] - $v['debit'];
                        }else{
                            $am = $v['debit'] - $v['credit'];
                        }

                        $node[] =   [
                                        'date' => date('Y-m-d', strtotime($v['date'])),
                                        'type' => _l($v['rel_type']),
                                        'split' => $v['split'] != 0 ? (isset($account_name[$v['split']]) ? $account_name[$v['split']] : '') : '-Split-',
                                        'description' => $v['description'],
                                        'customer' => $v['customer'],
                                        'debit' => $v['debit'],
                                        'credit' => $v['credit'],
                                        'amount' => $am,
                                        'balance' => $balance + $am,
                                    ];


                        $amount += $am;
                        $balance += $am;
                    }
                    $child_account = $this->get_data_general_ledger_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $accounting_method, $acc_show_account_numbers);

                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }

                    $data_report[$data_key][] = ['account' => $val['id'], 'name' => $name, 'amount' => $amount, 'balance' => $balance, 'details' => $node, 'child_account' => $child_account];

                    $total += $amount;
                    $balance_total += $balance;
                }
            }
            $data_total[$data_key] = ['amount' => $total, 'balance' => $balance_total];
        }
        
        return ['data' => $data_report, 'total' => $data_total, 'from_date' => $from_date, 'to_date' => $to_date];
    }

    /**
     * get data journal
     * @return array 
     */
    public function get_data_journal($data_filter){
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $accounts = $this->accounting_model->get_accounts();

        $account_name = [];

        foreach ($accounts as $key => $value) {
            $account_name[$value['id']] = $value['name'];
        }

        $data_report = [];
        
        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
        $this->db->order_by('date', 'asc');
        
        $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
        $balance = 0;
        $amount = 0;
        foreach ($account_history as $v) {
            $data_report[] =   [
                            'date' => date('Y-m-d', strtotime($v['date'])),
                            'type' => _l($v['rel_type']),
                            'name' => (isset($account_name[$v['account']]) ? $account_name[$v['account']] : ''),
                            'description' => $v['description'],
                            'customer' => $v['customer'],
                            'debit' => $v['debit'],
                            'credit' => $v['credit'],
                        ];
        }
                
        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
    }
    
    /**
     * get data recent transactions
     * @return array
     */
    public function get_data_recent_transactions($data_filter){
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $accounts = $this->accounting_model->get_accounts();

        $account_name = [];

        foreach ($accounts as $key => $value) {
            $account_name[$value['id']] = $value['name'];
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 1){
                $data_accounts['accounts_receivable'][] = $value;
            }
            if($value['account_type_id'] == 2){
                $data_accounts['current_assets'][] = $value;
            }
            if($value['account_type_id'] == 3){
                $data_accounts['cash_and_cash_equivalents'][] = $value;
            }
            if($value['account_type_id'] == 4){
                $data_accounts['fixed_assets'][] = $value;
            }
            if($value['account_type_id'] == 5){
                $data_accounts['non_current_assets'][] = $value;
            }
            if($value['account_type_id'] == 6){
                $data_accounts['accounts_payable'][] = $value;
            }
            if($value['account_type_id'] == 7){
                $data_accounts['credit_card'][] = $value;
            }
            if($value['account_type_id'] == 8){
                $data_accounts['current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 9){
                $data_accounts['non_current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 10){
                $data_accounts['owner_equity'][] = $value;
            }
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();

                foreach ($accounts as $val) {
                    $this->db->where('account', $val['id']);
                    
                    $this->db->where('((debit > 0 and (rel_type != "expense" and rel_type != "transfer")) or (credit > 0 and (rel_type = "expense" or rel_type = "transfer")))');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $this->db->order_by('rel_type,date', 'asc');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();

                    foreach ($account_history as $v) {
                        if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 10 || $value['account_type_id'] == 9 || $value['account_type_id'] == 8 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                            $am = $v['credit'] - $v['debit'];
                        }else{
                            $am = $v['debit'] - $v['credit'];
                        }

                        $data_report[$v['rel_type']][] =   [
                                        'date' => date('Y-m-d', strtotime($v['date'])),
                                        'type' => _l($v['rel_type']),
                                        'name' => (isset($account_name[$v['account']]) ? $account_name[$v['account']] : ''),
                                        'description' => $v['description'],
                                        'customer' => $v['customer'],
                                        'amount' => $am,
                                    ];
                    }
                }
            }
        }

        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
    }

    /**
     * get data transaction detail by account
     * @return array
     */
    public function get_data_transaction_detail_by_account($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }
        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $accounts = $this->accounting_model->get_accounts();

        $account_name = [];

        foreach ($accounts as $key => $value) {
            $account_name[$value['id']] = $value['name'];
        }
        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 1){
                $data_accounts['accounts_receivable'][] = $value;
            }
            if($value['account_type_id'] == 2){
                $data_accounts['current_assets'][] = $value;
            }
            if($value['account_type_id'] == 3){
                $data_accounts['cash_and_cash_equivalents'][] = $value;
            }
            if($value['account_type_id'] == 4){
                $data_accounts['fixed_assets'][] = $value;
            }
            if($value['account_type_id'] == 5){
                $data_accounts['non_current_assets'][] = $value;
            }
            if($value['account_type_id'] == 6){
                $data_accounts['accounts_payable'][] = $value;
            }
            if($value['account_type_id'] == 7){
                $data_accounts['credit_card'][] = $value;
            }
            if($value['account_type_id'] == 8){
                $data_accounts['current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 9){
                $data_accounts['non_current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 10){
                $data_accounts['owner_equity'][] = $value;
            }
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            $balance_total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->order_by('date', 'asc');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
                    $node = [];
                    $balance = 0;
                    $amount = 0;
                    foreach ($account_history as $v) {
                        if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 10 || $value['account_type_id'] == 9 || $value['account_type_id'] == 8 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                            $am = $v['credit'] - $v['debit'];
                        }else{
                            $am = $v['debit'] - $v['credit'];
                        }
                        $node[] =   [
                                        'date' => date('Y-m-d', strtotime($v['date'])),
                                        'type' => _l($v['rel_type']),
                                        'description' => $v['description'],
                                        'customer' => $v['customer'],
                                        'split' => $v['split'] != 0 ? (isset($account_name[$v['split']]) ? $account_name[$v['split']] : '') : '-Split-',
                                        'debit' => $v['debit'],
                                        'credit' => $v['credit'],
                                        'amount' => $am,
                                        'balance' => $balance + ($am),
                                    ];
                        $amount += $am;
                        $balance += $am;
                    }

                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }

                    $child_account = $this->get_data_transaction_detail_by_account_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $accounting_method, $acc_show_account_numbers);

                    $data_report[$data_key][] = ['account' => $val['id'], 'name' => $name, 'amount' => $amount, 'balance' => $balance, 'details' => $node, 'child_account' => $child_account];

                    $total += $amount;
                    $balance_total += $balance;
                }
            }
            $data_total[$data_key] = ['amount' => $total, 'balance' => $balance_total];
        }
        
        return ['data' => $data_report, 'total' => $data_total, 'from_date' => $from_date, 'to_date' => $to_date];
    }

    /**
     * get data transaction list by date
     * @return array
     */
    public function get_data_transaction_list_by_date($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $accounts = $this->accounting_model->get_accounts();

        $account_name = [];
        $account_type = [];

        foreach ($accounts as $key => $value) {
            $account_name[$value['id']] = $value['name'];
            $account_type[$value['id']] = $value['account_type_id'];
        }


        $data_report = [];
        
        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
        $this->db->where('((debit > 0 and (rel_type != "expense" and rel_type != "transfer")) or (credit > 0 and (rel_type = "expense" or rel_type = "transfer")))');
        $this->db->order_by('date', 'asc');
        $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
        $balance = 0;
        $amount = 0;
        foreach ($account_history as $v) {
            $account_type_id = (isset($account_type[$v['account']]) ? $account_type[$v['account']] : '');
            if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                $am = $v['credit'] - $v['debit'];
            }else{
                $am = $v['debit'] - $v['credit'];
            }
            $data_report[] =   [
                            'date' => date('Y-m-d', strtotime($v['date'])),
                            'type' => _l($v['rel_type']),
                            'split' => $v['split'] != 0 ? (isset($account_name[$v['split']]) ? $account_name[$v['split']] : '') : '-Split-',
                            'name' => isset($account_name[$v['account']]) ? $account_name[$v['account']] : '',
                            'description' => $v['description'],
                            'customer' => $v['customer'],
                            'amount' => $am,
                            'debit' => $v['debit'],
                            'credit' => $v['credit'],
                        ];
        }
        
        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
    }

    /**
     * get data trial balance
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_trial_balance($data_filter){
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }
        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 1){
                $data_accounts['accounts_receivable'][] = $value;
            }
            if($value['account_type_id'] == 2){
                $data_accounts['current_assets'][] = $value;
            }
            if($value['account_type_id'] == 3){
                $data_accounts['cash_and_cash_equivalents'][] = $value;
            }
            if($value['account_type_id'] == 4){
                $data_accounts['fixed_assets'][] = $value;
            }
            if($value['account_type_id'] == 5){
                $data_accounts['non_current_assets'][] = $value;
            }
            if($value['account_type_id'] == 6){
                $data_accounts['accounts_payable'][] = $value;
            }
            if($value['account_type_id'] == 7){
                $data_accounts['credit_card'][] = $value;
            }
            if($value['account_type_id'] == 8){
                $data_accounts['current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 9){
                $data_accounts['non_current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 10){
                $data_accounts['owner_equity'][] = $value;
            }

            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($credits > $debits){
                        $credits = $credits - $debits;
                        $debits = 0;
                    }else{
                        $debits = $debits - $credits;
                        $credits = 0;
                    }
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    $child_account = $this->get_data_trial_balance_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $accounting_method, $acc_show_account_numbers);

                    $data_report[$data_key][] = ['name' => $name, 'debit' => $debits, 'credit' => $credits, 'child_account' => $child_account];
                }
            }
            $data_total[$data_key] = $total;
        }
        return ['data' => $data_report, 'total' => $data_total, 'from_date' => $from_date, 'to_date' => $to_date];
        
    }

    /**
     * import xlsx banking
     * @param  array $data
     * @return integer or boolean      
     */
    public function import_xlsx_banking($data){
        $data['datecreated'] = date('Y-m-d H:i:s');
        $data['addedfrom'] = get_staff_user_id();
        $data['date'] = str_replace('/', '-', $data['date']);
        $data['date'] = date("Y-m-d", strtotime($data['date']));
        $this->db->insert(db_prefix() . 'acc_transaction_bankings', $data);

        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            return $insert_id;
        }

        return false;
    }

    /**
     * get transaction banking
     * @param  string $id
     * @param  array  $where
     * @return array or object
     */
    public function get_transaction_banking($id = '', $where = [])
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);
            return $this->db->get(db_prefix() . 'acc_transaction_bankings')->row();
        }

        $this->db->where($where);
        $this->db->order_by('id', 'desc');
        return $this->db->get(db_prefix() . 'acc_transaction_bankings')->result_array();
    }
    /**
     * get journal entry
     * @param  integer $id 
     * @return object     
     */
    public function get_journal_entry($id){
        $this->db->where('id', $id);
        $journal_entrie = $this->db->get(db_prefix() . 'acc_journal_entries')->row();

        if($journal_entrie){
            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'journal_entry');
            $details = $this->db->get(db_prefix().'acc_account_history')->result_array();

            $data_details =[];
            foreach ($details as $key => $value) {
                $data_details[] = [
                    "account" => $value['account'],
                    "debit" => floatval($value['debit']),
                    "credit" => floatval($value['credit']),
                    "description" => $value['description']];
            }
            if(count($data_details) < 10){

            }
            $journal_entrie->details = $data_details;
        }

        return $journal_entrie;
    }

    /**
     * delete journal entry
     * @param integer $id
     * @return boolean
     */

    public function delete_journal_entry($id)
    {
        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'acc_journal_entries');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'journal_entry');
            $this->db->delete(db_prefix() . 'acc_account_history');

            return true;
        }
        return false;
    }

    /**
     * update journal entry
     * @param  array $data 
     * @param  integer $id 
     * @return boolean       
     */
    public function update_journal_entry($data, $id){
        $journal_entry = json_decode($data['journal_entry']);
        unset($data['journal_entry']);

        $data['journal_date'] = to_sql_date($data['journal_date']);
        if(get_option('acc_close_the_books') == 1){
            if(strtotime($data['journal_date']) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                return 'close_the_book';
            }
        }

        $this->db->where('id', $id);
        $this->db->update(db_prefix().'acc_journal_entries', $data);

        $this->db->where('rel_id', $id);
        $this->db->where('rel_type', 'journal_entry');
        $this->db->delete(db_prefix() . 'acc_account_history');

        $data_insert = [];

        foreach ($journal_entry as $key => $value) {
            if($value[0] != ''){
                $node = [];
                $node['account'] = $value[0];
                $node['debit'] = $value[1];
                $node['credit'] = $value[2];
                $node['date'] = $data['journal_date'];
                $node['description'] = $value[3];
                $node['rel_id'] = $id;
                $node['rel_type'] = 'journal_entry';
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();

                $data_insert[] = $node;
            }
        }
        
        $this->db->insert_batch(db_prefix().'acc_account_history', $data_insert);

        return true;
    }

    /**
     * check format date Y-m-d
     *
     * @param      String   $date   The date
     *
     * @return     boolean
     */
    public function check_format_date($date)
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get transfer
     * @param  integer $id 
     * @return object    
     */
    public function get_transfer($id){
        $this->db->where('id', $id);
        return $this->db->get(db_prefix() . 'acc_transfers')->row();
    }

    /**
     * update transfer
     * @param array $data
     * @param  integer $id 
     * @return boolean
     */
    public function update_transfer($data, $id){
        if(isset($data['id'])){
            unset($data['id']);
        }
        $data['date'] = to_sql_date($data['date']);

        if(get_option('acc_close_the_books') == 1){
            if(strtotime($data['date']) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                return 'close_the_book';
            }
        }

        $data['transfer_amount'] = str_replace(',', '', $data['transfer_amount']);

        $this->db->where('id', $id);
        $this->db->update(db_prefix().'acc_transfers', $data);
        
        $this->db->where('rel_id', $id);
        $this->db->where('rel_type', 'transfer');
        $this->db->delete(db_prefix() . 'acc_account_history');

        $node = [];
        $node['account'] = $data['transfer_funds_from'];
        $node['debit'] = 0;
        $node['credit'] = $data['transfer_amount'];
        $node['date'] = $data['date'];
        $node['rel_id'] = $id;
        $node['rel_type'] = 'transfer';
        $node['datecreated'] = date('Y-m-d H:i:s');
        $node['addedfrom'] = get_staff_user_id();

        $this->db->insert(db_prefix().'acc_account_history', $node);

        $node = [];
        $node['account'] = $data['transfer_funds_to'];
        $node['debit'] = $data['transfer_amount'];
        $node['credit'] = 0;
        $node['date'] = $data['date'];
        $node['rel_id'] = $id;
        $node['rel_type'] = 'transfer';
        $node['datecreated'] = date('Y-m-d H:i:s');
        $node['addedfrom'] = get_staff_user_id();

        $this->db->insert(db_prefix().'acc_account_history', $node);

        return true;
    }

    /**
     * delete transfer
     * @param integer $id
     * @return boolean
     */

    public function delete_transfer($id)
    {
        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'acc_transfers');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'transfer');
            $this->db->delete(db_prefix() . 'acc_account_history');

            return true;
        }
        return false;
    }

    /**
     * delete account
     * @param integer $id
     * @return boolean
     */

    public function delete_account($id)
    {
        $this->db->where('(account = '. $id .' or split = '. $id.')');
        $count = $this->db->count_all_results(db_prefix() . 'acc_account_history');

        if($count > 0){
            return 'have_transaction';
        }

        $this->db->where('id', $id);
        $this->db->where('default_account', 0);
        $this->db->delete(db_prefix() . 'acc_accounts');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('account', $id);
            $this->db->delete(db_prefix() . 'acc_account_history');

            return true;
        }
        return false;
    }

    /**
     * delete convert
     * @param integer $id
     * @return boolean
     */
    public function delete_convert($id, $type)
    {
        if($type == 'opening_stock'){
            $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

            $date_financial_year = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.date('Y')));

            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', $type);
            $this->db->where('date >= "'.$date_financial_year.'"');
            $this->db->delete(db_prefix() . 'acc_account_history');
        }else{
            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', $type);
            $this->db->delete(db_prefix() . 'acc_account_history');
        }
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }
    
    /**
     * Gets the invoice without commission.
     * 
     * @param      bool        $old_invoice 
     * 
     * @return     array  The invoice without commission.
     */
    public function get_data_invoices_for_select($where = []){
        $this->db->where($where);
        $invoices = $this->db->get(db_prefix() . 'invoices')->result_array();

        $invoice_return = [];

        foreach ($invoices as $key => $value) {
            $payments_amount = sum_from_table(db_prefix() . 'invoicepaymentrecords', array('field' => 'amount', 'where' => array('invoiceid' => $value['id'])));

            if($payments_amount > 0){
                $node = [];
                $node['id'] = $value['id'];
                $node['name'] = format_invoice_number($value['id']);
                $invoice_return[] = $node;
            }
        }

        return $invoice_return;
    }

    /**
     * get reconcile by account
     * @param  integer $account 
     * @return object or boolean          
     */
    public function get_reconcile_by_account($account){
        $this->db->where('account', $account);
        $this->db->order_by('id', 'desc');
        $reconcile = $this->db->get(db_prefix() . 'acc_reconciles')->row();

        if($reconcile){
            return $reconcile;
        }

        return false;
    }

    /**
     * add reconcile
     * @param array $data 
     * @return  integer or boolean
     */
    public function add_reconcile($data){
        if($data['ending_date'] != ''){
            $data['ending_date'] = to_sql_date($data['ending_date']);
        }

        if($data['income_date'] != ''){
            $data['income_date'] = to_sql_date($data['income_date']);
        }

        if($data['expense_date'] != ''){
            $data['expense_date'] = to_sql_date($data['expense_date']);
        }

        $data['service_charge'] = str_replace(',', '', $data['service_charge']);
        $data['interest_earned'] = str_replace(',', '', $data['interest_earned']);
        $data['ending_balance'] = str_replace(',', '', $data['ending_balance']);
        $data['beginning_balance'] = str_replace(',', '', $data['beginning_balance']);
        
        $this->db->insert(db_prefix().'acc_reconciles', $data);
        $insert_id = $this->db->insert_id();
        
        if($insert_id){
            if($data['service_charge'] > 0){
                $node = [];
                $node['split'] = $data['account'];
                $node['reconcile'] = $insert_id;
                $node['account'] = $data['expense_account'];
                $node['debit'] = $data['service_charge'];
                $node['credit'] = 0;
                $node['rel_id'] = 0;
                $node['rel_type'] = 'cheque_expense';
                $node['description'] = _l('service_charge');
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();

                $this->db->insert(db_prefix().'acc_account_history', $node);

                $node = [];
                $node['split'] = $data['expense_account'];
                $node['reconcile'] = $insert_id;
                $node['account'] = $data['account'];
                
                $node['debit'] = 0;
                $node['credit'] = $data['service_charge'];
                $node['rel_id'] = 0;
                $node['rel_type'] = 'cheque_expense';
                $node['description'] = _l('service_charge');
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();

                $this->db->insert(db_prefix().'acc_account_history', $node);
            }
            if($data['interest_earned'] > 0){
                $node = [];
                $node['split'] = $data['account'];
                $node['reconcile'] = $insert_id;
                $node['account'] = $data['income_account'];
                $node['debit'] = 0;
                $node['credit'] = $data['interest_earned'];
                $node['rel_id'] = 0;
                $node['rel_type'] = 'deposit';
                $node['description'] = _l('interest_earned');
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();

                $this->db->insert(db_prefix().'acc_account_history', $node);

                $node = [];
                $node['split'] = $data['income_account'];
                $node['reconcile'] = $insert_id;
                $node['account'] = $data['account'];
                $node['debit'] = $data['interest_earned'];
                $node['credit'] = 0;
                $node['rel_id'] = 0;
                $node['rel_type'] = 'deposit';
                $node['description'] = _l('interest_earned');
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();

                $this->db->insert(db_prefix().'acc_account_history', $node);
            }

            return $insert_id;
        }

        return false;
    }

    /**
     * update reconcile
     * @param array $data 
     * @param integer $id 
     * @return  boolean
     */
    public function update_reconcile($data, $id){
        if($data['ending_date'] != ''){
            $data['ending_date'] = to_sql_date($data['ending_date']);
        }

        if($data['income_date'] != ''){
            $data['income_date'] = to_sql_date($data['income_date']);
        }

        if($data['expense_date'] != ''){
            $data['expense_date'] = to_sql_date($data['expense_date']);
        }

        $account = 0;
        if(isset($data['expense_date'])){
            $account = $data['account'];
            unset($data['account']);
        }

        $data['service_charge'] = str_replace(',', '', $data['service_charge']);
        $data['interest_earned'] = str_replace(',', '', $data['interest_earned']);
        $data['ending_balance'] = str_replace(',', '', $data['ending_balance']);
        $data['beginning_balance'] = str_replace(',', '', $data['beginning_balance']);

        $this->db->where('id', $id);
        $this->db->update(db_prefix().'acc_reconciles', $data);
        
        if ($this->db->affected_rows() > 0) {
            $this->db->where('rel_id', 0);
            $this->db->where('rel_type', 'cheque_expense');
            $this->db->where('reconcile', $id);
            $this->db->delete(db_prefix().'acc_account_history');

            $this->db->where('rel_id', 0);
            $this->db->where('rel_type', 'deposit');
            $this->db->where('reconcile', $id);
            $this->db->delete(db_prefix().'acc_account_history');

            if($data['service_charge'] > 0){
                $node = [];
                $node['split'] = $account;
                $node['reconcile'] = 0;
                $node['account'] = $data['expense_account'];
                $node['debit'] = $data['service_charge'];
                $node['credit'] = 0;
                $node['rel_id'] = 0;
                $node['rel_type'] = 'cheque_expense';
                $node['description'] = _l('service_charge');
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();

                $this->db->insert(db_prefix().'acc_account_history', $node);

                $node = [];
                $node['split'] = $data['expense_account'];
                $node['reconcile'] = $id;
                $node['account'] = $account;
                $node['debit'] = 0;
                $node['credit'] = $data['service_charge'];
                $node['rel_id'] = 0;
                $node['rel_type'] = 'cheque_expense';
                $node['description'] = _l('service_charge');
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();

                $this->db->insert(db_prefix().'acc_account_history', $node);
            }
            if($data['interest_earned'] > 0){
                $node = [];
                $node['split'] = $account;
                $node['reconcile'] = 0;
                $node['account'] = $data['income_account'];
                $node['debit'] = 0;
                $node['credit'] = $data['interest_earned'];
                $node['rel_id'] = 0;
                $node['rel_type'] = 'deposit';
                $node['description'] = _l('interest_earned');
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();

                $this->db->insert(db_prefix().'acc_account_history', $node);

                $node = [];
                $node['split'] = $data['income_account'];
                $node['reconcile'] = $id;
                $node['account'] = $account;
                $node['debit'] = $data['interest_earned'];
                $node['credit'] = 0;
                $node['rel_id'] = 0;
                $node['rel_type'] = 'deposit';
                $node['description'] = _l('interest_earned');
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();

                $this->db->insert(db_prefix().'acc_account_history', $node);
            }

            return true;
        }

        return false;
    }

    /**
     * add adjustment
     * @param array $data 
     * @return  integer or boolean
     */
    public function add_adjustment($data){
        $this->db->where('account_type_id', 15);
        $this->db->where('account_detail_type_id', 139);
        $account = $this->db->get(db_prefix().'acc_accounts')->row();
        $data['adjustment_date'] = to_sql_date($data['adjustment_date']);

        if(get_option('acc_close_the_books') == 1){
            if(strtotime($data['adjustment_date']) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                return 'close_the_book';
            }
        }
        if($account){
            $data['adjustment_amount'] = str_replace(',', '', $data['adjustment_amount']);

            $node = [];

            $node['account'] = $account->id;
            if($data['adjustment_amount'] > 0){
                $node['rel_id'] = 0;
                $node['rel_type'] = 'deposit';
                $node['debit'] = $data['adjustment_amount'];
                $node['credit'] = 0;
            }else{
                $node['rel_id'] = 0;
                $node['rel_type'] = 'cheque_expense';
                $node['debit'] = 0;
                $node['credit'] = $data['adjustment_amount'];
            }
            $node['split'] = $data['account'];
            $node['reconcile'] = $data['reconcile'];
            $node['description'] = _l('reconcile_adjustment');
            $node['datecreated'] = date('Y-m-d H:i:s');
            $node['date'] = $data['adjustment_date'];
            $node['addedfrom'] = get_staff_user_id();

            $this->db->insert(db_prefix().'acc_account_history', $node);

            $node = [];
            $node['account'] = $data['account'];
            if($data['adjustment_amount'] > 0){
                $node['rel_id'] = 0;
                $node['rel_type'] = 'deposit';
                $node['debit'] = 0;
                $node['credit'] = $data['adjustment_amount'];
            }else{
                $node['rel_id'] = 0;
                $node['rel_type'] = 'cheque_expense';
                $node['debit'] = $data['adjustment_amount'];
                $node['credit'] = 0;
            }

            $node['split'] = $account->id;
            $node['reconcile'] = $data['reconcile'];
            $node['description'] = _l('reconcile_adjustment');
            $node['datecreated'] = date('Y-m-d H:i:s');
            $node['date'] = $data['adjustment_date'];
            $node['addedfrom'] = get_staff_user_id();

            $this->db->insert(db_prefix().'acc_account_history', $node);

            $insert_id = $this->db->insert_id();
            if ($insert_id) {
                return $insert_id;
            }
        }else{
            $this->db->insert(db_prefix().'acc_accounts', [
                'name' => '',
                'key_name' => 'acc_reconciliation_discrepancies',
                'account_type_id' => 15,
                'account_detail_type_id' => 139,
            ]);

            $account_id = $this->db->insert_id();

            if ($account_id) {
                $node = [];
                $node['split'] = $data['account'];
                $node['account'] = $account_id;
                if($data['adjustment_amount'] > 0){
                    $node['rel_id'] = $id;
                    $node['rel_type'] = 'deposit';
                    $node['debit'] = $data['adjustment_amount'];
                    $node['credit'] = 0;
                }else{
                    $node['rel_id'] = $id;
                    $node['rel_type'] = 'cheque_expense';
                    $node['debit'] = 0;
                    $node['credit'] = $data['adjustment_amount'];
                }

                $node['reconcile'] = $data['reconcile'];
                $node['description'] = _l('reconcile_adjustment');
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['date'] = $data['adjustment_date'];
                $node['addedfrom'] = get_staff_user_id();

                $this->db->insert(db_prefix().'acc_account_history', $node);

                $node = [];
                $node['account'] = $data['account'];
                if($data['adjustment_amount'] > 0){
                    $node['rel_id'] = 0;
                    $node['rel_type'] = 'deposit';
                    $node['debit'] = 0;
                    $node['credit'] = $data['adjustment_amount'];
                }else{
                    $node['rel_id'] = 0;
                    $node['rel_type'] = 'cheque_expense';
                    $node['debit'] = $data['adjustment_amount'];
                    $node['credit'] = 0;
                }

                $node['split'] = $account_id;
                $node['reconcile'] = $data['reconcile'];
                $node['description'] = _l('reconcile_adjustment');
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['date'] = $data['adjustment_date'];
                $node['addedfrom'] = get_staff_user_id();

                $this->db->insert(db_prefix().'acc_account_history', $node);

                $insert_id = $this->db->insert_id();

                if ($insert_id) {
                    return $insert_id;
                }
            }
        }

        return false;
    }

    /**
     * finish reconcile account
     * @param  array $data 
     * @return boolean       
     */
    public function finish_reconcile_account($data){
        $affectedRows = 0;

        if($data['history_ids'] != ''){
            $history_ids = explode(', ', $data['history_ids']);

            foreach ($history_ids as $key => $value) {
                $this->db->where('id', $value);
                $this->db->update(db_prefix().'acc_account_history', ['reconcile' => $data['reconcile']]);

                if ($this->db->affected_rows() > 0) {
                    $affectedRows++;
                }
            }
        }

        if($data['finish'] == 1){
            $this->db->where('id', $data['reconcile']);
            $this->db->update(db_prefix().'acc_reconciles', ['finish' => 1]);

            if ($this->db->affected_rows() > 0) {
                $affectedRows++;
            }

        }

        if ($affectedRows > 0) {
            return true;
        }

        return true;
    }



    /**
     * reconcile save for later
     * @param  array $data 
     * @return boolean       
     */
    
    public function reconcile_save_for_later($data){
        $affectedRows = 0;
        if($data['history_ids'] != ''){
            $history_ids = explode(', ', $data['history_ids']);

            foreach ($history_ids as $key => $value) {
                $this->db->where('id', $value);
                $this->db->update(db_prefix().'acc_account_history', ['reconcile' => $data['reconcile']]);

                if ($this->db->affected_rows() > 0) {
                    $affectedRows++;
                }
            }
        }

        if ($affectedRows > 0) {
            return true;
        }
        return true;
    }

    /**
     * get data bank accounts dashboard
     * @param  array $data_filter 
     * @return array 
     */
    public function get_data_bank_accounts_dashboard($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $where = $this->get_where_report_period();

        $account_type_details = $this->get_account_type_details();
        $data_return = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 3){
                $data_accounts['cash_and_cash_equivalents'][] = $value;
            }
            if($value['account_type_id'] == 7){
                $data_accounts['credit_card'][] = $value;
            }
        }
        $html = '<ul class="list-group">
            <li class="list-group-item bold">'. _l('bank_accounts_uppercase').'<span class="badge">'. _l('balance').'</span></li>';
        foreach ($data_accounts as $data_key => $data_account) {
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($where != ''){
                        $this->db->where($where);
                    }
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    if($value['account_type_id'] == 10 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 7){
                        $html .= '<li class="list-group-item">'.$name.'<span class="badge">'.app_format_money($credits - $debits, $currency->name).'</span></li>';
                    }else{
                        $html .= '<li class="list-group-item">'.$name.'<span class="badge">'.app_format_money($debits - $credits, $currency->name).'</span></li>';
                    }

                    $data_return[] = ['name' => $name, 'balance' => $debits - $credits];
                }
            }
        }
        $html .= '</ul>';
        
        return $html;
    }

    /**
     * get data convert status dashboard
     * @param  array $data_filter 
     * @return array 
     */
    public function get_data_convert_status_dashboard($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $where = $this->get_where_report_period();

        $data_currency = $currency->id;
        if($this->input->get('currency')){
            $data_currency = $this->input->get('currency');
            $currency = $this->currencies_model->get($data_currency);
        }

        $this->db->select_sum('total');
        if($where != ''){
            $this->db->where($where);
        }
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_account_history where ' . db_prefix() . 'acc_account_history.rel_id = ' . db_prefix() . 'invoices.id and ' . db_prefix() . 'acc_account_history.rel_type = "invoice") = 0) and currency = '.$data_currency);
        $invoice = $this->db->get(db_prefix().'invoices')->row();

        $this->db->select_sum('amount');
        if($where != ''){
            $this->db->where($where);
        }
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_account_history where ' . db_prefix() . 'acc_account_history.rel_id = ' . db_prefix() . 'expenses.id and ' . db_prefix() . 'acc_account_history.rel_type = "expense") = 0) and currency = '.$data_currency);
        $expense = $this->db->get(db_prefix().'expenses')->row();

        $where_payment = $this->get_where_report_period(db_prefix() . 'invoicepaymentrecords.date');
        $this->db->select_sum('amount');
        if($where_payment != ''){
            $this->db->where($where_payment);
        }
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_account_history where ' . db_prefix() . 'acc_account_history.rel_id = ' . db_prefix() . 'invoicepaymentrecords.id and ' . db_prefix() . 'acc_account_history.rel_type = "payment") = 0) and currency = '.$data_currency);
        $this->db->join(db_prefix() . 'invoices', db_prefix() . 'invoices.id=' . db_prefix() . 'invoicepaymentrecords.invoiceid', 'left');
        $payment = $this->db->get(db_prefix().'invoicepaymentrecords')->row();


        $html = '<table class="table border table-striped no-margin">
                      <tbody>
                        <tr class="project-overview">
                            <td colspan="3" class="text-center"><h4>'. _l('transaction_not_yet_converted').'</h4></td>
                        </tr>
                        <tr class="project-overview">
                            <td class="bold" width="30%">'. _l('transaction').'</td>
                            <td class="bold" width="30%">'. _l('invoice_table_quantity_heading').'</td>
                            <td class="bold">'. _l('acc_amount').'</td>
                        </tr>
                        <tr class="project-overview '. ($invoice->total > 0 ? 'text-danger' : '').'">
                            <td class="bold" width="30%"><a href="'.admin_url('accounting/transaction?group=sales&tab=invoice&status=has_not_been_converted').'">'. _l('invoice').'</a></td>
                            <td width="30%">'. $this->count_invoice_not_convert_yet($data_currency, $where) .'</td>
                            <td>'. app_format_money($invoice->total, $currency->name)  .'</td>
                        </tr>
                        <tr class="project-overview '. ($payment->amount > 0 ? 'text-danger' : '').'">
                            <td class="bold" width="30%"><a href="'.admin_url('accounting/transaction?group=sales&tab=payment&status=has_not_been_converted').'">'. _l('payment').'</a></td>
                            <td width="30%">'. $this->count_payment_not_convert_yet($data_currency, $where_payment)  .'</td>
                            <td>'. app_format_money($payment->amount, $currency->name)  .'</td>
                         </tr>
                         <tr class="project-overview '. ($expense->amount > 0 ? 'text-danger' : '').'">
                            <td class="bold" width="30%"><a href="'.admin_url('accounting/transaction?group=expenses&status=has_not_been_converted').'">'. _l('expense').'</a></td>
                            <td width="30%">'. $this->count_expense_not_convert_yet($data_currency, $where)  .'</td>
                            <td>'. app_format_money($expense->amount, $currency->name)  .'</td>
                         </tr>
                        </tbody>
                  </table>';
        return $html;
    }

    /**
     * get data profit and loss chart
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_profit_and_loss_chart(){
        $accounting_method = get_option('acc_accounting_method');

        $where = $this->get_where_report_period();
        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }
        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    if($where != ''){
                        $this->db->where($where);
                    }
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;

                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                        $total += $credits - $debits;
                    }else{
                        $total += $debits - $credits;
                    }
                }
            }
            $data_total[$data_key] = $total;
        }

        $income = $data_total['income'] + $data_total['other_income'];
        $expenses = $data_total['expenses'] + $data_total['other_expenses'] + $data_total['cost_of_sales'];
        $net_income = $income - $expenses;

        return [$net_income, $income, $expenses];
    }

    /**
     * get data expenses chart
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_expenses_chart($data_filter){
        $where = $this->get_where_report_period();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }
        $total = 0;

        if($where != ''){
            $this->db->select('*, (SELECT (sum(debit) - sum(credit)) as balance FROM '.db_prefix().'acc_account_history where account = '.db_prefix().'acc_accounts.id and '.$where.') as amount');
        }else{
            $this->db->select('*, (SELECT (sum(debit) - sum(credit)) as balance FROM '.db_prefix().'acc_account_history where account = '.db_prefix().'acc_accounts.id) as amount');
        }

        $this->db->where('(account_type_id = 13 or account_type_id = 14 or account_type_id = 15)');
        $this->db->where('active', 1);

        $this->db->order_by('amount', 'desc');
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        foreach ($accounts as $k => $val) {
            if($k > 2){
                $total += $val['amount'];
            }else{
                if($acc_show_account_numbers == 1 && $val['number'] != ''){
                            $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                        }else{
                            $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                        }

                if($val['amount'] < 0){
                    $data_return[] = ['name' => $name, 'y' => floatval(-$val['amount']), 'amount' => ''.floatval($val['amount'])];
                }else{
                    $data_return[] = ['name' => $name, 'y' => floatval($val['amount']), 'amount' => ''.floatval($val['amount'])];
                }
            }
        }
        if($total < 0){
            $data_return[] = ['name' => _l('everything_else'), 'y' => floatval(-$total), 'amount' => ''.$total];
        }else{
            $data_return[] = ['name' => _l('everything_else'), 'y' => floatval($total), 'amount' => ''.$total];
        }
        return $data_return;
    }

    /**
     * get data income chart
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_income_chart($data_filter){
        $accounting_method = get_option('acc_accounting_method');
        $where = $this->get_where_report_period('date');

        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        if(isset($data_filter['currency'])){
            $data_currency = $data_filter['currency'];
        }else{
            $data_currency = $currency->id;
        }

        $last_30_days = date('Y-m-d', strtotime('today - 30 days'));

        if($where != ''){
            $this->db->where($where);
        }
        $this->db->select('*, (SELECT sum(amount) as amount FROM '.db_prefix().'invoicepaymentrecords where invoiceid = '.db_prefix().'invoices.id and date >= "'.$last_30_days.'") as amount');
        $this->db->where('currency', $data_currency);
        $invoices = $this->db->get(db_prefix().'invoices')->result_array();
        $mapped = 0;
        $open_invoice = 0;
        $overdue_invoices = 0;
        $paid_last_30_days = 0;
        $list_invoice = '0';

        foreach ($invoices as $key => $value) {
            $list_invoice .= ','.$value['id'];

            $this->db->select('sum(credit) as credit');
            $this->db->where('rel_id', $value['id']);
            $this->db->where('rel_type', 'invoice');
            $this->db->where('tax < 1');
            $this->db->where('paid', 1);
            $count = $this->db->get(db_prefix().'acc_account_history')->row();
            if(isset($count->credit) && $count->credit > 0){
                $mapped += $count->credit;
            }else{
                if($value['status'] == 1){
                    $open_invoice += $value['subtotal'];
                }elseif ($value['status'] == 2 && $value['amount'] > 0) {
                    $paid_last_30_days += $value['subtotal'];
                }elseif ($value['status'] == 4) {
                    $overdue_invoices += $value['subtotal'];
                }
            }
        }

        $data_return = [];
        $data_return[] = ['name' => _l('open_invoice'), 'data' => [floatval($open_invoice)]];
        $data_return[] = ['name' => _l('overdue_invoices'), 'data' => [floatval($overdue_invoices)]];
        $data_return[] = ['name' => _l('paid_last_30_days'), 'data' => [floatval($paid_last_30_days)]];

        $where = $this->get_where_report_period();
        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_total = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->where('account', $val['id']);
                    if($where != ''){
                        $this->db->where($where);
                    }
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    if($currency->id != $data_currency){
                        $this->db->where('1=0');
                    }
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    if($where != ''){
                        $this->db->where($where);
                    }
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;

                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                        $total += $credits - $debits;
                    }else{
                        $total += $debits - $credits;
                    }
                }
            }
            $data_total[$data_key] = $total;
        }

        $income = $data_total['income'] + $data_total['other_income'];
        $data_return[] = ['name' => _l('has_been_mapping'), 'data' => [floatval($data_total['income'] + $data_total['other_income'])]];
        return $data_return;
    }

    /**
     * get data sales chart
     * @param  array $data_filter
     * @return array
     */
    public function get_data_sales_chart($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        if(isset($data_filter['currency'])){
            $data_currency = $data_filter['currency'];
        }else{
            $data_currency = $currency->id;
        }


        $where = $this->get_where_report_period('date');

        if($where != ''){
            $this->db->where($where);
        }

        $this->db->where('currency', $data_currency);
        $invoices = $this->db->get(db_prefix().'invoices')->result_array();

        if($where != ''){
            $this->db->where($where);
        }
        $this->db->where('currency', $data_currency);
        $expenses = $this->db->get(db_prefix().'expenses')->result_array();

        $data_return = [];
        $data_date = [];

        $list_invoice = '0';
        foreach ($invoices as $key => $value) {
            $list_invoice .= ','.$value['id'];
            $this->db->where('rel_id', $value['id']);
            $this->db->where('rel_type', 'invoice');
            $this->db->where('paid', 1);
            $count = $this->db->count_all_results(db_prefix().'acc_account_history');

            if($count == 0){
                if(isset($data_date[$value['date']])){
                    $data_date[$value['date']]['payment'] += floatval($value['subtotal']);
                }else{
                    $data_date[$value['date']] = [];
                    $data_date[$value['date']]['payment'] = floatval($value['subtotal']);
                    $data_date[$value['date']]['expense'] = 0;
                    $data_date[$value['date']]['invoice_have_been_mapping'] = 0;
                    $data_date[$value['date']]['expense_have_been_mapping'] = 0;
                }
            }
        }

        $list_expense = '0';

        foreach ($expenses as $key => $value) {
            $list_expense .= ','.$value['id'];

            $this->db->where('rel_id', $value['id']);
            $this->db->where('rel_type', 'expense');
            $count = $this->db->count_all_results(db_prefix().'acc_account_history');
            if($count == 0){
                if(isset($data_date[$value['date']])){
                    $data_date[$value['date']]['expense'] += floatval($value['amount']);
                }else{
                    $data_date[$value['date']] = [];
                    $data_date[$value['date']]['expense'] = floatval($value['amount']);
                    $data_date[$value['date']]['payment'] = 0;
                    $data_date[$value['date']]['invoice_have_been_mapping'] = 0;
                    $data_date[$value['date']]['expense_have_been_mapping'] = 0;
                }
            }
        }

        $account_type_details = $this->get_account_type_details();

        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->where('account', $val['id']);
                    $this->db->select('credit, debit, date, datecreated');
                    if($currency->id != $data_currency){
                        $this->db->where('1=0');
                    }
                    if($where != ''){
                        $this->db->where($where);
                    }
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();

                    foreach ($account_history as $val) {
                        $credits = $val['credit'] != '' ? $val['credit'] : 0;
                        $debits = $val['debit'] != '' ? $val['debit'] : 0;
                        $date = $val['date'] != '' ? $val['date'] : date('Y-m-d', strtotime($val['datecreated']));

                        if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                            $total = $credits - $debits;
                            if(isset($data_date[$date])){
                                $data_date[$date]['invoice_have_been_mapping'] += floatval($total);

                            }else{
                                $data_date[$date] = [];
                                $data_date[$date]['invoice_have_been_mapping'] = floatval($total);
                                $data_date[$date]['expense_have_been_mapping'] = 0;
                                $data_date[$date]['payment'] = 0;
                                $data_date[$date]['expense'] = 0;
                            }
                        }else{
                            $total = $debits - $credits;
                            if(isset($data_date[$date])){
                                $data_date[$date]['expense_have_been_mapping'] += floatval($total);
                            }else{
                                $data_date[$date] = [];
                                $data_date[$date]['expense_have_been_mapping'] = floatval($total);
                                $data_date[$date]['invoice_have_been_mapping'] = 0;
                                $data_date[$date]['payment'] = 0;
                                $data_date[$date]['expense'] = 0;
                            }
                        }
                    }

                }
            }
        }

        $sales = [];
        $invoice_have_been_mapping = [];
        $expense_have_been_mapping = [];
        $expenses = [];
        $categories = [];
        $date_array = [];

        foreach ($data_date as $d => $val) {
            $_date = $d;
            foreach ($data_date as $date => $value) {
                if(strtotime($_date) > (strtotime($date)) && !in_array($date,$date_array)){
                    $_date = $date;
                }elseif(!in_array($date,$date_array) && in_array($_date,$date_array)){
                    $_date = $date;
                }
            }

            $date_array[] = $_date;

        }

        foreach ($date_array as $date) {
            if(isset($data_date[$date])){
                $sales[] = $data_date[$date]['payment'];
                $expenses[] = $data_date[$date]['expense'];
                $invoice_have_been_mapping[] = $data_date[$date]['invoice_have_been_mapping'];
                $expense_have_been_mapping[] = $data_date[$date]['expense_have_been_mapping'];
                $categories[] = _d($date);
            }
        }

        $data_return = [
            'data' => [
                ['name' => _l('sales'), 'data' => $sales],
                ['name' => _l('sales_have_been_mapping'), 'data' => $invoice_have_been_mapping],
                ['name' => _l('expenses'), 'data' => $expenses],
                ['name' => _l('expenses_have_been_mapping'), 'data' => $expense_have_been_mapping],
            ],
            'categories' => $categories
        ];
        return $data_return;
    }

    /**
     * add rule
     * @param array $data 
     */
    public function add_rule($data){
        if(isset($data['type'])){
            $type = $data['type'];
            unset($data['type']);
        }

        if(isset($data['subtype'])){
            $subtype = $data['subtype'];
            unset($data['subtype']);
        }

        if(isset($data['text'])){
            $text = $data['text'];
            unset($data['text']);
        }

        if(isset($data['subtype_amount'])){
            $subtype_amount = $data['subtype_amount'];
            unset($data['subtype_amount']);
        }

        if(!isset($data['auto_add'])){
            $data['auto_add'] = 0;
        }

        $this->db->insert(db_prefix().'acc_banking_rules', $data);

        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            if(isset($type)){
                foreach ($type as $key => $value) {
                    $this->db->insert(db_prefix().'acc_banking_rule_details', [
                        'rule_id' => $insert_id,
                        'type' => $value,
                        'subtype' => $subtype[$key],
                        'subtype_amount' => $subtype_amount[$key],
                        'text' => $text[$key],
                    ]);
                }
            }

            return $insert_id;
        }

        return false;
    }

    /**
     * update rule
     * @param array $data 
     */
    public function update_rule($data, $id){
        $affectedRows = 0;

        if(isset($data['type'])){
            $type = $data['type'];
            unset($data['type']);
        }

        if(isset($data['subtype'])){
            $subtype = $data['subtype'];
            unset($data['subtype']);
        }

        if(isset($data['text'])){
            $text = $data['text'];
            unset($data['text']);
        }

        if(isset($data['subtype_amount'])){
            $subtype_amount = $data['subtype_amount'];
            unset($data['subtype_amount']);
        }

        $this->db->where('id', $id);
        $this->db->update(db_prefix().'acc_banking_rules', $data);

        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
        }

        $this->db->where('rule_id', $id);
        $this->db->delete(db_prefix() . 'acc_banking_rule_details');

        if(isset($type)){
            foreach ($type as $key => $value) {
                $this->db->insert(db_prefix().'acc_banking_rule_details', [
                    'rule_id' => $id,
                    'type' => $value,
                    'subtype_amount' => $subtype_amount[$key],
                    'subtype' => $subtype[$key],
                    'text' => $text[$key],
                ]);
            }
        }

        if ($affectedRows > 0) {
            return $insert_id;
        }

        return false;
    }

    /**
     * get rule
     * @param  integer $id 
     * @param  array $where 
     * @return object     
     */
    public function get_rule($id = '', $where = []){
        if($id != ''){
            $this->db->where('id', $id);
            $rule = $this->db->get(db_prefix() . 'acc_banking_rules')->row();

            if($rule){
                $this->db->where('rule_id', $id);
                $rule->details = $this->db->get(db_prefix() . 'acc_banking_rule_details')->result_array();
            }
            return $rule;
        }

        $this->db->where($where);
        $rule = $this->db->get(db_prefix() . 'acc_banking_rules')->result_array();
        if($rule){
            foreach ($rule as $key => $value) {
                $this->db->where('rule_id', $value['id']);
                $rule[$key]['details'] = $this->db->get(db_prefix() . 'acc_banking_rule_details')->result_array();
            }
        }
            
        return $rule;
    }

    /**
     * delete journal entry
     * @param integer $id
     * @return boolean
     */

    public function delete_rule($id)
    {
        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'acc_banking_rules');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('rule_id', $id);
            $this->db->delete(db_prefix() . 'acc_banking_rule_details');

            return true;
        }
        return false;
    }

    /**
     * insert batch banking
     * @param  array $data_insert 
     * @return boolean              
     */
    public function insert_batch_banking($data_insert){
        $rule = $this->get_rule();

        foreach ($data_insert as $value) {
            $value['date'] = str_replace('/', '-', $value['date']);
            $value['date'] = date('Y-m-d', strtotime($value['date']));
            $this->db->insert(db_prefix().'acc_transaction_bankings', $value);

            // $insert_id = $this->db->insert_id();

            // if (!$insert_id) {
            //     continue;
            // }

            // if(get_option('acc_close_the_books') == 1){
            //     if(strtotime($value['date']) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
            //         continue;
            //     }
            // }

            // $amount = $value['deposits'];
            // if($value['withdrawals'] > 0){
            //     $amount = $value['withdrawals'];
            // }
            // foreach ($rule as $val) {
            //     if($this->check_rule($val, $value)){
            //         if($val['then'] == 'exclude'){
            //             break;
            //         }elseif($val['auto_add'] == 0){
            //             continue;
            //         }

            //         $data = [];
            //         $node = [];
            //         $node['split'] = $val['payment_account'];
            //         $node['account'] = $val['deposit_to'];
            //         $node['debit'] = $amount;
            //         $node['date'] = $value['date'];
            //         $node['credit'] = 0;
            //         $node['description'] = _l('banking_rule');
            //         $node['rel_id'] = $insert_id;
            //         $node['rel_type'] = 'banking';
            //         $node['datecreated'] = date('Y-m-d H:i:s');
            //         $node['addedfrom'] = get_staff_user_id();
            //         $data[] = $node;

            //         $node = [];
            //         $node['split'] = $val['deposit_to'];
            //         $node['account'] = $val['payment_account'];
            //         $node['date'] = $value['date'];
            //         $node['debit'] = 0;
            //         $node['credit'] = $amount;
            //         $node['description'] = _l('banking_rule');
            //         $node['rel_id'] = $insert_id;
            //         $node['rel_type'] = 'banking';
            //         $node['datecreated'] = date('Y-m-d H:i:s');
            //         $node['addedfrom'] = get_staff_user_id();
            //         $data[] = $node;

            //         $affectedRows = $this->db->insert_batch(db_prefix().'acc_account_history', $data);


            //         break;
            //     }
            // }
        }

        return true;
    }

    /**
     * check rule
     * @param  array $rule 
     * @param  array $data 
     * @return boolean       
     */
    public function check_rule($rule, $data){
        $check = false;
        $amount = $data['deposits'];
        if($data['withdrawals'] > 0){
            $amount = $data['withdrawals'];
        }
        if(($rule['transaction'] == 'money_out' && $data['withdrawals'] > 0) || ($rule['transaction'] == 'money_in' && $data['deposits'] > 0)){
            if($rule['following'] == 'any'){
                foreach ($rule['details'] as $v) {
                    if ($v['type'] == 'amount') {
                        switch ($v['subtype_amount']) {
                            case 'does_not_equal':
                                if(floatval($v['text']) != $amount){
                                    return true;
                                }
                                break;
                            case 'equals':
                                if(floatval($v['text']) == $amount){
                                    return true;
                                }
                                break;
                            case 'is_greater_than':
                                if(floatval($v['text']) < $amount){
                                    return true;
                                }
                                break;
                            case 'is_loss_than':
                                if(floatval($v['text']) > $amount){
                                    return true;
                                }
                                break;
                            default:
                                break;
                        }
                    }elseif($v['type'] == 'description'){
                        switch ($v['subtype']) {
                            case 'contains':
                                if (str_contains($data['description'], $v['text'])) { 
                                    return true;
                                }
                                break;
                            case 'does_not_contain':
                                if (!str_contains($data['description'], $v['text'])) { 
                                    return true;
                                }
                                break;
                            case 'is_exactly':
                                if ($data['description'] == $v['text']) { 
                                    return true;
                                }
                                break;
                            default:
                                break;
                        }
                    }                      
                }
            }else{
                foreach ($rule['details'] as $v) {
                    if ($v['type'] == 'amount') {
                        switch ($v['subtype_amount']) {
                            case 'does_not_equal':
                                if(floatval($v['text']) == $amount){
                                    return false;
                                }
                                break;
                            case 'equals':
                                if(floatval($v['text']) != $amount){
                                    return false;
                                }
                                break;
                            case 'is_greater_than':
                                if(floatval($v['text']) > $amount){
                                    return false;
                                }
                                break;
                            case 'is_loss_than':
                                if(floatval($v['text']) < $amount){
                                    return false;
                                }
                                break;
                            default:
                                break;
                        }
                    }elseif($v['type'] == 'description'){
                        switch ($v['subtype']) {
                            case 'contains':
                                if (!str_contains($data['description'], $v['text'])) { 
                                    return false;
                                }
                                break;
                            case 'does_not_contain':
                                if (str_contains($data['description'], $v['text'])) { 
                                    return false;
                                }
                                break;
                            case 'is_exactly':
                                if ($data['description'] != $v['text']) { 
                                    return false;
                                }
                                break;
                            default:
                                break;
                        }
                    } 
                    $check = true;                     
                }

                return true;
            }
        }

        return $check;
    }

    /**
     * get data journal
     * @return array 
     */
    public function get_data_account_history($data_filter){
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');
        $account = 0;

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        if(isset($data_filter['account'])){
            $account = $data_filter['account'];
        }

        $info_account = $this->accounting_model->get_accounts($account);

        $accounts = $this->accounting_model->get_accounts();

        $account_name = [];

        foreach ($accounts as $key => $value) {
            $account_name[$value['id']] = $value['name'];
        }

        $data_report = [];
        
        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
        if($account != ''){
            $this->db->where('account', $account);
        }
        $this->db->order_by('date', 'asc');
        
        $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
        $balance = 0;
        $amount = 0;
        foreach ($account_history as $v) {
            $decrease = 0;
            $increase = 0;
            if($info_account->account_type_id == 7 || $info_account->account_type_id == 8){
                $increase = $v['credit'];
                $decrease = $v['debit'];
                $balance += ($v['credit'] - $v['debit']);
            }elseif($info_account->account_type_id == 1){
                $increase = $v['credit'];
                $decrease = $v['debit'];
                $balance += ($v['debit'] - $v['credit']);
            }else{
                $increase = $v['debit'];
                $decrease = $v['credit'];
                $balance += ($v['debit'] - $v['credit']);
            }
            $data_report[] =   [
                            'date' => date('Y-m-d', strtotime($v['date'])),
                            'split' => $v['split'] != 0 ? (isset($account_name[$v['split']]) ? $account_name[$v['split']] : '') : '-Split-',
                            'type' => _l($v['rel_type']),
                            'name' => (isset($account_name[$v['account']]) ? $account_name[$v['account']] : ''),
                            'description' => $v['description'],
                            'customer' => $v['customer'],
                            'decrease' => $decrease,
                            'increase' => $increase,
                            'balance' => $balance,
                        ];
        }
                
        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date, 'account_type' => $info_account->account_type_id];
    }

    /**
     * Gets the where report period.
     *
     * @param      string  $field  The field
     *
     * @return     string  The where report period.
     */
    private function get_where_report_period($field = 'date')
    {
        $months_report      = $this->input->get('date_filter');
        
        $custom_date_select = '';
        if ($months_report != '') {
            if (is_numeric($months_report)) {
                // Last month
                if ($months_report == '1') {
                    $beginMonth = date('Y-m-01', strtotime('first day of last month'));
                    $endMonth   = date('Y-m-t', strtotime('last day of last month'));
                } else {
                    $months_report = (int) $months_report;
                    $months_report--;
                    $beginMonth = date('Y-m-01', strtotime("-$months_report MONTH"));
                    $endMonth   = date('Y-m-t');
                }

                $custom_date_select = '(' . $field . ' BETWEEN "' . $beginMonth . '" AND "' . $endMonth . '")';
            } elseif ($months_report == 'last_30_days') {
                $custom_date_select = '(' . $field . ' BETWEEN "' . date('Y-m-d', strtotime('today - 30 days')) . '" AND "' . date('Y-m-d') . '")';
            } elseif ($months_report == 'this_month') {
                $custom_date_select = '(' . $field . ' BETWEEN "' . date('Y-m-01') . '" AND "' . date('Y-m-t') . '")';
            } elseif ($months_report == 'last_month') {
                $this_month = date('m') - 1;
                $custom_date_select = '(' . $field . ' BETWEEN "' . date("Y-m-d", strtotime("first day of previous month")) . '" AND "' . date("Y-m-d", strtotime("last day of previous month")) . '")';
            }elseif ($months_report == 'this_quarter') {
                $current_month = date('m');
                  $current_year = date('Y');
                  if($current_month>=1 && $current_month<=3)
                  {
                    $start_date = date('Y-m-d', strtotime('1-January-'.$current_year));  // timestamp or 1-Januray 12:00:00 AM
                    $end_date = date('Y-m-d', strtotime('1-April-'.$current_year));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                  }
                  else  if($current_month>=4 && $current_month<=6)
                  {
                    $start_date = date('Y-m-d', strtotime('1-April-'.$current_year));  // timestamp or 1-April 12:00:00 AM
                    $end_date = date('Y-m-d', strtotime('1-July-'.$current_year));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                  }
                  else  if($current_month>=7 && $current_month<=9)
                  {
                    $start_date = date('Y-m-d', strtotime('1-July-'.$current_year));  // timestamp or 1-July 12:00:00 AM
                    $end_date = date('Y-m-d', strtotime('1-October-'.$current_year));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                  }
                  else  if($current_month>=10 && $current_month<=12)
                  {
                    $start_date = date('Y-m-d', strtotime('1-October-'.$current_year));  // timestamp or 1-October 12:00:00 AM
                    $end_date = date('Y-m-d', strtotime('1-January-'.($current_year+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                  }
                $custom_date_select = '(' . $field . ' BETWEEN "' .
                $start_date .
                '" AND "' .
                $end_date . '")';

            }elseif ($months_report == 'last_quarter') {
                $current_month = date('m');
                    $current_year = date('Y');

                  if($current_month>=1 && $current_month<=3)
                  {
                    $start_date = date('Y-m-d', strtotime('1-October-'.($current_year-1)));  // timestamp or 1-October Last Year 12:00:00 AM
                    $end_date = date('Y-m-d', strtotime('1-January-'.$current_year));  // // timestamp or 1-January  12:00:00 AM means end of 31 December Last year
                  } 
                  else if($current_month>=4 && $current_month<=6)
                  {
                    $start_date = date('Y-m-d', strtotime('1-January-'.$current_year));  // timestamp or 1-Januray 12:00:00 AM
                    $end_date = date('Y-m-d', strtotime('1-April-'.$current_year));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                  }
                  else  if($current_month>=7 && $current_month<=9)
                  {
                    $start_date = date('Y-m-d', strtotime('1-April-'.$current_year));  // timestamp or 1-April 12:00:00 AM
                    $end_date = date('Y-m-d', strtotime('1-July-'.$current_year));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                  }
                  else  if($current_month>=10 && $current_month<=12)
                  {
                    $start_date = date('Y-m-d', strtotime('1-July-'.$current_year));  // timestamp or 1-July 12:00:00 AM
                    $end_date = date('Y-m-d', strtotime('1-October-'.$current_year));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                  }
                $custom_date_select = '(' . $field . ' BETWEEN "' .
                $start_date .
                '" AND "' .
                $end_date . '")';

            }elseif ($months_report == 'this_year') {
                $custom_date_select = '(' . $field . ' BETWEEN "' .
                date('Y-m-d', strtotime(date('Y-01-01'))) .
                '" AND "' .
                date('Y-m-d', strtotime(date('Y-12-31'))) . '")';
            } elseif ($months_report == 'last_year') {
                $custom_date_select = '(' . $field . ' BETWEEN "' .
                date('Y-m-d', strtotime(date(date('Y', strtotime('last year')) . '-01-01'))) .
                '" AND "' .
                date('Y-m-d', strtotime(date(date('Y', strtotime('last year')) . '-12-31'))) . '")';
            } elseif ($months_report == 'custom') {
                $from_date = to_sql_date($this->input->post('report_from'));
                $to_date   = to_sql_date($this->input->post('report_to'));
                if ($from_date == $to_date) {
                    $custom_date_select = '' . $field . ' = "' . $from_date . '"';
                } else {
                    $custom_date_select = '(' . $field . ' BETWEEN "' . $from_date . '" AND "' . $to_date . '")';
                }
            } elseif(!(strpos($months_report, 'financial_year') === false)){
                $year = explode('financial_year_', $months_report);

                $first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

                $month = date('m', strtotime($first_month_of_financial_year));
                $custom_date_select = '(' . $field . ' BETWEEN "' . date($year[1].'-'.$month.'-01') . '" AND "' . date(($year[1]+1).'-'.$month.'-01') . '")';
            }
        }

        return $custom_date_select;
    }

    /**
     * delete all data the accounting module
     *
     * @param      int   $id     The identifier
     *
     * @return     boolean
     */
    public function reset_data()
    {
        $affectedRows = 0;
        if ($this->db->table_exists(db_prefix() . 'acc_accounts')) {
            $this->db->query('DROP TABLE `'.db_prefix() .'acc_accounts`;');
            $this->db->query('CREATE TABLE ' . db_prefix() . "acc_accounts (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `name` VARCHAR(255) NOT NULL,
            `key_name` VARCHAR(255) NULL,
              `number` VARCHAR(45) NULL,
              `parent_account` INT(11) NULL,
              `account_type_id` INT(11) NOT NULL,
              `account_detail_type_id` INT(11) NOT NULL,
              `balance` DECIMAL(15,2) NULL,
              `balance_as_of` DATE NULL,
              `description` TEXT NULL,
              `default_account` INT(11) NOT NULL DEFAULT 0,
              `active` INT(11) NOT NULL DEFAULT 1,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=" . $this->db->char_set . ';');
            $this->add_default_account();
            $this->add_default_account_new();
            $affectedRows++;
        }

        update_option('acc_first_month_of_financial_year', 'January');
        update_option('acc_first_month_of_tax_year', 'same_as_financial_year');
        update_option('acc_accounting_method', 'accrual');
        update_option('acc_close_the_books', 0);
        update_option('acc_allow_changes_after_viewing', 'allow_changes_after_viewing_a_warning');
        update_option('acc_enable_account_numbers', 0);
        update_option('acc_show_account_numbers', 0);

        update_option('acc_add_default_account', 0);
        update_option('acc_add_default_account_new', 0);
        update_option('acc_invoice_automatic_conversion', 1);
        update_option('acc_payment_automatic_conversion', 1);
        update_option('acc_expense_automatic_conversion', 1);
        update_option('acc_tax_automatic_conversion', 1);

        update_option('acc_invoice_payment_account', 66);
        update_option('acc_invoice_deposit_to', 1);
        update_option('acc_payment_payment_account', 1);
        update_option('acc_payment_deposit_to', 13);
        update_option('acc_expense_payment_account', 13);
        update_option('acc_expense_deposit_to', 80);
        update_option('acc_tax_payment_account', 29);
        update_option('acc_tax_deposit_to', 1);

        $this->db->where('id > 0');
        $this->db->delete(db_prefix() . 'acc_account_history');
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
        }

        $this->db->where('id > 0');
        $this->db->delete(db_prefix() . 'acc_banking_rules');
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
        }
        $this->db->where('id > 0');
        $this->db->delete(db_prefix() . 'acc_banking_rule_details');
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
        }
        $this->db->where('id > 0');
        $this->db->delete(db_prefix() . 'acc_journal_entries');
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
        }
        $this->db->where('id > 0');
        $this->db->delete(db_prefix() . 'acc_reconciles');
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
        }
        $this->db->where('id > 0');
        $this->db->delete(db_prefix() . 'acc_transaction_bankings');
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
        }

        $this->db->where('id > 0');
        $this->db->delete(db_prefix() . 'acc_transfers');
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
        }

        $this->db->where('id > 0');
        $this->db->delete(db_prefix() . 'acc_item_automatics');
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
        }

        $this->db->where('id > 0');
        $this->db->delete(db_prefix() . 'acc_tax_mappings');
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
        }

        if ($affectedRows > 0) {
            return true;
        }
        return false;
    }

    /**
     * Change account status / active / inactive
     * @param  mixed $id     staff id
     * @param  mixed $status status(0/1)
     */
    public function change_account_status($id, $status)
    {
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'acc_accounts', [
            'active' => $status,
        ]);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Automatic invoice conversion
     * @param  integer $invoice_id 
     * @return boolean
     */
    public function automatic_invoice_conversion($invoice_id){
        if(get_option('acc_invoice_automatic_conversion') == 0){
            return false;
        }

        $this->delete_convert($invoice_id, 'invoice');

        $affectedRows = 0;

        $this->load->model('invoices_model');
        $invoice = $this->invoices_model->get($invoice_id);

        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        $currency_converter = 0;
        if($invoice->currency_name != $currency->name){
            $currency_converter = 1;
        }

        $payment_account = get_option('acc_invoice_payment_account');
        $deposit_to = get_option('acc_invoice_deposit_to');
        $tax_payment_account = get_option('acc_tax_payment_account');
        $tax_deposit_to = get_option('acc_tax_deposit_to');

        if($invoice){
            if(get_option('acc_close_the_books') == 1){
                if(strtotime($invoice->date) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                    return false;
                }
            }
            $paid = 0;
            if($invoice->status == 2){
                $paid = 1;
            }
            $data_insert = [];

            $items = get_items_table_data($invoice, 'invoice', 'html', true);

            foreach($items->taxes() as $tax){
                $t = explode('|', $tax['tax_name']);
                $tax_name = '';
                $tax_rate = 0;
                if(isset($t[0])){
                    $tax_name = $t[0];
                }
                if(isset($t[1])){
                    $tax_rate = $t[1];
                }

                $this->db->where('name', $tax_name);
                $this->db->where('taxrate', $tax_rate);
                $_tax = $this->db->get(db_prefix().'taxes')->row();

                $total_tax = $tax['total_tax'];
                if($currency_converter == 1){
                    $total_tax = round($this->currency_converter($invoice->currency_name, $currency->name, $tax['total_tax']), 2);
                }

                if($_tax){
                    $tax_mapping = $this->get_tax_mapping($_tax->id);
                    if($tax_mapping){
                        $node = [];
                        $node['itemable_id'] = 0;
                        $node['split'] = $tax_mapping->payment_account;
                        $node['account'] = $tax_mapping->deposit_to;
                        $node['tax'] = $_tax->id;
                        $node['item'] = 0;
                        $node['paid'] = $paid;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['customer'] = $invoice->clientid;
                        $node['date'] = $invoice->date;
                        $node['description'] = '';
                        $node['rel_id'] = $invoice_id;
                        $node['rel_type'] = 'invoice';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['itemable_id'] = 0;
                        $node['split'] = $tax_mapping->deposit_to;
                        $node['customer'] = $invoice->clientid;
                        $node['account'] = $tax_mapping->payment_account;
                        $node['tax'] = $_tax->id;
                        $node['item'] = 0;
                        $node['paid'] = $paid;
                        $node['date'] = $invoice->date;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $invoice_id;
                        $node['rel_type'] = 'invoice';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }else{
                        $node = [];
                        $node['itemable_id'] = 0;
                        $node['split'] = $tax_payment_account;
                        $node['account'] = $tax_deposit_to;
                        $node['tax'] = $_tax->id;
                        $node['item'] = 0;
                        $node['date'] = $invoice->date;
                        $node['paid'] = $paid;
                        $node['debit'] = $total_tax;
                        $node['customer'] = $invoice->clientid;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $invoice_id;
                        $node['rel_type'] = 'invoice';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['itemable_id'] = 0;
                        $node['split'] = $tax_deposit_to;
                        $node['customer'] = $invoice->clientid;
                        $node['account'] = $tax_payment_account;
                        $node['date'] = $invoice->date;
                        $node['tax'] = $_tax->id;
                        $node['item'] = 0;
                        $node['paid'] = $paid;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $invoice_id;
                        $node['rel_type'] = 'invoice';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }
                }else{
                    $node = [];
                    $node['itemable_id'] = 0;
                    $node['split'] = $tax_payment_account;
                    $node['account'] = $tax_deposit_to;
                    $node['tax'] = 0;
                    $node['item'] = 0;
                    $node['date'] = $invoice->date;
                    $node['paid'] = $paid;
                    $node['debit'] = $total_tax;
                    $node['customer'] = $invoice->clientid;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $invoice_id;
                    $node['rel_type'] = 'invoice';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['itemable_id'] = 0;
                    $node['split'] = $tax_deposit_to;
                    $node['customer'] = $invoice->clientid;
                    $node['account'] = $tax_payment_account;
                    $node['date'] = $invoice->date;
                    $node['tax'] = 0;
                    $node['item'] = 0;
                    $node['paid'] = $paid;
                    $node['debit'] = 0;
                    $node['credit'] = $total_tax;
                    $node['description'] = '';
                    $node['rel_id'] = $invoice_id;
                    $node['rel_type'] = 'invoice';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }
            }

            foreach ($invoice->items as $value) {
                $item = $this->get_item_by_name($value['description']);
                $item_id = 0;
                if(isset($item->id)){
                    $item_id = $item->id;
                }

                $item_total = $value['qty'] * $value['rate'];
                if($currency_converter == 1){
                    $item_total = round($this->currency_converter($invoice->currency_name, $currency->name, $value['qty'] * $value['rate']), 2);
                }

                $item_automatic = $this->get_item_automatic($item_id);

                if($item_automatic){
                    $node = [];
                    $node['itemable_id'] = $value['id'];
                    $node['split'] = $payment_account;
                    $node['account'] = $deposit_to;
                    $node['item'] = $item_id;
                    $node['date'] = $invoice->date;
                    $node['paid'] = $paid;
                    $node['debit'] = $item_total;
                    $node['customer'] = $invoice->clientid;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $invoice_id;
                    $node['rel_type'] = 'invoice';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['itemable_id'] = $value['id'];
                    $node['split'] = $deposit_to;
                    $node['customer'] = $invoice->clientid;
                    $node['account'] = $item_automatic->income_account;
                    $node['item'] = $item_id;
                    $node['paid'] = $paid;
                    $node['date'] = $invoice->date;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $invoice_id;
                    $node['rel_type'] = 'invoice';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }else{
                    $node = [];
                    $node['itemable_id'] = $value['id'];
                    $node['split'] = $payment_account;
                    $node['account'] = $deposit_to;
                    $node['item'] = $item_id;
                    $node['debit'] = $item_total;
                    $node['customer'] = $invoice->clientid;
                    $node['paid'] = $paid;
                    $node['date'] = $invoice->date;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $invoice_id;
                    $node['rel_type'] = 'invoice';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['itemable_id'] = $value['id'];
                    $node['split'] = $deposit_to;
                    $node['customer'] = $invoice->clientid;
                    $node['account'] = $payment_account;
                    $node['item'] = $item_id;
                    $node['date'] = $invoice->date;
                    $node['paid'] = $paid;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $invoice_id;
                    $node['rel_type'] = 'invoice';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }
            }
            if($data_insert != []){
                $affectedRows = $this->db->insert_batch(db_prefix().'acc_account_history', $data_insert);
            }
                
            if ($affectedRows > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Automatic payment conversion
     * @param  integer $payment_id 
     * @return boolean
     */
    public function automatic_payment_conversion($payment_id){
        $this->delete_convert($payment_id, 'payment');

        $this->load->model('payments_model');
        $payment = $this->payments_model->get($payment_id);
        $payment_account = get_option('acc_payment_payment_account');
        $deposit_to = get_option('acc_payment_deposit_to');
        $affectedRows = 0;

        $this->automatic_invoice_conversion($payment->invoiceid);

        if($payment){
            if(get_option('acc_close_the_books') == 1){
                if(strtotime($payment->date) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                    return false;
                }
            }
            $this->load->model('invoices_model');
            $invoice = $this->invoices_model->get($payment->invoiceid);

            $this->load->model('currencies_model');
            $currency = $this->currencies_model->get_base_currency();

            $payment_total = $payment->amount;
            if($invoice->currency_name != $currency->name){
                $payment_total = round($this->currency_converter($invoice->currency_name, $currency->name, $payment->amount), 2);
            }

            if(get_option('acc_active_payment_mode_mapping') == 1){
                $payment_mode_mapping = $this->get_payment_mode_mapping($payment->paymentmode);
                $data_insert = [];
                if($payment_mode_mapping){
                    $node = [];
                    $node['split'] = $payment_mode_mapping->payment_account;
                    $node['account'] = $payment_mode_mapping->deposit_to;
                    $node['date'] = $payment->date;
                    $node['debit'] = $payment_total;
                    $node['customer'] = $invoice->clientid;
                    $node['credit'] = 0;
                    $node['tax'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $payment_id;
                    $node['rel_type'] = 'payment';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $payment_mode_mapping->deposit_to;
                    $node['customer'] = $invoice->clientid;
                    $node['account'] = $payment_mode_mapping->payment_account;
                    $node['date'] = $payment->date;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $payment_total;
                    $node['description'] = '';
                    $node['rel_id'] = $payment_id;
                    $node['rel_type'] = 'payment';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }

                if(count($data_insert) == 0){   
                    if(get_option('acc_payment_automatic_conversion') == 1){
                        $node = [];
                        $node['split'] = $payment_account;
                        $node['account'] = $deposit_to;
                        $node['customer'] = $invoice->clientid;
                        $node['debit'] = $payment_total;
                        $node['credit'] = 0;
                        $node['date'] = $payment->date;
                        $node['description'] = '';
                        $node['rel_id'] = $payment_id;
                        $node['rel_type'] = 'payment';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $deposit_to;
                        $node['customer'] = $invoice->clientid;
                        $node['account'] = $payment_account;
                        $node['date'] = $payment->date;
                        $node['debit'] = 0;
                        $node['credit'] = $payment_total;
                        $node['description'] = '';
                        $node['rel_id'] = $payment_id;
                        $node['rel_type'] = 'payment';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }
                }
            }else{
                if(get_option('acc_payment_automatic_conversion') == 1){
                    $node = [];
                    $node['split'] = $payment_account;
                    $node['account'] = $deposit_to;
                    $node['customer'] = $invoice->clientid;
                    $node['debit'] = $payment_total;
                    $node['credit'] = 0;
                    $node['date'] = $payment->date;
                    $node['description'] = '';
                    $node['rel_id'] = $payment_id;
                    $node['rel_type'] = 'payment';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $deposit_to;
                    $node['customer'] = $invoice->clientid;
                    $node['account'] = $payment_account;
                    $node['date'] = $payment->date;
                    $node['debit'] = 0;
                    $node['credit'] = $payment_total;
                    $node['description'] = '';
                    $node['rel_id'] = $payment_id;
                    $node['rel_type'] = 'payment';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }
            }

            if($data_insert != []){
                $affectedRows = $this->db->insert_batch(db_prefix().'acc_account_history', $data_insert);
            }
                
            if ($affectedRows > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Automatic expense conversion
     * @param  integer $expense_id 
     * @return boolean
     */
    public function automatic_expense_conversion($expense_id){
    
        $this->delete_convert($expense_id, 'expense');

        $this->load->model('expenses_model');
        $expense = $this->expenses_model->get($expense_id);
        $payment_account = get_option('acc_expense_payment_account');
        $deposit_to = get_option('acc_expense_deposit_to');
        $tax_payment_account = get_option('acc_tax_payment_account');
        $tax_deposit_to = get_option('acc_tax_deposit_to');
        $payment_mode_payment_account = get_option('acc_expense_payment_payment_account');
        $payment_mode_deposit_to = get_option('acc_expense_payment_deposit_to');
        $affectedRows = 0;

        if($expense){
            if(get_option('acc_close_the_books') == 1){
                if(strtotime($expense->date) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                    return false;
                }
            }

            $this->load->model('currencies_model');
            $currency = $this->currencies_model->get_base_currency();

            $expense_total = $expense->amount;
            if($expense->currency_data->name != $currency->name){
                $expense_total = round($this->currency_converter($expense->currency_data->name, $currency->name, $expense->amount), 2);
            }

            $data_insert = [];

            if(get_option('acc_active_expense_category_mapping') == 1){
                $expense_category_mapping = $this->get_expense_category_mapping($expense->category);
                if($expense_category_mapping){
                    if($expense_category_mapping->preferred_payment_method == 1 && $expense->paymentmode > 0){
                        $payment_mode_mapping = $this->get_payment_mode_mapping($expense->paymentmode);

                        if($payment_mode_mapping){
                            if(get_option('acc_active_payment_mode_mapping') == 1){
                                $node = [];
                                $node['split'] = $payment_mode_mapping->expense_payment_account;
                                $node['account'] = $payment_mode_mapping->expense_deposit_to;
                                $node['tax'] = 0;
                                $node['debit'] = $expense_total;
                                $node['credit'] = 0;
                                $node['customer'] = $expense->clientid;
                                $node['date'] = $expense->date;
                                $node['description'] = '';
                                $node['rel_id'] = $expense_id;
                                $node['rel_type'] = 'expense';
                                $node['datecreated'] = date('Y-m-d H:i:s');
                                $node['addedfrom'] = get_staff_user_id();
                                $data_insert[] = $node;

                                $node = [];
                                $node['split'] = $payment_mode_mapping->expense_deposit_to;
                                $node['customer'] = $expense->clientid;
                                $node['account'] = $payment_mode_mapping->expense_payment_account;
                                $node['tax'] = 0;
                                $node['date'] = $expense->date;
                                $node['debit'] = 0;
                                $node['credit'] = $expense_total;
                                $node['description'] = '';
                                $node['rel_id'] = $expense_id;
                                $node['rel_type'] = 'expense';
                                $node['datecreated'] = date('Y-m-d H:i:s');
                                $node['addedfrom'] = get_staff_user_id();
                                $data_insert[] = $node;
                            }
                        }
                    }

                    if(count($data_insert) == 0){   
                        $node = [];
                        $node['split'] = $expense_category_mapping->payment_account;
                        $node['account'] = $expense_category_mapping->deposit_to;
                        $node['date'] = $expense->date;
                        $node['debit'] = $expense_total;
                        $node['customer'] = $expense->clientid;
                        $node['credit'] = 0;
                        $node['tax'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $expense_id;
                        $node['rel_type'] = 'expense';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $expense_category_mapping->deposit_to;
                        $node['customer'] = $expense->clientid;
                        $node['account'] = $expense_category_mapping->payment_account;
                        $node['date'] = $expense->date;
                        $node['tax'] = 0;
                        $node['debit'] = 0;
                        $node['credit'] = $expense_total;
                        $node['description'] = '';
                        $node['rel_id'] = $expense_id;
                        $node['rel_type'] = 'expense';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }

                }

                if(count($data_insert) == 0 && get_option('acc_expense_automatic_conversion') == 1){   
                    $node = [];
                    $node['split'] = $payment_account;
                    $node['account'] = $deposit_to;
                    $node['debit'] = $expense_total;
                    $node['customer'] = $expense->clientid;
                    $node['date'] = $expense->date;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $expense_id;
                    $node['rel_type'] = 'expense';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $deposit_to;
                    $node['account'] = $payment_account;
                    $node['customer'] = $expense->clientid;
                    $node['date'] = $expense->date;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $expense_total;
                    $node['description'] = '';
                    $node['rel_id'] = $expense_id;
                    $node['rel_type'] = 'expense';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }
            }else{

                if(get_option('acc_expense_automatic_conversion') == 1){
                    $node = [];
                    $node['split'] = $payment_account;
                    $node['account'] = $deposit_to;
                    $node['debit'] = $expense_total;
                    $node['customer'] = $expense->clientid;
                    $node['date'] = $expense->date;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $expense_id;
                    $node['rel_type'] = 'expense';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $deposit_to;
                    $node['account'] = $payment_account;
                    $node['customer'] = $expense->clientid;
                    $node['date'] = $expense->date;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $expense_total;
                    $node['description'] = '';
                    $node['rel_id'] = $expense_id;
                    $node['rel_type'] = 'expense';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }
            }

            if(count($data_insert) == 0 && $expense->paymentmode > 0){
                $payment_mode_mapping = $this->get_payment_mode_mapping($expense->paymentmode);

                if($payment_mode_mapping){
                    if(get_option('acc_active_payment_mode_mapping') == 1){
                        $node = [];
                        $node['split'] = $payment_mode_mapping->expense_payment_account;
                        $node['account'] = $payment_mode_mapping->expense_deposit_to;
                        $node['tax'] = 0;
                        $node['debit'] = $expense_total;
                        $node['credit'] = 0;
                        $node['customer'] = $expense->clientid;
                        $node['date'] = $expense->date;
                        $node['description'] = '';
                        $node['rel_id'] = $expense_id;
                        $node['rel_type'] = 'expense';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $payment_mode_mapping->expense_deposit_to;
                        $node['customer'] = $expense->clientid;
                        $node['account'] = $payment_mode_mapping->expense_payment_account;
                        $node['tax'] = 0;
                        $node['date'] = $expense->date;
                        $node['debit'] = 0;
                        $node['credit'] = $expense_total;
                        $node['description'] = '';
                        $node['rel_id'] = $expense_id;
                        $node['rel_type'] = 'expense';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }
                }else{
                    if(get_option('acc_payment_expense_automatic_conversion') == 1){
                        $node = [];
                        $node['split'] = $payment_mode_payment_account;
                        $node['account'] = $payment_mode_deposit_to;
                        $node['tax'] = 0;
                        $node['date'] = $expense->date;
                        $node['debit'] = $expense_total;
                        $node['customer'] = $expense->clientid;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $expense_id;
                        $node['rel_type'] = 'expense';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $payment_mode_deposit_to;
                        $node['customer'] = $expense->clientid;
                        $node['account'] = $payment_mode_payment_account;
                        $node['date'] = $expense->date;
                        $node['tax'] = 0;
                        $node['debit'] = 0;
                        $node['credit'] = $expense_total;
                        $node['description'] = '';
                        $node['rel_id'] = $expense_id;
                        $node['rel_type'] = 'expense';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }
                }
            }

            if(get_option('acc_tax_automatic_conversion') == 1){
                if($expense->tax > 0){
                    $this->db->where('id', $expense->tax);
                    $tax = $this->db->get(db_prefix().'taxes')->row();
                    $total_tax = 0;
                    if($tax){
                        $total_tax = ($tax->taxrate/100) * $expense_total;
                    }
                    $tax_mapping = $this->get_tax_mapping($expense->tax);
                    if($tax_mapping){
                        $node = [];
                        $node['split'] = $tax_mapping->expense_payment_account;
                        $node['account'] = $tax_mapping->expense_deposit_to;
                        $node['tax'] = $expense->tax;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['customer'] = $expense->clientid;
                        $node['date'] = $expense->date;
                        $node['description'] = '';
                        $node['rel_id'] = $expense_id;
                        $node['rel_type'] = 'expense';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_mapping->expense_deposit_to;
                        $node['customer'] = $expense->clientid;
                        $node['account'] = $tax_mapping->expense_payment_account;
                        $node['tax'] = $expense->tax;
                        $node['date'] = $expense->date;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $expense_id;
                        $node['rel_type'] = 'expense';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }else{
                        $node = [];
                        $node['split'] = $tax_payment_account;
                        $node['account'] = $tax_deposit_to;
                        $node['tax'] = $expense->tax;
                        $node['date'] = $expense->date;
                        $node['debit'] = $total_tax;
                        $node['customer'] = $expense->clientid;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $expense_id;
                        $node['rel_type'] = 'expense';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_deposit_to;
                        $node['customer'] = $expense->clientid;
                        $node['account'] = $tax_payment_account;
                        $node['date'] = $expense->date;
                        $node['tax'] = $expense->tax;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $expense_id;
                        $node['rel_type'] = 'expense';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }
                }

                if($expense->tax2 > 0){
                    $this->db->where('id', $expense->tax2);
                    $tax = $this->db->get(db_prefix().'taxes')->row();
                    $total_tax = 0;
                    if($tax){
                        $total_tax = ($tax->taxrate/100) * $expense_total;
                    }
                    $tax_mapping = $this->get_tax_mapping($expense->tax2);
                    if($tax_mapping){
                        $node = [];
                        $node['split'] = $tax_mapping->expense_payment_account;
                        $node['account'] = $tax_mapping->expense_deposit_to;
                        $node['tax'] = $expense->tax2;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['customer'] = $expense->clientid;
                        $node['date'] = $expense->date;
                        $node['description'] = '';
                        $node['rel_id'] = $expense_id;
                        $node['rel_type'] = 'expense';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_mapping->expense_deposit_to;
                        $node['customer'] = $expense->clientid;
                        $node['account'] = $tax_mapping->expense_payment_account;
                        $node['tax'] = $expense->tax2;
                        $node['date'] = $expense->date;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $expense_id;
                        $node['rel_type'] = 'expense';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }else{
                        $node = [];
                        $node['split'] = $tax_payment_account;
                        $node['account'] = $tax_deposit_to;
                        $node['tax'] = $expense->tax2;
                        $node['date'] = $expense->date;
                        $node['debit'] = $total_tax;
                        $node['customer'] = $expense->clientid;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $expense_id;
                        $node['rel_type'] = 'expense';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_deposit_to;
                        $node['customer'] = $expense->clientid;
                        $node['account'] = $tax_payment_account;
                        $node['date'] = $expense->date;
                        $node['tax'] = $expense->tax2;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $expense_id;
                        $node['rel_type'] = 'expense';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }
                }
            }

            if($data_insert != []){
                $affectedRows = $this->db->insert_batch(db_prefix().'acc_account_history', $data_insert);
            }
                
            if ($affectedRows > 0) {
                return true;
            }
        }

        return false;
    }

    
    /**
     * count invoice not convert yet
     * @param  integer $currency
     * @param  string $where
     * @return object          
     */
    public function count_invoice_not_convert_yet($currency = '', $where = ''){
        $where_currency = '';
        if($currency != ''){
            $where_currency = 'and currency = '.$currency;
        }

        if($where != ''){
            $this->db->where($where);
        }
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_account_history where ' . db_prefix() . 'acc_account_history.rel_id = ' . db_prefix() . 'invoices.id and ' . db_prefix() . 'acc_account_history.rel_type = "invoice") = 0) '.$where_currency);
        return $this->db->count_all_results(db_prefix().'invoices');
    }

    /**
     * count payment not convert yet
     * @param  integer $currency
     * @param  string $where
     * @return object
     */
    public function count_payment_not_convert_yet($currency = '', $where = ''){
        $where_currency = '';
        if($currency != ''){
            $where_currency = 'and currency = '.$currency;
        }

        if($where != ''){
            $this->db->where($where);
        }
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_account_history where ' . db_prefix() . 'acc_account_history.rel_id = ' . db_prefix() . 'invoicepaymentrecords.id and ' . db_prefix() . 'acc_account_history.rel_type = "payment") = 0) '.$where_currency);
        $this->db->join(db_prefix() . 'invoices', db_prefix() . 'invoices.id=' . db_prefix() . 'invoicepaymentrecords.invoiceid', 'left');
        return $this->db->count_all_results(db_prefix().'invoicepaymentrecords');
    }

    /**
     * count expense not convert yet
     * @param  string $where
     * @param  integer $currency
     * @return object
     */
    public function count_expense_not_convert_yet($currency = '', $where = ''){
        $where_currency = '';
        if($currency != ''){
            $where_currency = 'and currency = '.$currency;
        }

        if($where != ''){
            $this->db->where($where);
        }
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_account_history where ' . db_prefix() . 'acc_account_history.rel_id = ' . db_prefix() . 'expenses.id and ' . db_prefix() . 'acc_account_history.rel_type = "expense") = 0) '.$where_currency);
        return $this->db->count_all_results(db_prefix().'expenses');
    }

    /**
     * delete invoice convert
     * @param  integer $invoice_id 
     * @return boolean            
     */
    public function delete_invoice_convert($invoice_id){
        $affectedRows = 0;

        $check = $this->delete_convert($invoice_id,'invoice');
        if($check){
            $affectedRows++;
        }

        $this->db->where('invoiceid', $invoice_id);
        $payments = $this->db->get(db_prefix() . 'invoicepaymentrecords')->result_array();

        foreach ($payments as $key => $value) {
            $check = $this->delete_convert($value['id'],'payment');
            if($check){
                $affectedRows++;
            }
        }

        if($affectedRows > 0){
            return true;
        }

        return false;
    }

    /**
     * invoice status changed
     * @param  array $data 
     * @return boolean       
     */
    public function invoice_status_changed($data){
        if(isset($data['invoice_id']) && isset($data['status'])){
            if($data['status'] == 2){
                $this->db->where('rel_id', $data['invoice_id']);
                $this->db->where('rel_type', 'invoice');
                $this->db->update(db_prefix().'acc_account_history', ['paid' => 1]);
                if ($this->db->affected_rows() > 0) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * get items are not yet auto
     * @return array
     */
    public function get_items_not_yet_auto(){
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_item_automatics where ' . db_prefix() . 'acc_item_automatics.item_id = ' . db_prefix() . 'items.id) = 0)');
        return $this->db->get(db_prefix().'items')->result_array();
    }

    /**
     * add item automatic
     * @param array $data
     * @return boolean
     */
    public function add_item_automatic($data){
        if(isset($data['id'])){
            unset($data['id']);
        }
        $items = [];
        if(isset($data['item'])){
            $items = $data['item'];
            unset($data['item']);
        }
        $data_insert = [];
        foreach ($items as $value) {
            $this->db->where('item_id', $value);
            $count = $this->db->count_all_results(db_prefix() . 'acc_item_automatics');

            if($count == 0){
                $node = [];
                $node['item_id'] = $value;
                $node['inventory_asset_account'] = $data['inventory_asset_account'];
                $node['income_account'] = $data['income_account'];
                $node['expense_account'] = $data['expense_account'];

                $data_insert[] = $node;
            }

        }

        $affectedRows = $this->db->insert_batch(db_prefix().'acc_item_automatics',  $data_insert);

        if ($affectedRows > 0) {
            return true;
        }

        return false;
    }

    /**
     * update item automatic
     * @param array $data
     * @param  integer $id 
     * @return boolean
     */
    public function update_item_automatic($data, $id){
        $this->db->where('id', $id);
        $this->db->update(db_prefix().'acc_item_automatics', $data);
       
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * delete item automatic
     * @param integer $id
     * @return boolean
     */

    public function delete_item_automatic($id)
    {
        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'acc_item_automatics');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Gets the item by name.
     *
     * @param      string  $item_name  The itemid
     *
     * @return     object  The item.
     */
    public function get_item_by_name($item_name) {

        $this->db->where('description', $item_name);
        return $this->db->get(db_prefix() . 'items')->row();
    }

    /**
     * Gets the item automatic
     *
     * @param      string  $item_id  The itemid
     *
     * @return     object  The item automatic.
     */
    public function get_item_automatic($item_id) {

        $this->db->where('item_id', $item_id);
        return $this->db->get(db_prefix() . 'acc_item_automatics')->row();
    }

    /**
     * delete banking
     * @param integer $id
     * @return boolean
     */

    public function delete_banking($id)
    {
        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'acc_transaction_bankings');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'banking');
            $this->db->delete(db_prefix() . 'acc_account_history');

            return true;
        }
        return false;
    }

    /**
     * add tax mapping
     * @param array $data
     * @return boolean
     */
    public function add_tax_mapping($data){
        if(isset($data['id'])){
            unset($data['id']);
        }
        $taxs = [];
        if(isset($data['tax'])){
            $taxs = $data['tax'];
            unset($data['tax']);
        }
        $data_insert = [];
        foreach ($taxs as $value) {
            $this->db->where('tax_id', $value);
            $count = $this->db->count_all_results(db_prefix() . 'acc_tax_mappings');

            if($count == 0){
                $node = [];
                $node['tax_id'] = $value;
                $node['payment_account'] = $data['payment_account'];
                $node['deposit_to'] = $data['deposit_to'];
                $node['expense_payment_account'] = $data['expense_payment_account'];
                $node['expense_deposit_to'] = $data['expense_deposit_to'];

                $data_insert[] = $node;
            }

        }

        $affectedRows = $this->db->insert_batch(db_prefix().'acc_tax_mappings',  $data_insert);

        if ($affectedRows > 0) {
            return true;
        }

        return false;
    }

    /**
     * update tax mapping
     * @param array $data
     * @param  integer $id 
     * @return boolean
     */
    public function update_tax_mapping($data, $id){
        $this->db->where('id', $id);
        $this->db->update(db_prefix().'acc_tax_mappings', $data);
       
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * delete tax mapping
     * @param integer $id
     * @return boolean
     */

    public function delete_tax_mapping($id)
    {
        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'acc_tax_mappings');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * get taxes are not yet auto
     * @return array
     */
    public function get_taxes_not_yet_auto(){
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_tax_mappings where ' . db_prefix() . 'acc_tax_mappings.tax_id = ' . db_prefix() . 'taxes.id) = 0)');
        return $this->db->get(db_prefix().'taxes')->result_array();
    }

    /**
     * Gets the tax mapping
     *
     * @param      string  $tax_id  The tax id
     *
     * @return     object  The tax mapping.
     */
    public function get_tax_mapping($tax_id) {

        $this->db->where('tax_id', $tax_id);
        return $this->db->get(db_prefix() . 'acc_tax_mappings')->row();
    }

    /**
     * [currency_converter description]
     * @param  string $from   Currency Code
     * @param  string $to     Currency Code
     * @param  float $amount
     * @return float        
     */
    public function currency_converter($from,$to,$amount)
    {
        $url = "https://api.frankfurter.app/latest?amount=$amount&from=$from&to=$to"; 

        $response = json_decode($this->api_get($url));

        if(isset($response->rates->$to)){
            return $response->rates->$to;
        }

        return false;
    }

    /**
     * api get
     * @param  string $url
     * @return string    
     */
    public function api_get($url) {
        $curl = curl_init($url);
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 120);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        
        return curl_exec($curl);
    }

    /**
     * get expense category are not yet auto
     * @return array
     */
    public function get_expense_category_not_yet_auto(){
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_expense_category_mappings where ' . db_prefix() . 'acc_expense_category_mappings.category_id = ' . db_prefix() . 'expenses_categories.id) = 0)');
        return $this->db->get(db_prefix().'expenses_categories')->result_array();
    }

    /**
     * add expense category mapping
     * @param array $data
     * @return boolean
     */
    public function add_expense_category_mapping($data){
        if(isset($data['id'])){
            unset($data['id']);
        }
        $categorys = [];
        if(isset($data['category'])){
            $categorys = $data['category'];
            unset($data['category']);
        }
        
        if (!isset($data['preferred_payment_method'])) {
            $data['preferred_payment_method'] = 0;
        }

        $data_insert = [];
        foreach ($categorys as $value) {
            $this->db->where('category_id', $value);
            $count = $this->db->count_all_results(db_prefix() . 'acc_expense_category_mappings');

            if($count == 0){
                $node = [];
                $node['category_id'] = $value;
                $node['payment_account'] = $data['payment_account'];
                $node['deposit_to'] = $data['deposit_to'];

                $data_insert[] = $node;
            }

        }

        $affectedRows = $this->db->insert_batch(db_prefix().'acc_expense_category_mappings',  $data_insert);

        if ($affectedRows > 0) {
            return true;
        }

        return false;
    }

    /**
     * update expense category mapping
     * @param array $data
     * @param  integer $id 
     * @return boolean
     */
    public function update_expense_category_mapping($data, $id){
        if (!isset($data['preferred_payment_method'])) {
            $data['preferred_payment_method'] = 0;
        }

        $this->db->where('id', $id);
        $this->db->update(db_prefix().'acc_expense_category_mappings', $data);
       
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * delete expense category mapping
     * @param integer $id
     * @return boolean
     */

    public function delete_expense_category_mapping($id)
    {
        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'acc_expense_category_mappings');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Gets the expense category mappings
     *
     * @param      string  $category_id  The expense category id
     *
     * @return     object  The expense category mapping.
     */
    public function get_expense_category_mapping($category_id) {

        $this->db->where('category_id', $category_id);
        return $this->db->get(db_prefix() . 'acc_expense_category_mappings')->row();
    }

    /**
     * get data tax detail report
     * @return array 
     */
    public function get_data_tax_detail_report($data_filter){
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $accounts = $this->accounting_model->get_accounts();

        $account_name = [];

        foreach ($accounts as $key => $value) {
            $account_name[$value['id']] = $value['name'];
        }

        $data_report = [];
        $data_report['tax_collected_on_sales'] = [];
        $data_report['total_taxable_sales_in_period_before_tax'] = [];

        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '") and tax > 0 and rel_type = "invoice" and debit > 0');
        if($accounting_method == 'cash'){
            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
        }
        $this->db->order_by('date', 'asc');
        
        $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
        
        $list_invoice = [];        
        $this->load->model('invoices_model');
        foreach ($account_history as $v) {

            if(!in_array($v['rel_id'], $list_invoice)){
                $list_invoice[] = $v['rel_id'];
                $invoice = $this->invoices_model->get($v['rel_id']);


                $data_report['total_taxable_sales_in_period_before_tax'][] = [
                                'date' => date('Y-m-d', strtotime($v['date'])),
                                'type' => _l($v['rel_type']),
                                'description' => $v['description'],
                                'customer' => $v['customer'],
                                'amount' => $invoice->subtotal,
                            ];
            }

            $this->db->where('id', $v['tax']);
            $_tax = $this->db->get(db_prefix().'taxes')->row();

            $data_report['tax_collected_on_sales'][] = [
                            'date' => date('Y-m-d', strtotime($v['date'])),
                            'type' => _l($v['rel_type']),
                            'tax_name' => $_tax->name,
                            'tax_rate' => $_tax->taxrate,
                            'description' => $v['description'],
                            'customer' => $v['customer'],
                            'amount' => $v['debit'],
                        ];
        }

        $data_report['tax_reclaimable_on_purchases'] = [];
        $data_report['total_taxable_purchases_in_period_before_tax'] = [];

        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '") and tax > 0 and rel_type = "expense" and credit > 0');
        if($accounting_method == 'cash'){
            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
        }
        $this->db->order_by('date', 'asc');
        
        $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();

        $list_expense = [];        
        $this->load->model('expenses_model');
        foreach ($account_history as $v) {

            if(!in_array($v['rel_id'], $list_expense)){
                $list_expense[] = $v['rel_id'];

                $expense = $this->expenses_model->get($v['rel_id']);

                $data_report['total_taxable_purchases_in_period_before_tax'][] = [
                                'date' => date('Y-m-d', strtotime($v['date'])),
                                'type' => _l($v['rel_type']),
                                'description' => $v['description'],
                                'customer' => $v['customer'],
                                'amount' => $expense->amount,
                            ];
            }

            $this->db->where('id', $v['tax']);
            $_tax = $this->db->get(db_prefix().'taxes')->row();

            $data_report['tax_reclaimable_on_purchases'][] = [
                            'date' => date('Y-m-d', strtotime($v['date'])),
                            'type' => _l($v['rel_type']),
                            'tax_name' => $_tax->name,
                            'tax_rate' => $_tax->taxrate,
                            'description' => $v['description'],
                            'customer' => $v['customer'],
                            'amount' => $v['credit'],
                        ];
        }
                
        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
    }

    /**
     * get data tax summary report
     * @return array 
     */
    public function get_data_tax_summary_report($data_filter){
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $tax = 0;
        if(isset($data_filter['tax'])){
            $tax = $data_filter['tax'];
        }

        $accounts = $this->accounting_model->get_accounts();

        $account_name = [];

        foreach ($accounts as $key => $value) {
            $account_name[$value['id']] = $value['name'];
        }

        $data_report = [];
        $data_report['tax_collected_on_sales'] = 0;
        $data_report['total_taxable_sales_in_period_before_tax'] = 0;
        $data_report['adjustments_to_tax_on_sales'] = 0;
        $data_report['total_taxable_purchases_in_period_before_tax'] = 0;
        $data_report['tax_reclaimable_on_purchases'] = 0;
        $data_report['other_adjustments'] = 0;
        $data_report['tax_due_or_credit_from_previous_periods'] = 0;
        $data_report['tax_payments_made_this_period'] = 0;
        $data_report['adjustments_to_reclaimable_tax_on_purchases'] = 0;

        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '") and tax = '.$tax.' and rel_type = "invoice" and debit > 0');

        if($accounting_method == 'cash'){
            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
        }
        $this->db->order_by('date', 'asc');
        
        $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
        
        $list_invoice = [];        
        $this->load->model('invoices_model');
        foreach ($account_history as $v) {

            if(!in_array($v['rel_id'], $list_invoice)){
                $list_invoice[] = $v['rel_id'];
                $invoice = $this->invoices_model->get($v['rel_id']);

                $data_report['total_taxable_sales_in_period_before_tax'] += $invoice->subtotal;
            }

            $data_report['tax_collected_on_sales'] += $v['debit'];
        }

        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '") and tax = '.$tax.' and rel_type = "expense" and credit > 0');
        if($accounting_method == 'cash'){
            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
        }
        $this->db->order_by('date', 'asc');
        
        $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();

        $this->load->model('expenses_model');
        $list_expense = [];        
        foreach ($account_history as $v) {

            if(!in_array($v['rel_id'], $list_expense)){
                $list_expense[] = $v['rel_id'];
                $expense = $this->expenses_model->get($v['rel_id']);

                $data_report['total_taxable_purchases_in_period_before_tax'] += $expense->amount;
            }

            $data_report['tax_reclaimable_on_purchases'] += $v['credit'];
        }
                
        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
    }

    /**
     * get data tax liability report
     * @return array 
     */
    public function get_data_tax_liability_report($data_filter){
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $accounts = $this->accounting_model->get_accounts();

        $account_name = [];

        foreach ($accounts as $key => $value) {
            $account_name[$value['id']] = $value['name'];
        }

        $data_report = [];

        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '") and tax > 0 and (rel_type = "invoice" or rel_type = "expense") and debit > 0');
        if($accounting_method == 'cash'){
            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
        }
        $this->db->order_by('tax, rel_type', 'asc');
        $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
        
        $list_invoice = [];        
        foreach ($account_history as $v) {
            if(isset($data_report[$v['tax'].'_'.$v['rel_type']])){
                $data_report[$v['tax'].'_'.$v['rel_type']]['amount'] += $v['debit'];
            }else{
                $this->db->where('id', $v['tax']);
                $_tax = $this->db->get(db_prefix().'taxes')->row();

                $data_report[$v['tax'].'_'.$v['rel_type']] = [];
                $data_report[$v['tax'].'_'.$v['rel_type']]['name'] = $_tax->name.' ('._l($v['rel_type']).')('.$_tax->taxrate.'%)';
                $data_report[$v['tax'].'_'.$v['rel_type']]['amount'] = $v['debit'];
            }

        }
                
        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
    }

    /**
     * get journal entry next number
     * @return integer
     */
    public function get_journal_entry_next_number()
    {
        $this->db->select('max(number) as max_number');
        $max = $this->db->get(db_prefix().'acc_journal_entries')->row();
        if(is_numeric($max->max_number)){
            return $max->max_number + 1;
        }
        return 1;
    }

    /**
     * add payment mode mapping
     * @param array $data
     * @return boolean
     */
    public function add_payment_mode_mapping($data){
        if(isset($data['id'])){
            unset($data['id']);
        }
        $payment_modes = [];
        if(isset($data['payment_mode'])){
            $payment_modes = $data['payment_mode'];
            unset($data['payment_mode']);
        }
        $data_insert = [];
        foreach ($payment_modes as $value) {
            $this->db->where('payment_mode_id', $value);
            $count = $this->db->count_all_results(db_prefix() . 'acc_payment_mode_mappings');

            if($count == 0){
                $node = [];
                $node['payment_mode_id'] = $value;
                $node['payment_account'] = $data['payment_account'];
                $node['deposit_to'] = $data['deposit_to'];
                $node['expense_payment_account'] = $data['expense_payment_account'];
                $node['expense_deposit_to'] = $data['expense_deposit_to'];
                
                $data_insert[] = $node;
            }

        }

        $affectedRows = $this->db->insert_batch(db_prefix().'acc_payment_mode_mappings',  $data_insert);

        if ($affectedRows > 0) {
            return true;
        }

        return false;
    }

    /**
     * update payment mode mapping
     * @param array $data
     * @param  integer $id 
     * @return boolean
     */
    public function update_payment_mode_mapping($data, $id){
        $this->db->where('id', $id);
        $this->db->update(db_prefix().'acc_payment_mode_mappings', $data);
       
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * delete payment mode mapping
     * @param integer $id
     * @return boolean
     */

    public function delete_payment_mode_mapping($id)
    {
        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'acc_payment_mode_mappings');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * get payment mode are not yet auto
     * @return array
     */
    public function get_payment_mode_not_yet_auto(){
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_payment_mode_mappings where ' . db_prefix() . 'acc_payment_mode_mappings.payment_mode_id = ' . db_prefix() . 'payment_modes.id) = 0)');
        return $this->db->get(db_prefix().'payment_modes')->result_array();
    }

    /**
     * Gets the payment mode mappings
     *
     * @param      string  $payment_mode_id  The payment mode id
     *
     * @return     object  The expense category mapping.
     */
    public function get_payment_mode_mapping($payment_mode_id) {

        $this->db->where('payment_mode_id', $payment_mode_id);
        return $this->db->get(db_prefix() . 'acc_payment_mode_mappings')->row();
    }

    /**
     * Change payment mode mapping active
     * @param  mixed $status status(0/1)
     */
    public function change_active_payment_mode_mapping($status)
    {
        $this->db->where('name', 'acc_active_payment_mode_mapping');
        $this->db->update(db_prefix() . 'options', [
            'value' => $status,
        ]);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Change expense category mapping active
     * @param  mixed $status status(0/1)
     */
    public function change_active_expense_category_mapping($status)
    {
        $this->db->where('name', 'acc_active_expense_category_mapping');
        $this->db->update(db_prefix() . 'options', [
            'value' => $status,
        ]);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * get account data tables
     * @param  array $aColumns           table columns
     * @param  mixed $sIndexColumn       main column in table for bettter performing
     * @param  string $sTable            table name
     * @param  array  $join              join other tables
     * @param  array  $where             perform where in query
     * @param  array  $additionalSelect  select additional fields
     * @param  string $sGroupBy group results
     * @return array
     */
    function get_account_data_tables($aColumns, $sIndexColumn, $sTable, $join = [], $where = [], $additionalSelect = [], $sGroupBy = '', $searchAs = [])
    {
        $CI          = & get_instance();
        $__post      = $CI->input->post();
        $where = implode(' ', $where);
        $where = trim($where);
        if (startsWith($where, 'AND') || startsWith($where, 'OR')) {
            if (startsWith($where, 'OR')) {
                $where = substr($where, 2);
            } else {
                $where = substr($where, 3);
            }

            $this->db->where($where);
        }

        if(!$this->input->post('ft_account')){
            $this->db->where('(parent_account is null or parent_account = 0)');
        }

        $accounting_method = get_option('acc_accounting_method');

        if($accounting_method == 'cash'){
            $debit = '(SELECT sum(debit) as debit FROM '.db_prefix().'acc_account_history where (account = '.db_prefix().'acc_accounts.id or parent_account = '.db_prefix().'acc_accounts.id) AND (('.db_prefix().'acc_account_history.rel_type = "invoice" AND '.db_prefix().'acc_account_history.paid = 1) or rel_type != "invoice")) as debit';
            $credit = '(SELECT sum(credit) as credit FROM '.db_prefix().'acc_account_history where (account = '.db_prefix().'acc_accounts.id or parent_account = '.db_prefix().'acc_accounts.id) AND (('.db_prefix().'acc_account_history.rel_type = "invoice" AND '.db_prefix().'acc_account_history.paid = 1) or rel_type != "invoice")) as credit';
        }else{
            $debit = '(SELECT sum(debit) as debit FROM '.db_prefix().'acc_account_history where (account = '.db_prefix().'acc_accounts.id or parent_account = '.db_prefix().'acc_accounts.id)) as debit';
            $credit = '(SELECT sum(credit) as credit FROM '.db_prefix().'acc_account_history where (account = '.db_prefix().'acc_accounts.id or parent_account = '.db_prefix().'acc_accounts.id)) as credit';
        }


        $this->db->select('id, number, name, parent_account, account_type_id, account_detail_type_id, balance, key_name, active, number, description, balance_as_of, '.$debit.', '.$credit.', default_account');
        $this->db->limit(intval($CI->input->post('length')), intval($CI->input->post('start')));
        $this->db->order_by('id', 'desc');

        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();

        $rResult = [];

        foreach ($accounts as $key => $value) {
            $rResult[] = $value;
            $rResult = $this->get_recursive_account($rResult, $value['id'], $where, 1);
        }

        /* Data set length after filtering */
        $sQuery = '
        SELECT FOUND_ROWS()
        ';
        $_query         = $CI->db->query($sQuery)->result_array();
        $iFilteredTotal = $_query[0]['FOUND_ROWS()'];
        
        /* Total data set length */
        $sQuery = '
        SELECT COUNT(' . $sTable . '.' . $sIndexColumn . ")
        FROM $sTable " . ($where != '' ? 'WHERE '.$where : $where). ' AND (parent_account IS NULL OR parent_account = 0)';
        $_query = $CI->db->query($sQuery)->result_array();

        $iTotal = $_query[0]['COUNT(' . $sTable . '.' . $sIndexColumn . ')'];
        /*
         * Output
         */
        $output = [
            'draw'                 => $__post['draw'] ? intval($__post['draw']) : 0,
            'iTotalRecords'        => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData'               => [],
            ];

        return [
            'rResult' => $rResult,
            'output'  => $output,
            ];
    }

    /**
     * get recursive account
     * @param  array $accounts  
     * @param  integer $account_id
     * @param  string $where     
     * @param  integer $number    
     * @return array            
     */
    public function get_recursive_account($accounts, $account_id, $where, $number){
        $this->db->select('id, number, name, parent_account, account_type_id, account_detail_type_id, balance, key_name, active, number, description, balance_as_of, (SELECT sum(debit) as debit FROM '.db_prefix().'acc_account_history where (account = '.db_prefix().'acc_accounts.id or parent_account = '.db_prefix().'acc_accounts.id)) as debit, (SELECT sum(credit) as credit FROM '.db_prefix().'acc_account_history where (account = '.db_prefix().'acc_accounts.id or parent_account = '.db_prefix().'acc_accounts.id)) as credit, default_account');
        if($where != ''){
            $this->db->where($where);
        }

        $this->db->where('parent_account', $account_id);
        $this->db->order_by('number,name', 'asc');
        $account_list = $this->db->get(db_prefix().'acc_accounts')->result_array();

        if($account_list){
            foreach ($account_list as $key => $value) {
                foreach ($accounts as $k => $val) {
                    if($value['id'] == $val['id']){
                        unset($accounts[$k]);
                    }
                }

                $value['level'] = $number;
                array_push($accounts, $value);
                $accounts = $this->get_recursive_account($accounts, $value['id'], $where, $number + 1);
            }
        }

        return $accounts;
    }

    /**
     * get data balance sheet comparison recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date         
     * @param  string $last_from_date  
     * @param  string $last_to_date    
     * @param  string $accounting_method    
     * @return array                 
     */
    public function get_data_balance_sheet_comparison_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $last_from_date, $last_to_date, $accounting_method, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        $data_return = [];
        foreach ($accounts as $val) {
            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;

            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->where('(date_format(datecreated, \'%Y-%m-%d\') >= "' . $last_from_date . '" and date_format(datecreated, \'%Y-%m-%d\') <= "' . $last_to_date . '")');
            $py_account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $py_credits = $py_account_history->credit != '' ? $py_account_history->credit : 0;
            $py_debits = $py_account_history->debit != '' ? $py_account_history->debit : 0;

            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }


            if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                $child_account[] = ['name' => $name, 'amount' => ($credits - $debits), 'py_amount' => ($py_credits - $py_debits), 'child_account' => $this->get_data_balance_sheet_comparison_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $last_from_date, $last_to_date, $accounting_method, $acc_show_account_numbers)];
            }else{
                $child_account[] = ['name' => $name, 'amount' => ($debits - $credits), 'py_amount' => ($py_debits - $py_credits), 'child_account' => $this->get_data_balance_sheet_comparison_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $last_from_date, $last_to_date, $accounting_method, $acc_show_account_numbers)];
            }
        }

        return $child_account; 
    }

    /**
     * get html balance sheet comparision
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_balance_sheet_comparision($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $total_py_amount = 0;
        $data_return['total_amount'] = 0;
        $data_return['total_py_amount'] = 0;
        foreach ($child_account as $val) {

            $data_return['row_index']++;
            $total_amount = $val['amount'];
            $total_py_amount = $val['py_amount'];
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$val['name'].'
              </td>
              <td class="total_amount">
              '.app_format_money($val['amount'], $currency->name).'
              </td>
              <td class="total_amount">
              '.app_format_money($val['py_amount'], $currency->name).'
              </td>
            </tr>';

            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $t_py = $data_return['total_py_amount'];
                $data_return = $this->get_html_balance_sheet_comparision($val['child_account'], $data_return, $data_return['row_index'], $currency);

                $total_amount += $data_return['total_amount'];
                $total_py_amount += $data_return['total_py_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_py_amount, $currency->name).'
                  </td>
                </tr>';
                $data_return['total_amount'] += $t;
                $data_return['total_py_amount'] += $t_py;
            }

            $data_return['total_amount'] += $val['amount'];
            $data_return['total_py_amount'] += $val['py_amount'];
        }
        return $data_return; 
    }

    /**
     * get data balance sheet detail recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date         
     * @param  string $accounting_method         
     * @return array                 
     */
    public function get_data_balance_sheet_detail_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        $data_return = [];
        foreach ($accounts as $val) {
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $this->db->order_by('date', 'asc');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
            $node = [];
            $balance = 0;
            $amount = 0;
            foreach ($account_history as $v) {
                if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 10 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 7 || $account_type_id == 6){
                    $am = $v['credit'] - $v['debit'];
                }else{
                    $am = $v['debit'] - $v['credit'];
                }

                $node[] =   [
                                'date' => date('Y-m-d', strtotime($v['date'])),
                                'type' => _l($v['rel_type']),
                                'description' => $v['description'],
                                'debit' => $v['debit'],
                                'credit' => $v['credit'],
                                'amount' => $am,
                                'balance' => $balance + $am,
                            ];

                $amount += $am;
                $balance += $am;
            }

            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }


            $child_account[] = ['account' => $val['id'], 'name' => $name, 'amount' => $amount, 'balance' => $balance, 'details' => $node, 'child_account' => $this->get_data_balance_sheet_detail_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];
        }

        return $child_account; 
    }

    /**
     * get html balance sheet detail
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_balance_sheet_detail($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $value) {
            $amount = 0;
            $data_return['row_index']++;
            $_parent_index = $data_return['row_index'];
            if(count($value['details']) > 0 || count($value['child_account']) > 0){
                $data_return['html'] .= '<tr class="treegrid-'.$_parent_index.' treegrid-parent-'.$parent_index.' parent-node expanded">
                    <td class="parent">'.$value['name'].'</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>';
            }

            foreach ($value['details'] as $val) { 
            $data_return['row_index']++;
                $amount += $val['amount'];
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' treegrid-parent-'.$_parent_index.'">
                  <td>
                  '. _d($val['date']).'
                  </td>
                  <td>
                  '. html_entity_decode($val['type']).' 
                  </td>
                  <td>
                  '. html_entity_decode($val['description']).' 
                  </td>
                  <td class="total_amount">
                  '. app_format_money($val['debit'], $currency->name).' 
                  </td>
                  <td class="total_amount">
                  '. app_format_money($val['credit'], $currency->name).' 
                  </td>
                  <td class="total_amount">
                  '. app_format_money($val['amount'], $currency->name).' 
                  </td>
                  <td class="total_amount">
                  '. app_format_money($val['balance'], $currency->name).' 
                  </td>
                </tr>';
               }
            $total_amount = $amount;
            $data_return['row_index']++;
           
            if(count($value['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_balance_sheet_detail($value['child_account'], $data_return, $_parent_index, $currency);
                $total_amount += $data_return['total_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '
                  <tr class="treegrid-'.$data_return['row_index'].' treegrid-parent-'.$parent_index.' tr_total">
                      <td>
                      '._l('total_for', $value['name']).'
                      </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                    <td></td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $amount;
        }
        return $data_return; 
    }

    /**
     * get data balance sheet summary recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date         
     * @param  string $accounting_method         
     * @return array                 
     */
    public function get_data_balance_sheet_summary_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        $data_return = [];
        foreach ($accounts as $val) {
            $this->db->where('account', $val['id']);
            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $node = [];
            $balance = 0;
            $amount = 0;

            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;
            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }

            if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                $child_account[] = ['name' => $name, 'amount' => $credits - $debits, 'child_account' => $this->get_data_balance_sheet_summary_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];

            }else{
                $child_account[] = ['name' => $name, 'amount' => $debits - $credits, 'child_account' => $this->get_data_balance_sheet_summary_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];
            }
        }

        return $child_account;
    }

    /**
     * get html balance sheet summary
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_balance_sheet_summary($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $val) {

            $data_return['row_index']++;
            $total_amount = $val['amount'];
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$val['name'].'
              </td>
              <td class="total_amount">
              '.app_format_money($val['amount'], $currency->name).'
              </td>
            </tr>';

            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_balance_sheet_summary($val['child_account'], $data_return, $data_return['row_index'], $currency);

                $total_amount += $data_return['total_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $val['amount'];
        }
        return $data_return; 
    }

    /**
     * get data balance sheet summary recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date         
     * @param  string $accounting_method         
     * @return array                 
     */
    public function get_data_balance_sheet_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        $data_return = [];
        foreach ($accounts as $val) {
            $this->db->where('account', $val['id']);
            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $node = [];
            $balance = 0;
            $amount = 0;

            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;
            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }


            if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                $child_account[] = ['name' => $name, 'amount' => $credits - $debits, 'child_account' => $this->get_data_balance_sheet_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];

            }else{
                $child_account[] = ['name' => $name, 'amount' => $debits - $credits, 'child_account' => $this->get_data_balance_sheet_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];
            }

        }

        return $child_account;
    }

    /**
     * get html balance sheet
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_balance_sheet($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $val) {

            $data_return['row_index']++;
            $total_amount = $val['amount'];
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$val['name'].'
              </td>
              <td class="total_amount">
              '.app_format_money($val['amount'], $currency->name).'
              </td>
            </tr>';

            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_balance_sheet($val['child_account'], $data_return, $data_return['row_index'], $currency);

                $total_amount += $data_return['total_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $val['amount'];
        }
        return $data_return; 
    }

    /**
     * get data custom summary recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date         
     * @param  string $accounting_method 
     * @return array                 
     */
    public function get_data_custom_summary_recursive($data){
        $child_account = $data['child_account'];
        $account_id = $data['account_id'];
        $account_type_id = $data['account_type_id'];
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $accounting_method = $data['accounting_method'];
        $acc_show_account_numbers = $data['acc_show_account_numbers'];
        $display_rows_by = $data['display_rows_by'];
        $display_columns_by = $data['display_columns_by'];

        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        $data_return = [];
       
        foreach ($accounts as $val) {
            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;
            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }


            if($account_type_id == 11 || $account_type_id == 12){
                $child_account[] = ['name' => $name, 'amount' => $credits - $debits, 'child_account' => $this->get_data_custom_summary_recursive([
                            'child_account' => [],
                            'account_id' => $val['id'],
                            'account_type_id' => $account_type_id,
                            'from_date' => $from_date,
                            'to_date' => $to_date,
                            'accounting_method' => $accounting_method,
                            'acc_show_account_numbers' => $acc_show_account_numbers,
                            'display_rows_by' => $display_rows_by,
                            'display_columns_by' => $display_columns_by,
                        ])];
            }else{
                $child_account[] = ['name' => $name, 'amount' => $debits - $credits, 'child_account' => $this->get_data_custom_summary_recursive([
                            'child_account' => [],
                            'account_id' => $val['id'],
                            'account_type_id' => $account_type_id,
                            'from_date' => $from_date,
                            'to_date' => $to_date,
                            'accounting_method' => $accounting_method,
                            'acc_show_account_numbers' => $acc_show_account_numbers,
                            'display_rows_by' => $display_rows_by,
                            'display_columns_by' => $display_columns_by,
                        ])];
            }
        }

        return $child_account;
    }

    /**
     * get html custom summary
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_custom_summary($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $val) {

            $data_return['row_index']++;
            $total_amount = $val['amount'];
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$val['name'].'
              </td>
              <td class="total_amount">
              '.app_format_money($val['amount'], $currency->name).'
              </td>
            </tr>';

            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_custom_summary($val['child_account'], $data_return, $data_return['row_index'], $currency);

                $total_amount += $data_return['total_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $val['amount'];
        }
        return $data_return; 
    }

    /**
     * get data profit and loss as of total income recursive
     * @param  array $child_account         
     * @param  integer $income      
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date         
     * @return array                 
     */
    public function get_data_profit_and_loss_as_of_total_income_recursive($child_account, $income, $account_id, $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        foreach ($accounts as $val) {
            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;
            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                            $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                        }else{
                            $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                        }


            if($account_type_id == 11 || $account_type_id == 12){
                $r_am = $credits - $debits;
            }else{
                $r_am = $debits - $credits;
            }

            if($income != 0){
                $child_account[] = ['name' => $name, 'amount' => $r_am, 'percent' => round((($r_am) / $income) * 100, 2), 'child_account' => $this->get_data_profit_and_loss_as_of_total_income_recursive([], $income, $val['id'], $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];
            }else{
                $child_account[] = ['name' => $name, 'amount' => $r_am, 'percent' => 0, 'child_account' => $this->get_data_profit_and_loss_as_of_total_income_recursive([], $income, $val['id'], $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];
            }
        }

        return $child_account;
    }

    /**
     * get html profit and loss as of total income
     * @param  array $child_account 
     * @param  integer $income 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_profit_and_loss_as_of_total_income($child_account, $income, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        $data_return['percent'] = 0;
        foreach ($child_account as $val) {

            $data_return['row_index']++;
            $total_amount = $val['amount'];
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$val['name'].'
              </td>
              <td class="total_amount">
              '.app_format_money($val['amount'], $currency->name).'
              </td>
              <td class="total_amount">
              '. html_entity_decode($val['percent']).'% 
              </td>
            </tr>';
            

            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $p = $data_return['percent'];
                $data_return = $this->get_html_profit_and_loss_as_of_total_income($val['child_account'], $income, $data_return, $data_return['row_index'], $currency);
                $total_amount += $data_return['total_amount'];

                if($income != 0){
                    $percent = round((($total_amount) / $income) * 100, 2);
                }else{
                    $percent = 0;
                }

                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                  <td class="total_amount">
                  '. html_entity_decode($percent).'% 
                  </td>
                </tr>';
                $data_return['total_amount'] += $t;
                $data_return['percent'] += $p;
            }

            $data_return['total_amount'] += $val['amount'];
            $data_return['percent'] += $val['percent'];
        }
        return $data_return; 
    }

    /**
     * get data profit and loss comparison recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date 
     * @param  string $last_from_date       
     * @param  string $last_to_date         
     * @param  string $accounting_method         
     * @return array                 
     */
    public function get_data_profit_and_loss_comparison_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $last_from_date, $last_to_date, $accounting_method, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        $data_return = [];
       
        foreach ($accounts as $val) {

            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;

            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
            $this->db->where('(date_format(datecreated, \'%Y-%m-%d\') >= "' . $last_from_date . '" and date_format(datecreated, \'%Y-%m-%d\') <= "' . $last_to_date . '")');
            $py_account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $py_credits = $py_account_history->credit != '' ? $py_account_history->credit : 0;
            $py_debits = $py_account_history->debit != '' ? $py_account_history->debit : 0;

            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }


            if($account_type_id == 11 || $account_type_id == 12){
                $child_account[] = ['name' => $name, 'this_year' => $credits - $debits, 'last_year' => $py_credits - $py_debits, 'child_account' => $this->get_data_profit_and_loss_comparison_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $last_from_date, $last_to_date, $accounting_method, $acc_show_account_numbers)];
            }else{
                $child_account[] = ['name' => $name, 'this_year' => $debits - $credits, 'last_year' => $py_debits - $py_credits, 'child_account' => $this->get_data_profit_and_loss_comparison_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $last_from_date, $last_to_date, $accounting_method, $acc_show_account_numbers)];
            }
        }

        return $child_account;
    }

    /**
     * get html profit and loss comparison
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_profit_and_loss_comparison($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $total_py_amount = 0;
        $data_return['total_amount'] = 0;
        $data_return['total_py_amount'] = 0;
        foreach ($child_account as $val) {

            $data_return['row_index']++;
            $total_amount = $val['this_year'];
            $total_py_amount = $val['last_year'];
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$val['name'].'
              </td>
              <td class="total_amount">
              '.app_format_money($val['this_year'], $currency->name).'
              </td>
              <td class="total_amount">
              '.app_format_money($val['last_year'], $currency->name).'
              </td>
            </tr>';
            

            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $p = $data_return['total_py_amount'];
                $data_return = $this->get_html_profit_and_loss_comparison($val['child_account'], $data_return, $data_return['row_index'], $currency);
                $total_amount += $data_return['total_amount'];
                $total_py_amount += $data_return['total_py_amount'];

                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_py_amount, $currency->name).'
                  </td>
                </tr>';
                $data_return['total_amount'] += $t;
                $data_return['total_py_amount'] += $p;
            }

            $data_return['total_amount'] += $val['this_year'];
            $data_return['total_py_amount'] += $val['last_year'];
        }
        return $data_return; 
    }

    /**
     * get data profit and loss detail recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date         
     * @param  string $accounting_method         
     * @return array                 
     */
    public function get_data_profit_and_loss_detail_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        foreach ($accounts as $val) {
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $this->db->order_by('date', 'asc');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
            $node = [];
            $balance = 0;
            $amount = 0;
            foreach ($account_history as $v) {
                if($account_type_id == 11 || $account_type_id == 12){
                    $am = $v['credit'] - $v['debit'];
                }else{
                    $am = $v['debit'] - $v['credit'];
                }
                $node[] =   [
                                'date' => date('Y-m-d', strtotime($v['date'])),
                                'type' => _l($v['rel_type']),
                                'split' => $v['split'] != 0 ? (isset($account_name[$v['split']]) ? $account_name[$v['split']] : '') : '-Split-',
                                'description' => $v['description'],
                                'customer' => $v['customer'],
                                'amount' => $am,
                                'balance' => $balance + $am,
                            ];
                $amount += $am;
                $balance += $am;
            }

            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }

            
            $child_account[] = ['account' => $val['id'], 'name' => $name, 'amount' => $amount, 'balance' => $balance, 'details' => $node, 'child_account' =>  $this->get_data_profit_and_loss_detail_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];
        }

        return $child_account;
    }
    
    /**
     * get html profit and loss detail
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_profit_and_loss_detail($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $value) {
            $amount = 0;
            $data_return['row_index']++;
            $_parent_index = $data_return['row_index'];
            if(count($value['details']) > 0 || count($value['child_account']) > 0){
                $data_return['html'] .= '<tr class="treegrid-'.$_parent_index.' treegrid-parent-'.$parent_index.' parent-node expanded">
                    <td class="parent">'.$value['name'].'</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>';
            }

            foreach ($value['details'] as $val) { 
            $data_return['row_index']++;
                $amount += $val['amount'];
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' treegrid-parent-'.$_parent_index.'">
                  <td>
                  '. _d($val['date']).'
                  </td>
                  <td>
                  '. html_entity_decode($val['type']).' 
                  </td>
                  <td>
                  '. html_entity_decode($val['description']).' 
                  </td>
                  <td>
                  '. html_entity_decode($val['split']).' 
                  </td>
                  <td class="total_amount">
                  '. app_format_money($val['amount'], $currency->name).' 
                  </td>
                  <td class="total_amount">
                  '. app_format_money($val['balance'], $currency->name).' 
                  </td>
                </tr>';
               }
            $total_amount = $amount;
            $data_return['row_index']++;
           
            if(count($value['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_profit_and_loss_detail($value['child_account'], $data_return, $_parent_index, $currency);
                $total_amount += $data_return['total_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '
                  <tr class="treegrid-'.$data_return['row_index'].' treegrid-parent-'.$parent_index.' tr_total">
                      <td>
                      '._l('total_for', $value['name']).'
                      </td>
                    <td></td>
                    <td></td>
                    <td></td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                    <td></td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $amount;
        }
        return $data_return; 
    }

    /**
     * get data profit and loss year to date comparison recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date   
     * @param  string $last_from_date       
     * @param  string $last_to_date         
     * @param  string $accounting_method         
     * @return array                 
     */
    public function get_data_profit_and_loss_year_to_date_comparison_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $last_from_date, $last_to_date, $accounting_method, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        foreach ($accounts as $val) {
            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;

            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->where('(date_format(datecreated, \'%Y-%m-%d\') >= "' . $last_from_date . '" and date_format(datecreated, \'%Y-%m-%d\') <= "' . $last_to_date . '")');
            $py_account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $py_credits = $py_account_history->credit != '' ? $py_account_history->credit : 0;
            $py_debits = $py_account_history->debit != '' ? $py_account_history->debit : 0;

            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }

            if($account_type_id == 11 || $account_type_id == 12){
                $child_account[] = ['name' => $name, 'this_year' => $credits - $debits, 'last_year' => $py_credits - $py_debits, 'child_account' => $this->get_data_profit_and_loss_year_to_date_comparison_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $last_from_date, $last_to_date, $accounting_method, $acc_show_account_numbers)];
            }else{
                $child_account[] = ['name' => $name, 'this_year' => $debits - $credits, 'last_year' => $py_debits - $py_credits, 'child_account' => $this->get_data_profit_and_loss_year_to_date_comparison_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $last_from_date, $last_to_date, $accounting_method, $acc_show_account_numbers)];
            }
        }

        return $child_account;
    }

    /**
     * get html profit and loss year to date comparison
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_profit_and_loss_year_to_date_comparison($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $total_py_amount = 0;
        $data_return['total_amount'] = 0;
        $data_return['total_py_amount'] = 0;
        foreach ($child_account as $val) {

            $data_return['row_index']++;
            $total_amount = $val['this_year'];
            $total_py_amount = $val['last_year'];
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$val['name'].'
              </td>
              <td class="total_amount">
              '.app_format_money($val['this_year'], $currency->name).'
              </td>
              <td class="total_amount">
              '.app_format_money($val['last_year'], $currency->name).'
              </td>
            </tr>';

            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $p = $data_return['total_py_amount'];
                $data_return = $this->get_html_profit_and_loss_year_to_date_comparison($val['child_account'], $data_return, $data_return['row_index'], $currency);
                $total_amount += $data_return['total_amount'];
                $total_py_amount += $data_return['total_py_amount'];

                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_py_amount, $currency->name).'
                  </td>
                </tr>';
                $data_return['total_amount'] += $t;
                $data_return['total_py_amount'] += $p;
            }

            $data_return['total_amount'] += $val['this_year'];
            $data_return['total_py_amount'] += $val['last_year'];
        }
        return $data_return; 
    }

    /**
     * get data profit and loss recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date   
     * @param  string $accounting_method   
     * @return array                 
     */
    public function get_data_profit_and_loss_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        foreach ($accounts as $val) {
            
            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
           
            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;
            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }


            if($account_type_id == 11 || $account_type_id == 12){
                $child_account[] = ['name' => $name, 'amount' => $credits - $debits, 'child_account' => $this->get_data_profit_and_loss_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];
            }else{
                $child_account[] = ['name' => $name, 'amount' => $debits - $credits, 'child_account' => $this->get_data_profit_and_loss_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];
            }
        }

        return $child_account;
    }

    /**
     * get html profit and loss
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_profit_and_loss($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $val) {

            $data_return['row_index']++;
            $total_amount = $val['amount'];
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$val['name'].'
              </td>
              <td class="total_amount">
              '.app_format_money($val['amount'], $currency->name).'
              </td>
            </tr>';

            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_custom_summary($val['child_account'], $data_return, $data_return['row_index'], $currency);

                $total_amount += $data_return['total_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $val['amount'];
        }
        return $data_return; 
    }

    /**
     * get data statement of cash flows recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  integer $account_detail_type_id 
     * @param  string $from_date       
     * @param  string $to_date   
     * @return array                 
     */
    public function get_data_statement_of_cash_flows_recursive($child_account, $account_id, $account_type_id, $account_detail_type_id, $from_date, $to_date, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        foreach ($accounts as $val) {
            if($val['id'] == 13){
                $this->db->where('(rel_type != "invoice" and rel_type != "expense" and rel_type != "payment")');
            }
            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $this->db->where('account', $val['id']);
            
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;
            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }


            if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 10 || $account_type_id == 8 || $account_type_id == 7 || $account_type_id == 4 || $account_type_id == 5 || $account_type_id == 6 || $account_type_id == 2 || $account_type_id == 9 || $account_type_id == 1){
                $child_account[] = ['account_detail_type_id' => $account_detail_type_id, 'name' => $name, 'amount' => $credits - $debits, 'child_account' => $this->get_data_statement_of_cash_flows_recursive([], $val['id'], $account_type_id, $account_detail_type_id, $from_date, $to_date, $acc_show_account_numbers)];
            }else{
                $child_account[] = ['account_detail_type_id' => $account_detail_type_id, 'name' => $name, 'amount' => $debits - $credits, 'child_account' => $this->get_data_statement_of_cash_flows_recursive([], $val['id'], $account_type_id, $account_detail_type_id, $from_date, $to_date, $acc_show_account_numbers)];
            }
        }

        return $child_account;
    }

    /**
     * get html statement of cash flows
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_statement_of_cash_flows($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $val) {

            $data_return['row_index']++;
            $total_amount = $val['amount'];
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$val['name'].'
              </td>
              <td class="total_amount">
              '.app_format_money($val['amount'], $currency->name).'
              </td>
            </tr>';

            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_statement_of_cash_flows($val['child_account'], $data_return, $data_return['row_index'], $currency);

                $total_amount += $data_return['total_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $val['amount'];
        }
        return $data_return; 
    }

    /**
     * get data statement of changes in equity recursive recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  integer $account_detail_type_id 
     * @param  string $from_date       
     * @param  string $to_date   
     * @param  string $accounting_method   
     * @return array                 
     */
    public function get_data_statement_of_changes_in_equity_recursive($child_account, $account_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        foreach ($accounts as $val) {
            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;
            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }

            
            $child_account[] = ['account_detail_type_id' => $value['id'], 'name' => $name, 'amount' => $credits - $debits, 'child_account' => $this->get_data_statement_of_changes_in_equity_recursive([], $val['id'], $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];
        }

        return $child_account;
    }

    /**
     * get html statement of changes in equity
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_statement_of_changes_in_equity($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $val) {

            $data_return['row_index']++;
            $total_amount = $val['amount'];
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$val['name'].'
              </td>
              <td class="total_amount">
              '.app_format_money($val['amount'], $currency->name).'
              </td>
            </tr>';

            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_statement_of_changes_in_equity($val['child_account'], $data_return, $data_return['row_index'], $currency);

                $total_amount += $data_return['total_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $val['amount'];
        }
        return $data_return; 
    }

    /**
     * get data account list recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  array $account_type_name 
     * @param  array $detail_type_name 
     * @return array                 
     */
    public function get_data_account_list_recursive($child_account, $account_id, $account_type_id, $account_type_name, $detail_type_name, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        foreach ($accounts as $val) {
            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('account', $val['id']);
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;
            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }


            $_account_type_name = isset($account_type_name[$val['account_type_id']]) ? $account_type_name[$val['account_type_id']] : '';
            $_detail_type_name = isset($detail_type_name[$val['account_detail_type_id']]) ? $detail_type_name[$val['account_detail_type_id']] : '';

            $child_account[] = ['description' => $val['description'], 'type' => $_account_type_name, 'detail_type' => $_detail_type_name, 'name' => $name, 'amount' => $debits - $credits, 'child_account' => $this->get_data_account_list_recursive([], $val['id'], $account_type_id, $account_type_name, $detail_type_name, $acc_show_account_numbers)];
        }

        return $child_account;
    }

    /**
     * get html account list
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_account_list($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $val) {

            $data_return['row_index']++;
            $total_amount = $val['amount'];
            
            $name = '';

            $name .= $val['name'];

            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$name.'
              </td>
              <td>
              '.$val['type'].'
              </td>
              <td>
              '.$val['detail_type'].'
              </td>
              <td>
              '.$val['description'].'
              </td>
              <td class="total_amount">
              '.app_format_money($val['amount'], $currency->name).'
              </td>
            </tr>';

            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_account_list($val['child_account'], $data_return, $data_return['row_index'], $currency);

                $total_amount += $data_return['total_amount'];
                $data_return['row_index']++;
                
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $val['amount'];
        }
        return $data_return; 
    }


    /**
     * get data general ledger recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date   
     * @param  string $accounting_method   
     * @return array                 
     */
    public function get_data_general_ledger_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        foreach ($accounts as $val) {
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->order_by('date', 'asc');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
            $node = [];
            $balance = 0;
            $amount = 0;
            foreach ($account_history as $v) {
                if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 10 || $account_type_id == 9 || $account_type_id == 8 || $account_type_id == 7 || $account_type_id == 6){
                    $am = $v['credit'] - $v['debit'];
                }else{
                    $am = $v['debit'] - $v['credit'];
                }

                $node[] =   [
                                'date' => date('Y-m-d', strtotime($v['date'])),
                                'type' => _l($v['rel_type']),
                                'split' => $v['split'] != 0 ? (isset($account_name[$v['split']]) ? $account_name[$v['split']] : '') : '-Split-',
                                'description' => $v['description'],
                                'customer' => $v['customer'],
                                'debit' => $v['debit'],
                                'credit' => $v['credit'],
                                'amount' => $am,
                                'balance' => $balance + $am,
                            ];

                $amount += $am;
                $balance += $am;
            }

            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }

            $child_account[] = ['account' => $val['id'], 'name' => $name, 'amount' => $amount, 'balance' => $balance, 'details' => $node, 'child_account' => $this->get_data_general_ledger_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];
        }

        return $child_account;
    }

    /**
     * get html general ledger
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_general_ledger($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $value) {
            $amount = 0;
            $data_return['row_index']++;
            $_parent_index = $data_return['row_index'];
            if(count($value['details']) > 0 || count($value['child_account']) > 0){
                $data_return['html'] .= '<tr class="treegrid-'.$_parent_index.' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' parent-node expanded">
                    <td class="parent">'.$value['name'].'</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>';
            }
            
            foreach ($value['details'] as $val) { 
            $data_return['row_index']++;
                $amount += $val['amount'];
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' treegrid-parent-'.$_parent_index.'">
                  <td>
                  '. _d($val['date']).'
                  </td>
                  <td>
                  '. html_entity_decode($val['type']).' 
                  </td>
                  <td>
                  '. get_company_name($val['customer']).' 
                  </td>
                  <td>
                  '. html_entity_decode($val['description']).' 
                  </td>
                  <td>
                  '. html_entity_decode($val['split']).' 
                  </td>
                  <td class="total_amount">
                  '. app_format_money($val['amount'], $currency->name).' 
                  </td>
                  <td class="total_amount">
                  '. app_format_money($val['balance'], $currency->name).' 
                  </td>
                </tr>';
               }
            $total_amount = $amount;
            $data_return['row_index']++;
            $t = 0;
            if(count($value['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_general_ledger($value['child_account'], $data_return, $_parent_index, $currency);
                $total_amount += $data_return['total_amount'];
            }

            if(count($value['details']) > 0 || count($value['child_account']) > 0){
                $data_return['row_index']++;
                $data_return['html'] .= '
                  <tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                      <td>'._l('total_for', $value['name']).'</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                    <td></td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $amount;
        }
        return $data_return; 
    }
    
    /**
     * get data trial balance recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date   
     * @param  string $accounting_method   
     * @return array                 
     */
    public function get_data_trial_balance_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        foreach ($accounts as $val) {

            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;
            if($credits > $debits){
                $credits = $credits - $debits;
                $debits = 0;
            }else{
                $debits = $debits - $credits;
                $credits = 0;
            }
            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }

            $child_account[] = ['name' => $name, 'debit' => $debits, 'credit' => $credits, 'child_account' => $this->get_data_trial_balance_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];
        }

        return $child_account;
    }
    
    /**
     * get html trial balance
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_trial_balance($child_account, $data_return, $parent_index, $currency){
        $total_debit = 0;
        $total_credit = 0;
        $data_return['total_debit'] = 0;
        $data_return['total_credit'] = 0;
        foreach ($child_account as $val) {
            $data_return['row_index']++;
            $total_debit = $val['debit'];
            $total_credit = $val['credit'];
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$val['name'].'
              </td>
              <td class="total_amount">
              '.app_format_money($val['debit'], $currency->name).'
              </td>
              <td class="total_amount">
              '.app_format_money($val['credit'], $currency->name).'
              </td>
            </tr>';

            if(count($val['child_account']) > 0){
                $d = $data_return['total_debit'];
                $c = $data_return['total_credit'];
                $data_return = $this->get_html_trial_balance($val['child_account'], $data_return, $data_return['row_index'], $currency);

                $total_debit += $data_return['total_debit'];
                $total_credit += $data_return['total_credit'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_debit, $currency->name).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_credit, $currency->name).'
                  </td>
                </tr>';
                $data_return['total_debit'] += $d;
                $data_return['total_credit'] += $c;
            }

            $data_return['total_debit'] += $val['debit'];
            $data_return['total_credit'] += $val['credit'];
        }
        return $data_return; 
    }

    /**
     * get data transaction detail by account recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date   
     * @param  string $accounting_method   
     * @return array                 
     */
    public function get_data_transaction_detail_by_account_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        foreach ($accounts as $val) {
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->order_by('date', 'asc');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
            $node = [];
            $balance = 0;
            $amount = 0;
            foreach ($account_history as $v) {
                if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 10 || $account_type_id == 9 || $account_type_id == 8 || $account_type_id == 7 || $account_type_id == 6){
                    $am = $v['credit'] - $v['debit'];
                }else{
                    $am = $v['debit'] - $v['credit'];
                }
                $node[] =   [
                                'date' => date('Y-m-d', strtotime($v['date'])),
                                'type' => _l($v['rel_type']),
                                'description' => $v['description'],
                                'customer' => $v['customer'],
                                'split' => $v['split'] != 0 ? (isset($account_name[$v['split']]) ? $account_name[$v['split']] : '') : '-Split-',
                                'debit' => $v['debit'],
                                'credit' => $v['credit'],
                                'amount' => $am,
                                'balance' => $balance + ($am),
                            ];
                $amount += $am;
                $balance += $am;
            }

            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }


            $child_account[] = ['account' => $val['id'], 'name' => $name, 'amount' => $amount, 'balance' => $balance, 'details' => $node, 'child_account' => $this->get_data_transaction_detail_by_account_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];
        }

        return $child_account;
    }
    
    /**
     * get html transaction detail by account
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_transaction_detail_by_account($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $value) {
            $amount = 0;
            $data_return['row_index']++;
            $_parent_index = $data_return['row_index'];
            if(count($value['details']) > 0 || count($value['child_account']) > 0){
                $data_return['html'] .= '<tr class="treegrid-'.$_parent_index.' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' parent-node expanded">
                    <td class="parent">'.$value['name'].'</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>';
            }
            
            foreach ($value['details'] as $val) { 
            $data_return['row_index']++;
                $amount += $val['amount'];
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' treegrid-parent-'.$_parent_index.'">
                  <td>
                  '. _d($val['date']).'
                  </td>
                  <td>
                  '. html_entity_decode($val['type']).' 
                  </td>
                  <td>
                  '. get_company_name($val['customer']).' 
                  </td>
                  <td>
                  '. html_entity_decode($val['description']).' 
                  </td>
                  <td>
                  '. html_entity_decode($val['split']).' 
                  </td>
                  <td class="total_amount">
                  '. app_format_money($val['amount'], $currency->name).' 
                  </td>
                  <td class="total_amount">
                  '. app_format_money($val['balance'], $currency->name).' 
                  </td>
                </tr>';
               }
            $total_amount = $amount;
            $data_return['row_index']++;
           
            if(count($value['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_transaction_detail_by_account($value['child_account'], $data_return, $_parent_index, $currency);
                $total_amount += $data_return['total_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '
                  <tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                      <td>
                      '._l('total_for', $value['name']).'
                      </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                    <td></td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $amount;
        }
        return $data_return; 
    }

    /**
     * get data deposit detail recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date   
     * @return array                 
     */
    public function get_data_deposit_detail_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        foreach ($accounts as $val) {

            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $this->db->where('account', $val['id']);
            $this->db->where('((rel_type = "payment" and debit > 0) or (rel_type = "deposit"  and credit > 0))');
            $this->db->order_by('date', 'asc');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();
            $node = [];
            $balance = 0;
            $amount = 0;
            foreach ($account_history as $v) {
                if($account_type_id == 10 || $account_type_id == 9 || $account_type_id == 8 || $account_type_id == 7){
                    $amount += $v['credit'] - $v['debit'];
                    $am = ($v['credit'] - $v['debit']);
                }else{
                    $amount += $v['debit'] - $v['credit'];
                    $am = ($v['debit'] - $v['credit']);
                }

                $node[] =   [
                                'date' => date('Y-m-d', strtotime($v['date'])),
                                'type' => _l($v['rel_type']),
                                'description' => $v['description'],
                                'customer' => $v['customer'],
                                'debit' => $v['debit'],
                                'credit' => $v['credit'],
                                'amount' =>  $am,
                            ];
            }

            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }

            $child_account[] = ['account' => $val['id'], 'name' => $name, 'amount' => $amount, 'details' => $node, 'child_account' => $this->get_data_deposit_detail_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $acc_show_account_numbers)];
            
        }

        return $child_account;
    }

    /**
     * get html transaction detail by account
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_deposit_detail($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $value) {
            $amount = 0;
            $data_return['row_index']++;
            $_parent_index = $data_return['row_index'];
            if(count($value['details']) > 0 || count($value['child_account']) > 0){
                $data_return['html'] .= '<tr class="treegrid-'.$_parent_index.' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' parent-node expanded">
                    <td class="parent">'.$value['name'].'</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>';
            }
            
            foreach ($value['details'] as $val) { 
            $data_return['row_index']++;
                $amount += $val['amount'];
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' treegrid-parent-'.$_parent_index.'">
                  <td>
                  '. _d($val['date']).'
                  </td>
                  <td>
                  '. html_entity_decode($val['type']).' 
                  </td>
                  <td>
                  '. get_company_name($val['customer']).' 
                  </td>
                  <td>
                  '. html_entity_decode($val['description']).' 
                  </td>
                  <td class="total_amount">
                  '. app_format_money($val['amount'], $currency->name).' 
                  </td>
                </tr>';
               }
            $total_amount = $amount;
            $data_return['row_index']++;
           
            if(count($value['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_deposit_detail($value['child_account'], $data_return, $_parent_index, $currency);
                $total_amount += $data_return['total_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '
                  <tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                      <td>
                      '._l('total_for', $value['name']).'
                      </td>
                    <td></td>
                    <td></td>
                    <td></td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $amount;
        }
        return $data_return; 
    }
    

    /**
     * add new account type detail
     * @param array $data
     * @return integer
     */
    public function add_account_type_detail($data)
    {
        if (isset($data['id'])) {
            unset($data['id']);
        }

        $this->db->insert(db_prefix() . 'acc_account_type_details', $data);

        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            return true;
        }

        return false;
    }

    /**
     * update account type detail
     * @param array $data
     * @param integer $id
     * @return integer
     */
    public function update_account_type_detail($data, $id)
    {
        if (isset($data['id'])) {
            unset($data['id']);
        }

        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'acc_account_type_details', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    /**
     * delete account type detail
     * @param integer $id
     * @return boolean
     */

    public function delete_account_type_detail($id)
    {
        $this->db->where('account_detail_type_id',$id);
        $count = $this->db->count_all_results(db_prefix() . 'acc_accounts');

        if($count > 0){
            return 'have_account';
        }

        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'acc_account_type_details');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * get account type details
     * @param  integer $id    member group id
     * @param  array  $where
     * @return object
     */
    public function get_data_account_type_details($id = '', $where = [])
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);
            return $this->db->get(db_prefix() . 'acc_account_type_details')->row();
        }

        $this->db->where($where);
        $this->db->order_by('account_type_id', 'desc');
        $account_type_details = $this->db->get(db_prefix() . 'acc_account_type_details')->result_array();

        $account_types = $this->accounting_model->get_account_types();

        $account_type_name = [];

        foreach ($account_types as $key => $value) {
            $account_type_name[$value['id']] = $value['name'];
        }

        foreach ($account_type_details as $key => $value) {
            $_account_type_name = isset($account_type_name[$value['account_type_id']]) ? $account_type_name[$value['account_type_id']] : '';
            $account_type_details[$key]['account_type_name'] = $_account_type_name;
        }

        return $account_type_details;
    }

    /**
     * Change preferred payment method status / on / off
     * @param  mixed $id     staff id
     * @param  mixed $status status(0/1)
     */
    public function change_preferred_payment_method($id, $status)
    {
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'acc_expense_category_mappings', [
            'preferred_payment_method' => $status,
        ]);
    }

    /**
     * count stock import not convert yet
     * @param  integer $currency
     * @param  string $where
     * @return object          
     */
    public function count_stock_import_not_convert_yet($currency = '', $where = ''){
        $where_currency = '';
        if($currency != ''){
            $where_currency = 'and currency = '.$currency;
        }

        if($where != ''){
            $this->db->where($where);
        }
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_account_history where ' . db_prefix() . 'acc_account_history.rel_id = ' . db_prefix() . 'goods_receipt.id and ' . db_prefix() . 'acc_account_history.rel_type = "stock_import") = 0) '.$where_currency);
        return $this->db->count_all_results(db_prefix().'goods_receipt');
    }

    /**
     * count stock export not convert yet
     * @param  integer $currency
     * @param  string $where
     * @return object          
     */
    public function count_stock_export_not_convert_yet($currency = '', $where = ''){
        $where_currency = '';
        if($currency != ''){
            $where_currency = 'and currency = '.$currency;
        }

        if($where != ''){
            $this->db->where($where);
        }
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_account_history where ' . db_prefix() . 'acc_account_history.rel_id = ' . db_prefix() . 'goods_delivery.id and ' . db_prefix() . 'acc_account_history.rel_type = "stock_export") = 0) '.$where_currency);
        return $this->db->count_all_results(db_prefix().'goods_delivery');
    }

    /**
     * count loss adjustment not convert yet
     * @param  integer $currency
     * @param  string $where
     * @return object          
     */
    public function count_loss_adjustment_not_convert_yet($currency = '', $where = ''){
        $where_currency = '';
        if($currency != ''){
            $where_currency = 'and currency = '.$currency;
        }

        if($where != ''){
            $this->db->where($where);
        }
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_account_history where ' . db_prefix() . 'acc_account_history.rel_id = ' . db_prefix() . 'wh_loss_adjustment.id and ' . db_prefix() . 'acc_account_history.rel_type = "loss_adjustment") = 0) '.$where_currency);
        return $this->db->count_all_results(db_prefix().'wh_loss_adjustment');
    }

    /**
     * count opening stock not convert yet
     * @param  integer $currency
     * @param  string $where
     * @return object          
     */
    public function count_opening_stock_not_convert_yet($currency = '', $where = ''){
        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $date_financial_year = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.date('Y')));

        if($where != ''){
            $this->db->where($where);
        }
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_account_history where ' . db_prefix() . 'acc_account_history.rel_id = ' . db_prefix() . 'items.id and ' . db_prefix() . 'acc_account_history.rel_type = "opening_stock" and date = "'.$date_financial_year.'") = 0)');
        return $this->db->count_all_results(db_prefix().'items');
    }

    /**
     * update payslip automatic conversion
     *
     * @param      array   $data   The data
     *
     * @return     boolean 
     */
    public function update_payslip_automatic_conversion($data){
        $affectedRows = 0;
        
        if(!isset($data['acc_pl_total_insurance_automatic_conversion'])){
            $data['acc_pl_total_insurance_automatic_conversion'] = 0;
        }

        if(!isset($data['acc_pl_tax_paye_automatic_conversion'])){
            $data['acc_pl_tax_paye_automatic_conversion'] = 0;
        }

        if(!isset($data['acc_pl_net_pay_automatic_conversion'])){
            $data['acc_pl_net_pay_automatic_conversion'] = 0;
        }

        foreach ($data as $key => $value) {
            $this->db->where('name', $key);
            $this->db->update(db_prefix() . 'options', [
                    'value' => $value,
                ]);
            if ($this->db->affected_rows() > 0) {
                $affectedRows++;
            }
        }

        if ($affectedRows > 0) {
            return true;
        }
        return false;
    }

    /**
     * get opening stock data tables
     * @param  array $aColumns           table columns
     * @param  mixed $sIndexColumn       main column in table for bettter performing
     * @param  string $sTable            table name
     * @param  array  $join              join other tables
     * @param  array  $where             perform where in query
     * @param  array  $additionalSelect  select additional fields
     * @param  string $sGroupBy group results
     * @return array
     */
    function get_opening_stock_data_tables($aColumns, $sIndexColumn, $sTable, $join = [], $where = [], $additionalSelect = [], $sGroupBy = '', $searchAs = [])
    {
        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $date_financial_year = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.date('Y')));

        $CI          = & get_instance();
        $__post      = $CI->input->post();
        $where = implode(' ', $where);
        $where = trim($where);
        if (startsWith($where, 'AND') || startsWith($where, 'OR')) {
            if (startsWith($where, 'OR')) {
                $where = substr($where, 2);
            } else {
                $where = substr($where, 3);
            }

            $this->db->where($where);
        }
        
        $this->db->select('*, (select count(*) from ' . db_prefix() . 'acc_account_history where ' . db_prefix() . 'acc_account_history.rel_id = ' . db_prefix() . 'items.id and ' . db_prefix() . 'acc_account_history.rel_type = "opening_stock" and ' . db_prefix() . 'acc_account_history.date = "'.$date_financial_year.'") as count_account_historys');
        $this->db->limit(intval($CI->input->post('length')), intval($CI->input->post('start')));
        $this->db->order_by('id', 'desc');

        $items = $this->db->get(db_prefix().'items')->result_array();

        $rResult = [];

        foreach ($items as $key => $value) {
            $value['opening_stock'] = $this->calculate_opening_stock($value['id'], $date_financial_year);
            $rResult[] = $value;
        }

        /* Data set length after filtering */
        $sQuery = '
        SELECT FOUND_ROWS()
        ';
        $_query         = $CI->db->query($sQuery)->result_array();
        $iFilteredTotal = $_query[0]['FOUND_ROWS()'];
        
        /* Total data set length */
        $sQuery = '
        SELECT COUNT(' . $sTable . '.' . $sIndexColumn . ")
        FROM $sTable " . ($where != '' ? 'WHERE '.$where : $where);
        $_query = $CI->db->query($sQuery)->result_array();

        $iTotal = $_query[0]['COUNT(' . $sTable . '.' . $sIndexColumn . ')'];
        /*
         * Output
         */
        $output = [
            'draw'                 => $__post['draw'] ? intval($__post['draw']) : 0,
            'iTotalRecords'        => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData'               => [],
            ];

        return [
            'rResult' => $rResult,
            'output'  => $output,
            ];
    }

    /**
     * calculate opening stock
     * @param  integer $item_id             
     * @param  date $date_financial_year 
     * @return float                     
     */
    public function calculate_opening_stock($item_id, $date_financial_year){
        

        $this->db->where('(' . db_prefix() . 'goods_receipt.date_c >= "' . $date_financial_year.'" and ' . db_prefix() . 'goods_receipt_detail.commodity_code = ' . $item_id.')');
        $this->db->join(db_prefix() . 'goods_receipt', db_prefix() . 'goods_receipt.id=' . db_prefix() . 'goods_receipt_detail.goods_receipt_id', 'left');
        $goods_receipt_detail = $this->db->get(db_prefix().'goods_receipt_detail')->result_array();

        $this->db->where('(' . db_prefix() . 'goods_delivery.date_c >= "' . $date_financial_year.'" and ' . db_prefix() . 'goods_delivery_detail.commodity_code = ' . $item_id.')');
        $this->db->join(db_prefix() . 'goods_delivery', db_prefix() . 'goods_delivery.id=' . db_prefix() . 'goods_delivery_detail.goods_delivery_id', 'left');
        $goods_delivery_detail = $this->db->get(db_prefix().'goods_delivery_detail')->result_array();

        $this->db->where('(date_format(' . db_prefix() . 'wh_loss_adjustment.time, \'%Y-%m-%d\') >= "' . $date_financial_year.'" and ' . db_prefix() . 'wh_loss_adjustment_detail.items = ' . $item_id.')');
        $this->db->join(db_prefix() . 'wh_loss_adjustment', db_prefix() . 'wh_loss_adjustment.id=' . db_prefix() . 'wh_loss_adjustment_detail.loss_adjustment', 'left');
        $wh_loss_adjustment_detail = $this->db->get(db_prefix().'wh_loss_adjustment_detail')->result_array();

        $this->db->where('commodity_id', $item_id);
        $inventory_manage = $this->db->get(db_prefix().'inventory_manage')->result_array();

        $amount = 0;

        foreach($goods_receipt_detail as $value){
            $amount -= ($value['quantities'] * $value['unit_price']);
        }

        foreach($goods_delivery_detail as $value){
            if($value['lot_number'] != ''){
                $this->db->where('lot_number', $value['lot_number']);
                $this->db->where('expiry_date', $value['expiry_date']);
                $receipt_detail = $this->db->get(db_prefix().'goods_receipt_detail')->row();
                if($receipt_detail){
                    $price = $receipt_detail->unit_price;
                }else{
                    $this->db->where('id' ,$item_id);
                    $item = $this->db->get(db_prefix().'items')->row();
                    if($item){
                        $price = $item->purchase_price;
                    }
                }
            }else{
                $this->db->where('id' ,$item_id);
                $item = $this->db->get(db_prefix().'items')->row();
                if($item){
                    $price = $item->purchase_price;
                }
            }

            $amount += ($value['quantities'] * $price);
        }

        foreach($wh_loss_adjustment_detail as $value){
            $price = 0;
            if($value['lot_number'] != ''){
                $this->db->where('lot_number', $value['lot_number']);
                $this->db->where('expiry_date', $value['expiry_date']);
                $receipt_detail = $this->db->get(db_prefix().'goods_receipt_detail')->row();
                if($receipt_detail){
                    $price = $receipt_detail->unit_price;
                }else{
                    $this->db->where('id' ,$item_id);
                    $item = $this->db->get(db_prefix().'items')->row();
                    if($item){
                        $price = $item->purchase_price;
                    }
                }
            }else{
                $this->db->where('id' ,$item_id);
                $item = $this->db->get(db_prefix().'items')->row();
                if($item){
                    $price = $item->purchase_price;
                }
            }

            if($value['current_number'] > $value['updates_number']){
                $amount -= ($value['current_number'] - $value['updates_number']) * $price;
            }else{
                $amount += ($value['updates_number'] - $value['current_number']) * $price;
            }
        }
        foreach($inventory_manage as $value){
            $price = 0;
            if($value['lot_number'] != ''){
                $this->db->where('lot_number', $value['lot_number']);
                $this->db->where('expiry_date', $value['expiry_date']);
                $receipt_detail = $this->db->get(db_prefix().'goods_receipt_detail')->row();
                if($receipt_detail){
                    $price = $receipt_detail->unit_price;
                }else{
                    $this->db->where('id' ,$item_id);
                    $item = $this->db->get(db_prefix().'items')->row();
                    if($item){
                        $price = $item->purchase_price;
                    }
                }
            }else{
                $this->db->where('id' ,$item_id);
                $item = $this->db->get(db_prefix().'items')->row();
                if($item){
                    $price = $item->purchase_price;
                }
            }

            $amount += $value['inventory_number'] * $price;
        }

        return $amount;
    }

    /**
     * get opening stock data
     * @param  integer $item_id 
     * @return object         
     */
    public function get_opening_stock_data($item_id){
        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $date_financial_year = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.date('Y')));

        $this->db->where('id' ,$item_id);
        $item = $this->db->get(db_prefix().'items')->row();

        $item->opening_stock = $this->calculate_opening_stock($item_id, $date_financial_year);

        return $item;
    }

    /**
     * update warehouse automatic conversion
     *
     * @param      array   $data   The data
     *
     * @return     boolean 
     */
    public function update_warehouse_automatic_conversion($data){
        $affectedRows = 0;
        
        if(!isset($data['acc_wh_stock_import_automatic_conversion'])){
            $data['acc_wh_stock_import_automatic_conversion'] = 0;
        }

        if(!isset($data['acc_wh_stock_export_automatic_conversion'])){
            $data['acc_wh_stock_export_automatic_conversion'] = 0;
        }

        if(!isset($data['acc_wh_loss_adjustment_automatic_conversion'])){
            $data['acc_wh_loss_adjustment_automatic_conversion'] = 0;
        }

        if(!isset($data['acc_wh_opening_stock_automatic_conversion'])){
            $data['acc_wh_opening_stock_automatic_conversion'] = 0;
        }

        foreach ($data as $key => $value) {
            $this->db->where('name', $key);
            $this->db->update(db_prefix() . 'options', [
                    'value' => $value,
                ]);
            if ($this->db->affected_rows() > 0) {
                $affectedRows++;
            }
        }

        if ($affectedRows > 0) {
            return true;
        }
        return false;
    }

    /**
     * Automatic payslip conversion
     * @param  integer $payslip_id 
     * @return boolean
     */
    public function automatic_payslip_conversion($payslips_id){
        $this->db->where('rel_id', $payslips_id);
        $this->db->where('rel_type', 'payslip');
        $count = $this->db->count_all_results(db_prefix() . 'acc_account_history');

        if($count > 0){
            return false;
        }

        $this->db->where('id', $payslips_id);
        $payslip = $this->db->get(db_prefix(). 'hrp_payslips')->row();

        $this->db->where('payslip_id', $payslips_id);
        $payslip_details = $this->db->get(db_prefix(). 'hrp_payslip_details')->result_array();

        $insurance_payment_account = get_option('acc_pl_total_insurance_payment_account');
        $insurance_deposit_to = get_option('acc_pl_total_insurance_deposit_to');

        $tax_paye_payment_account = get_option('acc_pl_tax_paye_payment_account');
        $tax_paye_deposit_to = get_option('acc_pl_tax_paye_deposit_to');

        $net_pay_payment_account = get_option('acc_pl_net_pay_payment_account');
        $net_pay_deposit_to = get_option('acc_pl_net_pay_deposit_to');

        $affectedRows = 0;

        if($payslip){
            if(get_option('acc_close_the_books') == 1){
                if(strtotime($payslip->payslip_month) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                    return false;
                }
            }

            $this->load->model('currencies_model');
            $currency = $this->currencies_model->get_base_currency();

            $total_insurance = 0;
            $net_pay = 0;
            $income_tax_paye = 0;
            foreach ($payslip_details as $key => $value) {
                if(is_numeric($value['total_insurance'])){
                    $total_insurance += $value['total_insurance'];
                }

                if(is_numeric($value['net_pay'])){
                    $net_pay += $value['net_pay'];
                }

                if(is_numeric($value['income_tax_paye'])){
                    $income_tax_paye += $value['income_tax_paye'];
                }
            }

            $data_insert = [];

            if(get_option('acc_pl_total_insurance_automatic_conversion') == 1){
                $node = [];
                $node['split'] = $insurance_payment_account;
                $node['account'] = $insurance_deposit_to;
                $node['date'] = $payslip->payslip_month;
                $node['debit'] = $total_insurance;
                $node['credit'] = 0;
                $node['description'] = '';
                $node['rel_id'] = $payslips_id;
                $node['rel_type'] = 'payslip';
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $data_insert[] = $node;

                $node = [];
                $node['split'] = $insurance_deposit_to;
                $node['account'] = $insurance_payment_account;
                $node['date'] = $payslip->payslip_month;
                $node['debit'] = 0;
                $node['credit'] = $total_insurance;
                $node['description'] = '';
                $node['rel_id'] = $payslips_id;
                $node['rel_type'] = 'payslip';
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $data_insert[] = $node;
            }

            if(get_option('acc_pl_tax_paye_automatic_conversion') == 1){
                $node = [];
                $node['split'] = $tax_paye_payment_account;
                $node['account'] = $tax_paye_deposit_to;
                $node['date'] = $payslip->payslip_month;
                $node['debit'] = $income_tax_paye;
                $node['credit'] = 0;
                $node['description'] = '';
                $node['rel_id'] = $payslips_id;
                $node['rel_type'] = 'payslip';
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $data_insert[] = $node;

                $node = [];
                $node['split'] = $tax_paye_deposit_to;
                $node['account'] = $tax_paye_payment_account;
                $node['date'] = $payslip->payslip_month;
                $node['debit'] = 0;
                $node['credit'] = $income_tax_paye;
                $node['description'] = '';
                $node['rel_id'] = $payslips_id;
                $node['rel_type'] = 'payslip';
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $data_insert[] = $node;
            }

            if(get_option('acc_pl_net_pay_automatic_conversion') == 1){
                $node = [];
                $node['split'] = $net_pay_payment_account;
                $node['account'] = $net_pay_deposit_to;
                $node['date'] = $payslip->payslip_month;
                $node['debit'] = $net_pay;
                $node['credit'] = 0;
                $node['description'] = '';
                $node['rel_id'] = $payslips_id;
                $node['rel_type'] = 'payslip';
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $data_insert[] = $node;

                $node = [];
                $node['split'] = $net_pay_deposit_to;
                $node['account'] = $net_pay_payment_account;
                $node['date'] = $payslip->payslip_month;
                $node['debit'] = 0;
                $node['credit'] = $net_pay;
                $node['description'] = '';
                $node['rel_id'] = $payslips_id;
                $node['rel_type'] = 'payslip';
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $data_insert[] = $node;
            }

            if($data_insert != []){
                $affectedRows = $this->db->insert_batch(db_prefix().'acc_account_history', $data_insert);
            }
                
            if ($affectedRows > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Automatic purchase order conversion
     * @param  integer $purchase_order_id 
     * @return boolean
     */
    public function automatic_purchase_order_conversion($purchase_order_id){
        $this->db->where('rel_id', $purchase_order_id);
        $this->db->where('rel_type', 'purchase_orde');
        $count = $this->db->count_all_results(db_prefix() . 'acc_account_history');
        $affectedRows = 0;
        
        if($count > 0){
            return false;
        }

        $this->load->model('purchase/purchase_model');
        $purchase_order = $this->purchase_model->get_pur_order($purchase_order_id);
        $purchase_order_detail = $this->purchase_model->get_pur_order_detail($purchase_order_id);


        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        $payment_account = get_option('acc_pur_order_payment_account');
        $deposit_to = get_option('acc_pur_order_deposit_to');
        $tax_payment_account = get_option('acc_expense_tax_payment_account');
        $tax_deposit_to = get_option('acc_expense_tax_deposit_to');

        if($purchase_order){
            if(get_option('acc_close_the_books') == 1){
                if(strtotime($purchase_order->order_date) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                    return false;
                }
            }
            
            $data_insert = [];

            foreach ($invoice->items as $value) {
                
            }

            foreach ($purchase_order_detail as $value) {

                $item = get_item_hp($value['item_code']);

                $item_id = 0;
                if(isset($item->id)){
                    $item_id = $item->id;
                }

                $item_total = $value['into_money'];

                $item_automatic = $this->get_item_automatic($item_id);

                if($item_automatic){
                    $node = [];
                    $node['split'] = $payment_account;
                    $node['account'] = $item_automatic->expence_account;
                    $node['item'] = $item_id;
                    $node['date'] = $purchase_order->order_date;
                    $node['debit'] = $item_total;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $purchase_order_id;
                    $node['rel_type'] = 'purchase_order';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $item_automatic->expence_account;
                    $node['account'] = $payment_account;
                    $node['item'] = $item_id;
                    $node['date'] = $purchase_order->order_date;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $purchase_order_id;
                    $node['rel_type'] = 'purchase_order';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }else{
                    $node = [];
                    $node['split'] = $payment_account;
                    $node['account'] = $deposit_to;
                    $node['item'] = $item_id;
                    $node['debit'] = $item_total;
                    $node['date'] = $purchase_order->order_date;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $purchase_order_id;
                    $node['rel_type'] = 'purchase_order';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $deposit_to;
                    $node['account'] = $payment_account;
                    $node['item'] = $item_id;
                    $node['date'] = $purchase_order->order_date;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $purchase_order_id;
                    $node['rel_type'] = 'purchase_order';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }

                if(get_option('acc_tax_automatic_conversion') == 1 && $value['tax'] > 0){
                    $tax_payment_account = get_option('acc_expense_tax_payment_account');
                    $tax_deposit_to = get_option('acc_expense_tax_deposit_to');

                    $total_tax = $value['total'] - $value['into_money'];

                    $tax_mapping = $this->get_tax_mapping($value['tax']);

                    if($tax_mapping){
                        $node = [];
                        $node['split'] = $tax_mapping->payment_account;
                        $node['account'] = $tax_mapping->deposit_to;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['date'] = $purchase_order->order_date;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $purchase_order_id;
                        $node['rel_type'] = 'purchase_order';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_mapping->deposit_to;
                        $node['account'] = $tax_mapping->payment_account;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['date'] = $purchase_order->order_date;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $purchase_order_id;
                        $node['rel_type'] = 'purchase_order';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }else{
                        $node = [];
                        $node['split'] = $tax_payment_account;
                        $node['account'] = $tax_deposit_to;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['date'] = $purchase_order->order_date;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $purchase_order_id;
                        $node['rel_type'] = 'purchase_order';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_deposit_to;
                        $node['date'] = $purchase_order->order_date;
                        $node['account'] = $tax_payment_account;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $purchase_order_id;
                        $node['rel_type'] = 'purchase_order';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }
                }
            }

            if($data_insert != []){
                $affectedRows = $this->db->insert_batch(db_prefix().'acc_account_history', $data_insert);
            }
                
            if ($affectedRows > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Automatic stock import conversion
     * @param  integer $stock_import_id 
     * @return boolean
     */
    public function automatic_stock_import_conversion($stock_import_id){
        $this->db->where('rel_id', $stock_import_id);
        $this->db->where('rel_type', 'stock_import');
        $count = $this->db->count_all_results(db_prefix() . 'acc_account_history');
        $affectedRows = 0;
        
        if($count > 0 || get_option('acc_wh_stock_import_automatic_conversion') == 0){
            return false;
        }

        $this->load->model('warehouse/warehouse_model');
        $goods_receipt = $this->warehouse_model->get_goods_receipt($stock_import_id);
        $goods_receipt_detail = $this->warehouse_model->get_goods_receipt_detail($stock_import_id);


        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        $payment_account = get_option('acc_wh_stock_import_payment_account');
        $deposit_to = get_option('acc_wh_stock_import_deposit_to');

        $tax_payment_account = get_option('acc_expense_tax_payment_account');
        $tax_deposit_to = get_option('acc_expense_tax_deposit_to');

        if($goods_receipt){
            if(get_option('acc_close_the_books') == 1){
                if(strtotime($goods_receipt->date_c) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                    return false;
                }
            }
            
            $data_insert = [];

            foreach ($invoice->items as $value) {
                
            }

            foreach ($goods_receipt_detail as $value) {

                $this->db->where('id', $value['commodity_code']);
                $item = $this->db->get(db_prefix().'items')->row();

                $item_id = 0;
                if(isset($item->id)){
                    $item_id = $item->id;
                }

                $item_total = $value['goods_money'];

                $item_automatic = $this->get_item_automatic($item_id);

                if($item_automatic){
                    $node = [];
                    $node['split'] = $payment_account;
                    $node['account'] = $item_automatic->inventory_asset_account;
                    $node['item'] = $item_id;
                    $node['date'] = $goods_receipt->date_c;
                    $node['debit'] = $item_total;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $stock_import_id;
                    $node['rel_type'] = 'stock_import';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $item_automatic->inventory_asset_account;
                    $node['account'] = $payment_account;
                    $node['item'] = $item_id;
                    $node['date'] = $goods_receipt->date_c;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $stock_import_id;
                    $node['rel_type'] = 'stock_import';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }else{
                    $node = [];
                    $node['split'] = $payment_account;
                    $node['account'] = $deposit_to;
                    $node['item'] = $item_id;
                    $node['debit'] = $item_total;
                    $node['date'] = $goods_receipt->date_c;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $stock_import_id;
                    $node['rel_type'] = 'stock_import';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $deposit_to;
                    $node['account'] = $payment_account;
                    $node['item'] = $item_id;
                    $node['date'] = $goods_receipt->date_c;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $stock_import_id;
                    $node['rel_type'] = 'stock_import';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }

                if(get_option('acc_tax_automatic_conversion') == 1 && $value['tax'] > 0){
                    $tax_payment_account = get_option('acc_expense_tax_payment_account');
                    $tax_deposit_to = get_option('acc_expense_tax_deposit_to');

                    $total_tax = $value['tax_money'];

                    $tax_mapping = $this->get_tax_mapping($value['tax']);

                    if($tax_mapping){
                        $node = [];
                        $node['split'] = $tax_mapping->payment_account;
                        $node['account'] = $tax_mapping->deposit_to;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['date'] = $goods_receipt->date_c;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $stock_import_id;
                        $node['rel_type'] = 'stock_import';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_mapping->deposit_to;
                        $node['account'] = $tax_mapping->payment_account;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['date'] = $goods_receipt->date_c;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $stock_import_id;
                        $node['rel_type'] = 'stock_import';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }else{
                        $node = [];
                        $node['split'] = $tax_payment_account;
                        $node['account'] = $tax_deposit_to;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['date'] = $goods_receipt->date_c;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $stock_import_id;
                        $node['rel_type'] = 'stock_import';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_deposit_to;
                        $node['date'] = $goods_receipt->date_c;
                        $node['account'] = $tax_payment_account;
                        $node['tax'] = $value['tax'];
                        $node['item'] = 0;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $stock_import_id;
                        $node['rel_type'] = 'stock_import';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }
                }
            }

            if($data_insert != []){
                $affectedRows = $this->db->insert_batch(db_prefix().'acc_account_history', $data_insert);
            }
                
            if ($affectedRows > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Automatic stock export conversion
     * @param  integer $stock_export_id 
     * @return boolean
     */
    public function automatic_stock_export_conversion($stock_export_id){
        $this->db->where('rel_id', $stock_export_id);
        $this->db->where('rel_type', 'stock_export');
        $count = $this->db->count_all_results(db_prefix() . 'acc_account_history');
        $affectedRows = 0;
        
        if($count > 0 || get_option('acc_wh_stock_export_automatic_conversion') == 0){
            return false;
        }

        $this->load->model('warehouse/warehouse_model');
        $goods_delivery = $this->warehouse_model->get_goods_delivery($stock_export_id);
        $goods_delivery_detail = $this->warehouse_model->get_goods_delivery_detail($stock_export_id);


        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        $payment_account = get_option('acc_wh_stock_export_payment_account');
        $deposit_to = get_option('acc_wh_stock_export_deposit_to');

        $tax_payment_account = get_option('acc_tax_payment_account');
        $tax_deposit_to = get_option('acc_tax_deposit_to');

        if($goods_delivery){
            if(get_option('acc_close_the_books') == 1){
                if(strtotime($goods_delivery->date_c) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                    return false;
                }
            }
            
            $data_insert = [];

            foreach ($invoice->items as $value) {
                
            }

            foreach ($goods_delivery_detail as $value) {

                $this->db->where('id', $value['commodity_code']);
                $item = $this->db->get(db_prefix().'items')->row();

                $item_id = 0;
                if(isset($item->id)){
                    $item_id = $item->id;
                }

                $item_total = ($value['quantities'] * $value['unit_price']);

                $item_automatic = $this->get_item_automatic($item_id);

                if($item_automatic){
                    $node = [];
                    $node['split'] = $payment_account;
                    $node['account'] = $item_automatic->inventory_asset_account;
                    $node['item'] = $item_id;
                    $node['date'] = $goods_delivery->date_c;
                    $node['debit'] = $item_total;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $stock_export_id;
                    $node['rel_type'] = 'stock_export';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $item_automatic->inventory_asset_account;
                    $node['account'] = $payment_account;
                    $node['item'] = $item_id;
                    $node['date'] = $goods_delivery->date_c;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $stock_export_id;
                    $node['rel_type'] = 'stock_export';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }else{
                    $node = [];
                    $node['split'] = $payment_account;
                    $node['account'] = $deposit_to;
                    $node['item'] = $item_id;
                    $node['debit'] = $item_total;
                    $node['date'] = $goods_delivery->date_c;
                    $node['tax'] = 0;
                    $node['credit'] = 0;
                    $node['description'] = '';
                    $node['rel_id'] = $stock_export_id;
                    $node['rel_type'] = 'stock_export';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $deposit_to;
                    $node['account'] = $payment_account;
                    $node['item'] = $item_id;
                    $node['date'] = $goods_delivery->date_c;
                    $node['tax'] = 0;
                    $node['debit'] = 0;
                    $node['credit'] = $item_total;
                    $node['description'] = '';
                    $node['rel_id'] = $stock_export_id;
                    $node['rel_type'] = 'stock_export';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }

                if(get_option('acc_tax_automatic_conversion') == 1 && $value['tax'] > 0){
                    $tax_payment_account = get_option('acc_tax_payment_account');
                    $tax_deposit_to = get_option('acc_tax_deposit_to');

                    $total_tax = $value['total_money'] - $item_total;

                    $tax_mapping = $this->get_tax_mapping($value['tax']);

                    if($tax_mapping){
                        $node = [];
                        $node['split'] = $tax_mapping->payment_account;
                        $node['account'] = $tax_mapping->deposit_to;
                        $node['tax'] = $value['tax_id'];
                        $node['item'] = 0;
                        $node['date'] = $goods_delivery->date_c;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $stock_export_id;
                        $node['rel_type'] = 'stock_export';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_mapping->deposit_to;
                        $node['account'] = $tax_mapping->payment_account;
                        $node['tax'] = $value['tax_id'];
                        $node['item'] = 0;
                        $node['date'] = $goods_delivery->date_c;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $stock_export_id;
                        $node['rel_type'] = 'stock_export';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }else{
                        $node = [];
                        $node['split'] = $tax_payment_account;
                        $node['account'] = $tax_deposit_to;
                        $node['tax'] = $value['tax_id'];
                        $node['item'] = 0;
                        $node['date'] = $goods_delivery->date_c;
                        $node['debit'] = $total_tax;
                        $node['credit'] = 0;
                        $node['description'] = '';
                        $node['rel_id'] = $stock_export_id;
                        $node['rel_type'] = 'stock_export';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;

                        $node = [];
                        $node['split'] = $tax_deposit_to;
                        $node['date'] = $goods_delivery->date_c;
                        $node['account'] = $tax_payment_account;
                        $node['tax'] = $value['tax_id'];
                        $node['item'] = 0;
                        $node['debit'] = 0;
                        $node['credit'] = $total_tax;
                        $node['description'] = '';
                        $node['rel_id'] = $stock_export_id;
                        $node['rel_type'] = 'stock_export';
                        $node['datecreated'] = date('Y-m-d H:i:s');
                        $node['addedfrom'] = get_staff_user_id();
                        $data_insert[] = $node;
                    }
                }
            }

            if($data_insert != []){
                $affectedRows = $this->db->insert_batch(db_prefix().'acc_account_history', $data_insert);
            }
                
            if ($affectedRows > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Automatic loss adjustment conversion
     * @param  integer $loss_adjustment_id 
     * @return boolean
     */
    public function automatic_loss_adjustment_conversion($loss_adjustment_id){
        $this->db->where('rel_id', $loss_adjustment_id);
        $this->db->where('rel_type', 'loss_adjustment');
        $count = $this->db->count_all_results(db_prefix() . 'acc_account_history');
        $affectedRows = 0;
        
        if($count > 0 || get_option('acc_wh_loss_adjustment_automatic_conversion') == 0){
            return false;
        }

        $this->load->model('warehouse/warehouse_model');
        $loss_adjustment = $this->warehouse_model->get_loss_adjustment($loss_adjustment_id);
        $loss_adjustment_detail = $this->warehouse_model->get_loss_adjustment_detailt_by_masterid($loss_adjustment_id);

        $decrease_payment_account = get_option('acc_wh_decrease_payment_account');
        $decrease_deposit_to = get_option('acc_wh_decrease_deposit_to');
        $increase_payment_account = get_option('acc_wh_increase_payment_account');
        $increase_deposit_to = get_option('acc_wh_increase_deposit_to');

        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        if($loss_adjustment){
            if(get_option('acc_close_the_books') == 1){
                if(strtotime(date('Y-m-d', strtotime($loss_adjustment->time))) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                    return false;
                }
            }
            
            $data_insert = [];

            foreach ($loss_adjustment_detail as $value) {
                

                $this->db->where('id', $value['items']);
                $item = $this->db->get(db_prefix().'items')->row();

                $item_id = 0;
                if(isset($item->id)){
                    $item_id = $item->id;
                }

                $price = 0;
                if($value['lot_number'] != ''){
                    $this->db->where('lot_number', $value['lot_number']);
                    $this->db->where('expiry_date', $value['expiry_date']);
                    $receipt_detail = $this->db->get(db_prefix().'goods_receipt_detail')->row();
                    if($receipt_detail){
                        $price = $receipt_detail->unit_price;
                    }else{
                        $this->db->where('id' ,$item_id);
                        $item = $this->db->get(db_prefix().'items')->row();
                        if($item){
                            $price = $item->purchase_price;
                        }
                    }
                }else{
                    $this->db->where('id' ,$item_id);
                    $item = $this->db->get(db_prefix().'items')->row();
                    if($item){
                        $price = $item->purchase_price;
                    }
                }


                $item_automatic = $this->get_item_automatic($item_id);

                if($item_automatic){
                    if($value['current_number'] < $value['updates_number']){
                        $number = $value['updates_number'] - $value['current_number'];
                        $loss_adjustment_payment_account = $increase_payment_account;
                        $loss_adjustment_deposit_to = $item_automatic->inventory_asset_account;
                    }else{
                        $number = $value['current_number'] - $value['updates_number'];
                        $loss_adjustment_payment_account = $item_automatic->inventory_asset_account;
                        $loss_adjustment_deposit_to = $increase_deposit_to;
                    }
                }else{
                    if($value['current_number'] < $value['updates_number']){
                        $number = $value['updates_number'] - $value['current_number'];
                        $loss_adjustment_payment_account = $increase_payment_account;
                        $loss_adjustment_deposit_to = $increase_deposit_to;
                    }else{
                        $number = $value['current_number'] - $value['updates_number'];
                        $loss_adjustment_payment_account = $decrease_payment_account;
                        $loss_adjustment_deposit_to = $decrease_deposit_to;
                    }
                }

                $item_total = $number * $price;

                $node = [];
                $node['split'] = $loss_adjustment_payment_account;
                $node['account'] = $loss_adjustment_deposit_to;
                $node['item'] = $item_id;
                $node['debit'] = $item_total;
                $node['date'] = date('Y-m-d', strtotime($loss_adjustment->time));
                $node['tax'] = 0;
                $node['credit'] = 0;
                $node['description'] = '';
                $node['rel_id'] = $loss_adjustment_id;
                $node['rel_type'] = 'loss_adjustment';
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $data_insert[] = $node;

                $node = [];
                $node['split'] = $loss_adjustment_deposit_to;
                $node['account'] = $loss_adjustment_payment_account;
                $node['item'] = $item_id;
                $node['date'] = date('Y-m-d', strtotime($loss_adjustment->time));
                $node['tax'] = 0;
                $node['debit'] = 0;
                $node['credit'] = $item_total;
                $node['description'] = '';
                $node['rel_id'] = $loss_adjustment_id;
                $node['rel_type'] = 'loss_adjustment';
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $data_insert[] = $node;
            }

            if($data_insert != []){
                $affectedRows = $this->db->insert_batch(db_prefix().'acc_account_history', $data_insert);
            }
                
            if ($affectedRows > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Automatic opening stock conversion
     * @param  integer $loss_adjustment_id 
     * @return boolean
     */
    public function automatic_opening_stock_conversion($opening_stock_id){
        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $date_financial_year = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.date('Y')));

        $this->db->where('rel_id', $opening_stock_id);
        $this->db->where('rel_type', 'opening_stock');
        $this->db->where('date', $date_financial_year);
        $count = $this->db->count_all_results(db_prefix() . 'acc_account_history');
        $affectedRows = 0;
        
        if($count > 0 || get_option('acc_wh_opening_stock_automatic_conversion') == 0){
            return false;
        }

        $opening_stock = $this->get_opening_stock_data($opening_stock_id);

        $deposit_to = get_option('acc_wh_opening_stock_deposit_to');
        $payment_account = get_option('acc_wh_opening_stock_payment_account');


        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        if($opening_stock){
            if(get_option('acc_close_the_books') == 1){
                if(strtotime($date_financial_year) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                    return false;
                }
            }
            
            $data_insert = [];

            $node = [];
            $node['split'] = $payment_account;
            $node['account'] = $deposit_to;
            $node['debit'] = $opening_stock->opening_stock;
            $node['date'] = $date_financial_year;
            $node['credit'] = 0;
            $node['tax'] = 0;
            $node['description'] = '';
            $node['rel_id'] = $opening_stock_id;
            $node['rel_type'] = 'opening_stock';
            $node['datecreated'] = date('Y-m-d H:i:s');
            $node['addedfrom'] = get_staff_user_id();
            $data_insert[] = $node;

            $node = [];
            $node['split'] = $deposit_to;
            $node['account'] = $payment_account;
            $node['date'] = $date_financial_year;
            $node['tax'] = 0;
            $node['debit'] = 0;
            $node['credit'] = $opening_stock->opening_stock;
            $node['description'] = '';
            $node['rel_id'] = $opening_stock_id;
            $node['rel_type'] = 'opening_stock';
            $node['datecreated'] = date('Y-m-d H:i:s');
            $node['addedfrom'] = get_staff_user_id();
            $data_insert[] = $node;

            if($data_insert != []){
                $affectedRows = $this->db->insert_batch(db_prefix().'acc_account_history', $data_insert);
            }
                
            if ($affectedRows > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * update purchase automatic conversion
     *
     * @param      array   $data   The data
     *
     * @return     boolean 
     */
    public function update_purchase_automatic_conversion($data){
        $affectedRows = 0;
        
        if(!isset($data['acc_pur_order_automatic_conversion'])){
            $data['acc_pur_order_automatic_conversion'] = 0;
        }

        if(!isset($data['acc_pur_payment_automatic_conversion'])){
            $data['acc_pur_payment_automatic_conversion'] = 0;
        }

        foreach ($data as $key => $value) {
            $this->db->where('name', $key);
            $this->db->update(db_prefix() . 'options', [
                    'value' => $value,
                ]);
            if ($this->db->affected_rows() > 0) {
                $affectedRows++;
            }
        }

        if ($affectedRows > 0) {
            return true;
        }
        return false;
    }

    /**
     * count purchase order not convert yet
     * @param  integer $currency
     * @param  string $where
     * @return object          
     */
    public function count_purchase_order_not_convert_yet($currency = '', $where = ''){
        $where_currency = '';
        if($currency != ''){
            $where_currency = 'and currency = '.$currency;
        }

        if($where != ''){
            $this->db->where($where);
        }
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_account_history where ' . db_prefix() . 'acc_account_history.rel_id = ' . db_prefix() . 'pur_orders.id and ' . db_prefix() . 'acc_account_history.rel_type = "purchase_order") = 0) '.$where_currency);
        return $this->db->count_all_results(db_prefix().'pur_orders');
    }

    /**
     * count purchase payment not convert yet
     * @param  integer $currency
     * @param  string $where
     * @return object          
     */
    public function count_purchase_payment_not_convert_yet($currency = '', $where = ''){
        $where_currency = '';
        if($currency != ''){
            $where_currency = 'and currency = '.$currency;
        }

        if($where != ''){
            $this->db->where($where);
        }
        $this->db->where('((select count(*) from ' . db_prefix() . 'acc_account_history where ' . db_prefix() . 'acc_account_history.rel_id = ' . db_prefix() . 'pur_invoice_payment.id and ' . db_prefix() . 'acc_account_history.rel_type = "purchase_payment") = 0) AND (' . db_prefix() . 'pur_invoices.pur_order is not null) '.$where_currency);
        $this->db->join(db_prefix().'pur_invoices', db_prefix() . 'pur_invoices.id = ' . db_prefix() . 'pur_invoice_payment.pur_invoice', 'left');
        return $this->db->count_all_results(db_prefix().'pur_invoice_payment');
    }

    /**
     * Automatic payment conversion
     * @param  integer $payment_id 
     * @return boolean
     */
    public function automatic_purchase_payment_conversion($payment_id){
        $this->db->where('rel_id', $payment_id);
        $this->db->where('rel_type', 'purchase_payment');
        $count = $this->db->count_all_results(db_prefix() . 'acc_account_history');

        if($count > 0){
            return false;
        }

        $this->load->model('purchase/purchase_model');
        $payment = $this->purchase_model->get_payment_pur_invoice($payment_id);

        $payment_account = get_option('acc_pur_payment_payment_account');
        $deposit_to = get_option('acc_pur_payment_deposit_to');
        $affectedRows = 0;
        $data_insert = [];

        if($payment){
            if(get_option('acc_close_the_books') == 1){
                if(strtotime($payment->date) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                    return false;
                }
            }

            $payment_total = $payment->amount;

            $payment_mode_mapping = $this->get_payment_mode_mapping($payment->paymentmode);

            if($payment_mode_mapping && get_option('acc_active_payment_mode_mapping') == 1){
                $node = [];
                $node['split'] = $payment_mode_mapping->expense_payment_account;
                $node['account'] = $payment_mode_mapping->expense_deposit_to;
                $node['date'] = $payment->date;
                $node['debit'] = $payment_total;
                $node['credit'] = 0;
                $node['tax'] = 0;
                $node['description'] = '';
                $node['rel_id'] = $payment_id;
                $node['rel_type'] = 'purchase_payment';
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $data_insert[] = $node;

                $node = [];
                $node['split'] = $payment_mode_mapping->expense_deposit_to;
                $node['account'] = $payment_mode_mapping->expense_payment_account;
                $node['date'] = $payment->date;
                $node['tax'] = 0;
                $node['debit'] = 0;
                $node['credit'] = $payment_total;
                $node['description'] = '';
                $node['rel_id'] = $payment_id;
                $node['rel_type'] = 'purchase_payment';
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $data_insert[] = $node;
            }else{
                if(get_option('acc_pur_payment_automatic_conversion') == 1){
                    $node = [];
                    $node['split'] = $payment_account;
                    $node['account'] = $deposit_to;
                    $node['debit'] = $payment_total;
                    $node['credit'] = 0;
                    $node['date'] = $payment->date;
                    $node['description'] = '';
                    $node['rel_id'] = $payment_id;
                    $node['rel_type'] = 'purchase_payment';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;

                    $node = [];
                    $node['split'] = $deposit_to;
                    $node['account'] = $payment_account;
                    $node['date'] = $payment->date;
                    $node['debit'] = 0;
                    $node['credit'] = $payment_total;
                    $node['description'] = '';
                    $node['rel_id'] = $payment_id;
                    $node['rel_type'] = 'purchase_payment';
                    $node['datecreated'] = date('Y-m-d H:i:s');
                    $node['addedfrom'] = get_staff_user_id();
                    $data_insert[] = $node;
                }
            }

            if($data_insert != []){
                $affectedRows = $this->db->insert_batch(db_prefix().'acc_account_history', $data_insert);
            }
                
            if ($affectedRows > 0) {
                return true;
            }
        }

        return false;
    }
    
    public function get_budgets($id = '', $where = []){
        if (is_numeric($id)) {
            $this->db->where('id', $id);
            $budget = $this->db->get(db_prefix() . 'acc_budgets')->row();

            if($budget){
                $this->db->where('budget_id', $id);
                $budget->details = $this->db->get(db_prefix() . 'acc_budget_details')->result_array();
            }
            
            return $budget;
        }

        $this->db->where($where);
        $this->db->order_by('id', 'desc');
        return $this->db->get(db_prefix() . 'acc_budgets')->result_array();
    }

    /**
     * Adds a budget.
     */
    public function add_budget($data){
        $data['name'] = $data['year'].' - '. _l($data['type']);

        $this->db->insert(db_prefix().'acc_budgets', $data);
        $insert_id = $this->db->insert_id();

        if($insert_id){
            return $insert_id;
        }
        return false;
    }

    /**
     * add journal entry
     * @param array $data 
     * @return boolean
     */
    public function update_budget_detail($data){

        $this->db->where('budget_id', $data['budget']);
        $this->db->delete(db_prefix().'acc_budget_details');

        $budget_data = json_decode($data['budget_data']);
        unset($data['budget_data']);

        $columns = $this->get_columns_budget($data['budget'], $data['view_type'], true);
        

        $data_insert = [];
        foreach($budget_data as $row){
            $data_details = array_combine($columns, $row);
            $account_id = '';
            $month = '';
            foreach($data_details as $key => $value){
                if($key == 'account_id'){
                    $account_id = $value;
                }

                if($key != 'account_name' && $key != 'account_id' && $key != 'total' && $value != null){
                    if($data['view_type'] == 'monthly'){
                        $month = explode('_', $key);
                        $data_insert[] = ['budget_id' => $data['budget'], 'month' => $month[0], 'year' => $month[1], 'account' => $account_id, 'amount' => $value];
                    }elseif($data['view_type'] == 'quarterly'){
                        $month = explode('_', $key);

                        if($month[0] == 'q1')
                        {
                            $value_1 = round($value/3);
                            $value_2 = round($value/3);
                            $value_3 = $value - $value_2 - $value_1;
                            $data_insert[] = ['budget_id' => $data['budget'], 'month' => 1, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                            $data_insert[] = ['budget_id' => $data['budget'], 'month' => 2, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_2];
                            $data_insert[] = ['budget_id' => $data['budget'], 'month' => 3, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_3];
                        }
                        else  if($month[0] == 'q2')
                        {
                            $value_1 = round($value/3);
                            $value_2 = round($value/3);
                            $value_3 = $value - $value_2 - $value_1;
                            $data_insert[] = ['budget_id' => $data['budget'], 'month' => 4, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                            $data_insert[] = ['budget_id' => $data['budget'], 'month' => 5, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_2];
                            $data_insert[] = ['budget_id' => $data['budget'], 'month' => 6, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_3];
                        }
                        else  if($month[0] == 'q3')
                        {
                            $value_1 = round($value/3);
                            $value_2 = round($value/3);
                            $value_3 = $value - $value_2 - $value_1;
                            $data_insert[] = ['budget_id' => $data['budget'], 'month' => 7, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                            $data_insert[] = ['budget_id' => $data['budget'], 'month' => 8, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_2];
                            $data_insert[] = ['budget_id' => $data['budget'], 'month' => 9, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_3];
                        }
                        else  if($month[0] == 'q4')
                        {
                            $value_1 = round($value/3);
                            $value_2 = round($value/3);
                            $value_3 = $value - $value_2 - $value_1;
                            $data_insert[] = ['budget_id' => $data['budget'], 'month' => 10, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                            $data_insert[] = ['budget_id' => $data['budget'], 'month' => 11, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_2];
                            $data_insert[] = ['budget_id' => $data['budget'], 'month' => 12, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_3];
                        }
                    }else{
                        $month = explode('_', $key);

                        $value_1 = round($value/12);
                        $value_2 = $value - ($value_1*11);

                        $data_insert[] = ['budget_id' => $data['budget'], 'month' => 1, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                        $data_insert[] = ['budget_id' => $data['budget'], 'month' => 2, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                        $data_insert[] = ['budget_id' => $data['budget'], 'month' => 3, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                        $data_insert[] = ['budget_id' => $data['budget'], 'month' => 4, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                        $data_insert[] = ['budget_id' => $data['budget'], 'month' => 5, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                        $data_insert[] = ['budget_id' => $data['budget'], 'month' => 6, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                        $data_insert[] = ['budget_id' => $data['budget'], 'month' => 7, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                        $data_insert[] = ['budget_id' => $data['budget'], 'month' => 8, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                        $data_insert[] = ['budget_id' => $data['budget'], 'month' => 9, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                        $data_insert[] = ['budget_id' => $data['budget'], 'month' => 10, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                        $data_insert[] = ['budget_id' => $data['budget'], 'month' => 11, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_1];
                        $data_insert[] = ['budget_id' => $data['budget'], 'month' => 12, 'year' => $month[1], 'account' => $account_id, 'amount' => $value_2];
                    }
                }
            }
        }

        if(count($data_insert) > 0){
            $affectedRows = $this->db->insert_batch(db_prefix().'acc_budget_details',  $data_insert);
        }

        return true;
    }

    /**
     * check budget.
     */
    public function check_budget($data){

        $this->db->where('year', $data['year']);
        $this->db->where('type', $data['type']);
        $budget = $this->db->get(db_prefix() . 'acc_budgets')->row();

        if($budget){
            return $budget->id;
        }
        return true;
    }

    /**
     * get data budget
     * @param  array  $data_fill 
     * @param  boolean $only_data 
     * @return object             
     */
    public function get_data_budget($data_fill, $only_data = false)
    {
        if(isset($data_fill['view_type'])){
            switch ($data_fill['view_type']) {
                case 'quarterly':
                $data = $this->get_data_budget_quarterly($data_fill, $only_data);
                break;
                case 'yearly':
                $data = $this->get_data_budget_yearly($data_fill, $only_data);
                break;
                case 'monthly':
                $data = $this->get_data_budget_monthly($data_fill, $only_data);
                break;
                default:
                $data = $this->get_data_budget_monthly($data_fill, $only_data);
                break;
            }
        }else{
            $data = $this->get_data_budget_monthly($data_fill, $only_data);
        }

        return $data;
    }

    /**
     * Gets the data budget.
     *
     * @param      object  $data_fill  The data fill
     *
     * @return     array   The data budget.
     */
    public function get_data_budget_monthly($data_fill, $only_data = false)
    {
        if(isset($data_fill['budget']) && $data_fill['budget'] != 0){
            $budget = $this->get_budgets($data_fill['budget']);            
            if($budget){
                $year = $budget->year;
            }else{
                $year = date('Y');
            }
        }elseif(isset($data_fill['year'])){
            $year = $data_fill['year'];
        }else{
            $year = date('Y');
        }

        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $from_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.$year));
        $to_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.($year + 1)));


        $this->db->where('active', 1);
        if(isset($budget)){
            if($budget->type == 'profit_and_loss_accounts'){
                $this->db->where('find_in_set(account_type_id, "11,12,13,14,15")');
            }elseif($budget->type == 'balance_sheet_accounts'){
                $this->db->where('account_type_id not in (11,12,13,14,15)');
            }
        }
        $this->db->where('(parent_account is null or parent_account = 0)');

        $this->db->order_by('id', 'asc');

        $accounts = $this->db->get(db_prefix() . 'acc_accounts')->result_array();

        $data_return = [];
        $rResult = [];

        foreach ($accounts as $key => $value) {
            $rResult[] = $value;
            $rResult = $this->get_recursive_account($rResult, $value['id'], [], 1);
        }

        $data = [];
        if (isset($budget) && !isset($data_fill['clear'])) {
            foreach($budget->details as $detail){
                if($detail['month'] < 10){
                    $detail['month'] = '0'.$detail['month'];
                }
                if(isset($data[$detail['account']])){
                    $data[$detail['account']][$detail['month'].'_'.$detail['year']] = $detail['amount'];
                    $data[$detail['account']]['total'] += $detail['amount'];
                }else{
                    $data[$detail['account']] = [];
                    $data[$detail['account']][$detail['month'].'_'.$detail['year']] = $detail['amount'];
                    $data[$detail['account']]['total'] = $detail['amount'];
                }
            }
        }

        foreach($rResult as $account){
            $name = '';
            if($account['number'] != ''){
                $name = $account['number'].' - ';
            }

            if (isset($account['level'])) {
                for ($i = 0; $i < $account['level']; $i++) {
                    $name .= '          ';
                }
            }

            if ($account['name'] == '') {
                $name .= _l($account['key_name']);
            } else {
                $name .= $account['name'];
            }

            if(isset($data[$account['id']])){
                $data_return[] = array_merge($data[$account['id']], ['account_name' => $name,'account_id' => $account['id']]);
            }else{
                $data_return[] = ['account_name' => $name,'account_id' => $account['id']];
            }
        }

        return $data_return;
    }

    /**
     * Gets the data budget.
     *
     * @param      object  $data_fill  The data fill
     *
     * @return     array   The data budget.
     */
    public function get_data_budget_quarterly($data_fill, $only_data = false)
    {

        if(isset($data_fill['budget']) && $data_fill['budget'] != 0){
            $budget = $this->get_budgets($data_fill['budget']);
            if($budget){
                $year = $budget->year;
            }else{
                $year = date('Y');
            }
        }elseif(isset($data_fill['year'])){
            $year = $data_fill['year'];
        }else{
            $year = date('Y');
        }

        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $from_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.$year));
        $to_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.($year + 1)));


        $this->db->where('active', 1);
        if(isset($budget)){
            if($budget->type == 'profit_and_loss_accounts'){
                $this->db->where('find_in_set(account_type_id, "11,12,13,14,15")');
            }elseif($budget->type == 'balance_sheet_accounts'){
                $this->db->where('account_type_id not in (11,12,13,14,15)');
            }
        }
        $this->db->where('(parent_account is null or parent_account = 0)');

        $this->db->order_by('id', 'asc');

        $accounts = $this->db->get(db_prefix() . 'acc_accounts')->result_array();

        $data_return = [];
        $rResult = [];

        foreach ($accounts as $key => $value) {
            $rResult[] = $value;
            $rResult = $this->get_recursive_account($rResult, $value['id'], [], 1);
        }

        $data = [];
        if (isset($budget) && !isset($data_fill['clear'])) {
            foreach($budget->details as $detail){
                if($detail['month'] < 10){
                    $detail['month'] = '0'.$detail['month'];
                }

                if($detail['month']>=1 && $detail['month']<=3)
                {
                    $t = 'q1_'.$detail['year'];
                }
                else  if($detail['month']>=4 && $detail['month']<=6)
                {
                    $t = 'q2_'.$detail['year'];
                }
                else  if($detail['month']>=7 && $detail['month']<=9)
                {
                    $t = 'q3_'.$detail['year'];
                }
                else  if($detail['month']>=10 && $detail['month']<=12)
                {
                    $t = 'q4_'.$detail['year'];
                }
                
                if(isset($data[$detail['account']])){
                    if(isset($data[$detail['account']][$t])){
                        $data[$detail['account']][$t] += $detail['amount'];
                    }else{
                        $data[$detail['account']][$t] = $detail['amount'];
                    }

                    if(isset($data[$detail['account']]['total'])){
                        $data[$detail['account']]['total'] += $detail['amount'];
                    }else{
                        $data[$detail['account']]['total'] = $detail['amount'];
                    }

                }else{
                    $data[$detail['account']] = [];
                    $data[$detail['account']][$t] = $detail['amount'];
                    $data[$detail['account']]['total'] = $detail['amount'];
                }
            }
        }

        foreach($rResult as $account){
            $name = '';
            if($account['number'] != ''){
                $name = $account['number'].' - ';
            }

            if (isset($account['level'])) {
                for ($i = 0; $i < $account['level']; $i++) {
                    $name .= '          ';
                }
            }

            if ($account['name'] == '') {
                $name .= _l($account['key_name']);
            } else {
                $name .= $account['name'];
            }

            if(isset($data[$account['id']])){
                $data_return[] = array_merge($data[$account['id']], ['account_name' => $name,'account_id' => $account['id']]);
            }else{
                $data_return[] = ['account_name' => $name,'account_id' => $account['id']];
            }
        }

        return $data_return;

    }

    /**
     * Gets the data budget.
     *
     * @param      object  $data_fill  The data fill
     *
     * @return     array   The data budget.
     */
    public function get_data_budget_yearly($data_fill, $only_data = false)
    {
        if(isset($data_fill['budget']) && $data_fill['budget'] != 0){
            $budget = $this->get_budgets($data_fill['budget']);
            if($budget){
                $year = $budget->year;
            }else{
                $year = date('Y');
            }
        }elseif(isset($data_fill['year'])){
            $year = $data_fill['year'];
        }else{
            $year = date('Y');
        }

        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $from_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.$year));
        $to_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.($year + 1)));

        $this->db->where('active', 1);
        if(isset($budget)){
            if($budget->type == 'profit_and_loss_accounts'){
                $this->db->where('find_in_set(account_type_id, "11,12,13,14,15")');
            }elseif($budget->type == 'balance_sheet_accounts'){
                $this->db->where('account_type_id not in (11,12,13,14,15)');
            }
        }
        $this->db->where('(parent_account is null or parent_account = 0)');

        $this->db->order_by('id', 'asc');

        $accounts = $this->db->get(db_prefix() . 'acc_accounts')->result_array();

        $data_return = [];
        $rResult = [];

        foreach ($accounts as $key => $value) {
            $rResult[] = $value;
            $rResult = $this->get_recursive_account($rResult, $value['id'], [], 1);
        }

        $data = [];
        if (isset($budget) && !isset($data_fill['clear'])) {
            foreach($budget->details as $detail){

                if(isset($data[$detail['account']])){
                    if(isset($data[$detail['account']]['_'.$detail['year']])){
                        $data[$detail['account']]['_'.$detail['year']] += $detail['amount'];
                    }else{
                        $data[$detail['account']]['_'.$detail['year']] = $detail['amount'];
                    }

                    $data[$detail['account']]['total'] += $detail['amount'];
                }else{
                    $data[$detail['account']] = [];
                    $data[$detail['account']]['_'.$detail['year']] = $detail['amount'];
                    $data[$detail['account']]['total'] = $detail['amount'];
                }
            }
        }

        foreach($rResult as $account){
            $name = '';
            if($account['number'] != ''){
                $name = $account['number'].' - ';
            }

            if (isset($account['level'])) {
                for ($i = 0; $i < $account['level']; $i++) {
                    $name .= '          ';
                }
            }

            if ($account['name'] == '') {
                $name .= _l($account['key_name']);
            } else {
                $name .= $account['name'];
            }
            if(isset($data[$account['id']])){
                $data_return[] = array_merge(['account_name' => $name,'account_id' => $account['id']], $data[$account['id']]);
            }else{
                $data_return[] = ['account_name' => $name,'account_id' => $account['id']];
            }
        }

        return $data_return;
    }

    /**
     * Gets the nestedheaders budget.
     *
     * @param      integer  $budget_id 
     * @param      string  $budget_type    monthly or quarterly or yearly
     *
     * @return     array   The nestedheaders budget.
     */
    public function get_nestedheaders_budget($budget_id, $budget_type)
    {

        $budget = $this->get_budgets($budget_id);

        $year = $budget->year;
        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $from_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.$year));
        $to_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.($year + 1)));

        $nestedheaders    = [];
        $nestedheaders[] = _l('acc_account');
        $nestedheaders[] = _l('account_id');

        switch ($budget_type) {
            case 'yearly':
                $nestedheaders[] = $year;
                if($acc_first_month_of_financial_year != 'January'){
                    $nestedheaders[] = $year+1;
                    $nestedheaders[] = _l('total');
                }
            break;
            case 'quarterly':
            while (strtotime($from_date) < strtotime($to_date)) {
                $month = date('m', strtotime($from_date));
                $year = date('Y', strtotime($from_date));
                if($month>=1 && $month<=3)
                {
                    $t = 'Q1 - '.$year;
                }
                else  if($month>=4 && $month<=6)
                {
                    $t = 'Q2 - '.$year;
                }
                else  if($month>=7 && $month<=9)
                {
                    $t = 'Q3 - '.$year;
                }
                else  if($month>=10 && $month<=12)
                {
                    $t = 'Q4 - '.$year;
                }

                if(!in_array($t, $nestedheaders)){
                    $nestedheaders[] = $t;
                }

                $from_date = date('Y-m-d', strtotime('+1 month', strtotime($from_date)));
            }
            $nestedheaders[] = _l('total');

            break;
            case 'monthly':
            while (strtotime($from_date) < strtotime($to_date)) {

                $month = date('M - Y', strtotime($from_date));

                $nestedheaders[] = $month;

                $from_date = date('Y-m-d', strtotime('+1 month', strtotime($from_date)));

                if(strtotime($from_date) > strtotime($to_date)){
                    $month_2 = date('M - Y', strtotime($to_date));

                    if($month != $month_2){
                        $nestedheaders[] = $month_2;
                    }
                }
            }

            $nestedheaders[] = _l('total');

            break;
            default:
            break;
        }

        return $nestedheaders;
    }

    /**
     * Gets the columns budget.
     *
     * @param      integer  $budget_id 
     * @param      string  $budget_type    day or week or month
     *
     * @return     array   The columns budget.
     */
    public function get_columns_budget($budget_id, $budget_type, $only_data = false)
    {
        $budget = $this->get_budgets($budget_id);

        $year = $budget->year;

        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $from_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.$year));
        $to_date = date('Y-m-t', strtotime($from_date . '  - 1 month + 1 year '));

       
        if($only_data){
            $columns = ['account_name', 'account_id'];
        }else{
            $columns = [['data' => 'account_name', 'type' => 'text', 'readOnly' => true],
                ['data' => 'account_id', 'type' => 'text', 'readOnly' => true]
            ];
        }

        switch ($budget_type) {
            case 'yearly':
                if($acc_first_month_of_financial_year != 'January'){
                    if($only_data){
                        array_push($columns, '_'.$year);
                        array_push($columns, '_'.($year+1));
                    }else{
                        array_push($columns, ['data' => '_'.$year, 'type' => 'numeric', 'numericFormat' => [
                            'pattern' => '0.00',
                        ]]);
                        array_push($columns, ['data' => '_'.($year+1), 'type' => 'numeric', 'numericFormat' => [
                            'pattern' => '0.00',
                        ]]);
                    }

                    if($only_data){
                        array_push($columns, 'total');
                    }else{
                        array_push($columns, ['data' => 'total', 'type' => 'numeric', 'numericFormat' => [
                            'pattern' => '0.00'
                        ],'readOnly' => true]);
                    }
                }else{
                    if($only_data){
                        array_push($columns, '_'.$year);
                    }else{
                        array_push($columns, ['data' => '_'.$year, 'type' => 'numeric', 'numericFormat' => [
                            'pattern' => '0.00',
                        ]]);
                    }
                }


            break;
            case 'quarterly':
            $nestedheaders = [];
            while (strtotime($from_date) < strtotime($to_date)) {
                $month = date('m', strtotime($from_date));
                $year = date('Y', strtotime($from_date));

                if($month>=1 && $month<=3)
                {
                    $t = 'q1_'.$year;
                }
                else  if($month>=4 && $month<=6)
                {
                    $t = 'q2_'.$year;
                }
                else  if($month>=7 && $month<=9)
                {
                    $t = 'q3_'.$year;
                }
                else  if($month>=10 && $month<=12)
                {
                    $t = 'q4_'.$year;
                }

                if(!in_array($t, $nestedheaders)){
                    $nestedheaders[] = $t;

                    if($only_data){
                        array_push($columns, $t);
                    }else{
                        array_push($columns, ['data' => $t, 'type' => 'numeric', 'numericFormat' => [
                            'pattern' => '0.00',
                        ]]);
                    }
                }

                $from_date = date('Y-m-d', strtotime('+1 month', strtotime($from_date)));
            }

            if($only_data){
                array_push($columns, 'total');
            }else{
                array_push($columns, ['data' => 'total', 'type' => 'numeric', 'numericFormat' => [
                    'pattern' => '0.00'
                ],'readOnly' => true]);
            }

            break;
            case 'monthly':

            while (strtotime($from_date) < strtotime($to_date)) {
                $month = date('m_Y', strtotime($from_date));

                if($only_data){
                    array_push($columns, $month);
                }else{
                    array_push($columns, ['data' => $month, 'type' => 'numeric', 'numericFormat' => [
                        'pattern' => '0.00',
                    ]]);
                }
                $from_date = date('Y-m-d', strtotime('+1 month', strtotime($from_date)));

                if(strtotime($from_date) > strtotime($to_date)){
                    $month_2 = date('m_Y', strtotime($to_date));

                    if($month != $month_2){
                        if($only_data){
                            array_push($columns, $month_2);
                        }else{
                            array_push($columns, ['data' => $month_2, 'type' => 'numeric', 'numericFormat' => [
                                'pattern' => '0.00',
                            ]]);
                        }
                    }
                }
            }

            if($only_data){
                array_push($columns, 'total');
            }else{
                array_push($columns, ['data' => 'total', 'type' => 'numeric', 'numericFormat' => [
                    'pattern' => '0.00'
                ],'readOnly' => true]);
            }

            break;
            default:
            break;
        }

        return $columns;
    }

    /**
     * Gets the columns budget.
     *
     * @param      string  $from_date  The from date format dd/mm/YYYY
     * @param      string  $to_date    To date format dd/mm/YYYY
     *
     * @return     array   The columns budget.
     */
    public function get_columns_budget_by_month($from_date, $to_date)
    {
        $visible = [];
        $visible[1] = get_option('staff_workload_monday_visible');
        $visible[2] = get_option('staff_workload_tuesday_visible');
        $visible[3] = get_option('staff_workload_thursday_visible');
        $visible[4] = get_option('staff_workload_wednesday_visible');
        $visible[5] = get_option('staff_workload_friday_visible');
        $visible[6] = get_option('staff_workload_saturday_visible');
        $visible[7] = get_option('staff_workload_sunday_visible');
        
        
        if (!$this->check_format_date($from_date)) {
            $from_date = to_sql_date($from_date);
        }
        if (!$this->check_format_date($to_date)) {
            $to_date = to_sql_date($to_date);
        }
        $columns = [['data' => 'staff_name', 'type' => 'text', 'readOnly' => true],
        ['data' => 'staff_id', 'type' => 'text', 'readOnly' => true],
        ['data' => 'capacity', 'type' => 'text', 'readOnly' => true],
        ['data' => 'remainCapacityEstimated', 'type' => 'numeric', 'readOnly' => true, 'numericFormat' => ['pattern' => '0.00']],
        ['data' => 'remainCapacity', 'type' => 'numeric', 'readOnly' => true, 'numericFormat' => ['pattern' => '0.00']],
        ['data' => 'staff_department', 'type' => 'text', 'readOnly' => true],
        ['data' => 'staff_role', 'type' => 'text', 'readOnly' => true]];
        while (strtotime($from_date) < strtotime($to_date)) {
            if($visible[date('N', strtotime($from_date))] == 1){
                array_push($columns, ['data' => date('d_m_Y', strtotime($from_date)) . '_e', 'type' => 'numeric', 'numericFormat' => [
                    'pattern' => '0.00',
                ]]);
                array_push($columns, ['data' => date('d_m_Y', strtotime($from_date)) . '_s', 'type' => 'numeric', 'numericFormat' => [
                    'pattern' => '0.00',
                ]]);
            }
            $from_date = date('Y-m-d', strtotime('+1 day', strtotime($from_date)));
        }
        return $columns;
    }

    /**
     * update a budget.
     */
    public function update_budget($data, $id){
        $this->db->where('id', $id);
        $this->db->update(db_prefix().'acc_budgets', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

        /**
     * check reconcile restored
     * @param  [type] $account 
     * @param  [type] $company 
     * @return [type]          
     */
    public function check_reconcile_restored($account){
        $restored = false;

        $this->db->where('account', $account);
        $this->db->where('opening_balance', 0);
        $this->db->where('finish', 1);
        $this->db->order_by('id', 'desc');
        $reconcile = $this->db->get(db_prefix() . 'acc_reconciles')->result_array();

        if(count($reconcile) > 0){
            $reconcile = true;
        }

        return $reconcile;
    }

    /**
     * reconcile restored
     * @param  [type] $account 
     * @return [type]          
     */
    public function reconcile_restored($account)
    {
        $affected_rows=0;
        //get reconcile
        $this->db->where('account', $account);
        $this->db->where('finish', 1);
        $this->db->order_by('ending_date', 'desc');

        $reconcile = $this->db->get(db_prefix() . 'acc_reconciles')->row();

        if($reconcile){
            $this->db->where('reconcile', $reconcile->id);
            $this->db->update(db_prefix() . 'acc_account_history', ['reconcile' => 0]);
 
            if ($this->db->affected_rows() > 0) {
                $affected_rows++;

                $this->db->where('id', $reconcile->id);
                $this->db->delete(db_prefix().'acc_reconciles');

                if ($this->db->affected_rows() > 0) {
                    $affected_rows++;
                }
            }
        }

        if($affected_rows > 0){
            return true;
        }
        return false;
    }

    /**
     * get data accounts receivable ageing detail
     * @return array 
     */
    public function get_data_accounts_receivable_ageing_detail($data_filter){
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $data_report = [];
        $data_report['current'] = [];
        $data_report['1_30_days_past_due'] = [];
        $data_report['31_60_days_past_due'] = [];
        $data_report['61_90_days_past_due'] = [];
        $data_report['91_and_over'] = [];

        $this->db->select('*, (select sum(amount) from '.db_prefix() . 'invoicepaymentrecords where invoiceid = '.db_prefix().'invoices.id) as total_payments');
        $this->db->where('IF(duedate IS NOT NULL,(date <= "' . $to_date . '" and duedate >= "' . $to_date . '"),(date = "' .  $to_date . '")) and (status = 1 or status = 3 or status = 4)');

        $this->db->order_by('date', 'asc');
        
        $invoices = $this->db->get(db_prefix().'invoices')->result_array();
        
        foreach ($invoices as $v) {
            $data_report['current'][] = [
                'date' => $v['date'],
                'duedate' => $v['duedate'],
                'type' => _l('invoice'),
                'number' => format_invoice_number($v['id']),
                'customer' => $v['clientid'],
                'amount' => $v['total'] - $v['total_payments'],
            ];
        }

        $this->db->select('*, (select sum(amount) from '.db_prefix() . 'invoicepaymentrecords where invoiceid = '.db_prefix().'invoices.id) as total_payments');
        $this->db->where('IF(duedate IS NOT NULL,(duedate >=  "' . date('Y-m-d', strtotime($to_date.' - 30 days')) . '" and duedate <= "' . date('Y-m-d', strtotime($to_date.' - 1 days')) . '"),(date >=  "' . date('Y-m-d', strtotime($to_date.' - 30 days')) . '" and date <= "' . date('Y-m-d', strtotime($to_date.' - 1 days')) . '")) and (status = 1 or status = 3 or status = 4)');

        $this->db->order_by('date', 'asc');
        
        $invoices = $this->db->get(db_prefix().'invoices')->result_array();
        
        foreach ($invoices as $v) {
            $data_report['1_30_days_past_due'][] = [
                'date' => $v['date'],
                'duedate' => $v['duedate'],
                'type' => _l('invoice'),
                'number' => format_invoice_number($v['id']),
                'customer' => $v['clientid'],
                'amount' => $v['total'] - $v['total_payments'],
            ];
        }

        $this->db->select('*, (select sum(amount) from '.db_prefix() . 'invoicepaymentrecords where invoiceid = '.db_prefix().'invoices.id) as total_payments');
        $this->db->where('IF(duedate IS NOT NULL,(duedate >=  "' . date('Y-m-d', strtotime($to_date.' - 60 days')) . '" and duedate <= "' . date('Y-m-d', strtotime($to_date.' - 31 days')) . '"),(date >=  "' . date('Y-m-d', strtotime($to_date.' - 60 days')) . '" and date <= "' . date('Y-m-d', strtotime($to_date.' - 31 days')) . '")) and (status = 1 or status = 3 or status = 4)');

        $this->db->order_by('date', 'asc');
        
        $invoices = $this->db->get(db_prefix().'invoices')->result_array();
        
        foreach ($invoices as $v) {
            $data_report['31_60_days_past_due'][] = [
                'date' => $v['date'],
                'duedate' => $v['duedate'],
                'type' => _l('invoice'),
                'number' => format_invoice_number($v['id']),
                'customer' => $v['clientid'],
                'amount' => $v['total'] - $v['total_payments'],
            ];
        }

        $this->db->select('*, (select sum(amount) from '.db_prefix() . 'invoicepaymentrecords where invoiceid = '.db_prefix().'invoices.id) as total_payments');
        $this->db->where('IF(duedate IS NOT NULL,(duedate >=  "' . date('Y-m-d', strtotime($to_date.' - 90 days')) . '" and duedate <= "' . date('Y-m-d', strtotime($to_date.' - 61 days')) . '"),(date >=  "' . date('Y-m-d', strtotime($to_date.' - 90 days')) . '" and date <= "' . date('Y-m-d', strtotime($to_date.' - 61 days')) . '")) and (status = 1 or status = 3 or status = 4)');

        $this->db->order_by('date', 'asc');
        
        $invoices = $this->db->get(db_prefix().'invoices')->result_array();
        
        foreach ($invoices as $v) {
            $data_report['61_90_days_past_due'][] = [
                'date' => $v['date'],
                'duedate' => $v['duedate'],
                'type' => _l('invoice'),
                'number' => format_invoice_number($v['id']),
                'customer' => $v['clientid'],
                'amount' => $v['total'] - $v['total_payments'],
            ];
        }

        $this->db->select('*, (select sum(amount) from '.db_prefix() . 'invoicepaymentrecords where invoiceid = '.db_prefix().'invoices.id) as total_payments');
        $this->db->where('IF(duedate IS NOT NULL,(duedate <=  "' . date('Y-m-d', strtotime($to_date.' - 91 days')) . '"),(date <=  "' . date('Y-m-d', strtotime($to_date.' - 91 days')) . '")) and (status = 1 or status = 3 or status = 4)');

        $this->db->order_by('date', 'asc');
        
        $invoices = $this->db->get(db_prefix().'invoices')->result_array();
        
        foreach ($invoices as $v) {
            $data_report['91_and_over'][] = [
                'date' => $v['date'],
                'duedate' => $v['duedate'],
                'type' => _l('invoice'),
                'number' => format_invoice_number($v['id']),
                'customer' => $v['clientid'],
                'amount' => $v['total'] - $v['total_payments'],
            ];
        }
        
        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
    }

    /**
     * get data accounts payable ageing detail
     * @return array 
     */
    public function get_data_accounts_payable_ageing_detail($data_filter){
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }


        $this->db->where('paymentmode', '');
        $expenses = $this->db->get(db_prefix().'expenses')->result_array();

        $list_expenses = [];
        foreach ($expenses as $key => $value) {
            $list_expenses[] = $value['id'];
        }
        $list_expenses = implode(',', $list_expenses);

        $this->db->where('account_detail_type_id', 1004);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();

        $list_accounts = [];
        foreach ($accounts as $key => $value) {
            $list_accounts[] = $value['id'];
        }
        $list_accounts = implode(',', $list_accounts);

        $data_report = [];
        $data_report['current'] = [];
        $data_report['1_30_days_past_due'] = [];
        $data_report['31_60_days_past_due'] = [];
        $data_report['61_90_days_past_due'] = [];
        $data_report['91_and_over'] = [];

        $this->db->select('*, ' . db_prefix() . 'expenses.id as expense_id, ' . db_prefix() . 'taxes.taxrate as taxrate, ' . db_prefix() . 'taxes_2.taxrate as taxrate2');
        $this->db->where('date = "' .  $to_date . '" and paymentmode = ""');
        $this->db->join(db_prefix() . 'taxes', '' . db_prefix() . 'taxes.id = ' . db_prefix() . 'expenses.tax', 'left');
        $this->db->join('' . db_prefix() . 'taxes as ' . db_prefix() . 'taxes_2', '' . db_prefix() . 'taxes_2.id = ' . db_prefix() . 'expenses.tax2', 'left');
        $this->db->order_by('date', 'asc');
        $expenses = $this->db->get(db_prefix().'expenses')->result_array();
        
        foreach ($expenses as $v) {
            $total = $v['amount'];

            if($v['tax'] != 0){
                $total += ($total / 100 * $v['taxrate']);
            }
            if($v['tax2'] != 0){
                $total += ($v['amount'] / 100 * $v['taxrate2']);
            }

            $data_report['current'][] = [
                'date' => $v['date'],
                'duedate' => $v['date'],
                'type' => _l('expenses'),
                'number' => '#'.$v['expense_id'],
                'vendor' => $v['vendor'],
                'customer' => $v['clientid'],
                'amount' => $total,
            ];
        }

        $this->db->select('*, ' . db_prefix() . 'expenses.id as expense_id, ' . db_prefix() . 'taxes.taxrate as taxrate, ' . db_prefix() . 'taxes_2.taxrate as taxrate2');
        $this->db->where('(date >= "' .  date('Y-m-d', strtotime($to_date.' - 30 days')) . '" and date <= "' . date('Y-m-d', strtotime($to_date.' - 1 days')) . '") and paymentmode = ""');
        $this->db->join(db_prefix() . 'taxes', '' . db_prefix() . 'taxes.id = ' . db_prefix() . 'expenses.tax', 'left');
        $this->db->join('' . db_prefix() . 'taxes as ' . db_prefix() . 'taxes_2', '' . db_prefix() . 'taxes_2.id = ' . db_prefix() . 'expenses.tax2', 'left');
        $this->db->order_by('date', 'asc');
        $expenses = $this->db->get(db_prefix().'expenses')->result_array();
        
        foreach ($expenses as $v) {
            $total = $v['amount'];

            if($v['tax'] != 0){
                $total += ($total / 100 * $v['taxrate']);
            }
            if($v['tax2'] != 0){
                $total += ($v['amount'] / 100 * $v['taxrate2']);
            }

            $data_report['1_30_days_past_due'][] = [
                'date' => $v['date'],
                'duedate' => $v['date'],
                'type' => _l('expenses'),
                'number' => '#'.$v['expense_id'],
                'vendor' => $v['vendor'],
                'customer' => $v['clientid'],
                'amount' => $total,
            ];
        }

        $this->db->select('*, ' . db_prefix() . 'expenses.id as expense_id, ' . db_prefix() . 'taxes.taxrate as taxrate, ' . db_prefix() . 'taxes_2.taxrate as taxrate2');
        $this->db->where('(date >= "' .  date('Y-m-d', strtotime($to_date.' - 60 days')) . '" and date <= "' . date('Y-m-d', strtotime($to_date.' - 31 days')) . '") and paymentmode = ""');
        $this->db->join(db_prefix() . 'taxes', '' . db_prefix() . 'taxes.id = ' . db_prefix() . 'expenses.tax', 'left');
        $this->db->join('' . db_prefix() . 'taxes as ' . db_prefix() . 'taxes_2', '' . db_prefix() . 'taxes_2.id = ' . db_prefix() . 'expenses.tax2', 'left');
        $this->db->order_by('date', 'asc');
        $expenses = $this->db->get(db_prefix().'expenses')->result_array();
        
        foreach ($expenses as $v) {
            $total = $v['amount'];

            if($v['tax'] != 0){
                $total += ($total / 100 * $v['taxrate']);
            }
            if($v['tax2'] != 0){
                $total += ($v['amount'] / 100 * $v['taxrate2']);
            }

            $data_report['31_60_days_past_due'][] = [
                'date' => $v['date'],
                'duedate' => $v['date'],
                'type' => _l('expenses'),
                'number' => '#'.$v['expense_id'],
                'vendor' => $v['vendor'],
                'customer' => $v['clientid'],
                'amount' => $total,
            ];
        }

        $this->db->select('*, ' . db_prefix() . 'expenses.id as expense_id, ' . db_prefix() . 'taxes.taxrate as taxrate, ' . db_prefix() . 'taxes_2.taxrate as taxrate2');
        $this->db->where('(date >= "' .  date('Y-m-d', strtotime($to_date.' - 90 days')) . '" and date <= "' . date('Y-m-d', strtotime($to_date.' - 61 days')) . '") and paymentmode = ""');
        $this->db->join(db_prefix() . 'taxes', '' . db_prefix() . 'taxes.id = ' . db_prefix() . 'expenses.tax', 'left');
        $this->db->join('' . db_prefix() . 'taxes as ' . db_prefix() . 'taxes_2', '' . db_prefix() . 'taxes_2.id = ' . db_prefix() . 'expenses.tax2', 'left');
        $this->db->order_by('date', 'asc');
        $expenses = $this->db->get(db_prefix().'expenses')->result_array();
        
        foreach ($expenses as $v) {
            $total = $v['amount'];

            if($v['tax'] != 0){
                $total += ($total / 100 * $v['taxrate']);
            }
            if($v['tax2'] != 0){
                $total += ($v['amount'] / 100 * $v['taxrate2']);
            }

            $data_report['61_90_days_past_due'][] = [
                'date' => $v['date'],
                'duedate' => $v['date'],
                'type' => _l('expenses'),
                'number' => '#'.$v['expense_id'],
                'vendor' => $v['vendor'],
                'customer' => $v['clientid'],
                'amount' => $total,
            ];
        }

        $this->db->select('*, ' . db_prefix() . 'expenses.id as expense_id, ' . db_prefix() . 'taxes.taxrate as taxrate, ' . db_prefix() . 'taxes_2.taxrate as taxrate2');
        $this->db->where('date <= "' .  date('Y-m-d', strtotime($to_date.' - 91 days')) . '" and paymentmode = ""');
        $this->db->join(db_prefix() . 'taxes', '' . db_prefix() . 'taxes.id = ' . db_prefix() . 'expenses.tax', 'left');
        $this->db->join('' . db_prefix() . 'taxes as ' . db_prefix() . 'taxes_2', '' . db_prefix() . 'taxes_2.id = ' . db_prefix() . 'expenses.tax2', 'left');
        $this->db->order_by('date', 'asc');
        $expenses = $this->db->get(db_prefix().'expenses')->result_array();
        
        foreach ($expenses as $v) {
            $total = $v['amount'];

            if($v['tax'] != 0){
                $total += ($total / 100 * $v['taxrate']);
            }
            if($v['tax2'] != 0){
                $total += ($v['amount'] / 100 * $v['taxrate2']);
            }

            $data_report['91_and_over'][] = [
                'date' => $v['date'],
                'duedate' => $v['date'],
                'type' => _l('expenses'),
                'number' => '#'.$v['expense_id'],
                'vendor' => $v['vendor'],
                'customer' => $v['clientid'],
                'amount' => $total,
            ];
        }
        
        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
    }

    /**
     * get data accounts receivable ageing summary
     * @return array 
     */
    public function get_data_accounts_receivable_ageing_summary($data_filter){
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $tax = 0;
        if(isset($data_filter['tax'])){
            $tax = $data_filter['tax'];
        }


        $data_report = [];


        $this->db->where('IF(duedate IS NOT NULL,(date <= "' . $to_date . '" and duedate >= "' . $to_date . '"),(date = "' .  $to_date . '")) and (status = 1 or status = 3 or status = 4)');

        $this->db->order_by('date', 'asc');
        
        $invoices = $this->db->get(db_prefix().'invoices')->result_array();

        foreach ($invoices as $v) {
            $total_payments = sum_from_table(db_prefix() . 'invoicepaymentrecords', array('field' => 'amount', 'where' => array('invoiceid' => $v['id'])));

            if(!isset($data_report[$v['clientid']])){
                $data_report[$v['clientid']]['current'] = 0;
                $data_report[$v['clientid']]['1_30_days_past_due'] = 0;
                $data_report[$v['clientid']]['31_60_days_past_due'] = 0;
                $data_report[$v['clientid']]['61_90_days_past_due'] = 0;
                $data_report[$v['clientid']]['91_and_over'] = 0;
                $data_report[$v['clientid']]['total'] = 0;
            }

            $data_report[$v['clientid']]['current'] += $v['total'] - $total_payments;
            $data_report[$v['clientid']]['total'] += $v['total'] - $total_payments;
        }

        $this->db->where('IF(duedate IS NOT NULL,(duedate >=  "' . date('Y-m-d', strtotime($to_date.' - 30 days')) . '" and duedate <= "' . date('Y-m-d', strtotime($to_date.' - 1 days')) . '"),(date >=  "' . date('Y-m-d', strtotime($to_date.' - 30 days')) . '" and date <= "' . date('Y-m-d', strtotime($to_date.' - 1 days')) . '")) and (status = 1 or status = 3 or status = 4)');

        $this->db->order_by('date', 'asc');
        
        $invoices = $this->db->get(db_prefix().'invoices')->result_array();

        foreach ($invoices as $v) {
            $total_payments = sum_from_table(db_prefix() . 'invoicepaymentrecords', array('field' => 'amount', 'where' => array('invoiceid' => $v['id'])));

            if(!isset($data_report[$v['clientid']])){
                $data_report[$v['clientid']]['current'] = 0;
                $data_report[$v['clientid']]['1_30_days_past_due'] = 0;
                $data_report[$v['clientid']]['31_60_days_past_due'] = 0;
                $data_report[$v['clientid']]['61_90_days_past_due'] = 0;
                $data_report[$v['clientid']]['91_and_over'] = 0;
                $data_report[$v['clientid']]['total'] = 0;
            }

            $data_report[$v['clientid']]['1_30_days_past_due'] += $v['total'] - $total_payments;
            $data_report[$v['clientid']]['total'] += $v['total'] - $total_payments;

        }

        $this->db->where('IF(duedate IS NOT NULL,(duedate >=  "' . date('Y-m-d', strtotime($to_date.' - 60 days')) . '" and duedate <= "' . date('Y-m-d', strtotime($to_date.' - 31 days')) . '"),(date >=  "' . date('Y-m-d', strtotime($to_date.' - 60 days')) . '" and date <= "' . date('Y-m-d', strtotime($to_date.' - 31 days')) . '")) and (status = 1 or status = 3 or status = 4)');

        $this->db->order_by('date', 'asc');
        
        $invoices = $this->db->get(db_prefix().'invoices')->result_array();

        foreach ($invoices as $v) {
            $total_payments = sum_from_table(db_prefix() . 'invoicepaymentrecords', array('field' => 'amount', 'where' => array('invoiceid' => $v['id'])));

            if(!isset($data_report[$v['clientid']])){
                $data_report[$v['clientid']]['current'] = 0;
                $data_report[$v['clientid']]['1_30_days_past_due'] = 0;
                $data_report[$v['clientid']]['31_60_days_past_due'] = 0;
                $data_report[$v['clientid']]['61_90_days_past_due'] = 0;
                $data_report[$v['clientid']]['91_and_over'] = 0;
                $data_report[$v['clientid']]['total'] = 0;
            }

            $data_report[$v['clientid']]['31_60_days_past_due'] += $v['total'] - $total_payments;
            $data_report[$v['clientid']]['total'] += $v['total'] - $total_payments;

        }

        $this->db->where('IF(duedate IS NOT NULL,(duedate >=  "' . date('Y-m-d', strtotime($to_date.' - 90 days')) . '" and duedate <= "' . date('Y-m-d', strtotime($to_date.' - 61 days')) . '"),(date >=  "' . date('Y-m-d', strtotime($to_date.' - 90 days')) . '" and date <= "' . date('Y-m-d', strtotime($to_date.' - 61 days')) . '")) and (status = 1 or status = 3 or status = 4)');

        $this->db->order_by('date', 'asc');
        
        $invoices = $this->db->get(db_prefix().'invoices')->result_array();

        foreach ($invoices as $v) {
            $total_payments = sum_from_table(db_prefix() . 'invoicepaymentrecords', array('field' => 'amount', 'where' => array('invoiceid' => $v['id'])));
            if(!isset($data_report[$v['clientid']])){
                $data_report[$v['clientid']]['current'] = 0;
                $data_report[$v['clientid']]['1_30_days_past_due'] = 0;
                $data_report[$v['clientid']]['31_60_days_past_due'] = 0;
                $data_report[$v['clientid']]['61_90_days_past_due'] = 0;
                $data_report[$v['clientid']]['91_and_over'] = 0;
                $data_report[$v['clientid']]['total'] = 0;
            }

            $data_report[$v['clientid']]['61_90_days_past_due'] += $v['total'] - $total_payments;
            $data_report[$v['clientid']]['total'] += $v['total'] - $total_payments;

        }
        
        $this->db->where('IF(duedate IS NOT NULL,(duedate <=  "' . date('Y-m-d', strtotime($to_date.' - 91 days')) . '"),(date <=  "' . date('Y-m-d', strtotime($to_date.' - 91 days')) . '")) and (status = 1 or status = 3 or status = 4)');

        $this->db->order_by('date', 'asc');
        
        $invoices = $this->db->get(db_prefix().'invoices')->result_array();

        foreach ($invoices as $v) {
            $total_payments = sum_from_table(db_prefix() . 'invoicepaymentrecords', array('field' => 'amount', 'where' => array('invoiceid' => $v['id'])));
            if(!isset($data_report[$v['clientid']])){
                $data_report[$v['clientid']]['current'] = 0;
                $data_report[$v['clientid']]['1_30_days_past_due'] = 0;
                $data_report[$v['clientid']]['31_60_days_past_due'] = 0;
                $data_report[$v['clientid']]['61_90_days_past_due'] = 0;
                $data_report[$v['clientid']]['91_and_over'] = 0;
                $data_report[$v['clientid']]['total'] = 0;
            }

            $data_report[$v['clientid']]['91_and_over'] += $v['total'] - $total_payments;
            $data_report[$v['clientid']]['total'] += $v['total'] - $total_payments;

        }

        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
    }

     /**
     * get data accounts payable ageing summary
     * @return array 
     */
     public function get_data_accounts_payable_ageing_summary($data_filter){
        $from_date = date('Y-m-01');
        $to_date = date('Y-m-d');

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $tax = 0;
        if(isset($data_filter['tax'])){
            $tax = $data_filter['tax'];
        }


        $data_report = [];

        $this->db->select('*, ' . db_prefix() . 'expenses.id as expense_id, ' . db_prefix() . 'taxes.taxrate as taxrate, ' . db_prefix() . 'taxes_2.taxrate as taxrate2');
        $this->db->where('date = "' .  $to_date . '" and paymentmode = ""');
        $this->db->join(db_prefix() . 'taxes', '' . db_prefix() . 'taxes.id = ' . db_prefix() . 'expenses.tax', 'left');
        $this->db->join('' . db_prefix() . 'taxes as ' . db_prefix() . 'taxes_2', '' . db_prefix() . 'taxes_2.id = ' . db_prefix() . 'expenses.tax2', 'left');
        $this->db->order_by('date', 'asc');
        $expenses = $this->db->get(db_prefix().'expenses')->result_array();
        
        foreach ($expenses as $v) {

            if($v['clientid'] != ''){

                $total = $v['amount'];

                if($v['tax'] != 0){
                    $total += ($total / 100 * $v['taxrate']);
                }
                if($v['tax2'] != 0){
                    $total += ($v['amount'] / 100 * $v['taxrate2']);
                }

                if(!isset($data_report[$v['clientid']])){
                    $data_report[$v['clientid']]['current'] = 0;
                    $data_report[$v['clientid']]['1_30_days_past_due'] = 0;
                    $data_report[$v['clientid']]['31_60_days_past_due'] = 0;
                    $data_report[$v['clientid']]['61_90_days_past_due'] = 0;
                    $data_report[$v['clientid']]['91_and_over'] = 0;
                    $data_report[$v['clientid']]['total'] = 0;
                }

                $data_report[$v['clientid']]['current'] += $total;
                $data_report[$v['clientid']]['total'] += $total;
            }

        }

        $this->db->select('*, ' . db_prefix() . 'expenses.id as expense_id, ' . db_prefix() . 'taxes.taxrate as taxrate, ' . db_prefix() . 'taxes_2.taxrate as taxrate2');
        $this->db->where('(date >= "' .  date('Y-m-d', strtotime($to_date.' - 30 days')) . '" and date <= "' . date('Y-m-d', strtotime($to_date.' - 1 days')) . '") and paymentmode = ""');
        $this->db->join(db_prefix() . 'taxes', '' . db_prefix() . 'taxes.id = ' . db_prefix() . 'expenses.tax', 'left');
        $this->db->join('' . db_prefix() . 'taxes as ' . db_prefix() . 'taxes_2', '' . db_prefix() . 'taxes_2.id = ' . db_prefix() . 'expenses.tax2', 'left');
        $this->db->order_by('date', 'asc');
        $expenses = $this->db->get(db_prefix().'expenses')->result_array();

        foreach ($expenses as $v) {
            if($v['clientid'] != ''){
                $total = $v['amount'];

                if($v['tax'] != 0){
                    $total += ($total / 100 * $v['taxrate']);
                }
                if($v['tax2'] != 0){
                    $total += ($v['amount'] / 100 * $v['taxrate2']);
                }

                if(!isset($data_report[$v['clientid']])){
                    $data_report[$v['clientid']]['current'] = 0;
                    $data_report[$v['clientid']]['1_30_days_past_due'] = 0;
                    $data_report[$v['clientid']]['31_60_days_past_due'] = 0;
                    $data_report[$v['clientid']]['61_90_days_past_due'] = 0;
                    $data_report[$v['clientid']]['91_and_over'] = 0;
                    $data_report[$v['clientid']]['total'] = 0;
                }

                $data_report[$v['clientid']]['1_30_days_past_due'] += $total;
                $data_report[$v['clientid']]['total'] += $total;
            }

        }

        $this->db->select('*, ' . db_prefix() . 'expenses.id as expense_id, ' . db_prefix() . 'taxes.taxrate as taxrate, ' . db_prefix() . 'taxes_2.taxrate as taxrate2');
        $this->db->where('(date >= "' .  date('Y-m-d', strtotime($to_date.' - 60 days')) . '" and date <= "' . date('Y-m-d', strtotime($to_date.' - 31 days')) . '") and paymentmode = ""');
        $this->db->join(db_prefix() . 'taxes', '' . db_prefix() . 'taxes.id = ' . db_prefix() . 'expenses.tax', 'left');
        $this->db->join('' . db_prefix() . 'taxes as ' . db_prefix() . 'taxes_2', '' . db_prefix() . 'taxes_2.id = ' . db_prefix() . 'expenses.tax2', 'left');
        $this->db->order_by('date', 'asc');
        $expenses = $this->db->get(db_prefix().'expenses')->result_array();

        foreach ($expenses as $v) {
            if($v['clientid'] != ''){
                $total = $v['amount'];

                if($v['tax'] != 0){
                    $total += ($total / 100 * $v['taxrate']);
                }
                if($v['tax2'] != 0){
                    $total += ($v['amount'] / 100 * $v['taxrate2']);
                }

                if(!isset($data_report[$v['clientid']])){
                    $data_report[$v['clientid']]['current'] = 0;
                    $data_report[$v['clientid']]['1_30_days_past_due'] = 0;
                    $data_report[$v['clientid']]['31_60_days_past_due'] = 0;
                    $data_report[$v['clientid']]['61_90_days_past_due'] = 0;
                    $data_report[$v['clientid']]['91_and_over'] = 0;
                    $data_report[$v['clientid']]['total'] = 0;
                }

                $data_report[$v['clientid']]['31_60_days_past_due'] += $total;
                $data_report[$v['clientid']]['total'] += $total;
            }

        }

        $this->db->select('*, ' . db_prefix() . 'expenses.id as expense_id, ' . db_prefix() . 'taxes.taxrate as taxrate, ' . db_prefix() . 'taxes_2.taxrate as taxrate2');
        $this->db->where('(date >= "' .  date('Y-m-d', strtotime($to_date.' - 90 days')) . '" and date <= "' . date('Y-m-d', strtotime($to_date.' - 61 days')) . '") and paymentmode = ""');
        $this->db->join(db_prefix() . 'taxes', '' . db_prefix() . 'taxes.id = ' . db_prefix() . 'expenses.tax', 'left');
        $this->db->join('' . db_prefix() . 'taxes as ' . db_prefix() . 'taxes_2', '' . db_prefix() . 'taxes_2.id = ' . db_prefix() . 'expenses.tax2', 'left');
        $this->db->order_by('date', 'asc');
        $expenses = $this->db->get(db_prefix().'expenses')->result_array();
        
        foreach ($expenses as $v) {
            if($v['clientid'] != ''){
                $total = $v['amount'];

                if($v['tax'] != 0){
                    $total += ($total / 100 * $v['taxrate']);
                }
                if($v['tax2'] != 0){
                    $total += ($v['amount'] / 100 * $v['taxrate2']);
                }

                if(!isset($data_report[$v['clientid']])){
                    $data_report[$v['clientid']]['current'] = 0;
                    $data_report[$v['clientid']]['1_30_days_past_due'] = 0;
                    $data_report[$v['clientid']]['31_60_days_past_due'] = 0;
                    $data_report[$v['clientid']]['61_90_days_past_due'] = 0;
                    $data_report[$v['clientid']]['91_and_over'] = 0;
                    $data_report[$v['clientid']]['total'] = 0;
                }

                $data_report[$v['clientid']]['61_90_days_past_due'] += $total;
                $data_report[$v['clientid']]['total'] += $total;
            }

        }

        $this->db->select('*, ' . db_prefix() . 'expenses.id as expense_id, ' . db_prefix() . 'taxes.taxrate as taxrate, ' . db_prefix() . 'taxes_2.taxrate as taxrate2');
        $this->db->where('date <= "' .  date('Y-m-d', strtotime($to_date.' - 91 days')) . '" and paymentmode = ""');
        $this->db->join(db_prefix() . 'taxes', '' . db_prefix() . 'taxes.id = ' . db_prefix() . 'expenses.tax', 'left');
        $this->db->join('' . db_prefix() . 'taxes as ' . db_prefix() . 'taxes_2', '' . db_prefix() . 'taxes_2.id = ' . db_prefix() . 'expenses.tax2', 'left');
        $this->db->order_by('date', 'asc');
        $expenses = $this->db->get(db_prefix().'expenses')->result_array();
        
        foreach ($expenses as $v) {
            if($v['clientid'] != ''){
                $total = $v['amount'];

                if($v['tax'] != 0){
                    $total += ($total / 100 * $v['taxrate']);
                }
                if($v['tax2'] != 0){
                    $total += ($v['amount'] / 100 * $v['taxrate2']);
                }

                if(!isset($data_report[$v['clientid']])){
                    $data_report[$v['clientid']]['current'] = 0;
                    $data_report[$v['clientid']]['1_30_days_past_due'] = 0;
                    $data_report[$v['clientid']]['31_60_days_past_due'] = 0;
                    $data_report[$v['clientid']]['61_90_days_past_due'] = 0;
                    $data_report[$v['clientid']]['91_and_over'] = 0;
                    $data_report[$v['clientid']]['total'] = 0;
                }

                $data_report[$v['clientid']]['91_and_over'] += $total;
                $data_report[$v['clientid']]['total'] += $total;
            }

        }

        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
    }

    /**
     * get data profit and loss 12 months
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_profit_and_loss_12_months($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'accrual';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $row = [];
                    $start = $month = strtotime($from_date);
                    $end = strtotime($to_date);

                    while($month < $end)
                    {
                        $this->db->where('account', $val['id']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                        if($acc_show_account_numbers == 1 && $val['number'] != ''){
                            $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                        }else{
                            $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                        }


                        if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                            $row[date('m-Y', $month)] = $credits - $debits;
                        }else{
                            $row[date('m-Y', $month)] = $debits - $credits;
                        }

                        $month = strtotime("+1 month", $month);
                    }
                    $child_account = $this->get_data_profit_and_loss_12_months_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $accounting_method, $acc_show_account_numbers);

                    $data_report[$data_key][] = ['name' => $name, 'amount' => $row, 'child_account' => $child_account];
                        
                }
            }
        }

        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
        
    }

    /**
     * get data profit and loss recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date   
     * @param  string $accounting_method   
     * @return array                 
     */
    public function get_data_profit_and_loss_12_months_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        foreach ($accounts as $val) {
            $row = [];
            $start = $month = strtotime($from_date);
            $end = strtotime($to_date);
            while($month < $end)
            {
                $this->db->where('account', $val['id']);
                if($accounting_method == 'cash'){
                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                }
                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                $debits = $account_history->debit != '' ? $account_history->debit : 0;
                if($acc_show_account_numbers == 1 && $val['number'] != ''){
                    $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                }else{
                    $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                }


                if($val['account_type_id'] == 11 || $val['account_type_id'] == 12){
                    $row[date('m-Y', $month)] = $credits - $debits;
                }else{
                    $row[date('m-Y', $month)] = $debits - $credits;
                }

                $month = strtotime("+1 month", $month);
            }

            $child_account[] = ['name' => $name, 'amount' => $row, 'child_account' => $this->get_data_profit_and_loss_12_months_recursive([], $val['id'], $account_type_id, $from_date, $to_date, $accounting_method, $acc_show_account_numbers)];
                
        }

        return $child_account;
    }

    /**
     * get html profit and loss
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_profit_and_loss_12_months($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $val) {
            $data_return['row_index']++;
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
            <td>
            '.$val['name'].'
            </td>';
            $total = 0;
            foreach($val['amount'] as $amount){
                $data_return['html'] .= '
                <td class="total_amount">
                '.app_format_money($amount, $currency->name).'
                </td>';
                $total += $amount;

            }
            $total_amount = $total;
            $data_return['html'] .= '
            <td class="total_amount">
            '.app_format_money($total_amount, $currency->name).'
            </td>';
            $data_return['html'] .= '</tr>';
            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_profit_and_loss_12_months($val['child_account'], $data_return, $data_return['row_index'], $currency);

                $total_amount += $data_return['total_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                <td>
                '._l('total_for', $val['name']).'
                </td>';
                foreach($val['amount'] as $amount){
                    $data_return['html'] .= '
                    <td class="total_amount"></td>';

                }
                $data_return['html'] .= '<td class="total_amount">
                '.app_format_money($total_amount, $currency->name).'
                </td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $total;
        }
        return $data_return; 
    }

    /**
     * get data budget overview
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_budget_overview($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $budget_id = 0;
      
        if(isset($data_filter['budget'])){
            $budget_id = $data_filter['budget'];
        }

        if($budget_id == 0){
            return ['type' => '','data' => []];
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_accounts = [];
        $budget = $this->get_budgets($budget_id);
        
        if($budget->type == 'profit_and_loss_accounts'){
            foreach ($account_type_details as $key => $value) {
                if($value['account_type_id'] == 11){
                    $data_accounts['income'][] = $value;
                }

                if($value['account_type_id'] == 12){
                    $data_accounts['other_income'][] = $value;
                }

                if($value['account_type_id'] == 13){
                    $data_accounts['cost_of_sales'][] = $value;
                }

                if($value['account_type_id'] == 14){
                    $data_accounts['expenses'][] = $value;
                }

                if($value['account_type_id'] == 15){
                    $data_accounts['other_expenses'][] = $value;
                }
            }
        }else{
            foreach ($account_type_details as $key => $value) {
                if($value['account_type_id'] == 1){
                    $data_accounts['accounts_receivable'][] = $value;
                }
                if($value['account_type_id'] == 2){
                    $data_accounts['current_assets'][] = $value;
                }
                if($value['account_type_id'] == 3){
                    $data_accounts['cash_and_cash_equivalents'][] = $value;
                }
                if($value['account_type_id'] == 4){
                    $data_accounts['fixed_assets'][] = $value;
                }
                if($value['account_type_id'] == 5){
                    $data_accounts['non_current_assets'][] = $value;
                }
                if($value['account_type_id'] == 6){
                    $data_accounts['accounts_payable'][] = $value;
                }
                if($value['account_type_id'] == 7){
                    $data_accounts['credit_card'][] = $value;
                }
                if($value['account_type_id'] == 8){
                    $data_accounts['current_liabilities'][] = $value;
                }
                if($value['account_type_id'] == 9){
                    $data_accounts['non_current_liabilities'][] = $value;
                }
                if($value['account_type_id'] == 10){
                    $data_accounts['owner_equity'][] = $value;
                }
            }
        }

        $year = $budget->year;
        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $from_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.$year));
        $to_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.($year + 1)));

        $_from_date = $from_date;

        $headers = [];
        while (strtotime($_from_date) < strtotime($to_date)) {

            $month = date('M - Y', strtotime($_from_date));

            $headers[] = $month;

            $_from_date = date('Y-m-d', strtotime('+1 month', strtotime($_from_date)));

            if(strtotime($_from_date) > strtotime($to_date)){
                $month_2 = date('M - Y', strtotime($to_date));

                if($month != $month_2){
                    $headers[] = $month_2;
                }
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $row = [];
                    $start = $month = strtotime($from_date);
                    $end = strtotime($to_date);

                    while($month < $end)
                    {
                        $this->db->select('sum(amount) as amount');
                        $this->db->where('account', $val['id']);
                        $this->db->where('budget_id', $budget_id);
                        $this->db->where('month', date('m',$month));
                        $this->db->where('year', date('Y',$month));

                        $budget_data = $this->db->get(db_prefix() . 'acc_budget_details')->row();

                        if($acc_show_account_numbers == 1 && $val['number'] != ''){
                            $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                        }else{
                            $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                        }

                        $row[date('m-Y', $month)] = $budget_data->amount;
                        
                        $month = strtotime("+1 month", $month);
                    }
                    $child_account = $this->get_data_budget_overview_recursive([], $val['id'], $from_date, $to_date, $budget_id, $acc_show_account_numbers);

                    $data_report[$data_key][] = ['name' => $name, 'amount' => $row, 'child_account' => $child_account];
                        
                }
            }
        }

        return ['type' => $budget->type,'data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date, 'headers' => $headers];
        
    }

    /**
     * get data profit and loss recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date   
     * @param  string $accounting_method   
     * @return array                 
     */
    public function get_data_budget_overview_recursive($child_account, $account_id, $from_date, $to_date, $budget_id, $acc_show_account_numbers){
        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        foreach ($accounts as $val) {
            $row = [];
            $start = $month = strtotime($from_date);
            $end = strtotime($to_date);
            while($month < $end)
            {
                $this->db->select('sum(amount) as amount');
                $this->db->where('account', $val['id']);
                $this->db->where('budget_id', $budget_id);
                $this->db->where('month', date('m',$month));
                $this->db->where('year', date('Y',$month));

                $budget_data = $this->db->get(db_prefix() . 'acc_budget_details')->row();
                if($acc_show_account_numbers == 1 && $val['number'] != ''){
                    $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                }else{
                    $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                }

                $row[date('m-Y', $month)] = $budget_data->amount;
                        
                $month = strtotime("+1 month", $month);
            }

            $child_account[] = ['name' => $name, 'amount' => $row, 'child_account' => $this->get_data_budget_overview_recursive([], $val['id'], $from_date, $to_date, $budget_id, $acc_show_account_numbers)];
                
        }

        return $child_account;
    }

    /**
     * get html profit and loss
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_budget_overview($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $val) {
            $data_return['row_index']++;
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
            <td>
            '.$val['name'].'
            </td>';
            $total = 0;
            foreach($val['amount'] as $amount){
                $data_return['html'] .= '
                <td class="total_amount">
                '.app_format_money($amount, $currency->name).'
                </td>';
                $total += $amount;

            }
            $total_amount = $total;
            $data_return['html'] .= '
            <td class="total_amount">
            '.app_format_money($total_amount, $currency->name).'
            </td>';
            $data_return['html'] .= '</tr>';
            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_budget_overview($val['child_account'], $data_return, $data_return['row_index'], $currency);

                $total_amount += $data_return['total_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                <td>
                '._l('total_for', $val['name']).'
                </td>';
                foreach($val['amount'] as $amount){
                    $data_return['html'] .= '
                    <td class="total_amount"></td>';

                }
                $data_return['html'] .= '<td class="total_amount">
                '.app_format_money($total_amount, $currency->name).'
                </td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $total;
        }
        return $data_return; 
    }

    /**
     * get data profit and loss
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_profit_and_loss_budget_vs_actual($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');
        $acc_show_account_numbers = get_option('acc_show_account_numbers');
        $date_financial_year = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.date('Y')));
        $date_financial_year_2 = date('Y-m-t', strtotime($date_financial_year . '  - 1 month + 1 year '));

        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $year = date('Y');
        $accounting_method = 'accrual';
        $display_columns = 'total_only';
        $budget_id = 0;
      
        if(isset($data_filter['budget'])){
            $budget_id = $data_filter['budget'];
        }

        if($budget_id == 0){
            return ['data' => []];
        }

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        $budget = $this->get_budgets($budget_id);
        $year = $budget->year;
        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $from_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.$year));
        $to_date = date('Y-m-t', strtotime($from_date . '  - 1 month + 1 year '));

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    $child_account = $this->get_data_profit_and_loss_budget_vs_actual_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $accounting_method, $budget_id, $acc_show_account_numbers);

                    $budget_amount = $this->get_budget_by_account($budget_id, $val['id'], $from_date, $to_date);

                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                        $amount = $credits - $debits;
                    }else{
                        $amount = $debits - $credits;
                    }

                    $data_report[$data_key][] = ['name' => $name, 'amount' => $amount, 'budget_amount' => $budget_amount, 'child_account' => $child_account];
                }
            }
        }

        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date];
        
    }

    /**
     * get data profit and loss
     * @param  array $data_filter 
     * @return array              
     */
    public function get_data_profit_and_loss_budget_performance($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $date_financial_year = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.date('Y')));
        $date_financial_year_2 = date('Y-m-t', strtotime($date_financial_year . '  - 1 month + 1 year '));

        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $year = date('Y');


        $accounting_method = 'accrual';
        $budget_id = 0;
      
        if(isset($data_filter['budget'])){
            $budget_id = $data_filter['budget'];
        }

        if($budget_id == 0){
            return ['data' => []];
        }

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        $budget = $this->get_budgets($budget_id);

        $year = $budget->year;
        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $from_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.$year));
        $to_date = date('Y-m-t', strtotime($from_date . '  - 1 month + 1 year '));

        $last_from_date = date('Y-m-01');
        $last_to_date = date('Y-m-t');
        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_accounts = [];
        
        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }
            
            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }

            if($value['account_type_id'] == 23){
                $data_accounts['cash_flow_data'][] = $value;
            }                
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('(date >= "' . $last_from_date . '" and date <= "' . $last_to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                        $last_amount = $credits - $debits;
                    }else{
                        $last_amount = $debits - $credits;
                    }
                    $last_budget_amount = $this->get_budget_by_account($budget_id, $val['id'],  $last_from_date, $last_to_date);

                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                        $amount = $credits - $debits;
                    }else{
                        $amount = $debits - $credits;
                    }
                    $budget_amount = $this->get_budget_by_account($budget_id, $val['id'], $from_date, $to_date);

                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }


                    $child_account = $this->get_data_profit_and_loss_budget_performance_recursive([], $val['id'], $value['account_type_id'], $from_date, $to_date, $accounting_method, $budget_id, $acc_show_account_numbers);

                    $data_report[$data_key][] = ['name' => $name, 'last_amount' => $last_amount, 'last_budget_amount' => $last_budget_amount, 'amount' => $amount, 'budget_amount' => $budget_amount, 'child_account' => $child_account];
                }
            }
        }

        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date, 'last_from_date' => $last_from_date, 'last_to_date' => $last_to_date];
        
    }

    /**
     * get html budget variance
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_profit_and_loss_budget_vs_actual($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        $data_return['total_budget_amount'] = 0;
        foreach ($child_account as $val) {
            $data_return['row_index']++;
            $total_amount = $val['amount'];
            $total_budget_amount = $val['budget_amount'];

            $percent = 0;
            if($val['amount'] != 0){
                if($val['budget_amount'] != 0){
                    $percent = round(($val['amount'] / $val['budget_amount']) * 100, 2);
                }else{
                    $percent = 100;
                }
            }
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$val['name'].'
              </td>
              <td class="total_amount">
              '.app_format_money($val['amount'], $currency->name).'
              </td>
              <td class="total_amount">
              '.app_format_money($val['budget_amount'], $currency->name).'
              </td>
              <td class="total_amount">
              '.app_format_money(($val['amount'] - $val['budget_amount']), $currency->name).'
              </td>
              <td class="total_amount">
              '.$percent.'%
              </td>
            </tr>';

            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $t_2 = $data_return['total_budget_amount'];
                $data_return = $this->get_html_profit_and_loss_budget_vs_actual($val['child_account'], $data_return, $data_return['row_index'], $currency);

                $total_amount += $data_return['total_amount'];
                $total_budget_amount += $data_return['total_budget_amount'];
                
                $data_return['row_index']++;
                $percent = 0;
                if($total_amount != 0){
                    if($total_budget_amount != 0){
                        $percent = round(($total_amount / $total_budget_amount) * 100, 2);
                    }else{
                        $percent = 100;
                    }
                }
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_budget_amount, $currency->name).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money(($total_amount - $total_budget_amount), $currency->name).'
                  </td>
                  <td class="total_amount">
                  '.$percent.'%
                  </td>
                </tr>';
                $data_return['total_amount'] += $t;
                $data_return['total_budget_amount'] += $t_2;
            }

            $data_return['total_amount'] += $val['amount'];
            $data_return['total_budget_amount'] += $val['budget_amount'];
        }
        return $data_return; 
    }


    /**
     * get html budget comparison
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_profit_and_loss_budget_performance($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_last_amount'] = 0;
        $data_return['total_last_budget_amount'] = 0;
        $data_return['total_amount'] = 0;
        $data_return['total_budget_amount'] = 0;

        foreach ($child_account as $val) {
            $data_return['row_index']++;
            $total_amount = $val['amount'];
            $total_budget_amount = $val['budget_amount'];
            $total_last_amount = $val['last_amount'];
            $total_last_budget_amount = $val['last_budget_amount'];

            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$val['name'].'
              </td>
              <td class="total_amount">
              '.app_format_money($val['last_amount'], $currency->name).'
              </td>
              <td class="total_amount">
              '.app_format_money($val['last_budget_amount'], $currency->name).'
              </td>
              <td class="total_amount">
              '.app_format_money($val['amount'], $currency->name).'
              </td>
              <td class="total_amount">
              '.app_format_money($val['budget_amount'], $currency->name).'
              </td>
              <td class="total_amount">
              '.app_format_money($val['amount'] - $val['budget_amount'], $currency->name).'
              </td>
            </tr>';

            if(count($val['child_account']) > 0){
                $t = $data_return['total_last_amount'];
                $t_2 = $data_return['total_last_budget_amount'];
                $t_3 = $data_return['total_amount'];
                $t_4 = $data_return['total_budget_amount'];
                $data_return = $this->get_html_profit_and_loss_budget_performance($val['child_account'], $data_return, $data_return['row_index'], $currency);

                $total_last_amount += $data_return['total_last_amount'];
                $total_last_budget_amount += $data_return['total_last_budget_amount'];
                $total_amount += $data_return['total_amount'];
                $total_budget_amount += $data_return['total_budget_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_last_amount, $currency->name).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_last_budget_amount, $currency->name).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_budget_amount, $currency->name).'
                  </td>
                  <td class="total_amount">
                  '.app_format_money($total_amount - $total_budget_amount, $currency->name).'
                  </td>
                </tr>';
                $data_return['total_last_amount'] += $t;
                $data_return['total_last_budget_amount'] += $t_2;
                $data_return['total_amount'] += $t_3;
                $data_return['total_budget_amount'] += $t_4;
            }

            $data_return['total_last_amount'] += $val['last_amount'];
            $data_return['total_last_budget_amount'] += $val['last_budget_amount'];
            $data_return['total_amount'] += $val['amount'];
            $data_return['total_budget_amount'] += $val['budget_amount'];
        }
        return $data_return; 
    }

    /**
     * get budget by account
     * @param  integer $company    
     * @param  integer $account_id 
     * @param  integer $year       
     * @return integer            
     */
    public function get_budget_by_account($budget_id, $account_id, $from_date, $to_date){
        $month = date('m', strtotime($from_date));
        $year = date('Y', strtotime($from_date));
        $month_2 = date('m', strtotime($to_date));
        $year_2 = date('Y', strtotime($to_date));
        
        $this->db->select('sum(amount) as amount');
        $this->db->where('account', $account_id);
        $this->db->where('budget_id', $budget_id);
        if($year == $year_2){
            $this->db->where('((month >= '.$month.' or month <= '.$month_2.') and year = '.$year.')');
        }else{
            $this->db->where('((month >= '.$month.' and year >= '.$year.' and year < '.$year_2.') or (month <= '.$month_2.' and year > '.$year.' and year <= '.$year_2.'))');
        }

        $data = $this->db->get(db_prefix() . 'acc_budget_details')->row();
        
        if($data->amount){
            return $data->amount;
        }else{
            return 0;
        }
    }

    /**
     * get data balance sheet summary recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date         
     * @param  string $accounting_method         
     * @param  integer $acc_report_show_non_zero         
     * @return array                 
     */
    public function get_data_profit_and_loss_budget_performance_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $accounting_method, $budget_id, $acc_show_account_numbers){
        $year = date('Y', strtotime($to_date));
        $last_from_date = date('Y-m-01');
        $last_to_date = date('Y-m-t');

        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        $data_return = [];
        foreach ($accounts as $val) {
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('(date >= "' . $last_from_date . '" and date <= "' . $last_to_date . '")');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;
            if($account_type_id == 11 || $account_type_id == 12){
                $last_amount = $credits - $debits;
            }else{
                $last_amount = $debits - $credits;
            }
            $last_budget_amount = $this->get_budget_by_account($budget_id, $val['id'], $last_from_date, $last_to_date);

            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;
            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }


            $budget_amount = $this->get_budget_by_account($budget_id, $val['id'], $from_date, $to_date);
            if($account_type_id == 11 || $account_type_id == 12){
                $amount = $credits - $debits;
            }else{
                $amount = $debits - $credits;
            }

            $child_account[] = ['name' => $name, 'last_amount' => $last_amount, 'last_budget_amount' => $last_budget_amount, 'amount' => $amount, 'budget_amount' => $budget_amount, 'child_account' => $this->get_data_profit_and_loss_budget_performance_recursive([], $val['id'],$account_type_id, $from_date, $to_date, $accounting_method, $budget_id, $acc_show_account_numbers)];

            
        }

        return $child_account;
    }

    /**
     * get data balance sheet summary recursive
     * @param  array $child_account         
     * @param  integer $account_id      
     * @param  integer $account_type_id 
     * @param  string $from_date       
     * @param  string $to_date         
     * @param  string $accounting_method         
     * @param  integer $acc_report_show_non_zero         
     * @return array                 
     */
    public function get_data_profit_and_loss_budget_vs_actual_recursive($child_account, $account_id, $account_type_id, $from_date, $to_date, $accounting_method, $budget_id, $acc_show_account_numbers){
        $year = date('Y', strtotime($to_date));
        $last_from_date = date('Y-m-01');
        $last_to_date = date('Y-m-t');

        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        $data_return = [];
        foreach ($accounts as $val) {
            $this->db->where('account', $val['id']);
            $this->db->where('account', $val['id']);
            if($accounting_method == 'cash'){
                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
            }
            $this->db->select('sum(credit) as credit, sum(debit) as debit');
            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

            $credits = $account_history->credit != '' ? $account_history->credit : 0;
            $debits = $account_history->debit != '' ? $account_history->debit : 0;
            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }


            $budget_amount = $this->get_budget_by_account($budget_id, $val['id'], $from_date, $to_date);
            if($account_type_id == 11 || $account_type_id == 12){
                $amount = $credits - $debits;
            }else{
                $amount = $debits - $credits;
            }

            $child_account[] = ['name' => $name, 'amount' => $amount, 'budget_amount' => $budget_amount, 'child_account' => $this->get_data_profit_and_loss_budget_vs_actual_recursive([], $val['id'],$account_type_id, $from_date, $to_date, $accounting_method, $budget_id, $acc_show_account_numbers)];

            
        }

        return $child_account;
    }

     /**
     * delete budget
     * @param integer $id
     * @return boolean
     */

    public function delete_budget($id)
    {
        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'acc_budgets');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('budget_id', $id);
            $this->db->delete(db_prefix() . 'acc_budget_details');

            return true;
        }
        return false;
    }

    /**
     * { insert batch account }
     *
     * @param        $data   The data
     */
    public function insert_batch_account($data){

        $row_update = 0;
        $row_add = 0;
        $data_sub_account = [];
        $data_update_account = [];
        foreach($data as $key => $val){

            if( get_account_by_name($val['name']) != false){
                $data_update_account[] = $data[$key];
                unset($data[$key]);
            }

            if($val['parent_account'] != '' && get_account_by_name($val['name']) == false){
                $data_sub_account[] = $data[$key];
                unset($data[$key]);
            }
        }

        if(count($data) > 0){
            $row_add = $this->db->insert_batch(db_prefix().'acc_accounts',  $data);
        }

        if(count($data_update_account) > 0){
            foreach($data_update_account as $acc){
                $acc_id = get_account_by_name($acc['name']);

                if($acc['parent_account'] != ''){
                    $acc['parent_account'] = $acc['parent_account'];
                }

                $this->db->where('id', $acc_id);
                $this->db->update(db_prefix().'acc_accounts', $acc);
                if($this->db->affected_rows() > 0){
                    $row_update++;
                }
            }
        }

        foreach($data_sub_account as $sub_acc){
            $acc_id = $sub_acc['parent_account'];
            if($acc_id){
                $this->db->where('id', $acc_id);
                $account = $this->db->get(db_prefix().'acc_accounts')->row();

                $this->db->insert(db_prefix().'acc_accounts',[
                    'account_type_id' => $account->account_type_id,
                    'account_detail_type_id' => $account->account_detail_type_id,
                    'name' => $sub_acc['name'],
                    'parent_account' => $acc_id,
                ]);
                $insert_id = $this->db->insert_id();
                if($insert_id){
                    $row_add ++;
                }
            }
        }

        return ['row_updated' => $row_update, 'row_added' => $row_add];
    }

    /**
     * { insert batch budget }
     *
     * @param        $data   The data
     */
    public function insert_batch_budget($data, $budget_id, $import_type){
        $data_insert = [];
        $this->db->where('budget_id', $budget_id);
        $this->db->delete(db_prefix().'acc_budget_details');

        $this->db->where('id', $budget_id);
        $budget = $this->db->get(db_prefix().'acc_budgets')->row();

        $year = $budget->year;

        $acc_first_month_of_financial_year = get_option('acc_first_month_of_financial_year');

        $from_date = date('Y-m-d', strtotime($acc_first_month_of_financial_year . ' 01 '.$year));
        $to_date = date('Y-m-t', strtotime($from_date . '  - 1 month + 1 year '));

        $month_columns = [];
        $_from_date = $from_date;
        while (strtotime($_from_date) < strtotime($to_date)) {
            $month = date('m', strtotime($_from_date));
            $year = date('Y', strtotime($_from_date));
                
            array_push($month_columns, ['month' => $month, 'year' => $year]);

            $_from_date = date('Y-m-d', strtotime('+1 month', strtotime($_from_date)));

            if(strtotime($_from_date) > strtotime($to_date)){
                $month_2 = date('m', strtotime($to_date));
                $year_2 = date('Y', strtotime($to_date));

                if($month != $month_2){
                    array_push($month_columns, ['month' => $month_2, 'year' => $year_2]);
                }
            }
        }

        $quarter_columns = [];
        $_from_date = $from_date;
        while (strtotime($_from_date) <= strtotime($to_date)) {
            $month = date('m', strtotime($_from_date));
            $year = date('Y', strtotime($_from_date));

            if($month>=1 && $month<=3)
            {
                $t = 'quarter_1';
            }
            else  if($month>=4 && $month<=6)
            {
                $t = 'quarter_2';
            }
            else  if($month>=7 && $month<=9)
            {
                $t = 'quarter_3';
            }
            else  if($month>=10 && $month<=12)
            {
                $t = 'quarter_4';
            }

            if(!in_array($t, $quarter_columns)){
                array_push($quarter_columns, $t);
            }

            $_from_date = date('Y-m-d', strtotime('+1 month', strtotime($_from_date)));
        }

        foreach($data as $value){
            $account = $value['account'];

            if($import_type == 'month'){


                $data_insert[] = ['budget_id' => $budget_id, 'amount' => $value['month_1'], 'year' => $month_columns[0]['year'], 'account' => $account, 'month' => $month_columns[0]['month']];
                $data_insert[] = ['budget_id' => $budget_id, 'amount' => $value['month_2'], 'year' => $month_columns[1]['year'], 'account' => $account, 'month' => $month_columns[1]['month']];
                $data_insert[] = ['budget_id' => $budget_id, 'amount' => $value['month_3'], 'year' => $month_columns[2]['year'], 'account' => $account, 'month' => $month_columns[2]['month']];
                $data_insert[] = ['budget_id' => $budget_id, 'amount' => $value['month_4'], 'year' => $month_columns[3]['year'], 'account' => $account, 'month' => $month_columns[3]['month']];
                $data_insert[] = ['budget_id' => $budget_id, 'amount' => $value['month_5'], 'year' => $month_columns[4]['year'], 'account' => $account, 'month' => $month_columns[4]['month']];
                $data_insert[] = ['budget_id' => $budget_id, 'amount' => $value['month_6'], 'year' => $month_columns[5]['year'], 'account' => $account, 'month' => $month_columns[5]['month']];
                $data_insert[] = ['budget_id' => $budget_id, 'amount' => $value['month_7'], 'year' => $month_columns[6]['year'], 'account' => $account, 'month' => $month_columns[6]['month']];
                $data_insert[] = ['budget_id' => $budget_id, 'amount' => $value['month_8'], 'year' => $month_columns[7]['year'], 'account' => $account, 'month' => $month_columns[7]['month']];
                $data_insert[] = ['budget_id' => $budget_id, 'amount' => $value['month_9'], 'year' => $month_columns[8]['year'], 'account' => $account, 'month' => $month_columns[8]['month']];
                $data_insert[] = ['budget_id' => $budget_id, 'amount' => $value['month_10'], 'year' => $month_columns[9]['year'], 'account' => $account, 'month' => $month_columns[9]['month']];
                $data_insert[] = ['budget_id' => $budget_id, 'amount' => $value['month_11'], 'year' => $month_columns[10]['year'], 'account' => $account, 'month' => $month_columns[10]['month']];
                $data_insert[] = ['budget_id' => $budget_id, 'amount' => $value['month_12'], 'year' => $month_columns[11]['year'], 'account' => $account, 'month' => $month_columns[11]['month']];

            }elseif($import_type == 'quarter'){

                $_value = $value;
                $value['quarter_1'] = $_value['quarter_1'];
                $value['quarter_2'] = $_value['quarter_2'];
                $value['quarter_3'] = $_value['quarter_3'];
                $value['quarter_4'] = $_value['quarter_4'];

                if($value['quarter_1'] > 0)
                {
                    $_from_date = $from_date;
                    $_to_date = $to_date;
                    $total_month = 0;
                    $end_month = 0;

                    while (strtotime($_from_date) <= strtotime($_to_date)) {
                        $_month = date('m', strtotime($_from_date));
                        $_year = date('Y', strtotime($_from_date));

                        if($_month>=1 && $_month<=3)
                        {
                            $total_month += 1;
                            $end_month = $_month;
                        }

                        $_from_date = date('Y-m-d', strtotime('+1 month', strtotime($_from_date)));
                    }

                    $_from_date = $from_date;
                    $_to_date = $to_date;
                    while (strtotime($_from_date) <= strtotime($_to_date)) {
                        $_month = date('m', strtotime($_from_date));
                        $_year = date('Y', strtotime($_from_date));
                        $key = $_month-1;
                        if($_month>=1 && $_month<=3)
                        {
                            $value_1 = round($value['quarter_1']/$total_month);
                            if($total_month > 1){
                                $value_2 = $value['quarter_1'] - ($value_1*($total_month - 1));
                            }else{
                                $value_2 = $value['quarter_1'];
                            }

                            if($end_month == $_month){
                                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[$key]['month'], 'year' => $month_columns[$key]['year'], 'account' => $account, 'amount' => $value_2];
                            }else{
                                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[$key]['month'], 'year' => $month_columns[$key]['year'], 'account' => $account, 'amount' => $value_1];
                            }
                        }

                        $_from_date = date('Y-m-d', strtotime('+1 month', strtotime($_from_date)));
                    }
                }
                if($value['quarter_2'] > 0)
                {
                    $_from_date = $from_date;
                    $_to_date = $to_date;
                    $total_month = 0;
                    $end_month = 0;

                    while (strtotime($_from_date) <= strtotime($_to_date)) {
                        $_month = date('m', strtotime($_from_date));
                        $_year = date('Y', strtotime($_from_date));

                        if($_month>=4 && $_month<=6)
                        {
                            $total_month += 1;
                            $end_month = $_month;
                        }

                        $_from_date = date('Y-m-d', strtotime('+1 month', strtotime($_from_date)));
                    }

                    $_from_date = $from_date;
                    $_to_date = $to_date;
                    while (strtotime($_from_date) <= strtotime($_to_date)) {
                        $_month = date('m', strtotime($_from_date));
                        $_year = date('Y', strtotime($_from_date));
                        $key = $_month-1;

                        if($_month>=4 && $_month<=6)
                        {
                            $value_1 = round($value['quarter_2']/$total_month);
                            if($total_month > 1){
                                $value_2 = $value['quarter_2'] - ($value_1*($total_month - 1));
                            }else{
                                $value_2 = $value_1;
                            }

                            if($end_month == $_month){
                                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[$key]['month'], 'year' => $month_columns[$key]['year'], 'account' => $account, 'amount' => $value_2];
                            }else{
                                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[$key]['month'], 'year' => $month_columns[$key]['year'], 'account' => $account, 'amount' => $value_1];
                            }
                        }

                        $_from_date = date('Y-m-d', strtotime('+1 month', strtotime($_from_date)));
                    }
                }
                if($value['quarter_3'] > 0)
                {
                    $_from_date = $from_date;
                    $_to_date = $to_date;
                    $total_month = 0;
                    $end_month = 0;

                    while (strtotime($_from_date) <= strtotime($_to_date)) {
                        $_month = date('m', strtotime($_from_date));
                        $_year = date('Y', strtotime($_from_date));

                        if($_month>=7 && $_month<=9)
                        {
                            $total_month += 1;
                            $end_month = $_month;
                        }

                        $_from_date = date('Y-m-d', strtotime('+1 month', strtotime($_from_date)));
                    }

                    $_from_date = $from_date;
                    $_to_date = $to_date;
                    while (strtotime($_from_date) <= strtotime($_to_date)) {
                        $_month = date('m', strtotime($_from_date));
                        $_year = date('Y', strtotime($_from_date));
                        $key = $_month-1;

                        if($_month>=7 && $_month<=9)
                        {
                            $value_1 = round($value['quarter_3']/$total_month);
                            if($total_month > 1){
                                $value_2 = $value['quarter_3'] - ($value_1*($total_month - 1));
                            }else{
                                $value_2 = $value_1;
                            }

                            if($end_month == $_month){
                                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[$key]['month'], 'year' => $month_columns[$key]['year'], 'account' => $account, 'amount' => $value_2];
                            }else{
                                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[$key]['month'], 'year' => $month_columns[$key]['year'], 'account' => $account, 'amount' => $value_1];
                            }
                        }

                        $_from_date = date('Y-m-d', strtotime('+1 month', strtotime($_from_date)));
                    }
                }
                if($value['quarter_4'] > 0)
                {
                    $_from_date = $from_date;
                    $_to_date = $to_date;
                    $total_month = 0;
                    $end_month = 0;

                    while (strtotime($_from_date) <= strtotime($_to_date)) {
                        $_month = date('m', strtotime($_from_date));
                        $_year = date('Y', strtotime($_from_date));

                        if($_month>=10 && $_month<=12)
                        {
                            $total_month += 1;
                            $end_month = $_month;
                        }

                        $_from_date = date('Y-m-d', strtotime('+1 month', strtotime($_from_date)));
                    }

                    $_from_date = $from_date;
                    $_to_date = $to_date;
                    while (strtotime($_from_date) <= strtotime($_to_date)) {
                        $_month = date('m', strtotime($_from_date));
                        $_year = date('Y', strtotime($_from_date));
                        $key = $_month-1;

                        if($_month>=10 && $_month<=12)
                        {
                            $value_1 = round($value['quarter_4']/$total_month);
                            if($total_month > 1){
                                $value_2 = $value['quarter_4'] - ($value_1*($total_month - 1));
                            }else{
                                $value_2 = $value_1;
                            }

                            if($end_month == $_month){
                                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[$key]['month'], 'year' => $month_columns[$key]['year'], 'account' => $account, 'amount' => $value_2];
                            }else{
                                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[$key]['month'], 'year' => $month_columns[$key]['year'], 'account' => $account, 'amount' => $value_1];
                            }
                        }

                        $_from_date = date('Y-m-d', strtotime('+1 month', strtotime($_from_date)));
                    }
                }

            }elseif($import_type == 'year'){
                $value_1 = round($value['amount']/12);
                $value_2 = $value['amount'] - ($value_1*11);

                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[0]['month'], 'year' =>$month_columns[0]['year'], 'account' => $account, 'amount' => $value_1];
                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[1]['month'], 'year' =>$month_columns[1]['year'], 'account' => $account, 'amount' => $value_1];
                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[2]['month'], 'year' =>$month_columns[2]['year'], 'account' => $account, 'amount' => $value_1];
                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[3]['month'], 'year' =>$month_columns[3]['year'], 'account' => $account, 'amount' => $value_1];
                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[4]['month'], 'year' =>$month_columns[4]['year'], 'account' => $account, 'amount' => $value_1];
                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[5]['month'], 'year' =>$month_columns[5]['year'], 'account' => $account, 'amount' => $value_1];
                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[6]['month'], 'year' =>$month_columns[6]['year'], 'account' => $account, 'amount' => $value_1];
                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[7]['month'], 'year' =>$month_columns[7]['year'], 'account' => $account, 'amount' => $value_1];
                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[8]['month'], 'year' =>$month_columns[8]['year'], 'account' => $account, 'amount' => $value_1];
                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[9]['month'], 'year' =>$month_columns[9]['year'], 'account' => $account, 'amount' => $value_1];
                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[10]['month'], 'year' =>$month_columns[10]['year'], 'account' => $account, 'amount' => $value_1];
                $data_insert[] = ['budget_id' => $budget_id, 'month' => $month_columns[11]['month'], 'year' =>$month_columns[11]['year'], 'account' => $account, 'amount' => $value_2];
            }
        }

        if(count($data_insert) > 0){
            $affectedRows = $this->db->insert_batch(db_prefix().'acc_budget_details',  $data_insert);
        }

        return true;
    }

    /**
     * get html profit and loss
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_custom_summary_report($child_account, $data_return, $parent_index, $currency){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $val) {
            $data_return['row_index']++;
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
            <td>
            '.$val['name'].'
            </td>';
            $total = 0;
            foreach($val['amount'] as $amount){
                $data_return['html'] .= '
                <td class="total_amount">
                '.app_format_money($amount, $currency->name).'
                </td>';
                $total += $amount;

            }
            $total_amount = $total;
            $data_return['html'] .= '
            <td class="total_amount">
            '.app_format_money($total_amount, $currency->name).'
            </td>';
            $data_return['html'] .= '</tr>';
            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_custom_summary_report($val['child_account'], $data_return, $data_return['row_index'], $currency);

                $total_amount += $data_return['total_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                <td>
                '._l('total_for', $val['name']).'
                </td>';
                foreach($val['amount'] as $amount){
                    $data_return['html'] .= '
                    <td class="total_amount"></td>';

                }
                $data_return['html'] .= '<td class="total_amount">
                '.app_format_money($total_amount, $currency->name).'
                </td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $total;
        }
        return $data_return; 
    }

    /**
     * get data custom summary report
     * @param  array $data_filter 
     * @return array           
     */
    public function get_data_custom_summary_report_by_customer($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $display_rows_by = 'income_statement';
        $display_columns_by = 'total_only';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        if(isset($data_filter['display_rows_by'])){
            $display_rows_by = $data_filter['display_rows_by'];
        }

        if(isset($data_filter['display_columns_by'])){
            $display_columns_by = $data_filter['display_columns_by'];
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_accounts = [];

        $clients = $this->clients_model->get();
        $headers = [];

        foreach ($clients as $key => $value) {
            $columns = [];
            switch ($display_columns_by) {
                case 'total_only':
                    $this->db->select('sum(credit) as credit');
                    $this->db->where('customer', $value['userid']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('rel_type != "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('customer', $value['userid']);
                    
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;
                  break;

                case 'months':
                    $start = $month = strtotime($from_date);
                    $end = strtotime($to_date);

                    while($month < $end)
                    {
                        $this->db->select('sum(credit) as credit');
                        $this->db->where('customer', $value['userid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('customer', $value['userid']);
                        
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                        $month = strtotime("+1 month", $month);
                    }
                  break;

                case 'quarters':
                    $start = strtotime($from_date);
                    $end = strtotime($to_date);

                    while ($start < $end) {
                        $month = date('m', $start);
                        $year = date('Y', $start);
                        if($month>=1 && $month<=3)
                        {
                            $start_date = date('Y-m-d', strtotime('1-January-'.$year));  // timestamp or 1-Januray 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                        }
                        else  if($month>=4 && $month<=6)
                        {
                            $start_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                        }
                        else  if($month>=7 && $month<=9)
                        {
                            $start_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                        }
                        else  if($month>=10 && $month<=12)
                        {
                            $start_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-January-'.($year+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                        }

                        $custom_date_select = '(date BETWEEN "' .
                        $start_date .
                        '" AND "' .
                        $end_date . '")';

                        $this->db->select('sum(credit) as credit');
                        $this->db->where('customer', $value['userid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where($custom_date_select);
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('customer', $value['userid']);
                        
                        $this->db->where('rel_type = "expense"');
                        $this->db->where($custom_date_select);
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                       

                        $start = strtotime('+3 month', $start);

                        if($start > $end){
                            $month_2 = date('m', $start);
                            $year_2 = date('Y', $start);
                            
                            if($month_2>=1 && $month_2<=3)
                            {
                                $start_date = date('Y-m-d', strtotime('1-January-'.$year_2));  // timestamp or 1-Januray 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                            }
                            else  if($month_2>=4 && $month_2<=6)
                            {
                                $start_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                            }
                            else  if($month_2>=7 && $month_2<=9)
                            {
                                $start_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                            }
                            else  if($month_2>=10 && $month_2<=12)
                            {
                                $start_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-January-'.($year_2+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                            }

                            if($month . ' - ' . $year != $month_2 . ' - ' . $year_2){
                                $custom_date_select = '(date BETWEEN "' .
                                $start_date .
                                '" AND "' .
                                $end_date . '")';

                                $this->db->select('sum(credit) as credit');
                                $this->db->where('customer', $value['userid']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('rel_type != "expense"');
                                $this->db->where($custom_date_select);
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                                $this->db->select('sum(debit) as debit');
                                $this->db->where('customer', $value['userid']);
                                
                                $this->db->where('rel_type = "expense"');
                                $this->db->where($custom_date_select);
                                $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                                $columns[] = $credits - $debits;
                            }
                        }
                    }
                    break;

                case 'years':
                    $start = strtotime($from_date);
                    $end = strtotime($to_date);

                    while ($start < $end) {
                        $year = date('Y', $start);

                        $this->db->select('sum(credit) as credit');
                        $this->db->where('customer', $value['userid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('year(date) = "' . $year . '"');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('customer', $value['userid']);
                        
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('year(date) = "' . $year . '"');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;

                        $start = strtotime('+1 year', $start);

                        if($start > $end){
                            $year_2 = date('Y', $end);
                      
                            if($year != $year_2){
                                $this->db->select('sum(credit) as credit');
                                $this->db->where('customer', $value['userid']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('rel_type != "expense"');
                                $this->db->where('year(date) = "' . $year_2 . '"');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                                $this->db->select('sum(debit) as debit');
                                $this->db->where('customer', $value['userid']);
                                
                                $this->db->where('rel_type = "expense"');
                                $this->db->where('year(date) = "' . $year_2 . '"');
                                $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                                $columns[] = $credits - $debits;
                            }
                        }
                    }
                    break;

                case 'vendors':
                    $this->load->model('purchase/purchase_model');
                    $vendors = $this->purchase_model->get_vendor();
                    foreach ($vendors as $key => $vendor) {
                        $columns[] = 0;
                    }

                    $this->db->select('sum(credit) as credit');
                    $this->db->where('customer', $value['userid']);
                    $this->db->where('(vendor = 0 or vendor is null)');
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('rel_type != "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('customer', $value['userid']);
                    $this->db->where('(vendor = 0 or vendor is null)');
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;
                  break;

                case 'employees':
                  $this->load->model('staff_model');
                  $staffs = $this->staff_model->get();
                  foreach ($staffs as $key => $staff) {
                    $this->db->select('sum(credit) as credit');
                    $this->db->where('customer', $value['userid']);
                    $this->db->where('addedfrom', $staff['staffid']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('rel_type != "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('customer', $value['userid']);
                    $this->db->where('addedfrom', $staff['staffid']);
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;
                  }
                  break;

                case 'product_service':
                    $this->load->model('invoice_items_model');
                    $items = $this->invoice_items_model->get();
                    foreach ($items as $key => $item) {
                        $this->db->select('sum(credit) as credit');
                        $this->db->where('customer', $value['userid']);
                        $this->db->where('item', $item['itemid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('customer', $value['userid']);
                        $this->db->where('item', $item['itemid']);
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                    }

                    $this->db->select('sum(credit) as credit');
                    $this->db->where('customer', $value['userid']);
                    $this->db->where('(item = 0 or item is null)');
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('rel_type != "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('customer', $value['userid']);
                    $this->db->where('(item = 0 or item is null)');
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;
                    break;
                default:
                  // code...
                  break;
            }

            $data_report[] = ['name' => $value['company'], 'columns' => $columns];
        }

        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date, 'display_rows_by' => $display_rows_by, 'display_columns_by' => $display_columns_by];
    }

    /**
     * get data custom summary report
     * @param  array $data_filter 
     * @return array           
     */
    public function get_data_custom_summary_report_by_income_statement($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $display_rows_by = 'income_statement';
        $display_columns_by = 'total_only';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        if(isset($data_filter['display_rows_by'])){
            $display_rows_by = $data_filter['display_rows_by'];
        }

        if(isset($data_filter['display_columns_by'])){
            $display_columns_by = $data_filter['display_columns_by'];
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_accounts = [];

        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }

                    $columns = [];
                    switch ($display_columns_by) {
                        case 'total_only':
                            $this->db->select('sum(credit) as credit, sum(debit) as debit');
                            $this->db->where('account', $val['id']);
                            if($accounting_method == 'cash'){
                                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                            }
                            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                            $credits = $account_history->credit != '' ? $account_history->credit : 0;
                            $debits = $account_history->debit != '' ? $account_history->debit : 0;

                            if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                                $columns[] = $credits - $debits;
                            }else{
                                $columns[] = $debits - $credits;
                            }
                          break;

                        case 'months':
                            $start = $month = strtotime($from_date);
                            $end = strtotime($to_date);

                            while($month < $end)
                            {
                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('account', $val['id']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;

                                if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }

                                $month = strtotime("+1 month", $month);
                            }
                          break;

                        case 'quarters':
                            $start = strtotime($from_date);
                            $end = strtotime($to_date);

                            while ($start < $end) {
                                $month = date('m', $start);
                                $year = date('Y', $start);
                                if($month>=1 && $month<=3)
                                {
                                    $start_date = date('Y-m-d', strtotime('1-January-'.$year));  // timestamp or 1-Januray 12:00:00 AM
                                    $end_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                                }
                                else  if($month>=4 && $month<=6)
                                {
                                    $start_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM
                                    $end_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                                }
                                else  if($month>=7 && $month<=9)
                                {
                                    $start_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM
                                    $end_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                                }
                                else  if($month>=10 && $month<=12)
                                {
                                    $start_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM
                                    $end_date = date('Y-m-d', strtotime('1-January-'.($year+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                                }

                                $custom_date_select = '(date BETWEEN "' .
                                $start_date .
                                '" AND "' .
                                $end_date . '")';

                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('account', $val['id']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where($custom_date_select);
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;
                                
                                if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }

                                $start = strtotime('+3 month', $start);

                                if($start > $end){
                                    $month_2 = date('m', $start);
                                    $year_2 = date('Y', $start);
                                    
                                    if($month_2>=1 && $month_2<=3)
                                    {
                                        $start_date = date('Y-m-d', strtotime('1-January-'.$year_2));  // timestamp or 1-Januray 12:00:00 AM
                                        $end_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                                    }
                                    else  if($month_2>=4 && $month_2<=6)
                                    {
                                        $start_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM
                                        $end_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                                    }
                                    else  if($month_2>=7 && $month_2<=9)
                                    {
                                        $start_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM
                                        $end_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                                    }
                                    else  if($month_2>=10 && $month_2<=12)
                                    {
                                        $start_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM
                                        $end_date = date('Y-m-d', strtotime('1-January-'.($year_2+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                                    }

                                    if($month . ' - ' . $year != $month_2 . ' - ' . $year_2){
                                        $custom_date_select = '(date BETWEEN "' .
                                        $start_date .
                                        '" AND "' .
                                        $end_date . '")';

                                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                        $this->db->where('account', $val['id']);
                                        if($accounting_method == 'cash'){
                                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                        }
                                        $this->db->where($custom_date_select);
                                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                        $debits = $account_history->debit != '' ? $account_history->debit : 0;

                                        if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                                            $columns[] = $credits - $debits;
                                        }else{
                                            $columns[] = $debits - $credits;
                                        }
                                    }
                                }
                            }
                            break;

                        case 'years':
                            $start = strtotime($from_date);
                            $end = strtotime($to_date);

                            while ($start < $end) {
                                $year = date('Y', $start);

                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('account', $val['id']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('year(date) = "' . $year . '"');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;
                                
                                if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }

                                $start = strtotime('+1 year', $start);

                                if($start > $end){
                                    $year_2 = date('Y', $end);
                              
                                    if($year != $year_2){
                                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                        $this->db->where('account', $val['id']);
                                        if($accounting_method == 'cash'){
                                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                        }
                                        $this->db->where('year(date) = "' . $year_2 . '"');
                                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                                        
                                        if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                                            $columns[] = $credits - $debits;
                                        }else{
                                            $columns[] = $debits - $credits;
                                        }
                                    }
                                }
                            }
                            break;
                        case 'customers':
                            $this->load->model('clients_model');
                            $clients = $this->clients_model->get();
                            foreach ($clients as $key => $client) {
                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('customer', $client['userid']);
                                $this->db->where('account', $val['id']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;
                                
                                if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }
                            }

                            $this->db->select('sum(credit) as credit, sum(debit) as debit');
                            $this->db->where('account', $val['id']);
                            $this->db->where('(customer = 0 or customer is null)');
                            if($accounting_method == 'cash'){
                                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                            }
                            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                            $credits = $account_history->credit != '' ? $account_history->credit : 0;
                            $debits = $account_history->debit != '' ? $account_history->debit : 0;
                            
                            if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                                $columns[] = $credits - $debits;
                            }else{
                                $columns[] = $debits - $credits;
                            }
                          break;

                        case 'vendors':
                            $this->load->model('purchase/purchase_model');
                            $vendors = $this->purchase_model->get_vendor();
                            foreach ($vendors as $key => $vendor) {
                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('account', $val['id']);
                                $this->db->where('vendor', $vendor['userid']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;
                                
                                if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }
                            }

                            $this->db->select('sum(credit) as credit, sum(debit) as debit');
                            $this->db->where('account', $val['id']);
                            $this->db->where('(vendor = 0 or vendor is null)');
                            if($accounting_method == 'cash'){
                                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                            }
                            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                            $credits = $account_history->credit != '' ? $account_history->credit : 0;
                            $debits = $account_history->debit != '' ? $account_history->debit : 0;
                            
                            if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                                $columns[] = $credits - $debits;
                            }else{
                                $columns[] = $debits - $credits;
                            }
                          break;

                        case 'employees':
                          $this->load->model('staff_model');
                          $staffs = $this->staff_model->get();
                          foreach ($staffs as $key => $staff) {
                            $this->db->select('sum(credit) as credit, sum(debit) as debit');
                            $this->db->where('account', $val['id']);
                            $this->db->where('addedfrom', $staff['staffid']);
                            if($accounting_method == 'cash'){
                                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                            }
                            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                            $credits = $account_history->credit != '' ? $account_history->credit : 0;
                            $debits = $account_history->debit != '' ? $account_history->debit : 0;
                            
                            if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                                $columns[] = $credits - $debits;
                            }else{
                                $columns[] = $debits - $credits;
                            }
                          }
                          break;

                        case 'product_service':
                            $this->load->model('invoice_items_model');
                            $items = $this->invoice_items_model->get();
                            foreach ($items as $key => $item) {
                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('account', $val['id']);
                                $this->db->where('item', $item['itemid']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;
                                
                                if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }
                            }
                            $this->db->select('sum(credit) as credit, sum(debit) as debit');
                            $this->db->where('account', $val['id']);
                            $this->db->where('(item = 0 or item is null)');
                            if($accounting_method == 'cash'){
                                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                            }
                            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                            $credits = $account_history->credit != '' ? $account_history->credit : 0;
                            $debits = $account_history->debit != '' ? $account_history->debit : 0;
                            
                            if($value['account_type_id'] == 11 || $value['account_type_id'] == 12){
                                $columns[] = $credits - $debits;
                            }else{
                                $columns[] = $debits - $credits;
                            }
                            
                            break;
                        default:
                          // code...
                          break;
                    }

                    $child_account = $this->get_data_custom_summary_report_by_income_statement_recursive([
                        'child_account' => [],
                        'account_id' => $val['id'],
                        'account_type_id' => $value['account_type_id'],
                        'from_date' => $from_date,
                        'to_date' => $to_date,
                        'accounting_method' => $accounting_method,
                        'acc_show_account_numbers' => $acc_show_account_numbers,
                        'display_rows_by' => $display_rows_by,
                        'display_columns_by' => $display_columns_by,
                    ]);

                    $data_report[$data_key][] = ['name' => $name, 'columns' => $columns, 'child_account' => $child_account];
                }
            }
        }

        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date, 'display_rows_by' => $display_rows_by, 'display_columns_by' => $display_columns_by];
    }

    /**
     * get data custom summary report
     * @param  array $data_filter 
     * @return array           
     */
    public function get_data_custom_summary_report_by_employees($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $display_rows_by = 'income_statement';
        $display_columns_by = 'total_only';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        if(isset($data_filter['display_rows_by'])){
            $display_rows_by = $data_filter['display_rows_by'];
        }

        if(isset($data_filter['display_columns_by'])){
            $display_columns_by = $data_filter['display_columns_by'];
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_accounts = [];

        $staffs = $this->staff_model->get();
        $headers = [];

        foreach ($staffs as $key => $value) {
            $columns = [];
            switch ($display_columns_by) {
                case 'total_only':
                    $this->db->select('sum(credit) as credit');
                    $this->db->where('addedfrom', $value['staffid']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('rel_type != "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('addedfrom', $value['staffid']);
                    
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;
                  break;

                case 'months':
                    $start = $month = strtotime($from_date);
                    $end = strtotime($to_date);

                    while($month < $end)
                    {
                        $this->db->select('sum(credit) as credit');
                        $this->db->where('addedfrom', $value['staffid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('addedfrom', $value['staffid']);
                        
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                        $month = strtotime("+1 month", $month);
                    }
                  break;

                case 'quarters':
                    $start = strtotime($from_date);
                    $end = strtotime($to_date);

                    while ($start < $end) {
                        $month = date('m', $start);
                        $year = date('Y', $start);
                        if($month>=1 && $month<=3)
                        {
                            $start_date = date('Y-m-d', strtotime('1-January-'.$year));  // timestamp or 1-Januray 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                        }
                        else  if($month>=4 && $month<=6)
                        {
                            $start_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                        }
                        else  if($month>=7 && $month<=9)
                        {
                            $start_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                        }
                        else  if($month>=10 && $month<=12)
                        {
                            $start_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-January-'.($year+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                        }

                        $custom_date_select = '(date BETWEEN "' .
                        $start_date .
                        '" AND "' .
                        $end_date . '")';

                        $this->db->select('sum(credit) as credit');
                        $this->db->where('addedfrom', $value['staffid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where($custom_date_select);
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('addedfrom', $value['staffid']);
                        
                        $this->db->where('rel_type = "expense"');
                        $this->db->where($custom_date_select);
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                       

                        $start = strtotime('+3 month', $start);

                        if($start > $end){
                            $month_2 = date('m', $start);
                            $year_2 = date('Y', $start);
                            
                            if($month_2>=1 && $month_2<=3)
                            {
                                $start_date = date('Y-m-d', strtotime('1-January-'.$year_2));  // timestamp or 1-Januray 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                            }
                            else  if($month_2>=4 && $month_2<=6)
                            {
                                $start_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                            }
                            else  if($month_2>=7 && $month_2<=9)
                            {
                                $start_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                            }
                            else  if($month_2>=10 && $month_2<=12)
                            {
                                $start_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-January-'.($year_2+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                            }

                            if($month . ' - ' . $year != $month_2 . ' - ' . $year_2){
                                $custom_date_select = '(date BETWEEN "' .
                                $start_date .
                                '" AND "' .
                                $end_date . '")';

                                $this->db->select('sum(credit) as credit');
                                $this->db->where('addedfrom', $value['staffid']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('rel_type != "expense"');
                                $this->db->where($custom_date_select);
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                                $this->db->select('sum(debit) as debit');
                                $this->db->where('addedfrom', $value['staffid']);
                                
                                $this->db->where('rel_type = "expense"');
                                $this->db->where($custom_date_select);
                                $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                                $columns[] = $credits - $debits;
                            }
                        }
                    }
                    break;

                case 'years':
                    $start = strtotime($from_date);
                    $end = strtotime($to_date);

                    while ($start < $end) {
                        $year = date('Y', $start);

                        $this->db->select('sum(credit) as credit');
                        $this->db->where('addedfrom', $value['staffid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('year(date) = "' . $year . '"');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('addedfrom', $value['staffid']);
                        
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('year(date) = "' . $year . '"');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;

                        $start = strtotime('+1 year', $start);

                        if($start > $end){
                            $year_2 = date('Y', $end);
                      
                            if($year != $year_2){
                                $this->db->select('sum(credit) as credit');
                                $this->db->where('addedfrom', $value['staffid']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('rel_type != "expense"');
                                $this->db->where('year(date) = "' . $year_2 . '"');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                                $this->db->select('sum(debit) as debit');
                                $this->db->where('addedfrom', $value['staffid']);
                                
                                $this->db->where('rel_type = "expense"');
                                $this->db->where('year(date) = "' . $year_2 . '"');
                                $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                                $columns[] = $credits - $debits;
                            }
                        }
                    }
                    break;

                case 'vendors':
                    $this->load->model('purchase/purchase_model');
                    $vendors = $this->purchase_model->get_vendor();
                    foreach ($vendors as $key => $vendor) {
                        $this->db->select('sum(credit) as credit');
                        $this->db->where('addedfrom', $value['staffid']);
                        $this->db->where('vendor', $vendor['userid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('addedfrom', $value['staffid']);
                        $this->db->where('vendor', $vendor['userid']);
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                    }

                    $this->db->select('sum(credit) as credit');
                    $this->db->where('addedfrom', $value['staffid']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('rel_type != "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('addedfrom', $value['staffid']);
                    
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;
                  break;

                case 'customers':
                    $this->load->model('clients_model');
                    $clients = $this->clients_model->get();
                    foreach ($clients as $key => $client) {
                        $this->db->select('sum(credit) as credit');
                        $this->db->where('addedfrom', $value['staffid']);
                        $this->db->where('customer', $client['userid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('addedfrom', $value['staffid']);
                        $this->db->where('customer', $client['userid']);
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                    }

                    $this->db->select('sum(credit) as credit');
                    $this->db->where('addedfrom', $value['staffid']);
                    $this->db->where('(customer = 0 or customer is null)');
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('rel_type != "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('addedfrom', $value['staffid']);
                    $this->db->where('(customer = 0 or customer is null)');
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;

                  break;

                case 'product_service':
                    $this->load->model('invoice_items_model');
                    $items = $this->invoice_items_model->get();
                    foreach ($items as $key => $item) {
                        $this->db->select('sum(credit) as credit');
                        $this->db->where('addedfrom', $value['staffid']);
                        $this->db->where('item', $item['itemid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('addedfrom', $value['staffid']);
                        $this->db->where('item', $item['itemid']);
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                    }

                    $this->db->select('sum(credit) as credit');
                    $this->db->where('addedfrom', $value['staffid']);
                    $this->db->where('(item = 0 or item is null)');
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('rel_type != "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('addedfrom', $value['staffid']);
                    $this->db->where('(item = 0 or item is null)');
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;
                    break;
                default:
                  // code...
                  break;
            }

            $data_report[] = ['name' => $value['full_name'], 'columns' => $columns];
        }

        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date, 'display_rows_by' => $display_rows_by, 'display_columns_by' => $display_columns_by];
    }

    /**
     * get data custom summary report
     * @param  array $data_filter 
     * @return array           
     */
    public function get_data_custom_summary_report_by_vendors($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $display_rows_by = 'income_statement';
        $display_columns_by = 'total_only';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        if(isset($data_filter['display_rows_by'])){
            $display_rows_by = $data_filter['display_rows_by'];
        }

        if(isset($data_filter['display_columns_by'])){
            $display_columns_by = $data_filter['display_columns_by'];
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_accounts = [];

        $this->load->model('purchase/purchase_model');
        $vendors = $this->purchase_model->get_vendor();

        $headers = [];

        foreach ($vendors as $key => $value) {
            $columns = [];
            switch ($display_columns_by) {
                case 'total_only':
                    $this->db->select('sum(credit) as credit');
                    $this->db->where('vendor', $value['userid']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('rel_type != "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('vendor', $value['userid']);
                    
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;
                  break;

                case 'months':
                    $start = $month = strtotime($from_date);
                    $end = strtotime($to_date);

                    while($month < $end)
                    {
                        $this->db->select('sum(credit) as credit');
                        $this->db->where('vendor', $value['userid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('vendor', $value['userid']);
                        
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                        $month = strtotime("+1 month", $month);
                    }
                  break;

                case 'quarters':
                    $start = strtotime($from_date);
                    $end = strtotime($to_date);

                    while ($start < $end) {
                        $month = date('m', $start);
                        $year = date('Y', $start);
                        if($month>=1 && $month<=3)
                        {
                            $start_date = date('Y-m-d', strtotime('1-January-'.$year));  // timestamp or 1-Januray 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                        }
                        else  if($month>=4 && $month<=6)
                        {
                            $start_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                        }
                        else  if($month>=7 && $month<=9)
                        {
                            $start_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                        }
                        else  if($month>=10 && $month<=12)
                        {
                            $start_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-January-'.($year+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                        }

                        $custom_date_select = '(date BETWEEN "' .
                        $start_date .
                        '" AND "' .
                        $end_date . '")';

                        $this->db->select('sum(credit) as credit');
                        $this->db->where('vendor', $value['userid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where($custom_date_select);
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('vendor', $value['userid']);
                        
                        $this->db->where('rel_type = "expense"');
                        $this->db->where($custom_date_select);
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                       

                        $start = strtotime('+3 month', $start);

                        if($start > $end){
                            $month_2 = date('m', $start);
                            $year_2 = date('Y', $start);
                            
                            if($month_2>=1 && $month_2<=3)
                            {
                                $start_date = date('Y-m-d', strtotime('1-January-'.$year_2));  // timestamp or 1-Januray 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                            }
                            else  if($month_2>=4 && $month_2<=6)
                            {
                                $start_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                            }
                            else  if($month_2>=7 && $month_2<=9)
                            {
                                $start_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                            }
                            else  if($month_2>=10 && $month_2<=12)
                            {
                                $start_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-January-'.($year_2+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                            }

                            if($month . ' - ' . $year != $month_2 . ' - ' . $year_2){
                                $custom_date_select = '(date BETWEEN "' .
                                $start_date .
                                '" AND "' .
                                $end_date . '")';

                                $this->db->select('sum(credit) as credit');
                                $this->db->where('vendor', $value['userid']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('rel_type != "expense"');
                                $this->db->where($custom_date_select);
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                                $this->db->select('sum(debit) as debit');
                                $this->db->where('vendor', $value['userid']);
                                
                                $this->db->where('rel_type = "expense"');
                                $this->db->where($custom_date_select);
                                $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                                $columns[] = $credits - $debits;
                            }
                        }
                    }
                    break;

                case 'years':
                    $start = strtotime($from_date);
                    $end = strtotime($to_date);

                    while ($start < $end) {
                        $year = date('Y', $start);

                        $this->db->select('sum(credit) as credit');
                        $this->db->where('vendor', $value['userid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('year(date) = "' . $year . '"');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('vendor', $value['userid']);
                        
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('year(date) = "' . $year . '"');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;

                        $start = strtotime('+1 year', $start);

                        if($start > $end){
                            $year_2 = date('Y', $end);
                      
                            if($year != $year_2){
                                $this->db->select('sum(credit) as credit');
                                $this->db->where('vendor', $value['userid']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('rel_type != "expense"');
                                $this->db->where('year(date) = "' . $year_2 . '"');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                                $this->db->select('sum(debit) as debit');
                                $this->db->where('vendor', $value['userid']);
                                
                                $this->db->where('rel_type = "expense"');
                                $this->db->where('year(date) = "' . $year_2 . '"');
                                $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                                $columns[] = $credits - $debits;
                            }
                        }
                    }
                    break;

                case 'customers':
                    $this->load->model('clients_model');
                    $clients = $this->clients_model->get();
                    foreach ($clients as $key => $client) {
                        $columns[] = 0;
                    }

                    $this->db->select('sum(credit) as credit');
                    $this->db->where('vendor', $value['userid']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('rel_type != "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('vendor', $value['userid']);
                    
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;
                  break;

                case 'employees':
                  $this->load->model('staff_model');
                  $staffs = $this->staff_model->get();
                  foreach ($staffs as $key => $staff) {
                    $this->db->select('sum(credit) as credit');
                    $this->db->where('vendor', $value['userid']);
                    $this->db->where('addedfrom', $staff['staffid']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('rel_type != "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('vendor', $value['userid']);
                    $this->db->where('addedfrom', $staff['staffid']);
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;
                  }
                  break;

                case 'product_service':
                    $this->load->model('invoice_items_model');
                    $items = $this->invoice_items_model->get();
                    foreach ($items as $key => $item) {
                        $this->db->select('sum(credit) as credit');
                        $this->db->where('vendor', $value['userid']);
                        $this->db->where('item', $item['itemid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('vendor', $value['userid']);
                        $this->db->where('item', $item['itemid']);
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                    }

                    $this->db->select('sum(credit) as credit');
                    $this->db->where('vendor', $value['userid']);
                    $this->db->where('(item = 0 or item is null)');
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('rel_type != "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('vendor', $value['userid']);
                    $this->db->where('(item = 0 or item is null)');
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;
                    break;
                default:
                  // code...
                  break;
            }

            $data_report[] = ['name' => $value['company'], 'columns' => $columns];
        }

        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date, 'display_rows_by' => $display_rows_by, 'display_columns_by' => $display_columns_by];
    }

    /**
     * get data custom summary report
     * @param  array $data_filter 
     * @return array           
     */
    public function get_data_custom_summary_report_by_product_service($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $display_rows_by = 'income_statement';
        $display_columns_by = 'total_only';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        if(isset($data_filter['display_rows_by'])){
            $display_rows_by = $data_filter['display_rows_by'];
        }

        if(isset($data_filter['display_columns_by'])){
            $display_columns_by = $data_filter['display_columns_by'];
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_accounts = [];

        $this->load->model('invoice_items_model');
        $items = $this->invoice_items_model->get();

        $headers = [];

        foreach ($items as $key => $value) {
            $columns = [];
            switch ($display_columns_by) {
                case 'total_only':
                    $this->db->select('sum(credit) as credit');
                    $this->db->where('item', $value['itemid']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('rel_type != "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('item', $value['itemid']);
                    
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;
                  break;

                case 'months':
                    $start = $month = strtotime($from_date);
                    $end = strtotime($to_date);

                    while($month < $end)
                    {
                        $this->db->select('sum(credit) as credit');
                        $this->db->where('item', $value['itemid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('item', $value['itemid']);
                        
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                        $month = strtotime("+1 month", $month);
                    }
                  break;

                case 'quarters':
                    $start = strtotime($from_date);
                    $end = strtotime($to_date);

                    while ($start < $end) {
                        $month = date('m', $start);
                        $year = date('Y', $start);
                        if($month>=1 && $month<=3)
                        {
                            $start_date = date('Y-m-d', strtotime('1-January-'.$year));  // timestamp or 1-Januray 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                        }
                        else  if($month>=4 && $month<=6)
                        {
                            $start_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                        }
                        else  if($month>=7 && $month<=9)
                        {
                            $start_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                        }
                        else  if($month>=10 && $month<=12)
                        {
                            $start_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-January-'.($year+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                        }

                        $custom_date_select = '(date BETWEEN "' .
                        $start_date .
                        '" AND "' .
                        $end_date . '")';

                        $this->db->select('sum(credit) as credit');
                        $this->db->where('item', $value['itemid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where($custom_date_select);
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('item', $value['itemid']);
                        
                        $this->db->where('rel_type = "expense"');
                        $this->db->where($custom_date_select);
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                       

                        $start = strtotime('+3 month', $start);

                        if($start > $end){
                            $month_2 = date('m', $start);
                            $year_2 = date('Y', $start);
                            
                            if($month_2>=1 && $month_2<=3)
                            {
                                $start_date = date('Y-m-d', strtotime('1-January-'.$year_2));  // timestamp or 1-Januray 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                            }
                            else  if($month_2>=4 && $month_2<=6)
                            {
                                $start_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                            }
                            else  if($month_2>=7 && $month_2<=9)
                            {
                                $start_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                            }
                            else  if($month_2>=10 && $month_2<=12)
                            {
                                $start_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-January-'.($year_2+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                            }

                            if($month . ' - ' . $year != $month_2 . ' - ' . $year_2){
                                $custom_date_select = '(date BETWEEN "' .
                                $start_date .
                                '" AND "' .
                                $end_date . '")';

                                $this->db->select('sum(credit) as credit');
                                $this->db->where('item', $value['itemid']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('rel_type != "expense"');
                                $this->db->where($custom_date_select);
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                                $this->db->select('sum(debit) as debit');
                                $this->db->where('item', $value['itemid']);
                                
                                $this->db->where('rel_type = "expense"');
                                $this->db->where($custom_date_select);
                                $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                                $columns[] = $credits - $debits;
                            }
                        }
                    }
                    break;

                case 'years':
                    $start = strtotime($from_date);
                    $end = strtotime($to_date);

                    while ($start < $end) {
                        $year = date('Y', $start);

                        $this->db->select('sum(credit) as credit');
                        $this->db->where('item', $value['itemid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('year(date) = "' . $year . '"');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('item', $value['itemid']);
                        
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('year(date) = "' . $year . '"');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;

                        $start = strtotime('+1 year', $start);

                        if($start > $end){
                            $year_2 = date('Y', $end);
                      
                            if($year != $year_2){
                                $this->db->select('sum(credit) as credit');
                                $this->db->where('item', $value['itemid']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('rel_type != "expense"');
                                $this->db->where('year(date) = "' . $year_2 . '"');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                                $this->db->select('sum(debit) as debit');
                                $this->db->where('item', $value['itemid']);
                                
                                $this->db->where('rel_type = "expense"');
                                $this->db->where('year(date) = "' . $year_2 . '"');
                                $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                                $columns[] = $credits - $debits;
                            }
                        }
                    }
                    break;

                case 'vendors':
                    $this->load->model('purchase/purchase_model');
                    $vendors = $this->purchase_model->get_vendor();
                    foreach ($vendors as $key => $vendor) {
                        $this->db->select('sum(credit) as credit');
                        $this->db->where('item', $value['itemid']);
                        $this->db->where('vendor', $vendor['userid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('item', $value['itemid']);
                        $this->db->where('vendor', $vendor['userid']);
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                    }

                    $this->db->select('sum(credit) as credit');
                    $this->db->where('item', $value['itemid']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('rel_type != "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('item', $value['itemid']);
                    
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;
                  break;

                case 'customers':
                    $this->load->model('clients_model');
                    $clients = $this->clients_model->get();
                    foreach ($clients as $key => $client) {
                        $this->db->select('sum(credit) as credit');
                        $this->db->where('item', $value['itemid']);
                        $this->db->where('customer', $client['userid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('item', $value['itemid']);
                        $this->db->where('customer', $client['userid']);
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                    }

                    $this->db->select('sum(credit) as credit');
                    $this->db->where('item', $value['itemid']);
                    $this->db->where('(customer = 0 or customer is null)');
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $this->db->where('rel_type != "expense"');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $this->db->select('sum(debit) as debit');
                    $this->db->where('item', $value['itemid']);
                    $this->db->where('(customer = 0 or customer is null)');
                    $this->db->where('rel_type = "expense"');
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                    $columns[] = $credits - $debits;

                  break;

                case 'employees':
                    $this->load->model('staff_model');
                    $staffs = $this->staff_model->get();
                    foreach ($staffs as $key => $staff) {
                        $this->db->select('sum(credit) as credit');
                        $this->db->where('item', $value['itemid']);
                        $this->db->where('addedfrom', $staff['staffid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('rel_type != "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                        $this->db->select('sum(debit) as debit');
                        $this->db->where('item', $value['itemid']);
                        $this->db->where('addedfrom', $staff['staffid']);
                        $this->db->where('rel_type = "expense"');
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history_2 = $this->db->get(db_prefix().'acc_account_history')->row();

                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history_2->debit != '' ? $account_history_2->debit : 0;
                        $columns[] = $credits - $debits;
                    }
                  break;
                default:
                  // code...
                  break;
            }

            $data_report[] = ['name' => $value['description'], 'columns' => $columns];
        }

        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date, 'display_rows_by' => $display_rows_by, 'display_columns_by' => $display_columns_by];
    }

    /**
     * get html custom summary
     * @param  array $child_account 
     * @param  array $data_return   
     * @param  integer $parent_index  
     * @param  object $currency      
     * @return array               
     */
    public function get_html_custom_summary_by_income_statement($child_account, $data_return, $parent_index, $currency, $display_columns_by){
        $total_amount = 0;
        $data_return['total_amount'] = 0;
        foreach ($child_account as $val) {

            $data_return['row_index']++;
            $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' expanded">
              <td>
              '.$val['name'].'
              </td>';
            $amount = 0;
            $total_amount = $amount;
            $html_column = '';

            foreach($val['columns'] as $column){
                $amount += $column;
                $html_column .= '<td></td>';
                $data_return['html'] .= '<td class="total_amount">'.app_format_money($column, $currency->name).'</td>';
            }
            if ($display_columns_by != 'total_only') {
                $data_return['html'] .= '<td class="total_amount">
                  '.app_format_money($amount, $currency->name).'
                  </td>
                </tr>';
            }

            if(count($val['child_account']) > 0){
                $t = $data_return['total_amount'];
                $data_return = $this->get_html_custom_summary_by_income_statement($val['child_account'], $data_return, $data_return['row_index'], $currency, $display_columns_by);

                $total_amount += $data_return['total_amount'];
                
                $data_return['row_index']++;
                $data_return['html'] .= '<tr class="treegrid-'.$data_return['row_index'].' '.($parent_index != 0 ? 'treegrid-parent-'.$parent_index : '').' tr_total">
                  <td>
                  '._l('total_for', $val['name']).'
                  </td>';
                    if ($display_columns_by != 'total_only') {
                        $data_return['html'] .= $html_column;
                    }
                $data_return['html'] .= '<td class="total_amount">
                  '.app_format_money($total_amount, $currency->name).'
                  </td>
                </tr>';
                $data_return['total_amount'] += $t;
            }

            $data_return['total_amount'] += $amount;
        }
        return $data_return; 
    }

    /**
     * get data custom summary recursive
     * @param  array $data         
     * @return array                 
     */
    public function get_data_custom_summary_report_by_income_statement_recursive($data){
        $child_account = $data['child_account'];
        $account_id = $data['account_id'];
        $account_type_id = $data['account_type_id'];
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $accounting_method = $data['accounting_method'];
        $acc_show_account_numbers = $data['acc_show_account_numbers'];
        $display_rows_by = $data['display_rows_by'];
        $display_columns_by = $data['display_columns_by'];

        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        $data_return = [];
       
        foreach ($accounts as $val) {
            $columns = [];
            switch ($display_columns_by) {
                case 'total_only':
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;

                    if($account_type_id == 11 || $account_type_id == 12){
                        $columns[] = $credits - $debits;
                    }else{
                        $columns[] = $debits - $credits;
                    }
                  break;

                case 'months':
                    $start = $month = strtotime($from_date);
                    $end = strtotime($to_date);

                    while($month < $end)
                    {
                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('account', $val['id']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;

                        if($account_type_id == 11 || $account_type_id == 12){
                            $columns[] = $credits - $debits;
                        }else{
                            $columns[] = $debits - $credits;
                        }

                        $month = strtotime("+1 month", $month);
                    }
                  break;

                case 'quarters':
                    $start = strtotime($from_date);
                    $end = strtotime($to_date);

                    while ($start < $end) {
                        $month = date('m', $start);
                        $year = date('Y', $start);
                        if($month>=1 && $month<=3)
                        {
                            $start_date = date('Y-m-d', strtotime('1-January-'.$year));  // timestamp or 1-Januray 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                        }
                        else  if($month>=4 && $month<=6)
                        {
                            $start_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                        }
                        else  if($month>=7 && $month<=9)
                        {
                            $start_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                        }
                        else  if($month>=10 && $month<=12)
                        {
                            $start_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-January-'.($year+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                        }

                        $custom_date_select = '(date BETWEEN "' .
                        $start_date .
                        '" AND "' .
                        $end_date . '")';

                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('account', $val['id']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where($custom_date_select);
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                        
                        if($account_type_id == 11 || $account_type_id == 12){
                            $columns[] = $credits - $debits;
                        }else{
                            $columns[] = $debits - $credits;
                        }

                        $start = strtotime('+3 month', $start);

                        if($start > $end){
                            $month_2 = date('m', $start);
                            $year_2 = date('Y', $start);
                            
                            if($month_2>=1 && $month_2<=3)
                            {
                                $start_date = date('Y-m-d', strtotime('1-January-'.$year_2));  // timestamp or 1-Januray 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                            }
                            else  if($month_2>=4 && $month_2<=6)
                            {
                                $start_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                            }
                            else  if($month_2>=7 && $month_2<=9)
                            {
                                $start_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                            }
                            else  if($month_2>=10 && $month_2<=12)
                            {
                                $start_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-January-'.($year_2+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                            }

                            if($month . ' - ' . $year != $month_2 . ' - ' . $year_2){
                                $custom_date_select = '(date BETWEEN "' .
                                $start_date .
                                '" AND "' .
                                $end_date . '")';

                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('account', $val['id']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where($custom_date_select);
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;

                                if($account_type_id == 11 || $account_type_id == 12){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }
                            }
                        }
                    }
                    break;

                case 'years':
                    $start = strtotime($from_date);
                    $end = strtotime($to_date);

                    while ($start < $end) {
                        $year = date('Y', $start);

                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('account', $val['id']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('year(date) = "' . $year . '"');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                        
                        if($account_type_id == 11 || $account_type_id == 12){
                            $columns[] = $credits - $debits;
                        }else{
                            $columns[] = $debits - $credits;
                        }

                        $start = strtotime('+1 year', $start);

                        if($start > $end){
                            $year_2 = date('Y', $end);
                      
                            if($year != $year_2){
                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('account', $val['id']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('year(date) = "' . $year_2 . '"');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;
                                
                                if($account_type_id == 11 || $account_type_id == 12){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }
                            }
                        }
                    }
                    break;
                case 'customers':
                    $this->load->model('clients_model');
                    $clients = $this->clients_model->get();
                    foreach ($clients as $key => $client) {
                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('customer', $client['userid']);
                        $this->db->where('account', $val['id']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                        
                        if($account_type_id == 11 || $account_type_id == 12){
                            $columns[] = $credits - $debits;
                        }else{
                            $columns[] = $debits - $credits;
                        }
                    }

                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    $this->db->where('(customer = 0 or customer is null)');
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    
                    if($account_type_id == 11 || $account_type_id == 12){
                        $columns[] = $credits - $debits;
                    }else{
                        $columns[] = $debits - $credits;
                    }
                  break;

                case 'vendors':
                    $this->load->model('purchase/purchase_model');
                    $vendors = $this->purchase_model->get_vendor();
                    foreach ($vendors as $key => $vendor) {
                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('account', $val['id']);
                        $this->db->where('vendor', $vendor['userid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                        
                        if($account_type_id == 11 || $account_type_id == 12){
                            $columns[] = $credits - $debits;
                        }else{
                            $columns[] = $debits - $credits;
                        }
                    }

                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    $this->db->where('(vendor = 0 or vendor is null)');
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    
                    if($account_type_id == 11 || $account_type_id == 12){
                        $columns[] = $credits - $debits;
                    }else{
                        $columns[] = $debits - $credits;
                    }
                  break;

                case 'employees':
                  $this->load->model('staff_model');
                  $staffs = $this->staff_model->get();
                  foreach ($staffs as $key => $staff) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    $this->db->where('addedfrom', $staff['staffid']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    
                    if($account_type_id == 11 || $account_type_id == 12){
                        $columns[] = $credits - $debits;
                    }else{
                        $columns[] = $debits - $credits;
                    }
                  }
                  break;

                case 'product_service':
                    $this->load->model('invoice_items_model');
                    $items = $this->invoice_items_model->get();
                    foreach ($items as $key => $item) {
                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('account', $val['id']);
                        $this->db->where('item', $item['itemid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                        
                        if($account_type_id == 11 || $account_type_id == 12){
                            $columns[] = $credits - $debits;
                        }else{
                            $columns[] = $debits - $credits;
                        }
                    }
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    $this->db->where('(item = 0 or item is null)');
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    
                    if($account_type_id == 11 || $account_type_id == 12){
                        $columns[] = $credits - $debits;
                    }else{
                        $columns[] = $debits - $credits;
                    }
                    
                    break;
                default:
                  // code...
                  break;
            }
            
            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }

            $child_account[] = ['name' => $name, 'columns' => $columns, 'child_account' => $this->get_data_custom_summary_report_by_income_statement_recursive([
                        'child_account' => [],
                        'account_id' => $val['id'],
                        'account_type_id' => $account_type_id,
                        'from_date' => $from_date,
                        'to_date' => $to_date,
                        'accounting_method' => $accounting_method,
                        'acc_show_account_numbers' => $acc_show_account_numbers,
                        'display_rows_by' => $display_rows_by,
                        'display_columns_by' => $display_columns_by,
                    ])];
            
        }

        return $child_account;
    }

    /**
     * get data custom summary report
     * @param  array $data_filter 
     * @return array           
     */
    public function get_data_custom_summary_report_by_balance_sheet($data_filter){
        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();
        $acc_show_account_numbers = get_option('acc_show_account_numbers');

        $from_date = date('Y-01-01');
        $to_date = date('Y-m-d');
        $accounting_method = 'cash';
        $display_rows_by = 'income_statement';
        $display_columns_by = 'total_only';

        if(isset($data_filter['accounting_method'])){
            $accounting_method = $data_filter['accounting_method'];
        }

        if(isset($data_filter['from_date'])){
            $from_date = to_sql_date($data_filter['from_date']);
        }

        if(isset($data_filter['to_date'])){
            $to_date = to_sql_date($data_filter['to_date']);
        }

        if(isset($data_filter['display_rows_by'])){
            $display_rows_by = $data_filter['display_rows_by'];
        }

        if(isset($data_filter['display_columns_by'])){
            $display_columns_by = $data_filter['display_columns_by'];
        }

        $account_type_details = $this->get_account_type_details();
        $data_report = [];
        $data_accounts = [];

        foreach ($account_type_details as $key => $value) {
            if($value['account_type_id'] == 1){
                $data_accounts['accounts_receivable'][] = $value;
            }
            if($value['account_type_id'] == 2){
                $data_accounts['current_assets'][] = $value;
            }
            if($value['account_type_id'] == 3){
                $data_accounts['cash_and_cash_equivalents'][] = $value;
            }
            if($value['account_type_id'] == 4){
                $data_accounts['fixed_assets'][] = $value;
            }
            if($value['account_type_id'] == 5){
                $data_accounts['non_current_assets'][] = $value;
            }
            if($value['account_type_id'] == 6){
                $data_accounts['accounts_payable'][] = $value;
            }
            if($value['account_type_id'] == 7){
                $data_accounts['credit_card'][] = $value;
            }
            if($value['account_type_id'] == 8){
                $data_accounts['current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 9){
                $data_accounts['non_current_liabilities'][] = $value;
            }
            if($value['account_type_id'] == 10){
                $data_accounts['owner_equity'][] = $value;
            }

            if($value['account_type_id'] == 11){
                $data_accounts['income'][] = $value;
            }

            if($value['account_type_id'] == 12){
                $data_accounts['other_income'][] = $value;
            }

            if($value['account_type_id'] == 13){
                $data_accounts['cost_of_sales'][] = $value;
            }

            if($value['account_type_id'] == 14){
                $data_accounts['expenses'][] = $value;
            }

            if($value['account_type_id'] == 15){
                $data_accounts['other_expenses'][] = $value;
            }
        }

        foreach ($data_accounts as $data_key => $data_account) {
            $data_report[$data_key] = [];
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('(parent_account is null or parent_account = 0)');
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                        $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                    }else{
                        $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                    }

                    $columns = [];
                    switch ($display_columns_by) {
                        case 'total_only':
                            $this->db->select('sum(credit) as credit, sum(debit) as debit');
                            $this->db->where('account', $val['id']);
                            if($accounting_method == 'cash'){
                                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                            }
                            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                            $credits = $account_history->credit != '' ? $account_history->credit : 0;
                            $debits = $account_history->debit != '' ? $account_history->debit : 0;

                            if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                                $columns[] = $credits - $debits;
                            }else{
                                $columns[] = $debits - $credits;
                            }
                          break;

                        case 'months':
                            $start = $month = strtotime($from_date);
                            $end = strtotime($to_date);

                            while($month < $end)
                            {
                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('account', $val['id']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;

                                if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }

                                $month = strtotime("+1 month", $month);
                            }
                          break;

                        case 'quarters':
                            $start = strtotime($from_date);
                            $end = strtotime($to_date);

                            while ($start < $end) {
                                $month = date('m', $start);
                                $year = date('Y', $start);
                                if($month>=1 && $month<=3)
                                {
                                    $start_date = date('Y-m-d', strtotime('1-January-'.$year));  // timestamp or 1-Januray 12:00:00 AM
                                    $end_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                                }
                                else  if($month>=4 && $month<=6)
                                {
                                    $start_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM
                                    $end_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                                }
                                else  if($month>=7 && $month<=9)
                                {
                                    $start_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM
                                    $end_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                                }
                                else  if($month>=10 && $month<=12)
                                {
                                    $start_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM
                                    $end_date = date('Y-m-d', strtotime('1-January-'.($year+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                                }

                                $custom_date_select = '(date BETWEEN "' .
                                $start_date .
                                '" AND "' .
                                $end_date . '")';

                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('account', $val['id']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where($custom_date_select);
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;
                                
                                if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }

                                $start = strtotime('+3 month', $start);

                                if($start > $end){
                                    $month_2 = date('m', $start);
                                    $year_2 = date('Y', $start);
                                    
                                    if($month_2>=1 && $month_2<=3)
                                    {
                                        $start_date = date('Y-m-d', strtotime('1-January-'.$year_2));  // timestamp or 1-Januray 12:00:00 AM
                                        $end_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                                    }
                                    else  if($month_2>=4 && $month_2<=6)
                                    {
                                        $start_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM
                                        $end_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                                    }
                                    else  if($month_2>=7 && $month_2<=9)
                                    {
                                        $start_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM
                                        $end_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                                    }
                                    else  if($month_2>=10 && $month_2<=12)
                                    {
                                        $start_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM
                                        $end_date = date('Y-m-d', strtotime('1-January-'.($year_2+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                                    }

                                    if($month . ' - ' . $year != $month_2 . ' - ' . $year_2){
                                        $custom_date_select = '(date BETWEEN "' .
                                        $start_date .
                                        '" AND "' .
                                        $end_date . '")';

                                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                        $this->db->where('account', $val['id']);
                                        if($accounting_method == 'cash'){
                                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                        }
                                        $this->db->where($custom_date_select);
                                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                        $debits = $account_history->debit != '' ? $account_history->debit : 0;

                                        if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                                            $columns[] = $credits - $debits;
                                        }else{
                                            $columns[] = $debits - $credits;
                                        }
                                    }
                                }
                            }
                            break;

                        case 'years':
                            $start = strtotime($from_date);
                            $end = strtotime($to_date);

                            while ($start < $end) {
                                $year = date('Y', $start);

                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('account', $val['id']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('year(date) = "' . $year . '"');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;
                                
                                if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }

                                $start = strtotime('+1 year', $start);

                                if($start > $end){
                                    $year_2 = date('Y', $end);
                              
                                    if($year != $year_2){
                                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                        $this->db->where('account', $val['id']);
                                        if($accounting_method == 'cash'){
                                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                        }
                                        $this->db->where('year(date) = "' . $year_2 . '"');
                                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                                        
                                        if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                                            $columns[] = $credits - $debits;
                                        }else{
                                            $columns[] = $debits - $credits;
                                        }
                                    }
                                }
                            }
                            break;
                        case 'customers':
                            $this->load->model('clients_model');
                            $clients = $this->clients_model->get();
                            foreach ($clients as $key => $client) {
                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('customer', $client['userid']);
                                $this->db->where('account', $val['id']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;
                                
                                if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }
                            }

                            $this->db->select('sum(credit) as credit, sum(debit) as debit');
                            $this->db->where('account', $val['id']);
                            $this->db->where('(customer = 0 or customer is null)');
                            if($accounting_method == 'cash'){
                                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                            }
                            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                            $credits = $account_history->credit != '' ? $account_history->credit : 0;
                            $debits = $account_history->debit != '' ? $account_history->debit : 0;
                            
                            if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                                $columns[] = $credits - $debits;
                            }else{
                                $columns[] = $debits - $credits;
                            }
                          break;

                        case 'vendors':
                            $this->load->model('purchase/purchase_model');
                            $vendors = $this->purchase_model->get_vendor();
                            foreach ($vendors as $key => $vendor) {
                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('account', $val['id']);
                                $this->db->where('vendor', $vendor['userid']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;
                                
                                if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }
                            }

                            $this->db->select('sum(credit) as credit, sum(debit) as debit');
                            $this->db->where('account', $val['id']);
                            $this->db->where('(vendor = 0 or vendor is null)');
                            if($accounting_method == 'cash'){
                                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                            }
                            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                            $credits = $account_history->credit != '' ? $account_history->credit : 0;
                            $debits = $account_history->debit != '' ? $account_history->debit : 0;
                            
                            if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                                $columns[] = $credits - $debits;
                            }else{
                                $columns[] = $debits - $credits;
                            }
                          break;

                        case 'employees':
                          $this->load->model('staff_model');
                          $staffs = $this->staff_model->get();
                          foreach ($staffs as $key => $staff) {
                            $this->db->select('sum(credit) as credit, sum(debit) as debit');
                            $this->db->where('account', $val['id']);
                            $this->db->where('addedfrom', $staff['staffid']);
                            if($accounting_method == 'cash'){
                                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                            }
                            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                            $credits = $account_history->credit != '' ? $account_history->credit : 0;
                            $debits = $account_history->debit != '' ? $account_history->debit : 0;
                            
                            if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                                $columns[] = $credits - $debits;
                            }else{
                                $columns[] = $debits - $credits;
                            }
                          }
                          break;

                        case 'product_service':
                            $this->load->model('invoice_items_model');
                            $items = $this->invoice_items_model->get();
                            foreach ($items as $key => $item) {
                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('account', $val['id']);
                                $this->db->where('item', $item['itemid']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;
                                
                                if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }
                            }
                            $this->db->select('sum(credit) as credit, sum(debit) as debit');
                            $this->db->where('account', $val['id']);
                            $this->db->where('(item = 0 or item is null)');
                            if($accounting_method == 'cash'){
                                $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                            }
                            $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                            $credits = $account_history->credit != '' ? $account_history->credit : 0;
                            $debits = $account_history->debit != '' ? $account_history->debit : 0;
                            
                            if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7 || $value['account_type_id'] == 6){
                                $columns[] = $credits - $debits;
                            }else{
                                $columns[] = $debits - $credits;
                            }
                            
                            break;
                        default:
                          // code...
                          break;
                    }

                    $child_account = $this->get_data_custom_summary_report_by_balance_sheet_recursive([
                        'child_account' => [],
                        'account_id' => $val['id'],
                        'account_type_id' => $value['account_type_id'],
                        'from_date' => $from_date,
                        'to_date' => $to_date,
                        'accounting_method' => $accounting_method,
                        'acc_show_account_numbers' => $acc_show_account_numbers,
                        'display_rows_by' => $display_rows_by,
                        'display_columns_by' => $display_columns_by,
                    ]);

                    $data_report[$data_key][] = ['name' => $name, 'columns' => $columns, 'child_account' => $child_account];
                }
            }
        }

        $data_total_2 = [];
        foreach ($data_accounts as $data_key => $data_account) {
            if($data_key != 'income' && $data_key != 'other_income' && $data_key != 'cost_of_sales' && $data_key != 'expenses' && $data_key != 'other_expenses'){
                continue;
            }
            $total = 0;
            foreach ($data_account as $key => $value) {
                $this->db->where('active', 1);
                $this->db->where('account_detail_type_id', $value['id']);
                $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
                foreach ($accounts as $val) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();

                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    if($acc_show_account_numbers == 1 && $val['number'] != ''){
                            $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
                        }else{
                            $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
                        }


                    if($value['account_type_id'] == 11 || $value['account_type_id'] == 12 || $value['account_type_id'] == 8 || $value['account_type_id'] == 9 || $value['account_type_id'] == 10 || $value['account_type_id'] == 7){
                        $total += $credits - $debits;
                    }else{
                        $total += $debits - $credits;
                    }

                }
            }
            $data_total_2[$data_key] = $total;
        }

        $income = $data_total_2['income'] + $data_total_2['other_income'];
        $expenses = $data_total_2['expenses'] + $data_total_2['other_expenses'] + $data_total_2['cost_of_sales'];
        $net_income = $income - $expenses;

        return ['data' => $data_report, 'from_date' => $from_date, 'to_date' => $to_date, 'display_rows_by' => $display_rows_by, 'display_columns_by' => $display_columns_by, 'net_income' => $net_income];
    }

    /**
     * get data custom summary recursive
     * @param  array $data         
     * @return array                 
     */
    public function get_data_custom_summary_report_by_balance_sheet_recursive($data){
        $child_account = $data['child_account'];
        $account_id = $data['account_id'];
        $account_type_id = $data['account_type_id'];
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $accounting_method = $data['accounting_method'];
        $acc_show_account_numbers = $data['acc_show_account_numbers'];
        $display_rows_by = $data['display_rows_by'];
        $display_columns_by = $data['display_columns_by'];

        $this->db->where('active', 1);
        $this->db->where('parent_account', $account_id);
        $accounts = $this->db->get(db_prefix().'acc_accounts')->result_array();
        $data_return = [];
       
        foreach ($accounts as $val) {
            $columns = [];
            switch ($display_columns_by) {
                case 'total_only':
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;

                    if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                        $columns[] = $credits - $debits;
                    }else{
                        $columns[] = $debits - $credits;
                    }
                  break;

                case 'months':
                    $start = $month = strtotime($from_date);
                    $end = strtotime($to_date);

                    while($month < $end)
                    {
                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('account', $val['id']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('(month(date) = "' . date('m',$month) . '" and year(date) = "' . date('Y',$month) . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;

                        if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                            $columns[] = $credits - $debits;
                        }else{
                            $columns[] = $debits - $credits;
                        }

                        $month = strtotime("+1 month", $month);
                    }
                  break;

                case 'quarters':
                    $start = strtotime($from_date);
                    $end = strtotime($to_date);

                    while ($start < $end) {
                        $month = date('m', $start);
                        $year = date('Y', $start);
                        if($month>=1 && $month<=3)
                        {
                            $start_date = date('Y-m-d', strtotime('1-January-'.$year));  // timestamp or 1-Januray 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                        }
                        else  if($month>=4 && $month<=6)
                        {
                            $start_date = date('Y-m-d', strtotime('1-April-'.$year));  // timestamp or 1-April 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                        }
                        else  if($month>=7 && $month<=9)
                        {
                            $start_date = date('Y-m-d', strtotime('1-July-'.$year));  // timestamp or 1-July 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                        }
                        else  if($month>=10 && $month<=12)
                        {
                            $start_date = date('Y-m-d', strtotime('1-October-'.$year));  // timestamp or 1-October 12:00:00 AM
                            $end_date = date('Y-m-d', strtotime('1-January-'.($year+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                        }

                        $custom_date_select = '(date BETWEEN "' .
                        $start_date .
                        '" AND "' .
                        $end_date . '")';

                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('account', $val['id']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where($custom_date_select);
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                        
                        if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                            $columns[] = $credits - $debits;
                        }else{
                            $columns[] = $debits - $credits;
                        }

                        $start = strtotime('+3 month', $start);

                        if($start > $end){
                            $month_2 = date('m', $start);
                            $year_2 = date('Y', $start);
                            
                            if($month_2>=1 && $month_2<=3)
                            {
                                $start_date = date('Y-m-d', strtotime('1-January-'.$year_2));  // timestamp or 1-Januray 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM means end of 31 March
                            }
                            else  if($month_2>=4 && $month_2<=6)
                            {
                                $start_date = date('Y-m-d', strtotime('1-April-'.$year_2));  // timestamp or 1-April 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM means end of 30 June
                            }
                            else  if($month_2>=7 && $month_2<=9)
                            {
                                $start_date = date('Y-m-d', strtotime('1-July-'.$year_2));  // timestamp or 1-July 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM means end of 30 September
                            }
                            else  if($month_2>=10 && $month_2<=12)
                            {
                                $start_date = date('Y-m-d', strtotime('1-October-'.$year_2));  // timestamp or 1-October 12:00:00 AM
                                $end_date = date('Y-m-d', strtotime('1-January-'.($year_2+1)));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
                            }

                            if($month . ' - ' . $year != $month_2 . ' - ' . $year_2){
                                $custom_date_select = '(date BETWEEN "' .
                                $start_date .
                                '" AND "' .
                                $end_date . '")';

                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('account', $val['id']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where($custom_date_select);
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;

                                if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }
                            }
                        }
                    }
                    break;

                case 'years':
                    $start = strtotime($from_date);
                    $end = strtotime($to_date);

                    while ($start < $end) {
                        $year = date('Y', $start);

                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('account', $val['id']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('year(date) = "' . $year . '"');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                        
                        if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                            $columns[] = $credits - $debits;
                        }else{
                            $columns[] = $debits - $credits;
                        }

                        $start = strtotime('+1 year', $start);

                        if($start > $end){
                            $year_2 = date('Y', $end);
                      
                            if($year != $year_2){
                                $this->db->select('sum(credit) as credit, sum(debit) as debit');
                                $this->db->where('account', $val['id']);
                                if($accounting_method == 'cash'){
                                    $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                                }
                                $this->db->where('year(date) = "' . $year_2 . '"');
                                $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                                $credits = $account_history->credit != '' ? $account_history->credit : 0;
                                $debits = $account_history->debit != '' ? $account_history->debit : 0;
                                
                                if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                                    $columns[] = $credits - $debits;
                                }else{
                                    $columns[] = $debits - $credits;
                                }
                            }
                        }
                    }
                    break;
                case 'customers':
                    $this->load->model('clients_model');
                    $clients = $this->clients_model->get();
                    foreach ($clients as $key => $client) {
                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('customer', $client['userid']);
                        $this->db->where('account', $val['id']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                        
                        if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                            $columns[] = $credits - $debits;
                        }else{
                            $columns[] = $debits - $credits;
                        }
                    }

                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    $this->db->where('(customer = 0 or customer is null)');
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    
                    if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                        $columns[] = $credits - $debits;
                    }else{
                        $columns[] = $debits - $credits;
                    }
                  break;

                case 'vendors':
                    $this->load->model('purchase/purchase_model');
                    $vendors = $this->purchase_model->get_vendor();
                    foreach ($vendors as $key => $vendor) {
                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('account', $val['id']);
                        $this->db->where('vendor', $vendor['userid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                        
                        if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                            $columns[] = $credits - $debits;
                        }else{
                            $columns[] = $debits - $credits;
                        }
                    }

                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    $this->db->where('(vendor = 0 or vendor is null)');
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    
                    if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                        $columns[] = $credits - $debits;
                    }else{
                        $columns[] = $debits - $credits;
                    }
                  break;

                case 'employees':
                  $this->load->model('staff_model');
                  $staffs = $this->staff_model->get();
                  foreach ($staffs as $key => $staff) {
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    $this->db->where('addedfrom', $staff['staffid']);
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    
                    if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                        $columns[] = $credits - $debits;
                    }else{
                        $columns[] = $debits - $credits;
                    }
                  }
                  break;

                case 'product_service':
                    $this->load->model('invoice_items_model');
                    $items = $this->invoice_items_model->get();
                    foreach ($items as $key => $item) {
                        $this->db->select('sum(credit) as credit, sum(debit) as debit');
                        $this->db->where('account', $val['id']);
                        $this->db->where('item', $item['itemid']);
                        if($accounting_method == 'cash'){
                            $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                        }
                        $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                        $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                        $credits = $account_history->credit != '' ? $account_history->credit : 0;
                        $debits = $account_history->debit != '' ? $account_history->debit : 0;
                        
                        if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                            $columns[] = $credits - $debits;
                        }else{
                            $columns[] = $debits - $credits;
                        }
                    }
                    $this->db->select('sum(credit) as credit, sum(debit) as debit');
                    $this->db->where('account', $val['id']);
                    $this->db->where('(item = 0 or item is null)');
                    if($accounting_method == 'cash'){
                        $this->db->where('((rel_type = "invoice" and paid = 1) or rel_type != "invoice")');
                    }
                    $this->db->where('(date >= "' . $from_date . '" and date <= "' . $to_date . '")');
                    $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
                    $credits = $account_history->credit != '' ? $account_history->credit : 0;
                    $debits = $account_history->debit != '' ? $account_history->debit : 0;
                    
                    if($account_type_id == 11 || $account_type_id == 12 || $account_type_id == 8 || $account_type_id == 9 || $account_type_id == 10 || $account_type_id == 7 || $account_type_id == 6){
                        $columns[] = $credits - $debits;
                    }else{
                        $columns[] = $debits - $credits;
                    }
                    
                    break;
                default:
                  // code...
                  break;
            }
            
            if($acc_show_account_numbers == 1 && $val['number'] != ''){
                $name = $val['name'] != '' ? $val['number'].' - '.$val['name'] : $val['number'].' - '._l($val['key_name']);
            }else{
                $name = $val['name'] != '' ? $val['name'] : _l($val['key_name']);
            }

            $child_account[] = ['name' => $name, 'columns' => $columns, 'child_account' => $this->get_data_custom_summary_report_by_balance_sheet_recursive([
                        'child_account' => [],
                        'account_id' => $val['id'],
                        'account_type_id' => $account_type_id,
                        'from_date' => $from_date,
                        'to_date' => $to_date,
                        'accounting_method' => $accounting_method,
                        'acc_show_account_numbers' => $acc_show_account_numbers,
                        'display_rows_by' => $display_rows_by,
                        'display_columns_by' => $display_columns_by,
                    ])];
            
        }

        return $child_account;
    }

    /**
     * delete all data the account detail types table
     *
     * @param      int   $id     The identifier
     *
     * @return     boolean
     */
    public function reset_account_detail_types()
    {
        $affectedRows = 0;
        if ($this->db->table_exists(db_prefix() . 'acc_account_type_details')) {
            $this->db->query('DROP TABLE `'.db_prefix() .'acc_account_type_details`;');
            $this->db->query('CREATE TABLE ' . db_prefix() . "acc_account_type_details (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `account_type_id` INT(11) NOT NULL,
              `name` VARCHAR(255) NOT NULL,
              `note` TEXT NULL,
              `statement_of_cash_flows` VARCHAR(255) NULL,
              PRIMARY KEY (`id`)
            ) AUTO_INCREMENT=200, ENGINE=InnoDB DEFAULT CHARSET=" . $this->db->char_set . ';');
            $affectedRows++;
        }

        if ($affectedRows > 0) {
            return true;
        }
        return false;
    }

    /**
     * Automatic credit note conversion
     * @param  integer $payment_id 
     * @return boolean
     */
    public function automatic_credit_note_conversion($data){
        $this->delete_convert($data['credit_id'], 'credit_note');

        $payment_account = get_option('acc_credit_note_payment_account');
        $deposit_to = get_option('acc_credit_note_deposit_to');
        $affectedRows = 0;

        if(get_option('acc_close_the_books') == 1){
            if(strtotime(date('Y-m-d')) <= strtotime(get_option('acc_closing_date')) && strtotime(date('Y-m-d')) > strtotime(get_option('acc_closing_date'))){
                return false;
            }
        }

        $this->load->model('invoices_model');
        $invoice = $this->invoices_model->get($data['data']['invoice_id']);

        $this->load->model('currencies_model');
        $currency = $this->currencies_model->get_base_currency();

        $payment_total = $data['data']['amount'];
        if($invoice->currency_name != $currency->name){
            $payment_total = round($this->currency_converter($invoice->currency_name, $currency->name, $data['data']['amount']), 2);
        }

        if(get_option('acc_credit_note_automatic_conversion') == 1){
            $node = [];
            $node['split'] = $payment_account;
            $node['account'] = $deposit_to;
            $node['customer'] = $invoice->clientid;
            $node['debit'] = $payment_total;
            $node['credit'] = 0;
            $node['date'] = date('Y-m-d');
            $node['description'] = '';
            $node['rel_id'] = $data['credit_id'];
            $node['rel_type'] = 'credit_note';
            $node['datecreated'] = date('Y-m-d H:i:s');
            $node['addedfrom'] = get_staff_user_id();
            $data_insert[] = $node;

            $node = [];
            $node['split'] = $deposit_to;
            $node['customer'] = $invoice->clientid;
            $node['account'] = $payment_account;
            $node['date'] = date('Y-m-d');
            $node['debit'] = 0;
            $node['credit'] = $payment_total;
            $node['description'] = '';
            $node['rel_id'] = $data['credit_id'];
            $node['rel_type'] = 'credit_note';
            $node['datecreated'] = date('Y-m-d H:i:s');
            $node['addedfrom'] = get_staff_user_id();
            $data_insert[] = $node;
        }

        if($data_insert != []){
            $affectedRows = $this->db->insert_batch(db_prefix().'acc_account_history', $data_insert);
        }
            
        if ($affectedRows > 0) {
            return true;
        }

        return false;
    }

    public function get_account_bank_data($bank_id){
        $this->db->where('id', $bank_id);
        $this->db->order_by('id', 'asc');

        $transactions = $this->db->get(db_prefix().'acc_accounts')->result_array();

        $rResult = [];
        foreach ($transactions as $key => $value) {
            $rResult[$key]['plaid_status'] = $value['plaid_status'];
            $rResult[$key]['account_name'] = $value['plaid_account_name'];
        }
         
        return $rResult;
    }

    public function get_plaid_transaction($bank_id){
        $this->db->where('bank_id', $bank_id);
        $this->db->order_by('date', 'desc');

        $transactions = $this->db->get(db_prefix().'acc_transaction_bankings')->result_array();
      
        $account_type_name = [];
        $detail_type_name = [];

        $rResult = [];
        foreach ($transactions as $key => $value) {
            $rResult[$key]['withdrawals'] = $value['withdrawals'] != 0 ? $value['withdrawals'] : '';
            $rResult[$key]['deposits'] = $value['deposits'] != 0 ? $value['deposits'] : '';
            $rResult[$key]['date'] = $value['date'];
            $rResult[$key]['payee'] = $value['description'];
            //$rResult[$key]['check_number'] = $value['check_number'];
            $rResult[$key]['datecreated'] = $value['datecreated'];
        }
         
        return $rResult;
    }

    public function get_last_refresh_data($bank_id){
        $this->db->where('bank_id', $bank_id);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $refresh_date = $this->db->get(db_prefix().'acc_plaid_transaction_logs')->result_array();

        $rResult = [];
        foreach ($refresh_date as $key => $value) {
            $rResult[$key]['refresh_date'] = $value['last_updated'];
            
            $this->db->where('bank_id', $bank_id);
            $this->db->where('date', $value['last_updated']);
            $count = $this->db->get(db_prefix().'acc_transaction_bankings')->result_array();
            $count = count($count);
            
            $rResult[$key]['count'] = $count;
        }
         
        return $rResult;
    }

    public function get_date_last_updated($bank_id){
        $this->db->where('bank_id', $bank_id);
        $this->db->order_by('last_updated', 'desc');
        $this->db->limit(1);

        $plaid_transaction_log = $this->db->get(db_prefix().'acc_plaid_transaction_logs')->row();

        if($plaid_transaction_log)
        {
            return $plaid_transaction_log->last_updated;
        }

        return '';
    }


    public function get_plaid_link_token(){
        $data = $this->get_plaid_params(); 
        $data['products'] = ["auth"];
        $data['client_name'] = 'Plaid Test App';
        $data['country_codes'] = ["US"];
        $data['language'] = 'en';
        $data['user'] = ['client_user_id' => 'testUser'];

        $data_string = json_encode($data);

        $plaid_environment = $this->get_plaid_environment();

        $url = $plaid_environment.'link/token/create';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 120);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        
        $result = curl_exec($curl);

        $result = json_decode($result);

        return isset($result->link_token) ? $result->link_token : '';
    }

    public function get_plaid_params(){
        $plaid_environment = get_option('acc_plaid_environment');

        switch ($plaid_environment) {
            case 'production':
                $secret = get_option('acc_live_secret');
                break;
            case 'sandbox':
                $secret = get_option('acc_sandbox_secret');
                break;
            default:
                $secret = get_option('acc_live_secret');
                break;
        }

        $data = array(
            "client_id" => get_option('acc_plaid_client_id'), 
            "secret" => $secret, 
        );
        return $data;
    }

    public function get_plaid_environment(){
        $plaid_environment = get_option('acc_plaid_environment');
        
        switch ($plaid_environment) {
            case 'production':
                return 'https://production.plaid.com/';
                break;
            case 'sandbox':
                return 'https://sandbox.plaid.com/';
                break;
            default:
                return 'https://production.plaid.com/';
                break;
        }
    }

    /**
     * update general setting
     *
     * @param      array   $data   The data
     *
     * @return     boolean 
     */
    public function update_plaid_environment($data){
        foreach ($data as $key => $value) {
            update_option($key, $value);
            
            if ($this->db->affected_rows() > 0) {
                $affectedRows++;
            }
        }
        
        if ($affectedRows > 0) {
            return true;
        }
        return false;
    }

    public function plaid_get_account($access_token){
        $data = $this->get_plaid_params(); 
        $data['access_token'] = $access_token;

        $data_string = json_encode($data);

        $plaid_environment = $this->get_plaid_environment();

        $url = $plaid_environment.'accounts/get';

        $curl = curl_init($url);
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 120);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        
        $result = curl_exec($curl);

        $result = json_decode($result);

        return $result->accounts;
    }


    public function get_access_token($public_token){
        $data = $this->get_plaid_params(); 
        $data['public_token'] = $public_token;

        $data_string = json_encode($data);

        $plaid_environment = $this->get_plaid_environment();

        $url = $plaid_environment.'item/public_token/exchange';

        $curl = curl_init($url);
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 120);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        
        $result = curl_exec($curl);

        $result = json_decode($result);

        return $result->access_token;
    }


    public function plaid_get_transactions($data_filter, $retry = 1){
        $data = $this->get_plaid_params(); 
        $data['access_token'] = $data_filter['access_token'];
        $data['start_date'] = $data_filter['start_date'];
        $data['end_date'] = $data_filter['end_date'];
        $data['options'] = ['include_original_description' => true];
        
        $data_string = json_encode($data);

        $plaid_environment = $this->get_plaid_environment();

        $url = $plaid_environment.'transactions/get';

        $curl = curl_init($url);
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 120);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        
        $result = curl_exec($curl);

        $result = json_decode($result);
        if(isset($result->transactions)){
            return $result->transactions;
        }else{
            if($retry < 3){
                return $this->plaid_get_transactions($data_filter, $retry++);
            }else{
                return false;
            }
        }
    }

    /**
     * add bank reconcile
     * @param array $data 
     * @return  integer or boolean
     */
    public function add_bank_reconcile($data){
        if(isset($data['reconcile_id'])){
            unset($data['reconcile_id']);
        }

        if($data['ending_date'] != ''){
            $data['ending_date'] = to_sql_date($data['ending_date']);
        }

        if($data['income_date'] != ''){
            $data['income_date'] = to_sql_date($data['income_date']);
        }

        if($data['expense_date'] != ''){
            $data['expense_date'] = to_sql_date($data['expense_date']);
        }

        $data['service_charge'] = str_replace(',', '', $data['service_charge']);
        $data['interest_earned'] = str_replace(',', '', $data['interest_earned']);
        $data['ending_balance'] = str_replace(',', '', $data['ending_balance']);
        $data['debits_for_period'] = str_replace(',', '', $data['debits_for_period']);
        $data['credits_for_period'] = str_replace(',', '', $data['credits_for_period']);
        $data['beginning_balance'] = str_replace(',', '', $data['beginning_balance']);
        
        $this->db->insert(db_prefix().'acc_reconciles', $data);
        $insert_id = $this->db->insert_id();
        
        if($insert_id){
            if($data['service_charge'] > 0){
                $node = [];
                $node['split'] = $data['account'];
                $node['reconcile'] = $insert_id;
                $node['account'] = $data['expense_account'];
                $node['debit'] = $data['service_charge'];
                $node['credit'] = 0;
                $node['rel_id'] = 0;
                $node['rel_type'] = 'cheque_expense';
                $node['description'] = _l('service_charge');
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $node['company'] = $data['company'];

                $this->db->insert(db_prefix().'acc_account_history', $node);

                $node = [];
                $node['split'] = $data['expense_account'];
                $node['reconcile'] = $insert_id;
                $node['account'] = $data['account'];
                
                $node['debit'] = 0;
                $node['credit'] = $data['service_charge'];
                $node['rel_id'] = 0;
                $node['rel_type'] = 'cheque_expense';
                $node['description'] = _l('service_charge');
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $node['company'] = $data['company'];


                $this->db->insert(db_prefix().'acc_account_history', $node);
            }
            if($data['interest_earned'] > 0){
                $node = [];
                $node['split'] = $data['account'];
                $node['reconcile'] = $insert_id;
                $node['account'] = $data['income_account'];
                $node['debit'] = 0;
                $node['credit'] = $data['interest_earned'];
                $node['rel_id'] = 0;
                $node['rel_type'] = 'deposit';
                $node['description'] = _l('interest_earned');
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $node['company'] = $data['company'];


                $this->db->insert(db_prefix().'acc_account_history', $node);

                $node = [];
                $node['split'] = $data['income_account'];
                $node['reconcile'] = $insert_id;
                $node['account'] = $data['account'];
                $node['debit'] = $data['interest_earned'];
                $node['credit'] = 0;
                $node['rel_id'] = 0;
                $node['rel_type'] = 'deposit';
                $node['description'] = _l('interest_earned');
                $node['datecreated'] = date('Y-m-d H:i:s');
                $node['addedfrom'] = get_staff_user_id();
                $node['company'] = $data['company'];


                $this->db->insert(db_prefix().'acc_account_history', $node);
            }

            return $insert_id;
        }

        return false;
    }

    public function get_reconcile_difference_info($reconcile_id){
        $rs = 0;
        $from_date = '';
        $to_date = '';

        $reconcile = $this->get_reconcile($reconcile_id);
        if($reconcile){
            $to_date = $reconcile->ending_date;
        }

        $recently_reconcile = $this->get_recently_reconcile_by_account($reconcile->account, $reconcile_id);
        if($recently_reconcile){
            $from_date = $recently_reconcile->ending_date;
        }



        $this->db->where('account', $reconcile->account);

        if ($from_date != '' && $to_date != '') {
            $this->db->where('(date > "' . $from_date . '" and date <= "' . $to_date . '")');
        } elseif ($to_date != '' && $from_date == '') {
            $this->db->where('(date <= "' . $to_date . '")');
        }
            
        $this->db->where('('.db_prefix() . 'acc_account_history.reconcile ='. $reconcile->id.' or '.db_prefix() . 'acc_account_history.reconcile = 0)');
       
        $transactions = $this->db->get(db_prefix().'acc_account_history')->result_array();

        $this->db->where('bank_id', $reconcile->account);
        if ($from_date != '' && $to_date != '') {
            $this->db->where('(date > "' . $from_date . '" and date <= "' . $to_date . '")');
        } elseif ($to_date != '' && $from_date == '') {
            $this->db->where('(date <= "' . $to_date . '")');
        }
        $bankings = $this->db->get(db_prefix().'acc_transaction_bankings')->result_array();

        $banking_matched = [];

        $data_return = [];
        $data_return['banking_register_withdrawals'] = 0;
        $data_return['banking_register_deposits'] = 0;
        $data_return['posted_bank_withdrawals'] = 0;
        $data_return['posted_bank_deposits'] = 0;

        foreach($transactions as $tran){
            $data_return['banking_register_withdrawals'] +=  $tran['credit'];
            $data_return['banking_register_deposits'] +=  $tran['debit'];
        }

        foreach($bankings as $bank){
            $data_return['posted_bank_withdrawals'] +=  $bank['withdrawals'];
            $data_return['posted_bank_deposits'] +=  $bank['deposits'];
        }
            
        return $data_return;
    }

    /**
     * get reconcile
     * @param  string $id
     * @param  array  $where
     * @return array or object
     */
    public function get_reconcile($id = '', $where = [])
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);
            return $this->db->get(db_prefix() . 'acc_reconciles')->row();
        }

        $this->db->where($where);
        $this->db->order_by('id', 'desc');
        return $this->db->get(db_prefix() . 'acc_reconciles')->result_array();
    }

    /**
     * Gets the recently reconcile by account.
     *
     * @param        $bank_account  The bank account
     * @param        $reconcile_id  The reconcile identifier
     */
    public function get_recently_reconcile_by_account($bank_account, $reconcile_id){
        $this->db->where('account', $bank_account);
        $this->db->where('opening_balance', 0);
        
        $this->db->where('id != '.$reconcile_id);
        $this->db->order_by('id', 'desc');
        
        $reconcile = $this->db->get(db_prefix() . 'acc_reconciles')->row();

        if($reconcile){
            return $reconcile;
        }
        return false;
    }

    /**
     * Get account_id by number
     *
     * @param      string  $number  The account number
     * @param      string  $company_id
     *
     * @return     array  The date range report period.
     */
    public function get_account_id_by_number($number = ''){

        $this->db->where('number', $number);
        $account = $this->db->get(db_prefix() . 'acc_accounts')->row();

        if($account){
            return $account->id;
        }

        return false;
    }

    public function match_transactions($reconcile_id, $account_id){
        $rs = 0;
        $from_date = '';
        $to_date = '';

        $reconcile = $this->get_reconcile($reconcile_id);
        if($reconcile){
            $to_date = $reconcile->ending_date;
        }

        if($account_id != ''){
            $recently_reconcile = $this->get_recently_reconcile_by_account($account_id, $reconcile_id);
            if($recently_reconcile){
                $from_date = $recently_reconcile->ending_date;
            }
        }

        $this->db->where('account', $account_id);
        $this->db->where('(cleared != 1 or reconcile = 0)');
        if ($from_date != '' && $to_date != '') {
            $this->db->where('(date > "' . $from_date . '" and date <= "' . $to_date . '")');
        } elseif ($to_date != '' && $from_date == '') {
            $this->db->where('(date <= "' . $to_date . '")');
        }
        $transactions = $this->db->get(db_prefix().'acc_account_history')->result_array();

        $this->db->where('bank_id', $account_id);
        if ($from_date != '' && $to_date != '') {
            $this->db->where('(date > "' . $from_date . '" and date <= "' . $to_date . '")');
        } elseif ($to_date != '' && $from_date == '') {
            $this->db->where('(date <= "' . $to_date . '")');
        }
        $this->db->where('(matched != 1 or reconcile = 0)');
        $bankings = $this->db->get(db_prefix().'acc_transaction_bankings')->result_array();

        $banking_matched = [];

        $data_return = [];
        
        foreach($transactions as $tran){
            
            foreach($bankings as $bank){
                if(in_array($bank['id'], $banking_matched)){
                    continue;
                }
                $check = 1;
                if($tran['date'] != $bank['date']){
                    $check = 0;
                }
                
                if($tran['credit'] != $bank['withdrawals']){
                    $check = 0;
                }

                if($tran['debit'] != $bank['deposits']){
                    $check = 0;
                }
                
                if($check == 1){
                    $banking_matched[] = $bank['id'];

                    $this->db->where('id', $bank['id']);
                    $this->db->update(db_prefix().'acc_transaction_bankings', [
                        'reconcile' => $reconcile_id,
                        'matched' => 1,
                        //'matched_with' => $tran['id'],
                    ]);
                    if($this->db->affected_rows() > 0){
                        $rs++;
                    }

                    $this->db->where('id', $tran['id']);
                    $this->db->update(db_prefix().'acc_account_history', [
                        'reconcile' => $reconcile_id,
                        'cleared' => 1,
                    ]);
                    if($this->db->affected_rows() > 0){
                        $rs++;
                    }

                    $this->db->insert(db_prefix().'acc_matched_transactions', [
                        'account_history_id' => $tran['id'],
                        'history_amount' => 0,
                        'rel_id' => $bank['id'],
                        'rel_type' => 'banking',
                        'amount' => 0,
                        'reconcile' => $reconcile_id,
                    ]);
                    break;
                }
            }
        }


        $this->db->where('account', $account_id);
        $this->db->where('(cleared != 1 or reconcile = 0)');
        if ($from_date != '' && $to_date != '') {
            $this->db->where('(date > "' . $from_date . '" and date <= "' . $to_date . '")');
        } elseif ($to_date != '' && $from_date == '') {
            $this->db->where('(date <= "' . $to_date . '")');
        }
        $new_transactions = $this->db->get(db_prefix().'acc_account_history')->result_array();

        $this->db->where('bank_id', $account_id);
        $this->db->where('(matched != 1 or reconcile = 0)');
        if ($from_date != '' && $to_date != '') {
            $this->db->where('(date > "' . $from_date . '" and date <= "' . $to_date . '")');
        } elseif ($to_date != '' && $from_date == '') {
            $this->db->where('(date <= "' . $to_date . '")');
        }
        $new_bankings = $this->db->get(db_prefix().'acc_transaction_bankings')->result_array();

        foreach($new_transactions as $tran){
            $this->db->where('id', $tran['id']);
            $this->db->update(db_prefix().'acc_account_history', [
                'cleared' => -1,
            ]);
        }

        foreach($new_bankings as $bank){
            $this->db->where('id', $bank['id']);
            $this->db->update(db_prefix().'acc_transaction_bankings', [
                'matched' => -1,
                //'matched_with' => 0,
            ]);
        }

        if($rs > 0){
            return 1;
        }
        return 0;
    }


    public function unmatch_transactions($reconcile_id, $account_id){
        $affected_rows = 0;

        $from_date = '';
        $to_date = '';

        $reconcile = $this->get_reconcile($reconcile_id);
        if($reconcile){
            $to_date = $reconcile->ending_date;
        }

        if($account_id != ''){
            $recently_reconcile = $this->get_recently_reconcile_by_account($account_id, $reconcile_id);
            if($recently_reconcile){
                $from_date = $recently_reconcile->ending_date;
            }
        }

        $this->db->where('(reconcile = 0 or reconcile = '.$reconcile_id.')');
        if ($from_date != '' && $to_date != '') {
            $this->db->where('(date > "' . $from_date . '" and date <= "' . $to_date . '")');
        } elseif ($to_date != '' && $from_date == '') {
            $this->db->where('(date <= "' . $to_date . '")');
        }
        $this->db->update(db_prefix().'acc_account_history', ['reconcile' => 0, 'cleared' => 0]);
        if ($this->db->affected_rows() > 0) {
            $affected_rows++;
        }

        if ($from_date != '' && $to_date != '') {
            $this->db->where('(date > "' . $from_date . '" and date <= "' . $to_date . '")');
        } elseif ($to_date != '' && $from_date == '') {
            $this->db->where('(date <= "' . $to_date . '")');
        }
        $this->db->where('(reconcile = 0 or reconcile = '.$reconcile_id.')');
        $this->db->update(db_prefix().'acc_transaction_bankings', [
                    'adjusted' => 0,
                    'reconcile' => 0,
                    'matched' => 0,
                    //'matched_with' => 0,
                ]);

        if ($this->db->affected_rows() > 0) {
            $affected_rows++;
        }

        $this->db->where('rel_type', 'banking');
        $this->db->where('reconcile', $reconcile_id);
        $this->db->delete(db_prefix().'acc_matched_transactions');
        
        if ($this->db->affected_rows() > 0) {
            $affected_rows++;
        }

        $this->db->where('id', $reconcile->id);
        $this->db->update(db_prefix().'acc_reconciles', ['finish' => 0]);

        if ($this->db->affected_rows() > 0) {
            $affected_rows++;
        }

        if($affected_rows > 0){
            return true;
        }
        return false;
    }

    public function get_transaction_uncleared($reconcile_id){
        $from_date = '';
        $to_date = '';

        $reconcile = $this->get_reconcile($reconcile_id);
        if($reconcile){
            $to_date = $reconcile->ending_date;
        }

        $recently_reconcile = $this->get_recently_reconcile_by_account($reconcile->account, $reconcile_id);
        if($recently_reconcile){
            $from_date = $recently_reconcile->ending_date;
        }

        $this->db->where('bank_id', $reconcile->account);
        $this->db->where('((matched != 1 and matched != -2) or adjusted = 1)');
        if ($from_date != '' && $to_date != '') {
            $this->db->where('(date > "' . $from_date . '" and date <= "' . $to_date . '")');
        } elseif ($to_date != '' && $from_date == '') {
            $this->db->where('(date <= "' . $to_date . '")');
        }

        $transaction_bankings = $this->db->get(db_prefix().'acc_transaction_bankings')->result_array();

        return $transaction_bankings;
    }

    public function make_adjusting_entry_save($data){
        if($data['type'] == 'add_transaction'){
            $transaction_banking = $this->accounting_model->get_transaction_banking($data['transaction_bank_id']);

            $node = [];
            $node['split'] = $transaction_banking->bank_id;
            $node['account'] = $data['account'];
            //$node['vendor'] = $data['payee'] != '' ? $data['payee'] : 0;
            $node['customer'] = 0;
            $node['debit'] = $transaction_banking->withdrawals;
            $node['date'] = $transaction_banking->date;
            $node['credit'] = $transaction_banking->deposits;
            $node['reconcile'] = $data['reconcile'];
            $node['tax'] = 0;
            $node['cleared'] = 1;
            $node['description'] = '';
            $node['rel_id'] = $data['transaction_bank_id'];
            $node['rel_type'] = 'banking';
            $node['datecreated'] = date('Y-m-d H:i:s');
            $node['addedfrom'] = get_staff_user_id();

            $this->db->insert(db_prefix().'acc_account_history', $node);

            $node = [];
            $node['split'] = $data['account'];
            $node['account'] = $transaction_banking->bank_id;
            //$node['vendor'] = $data['payee'] != '' ? $data['payee'] : 0;
            $node['customer'] = 0;
            $node['debit'] = $transaction_banking->deposits;
            $node['date'] = $transaction_banking->date;
            $node['credit'] = $transaction_banking->withdrawals;
            $node['reconcile'] = $data['reconcile'];
            $node['tax'] = 0;
            $node['cleared'] = 1;
            $node['description'] = '';
            $node['rel_id'] = $data['transaction_bank_id'];
            $node['rel_type'] = 'banking';
            $node['datecreated'] = date('Y-m-d H:i:s');
            $node['addedfrom'] = get_staff_user_id();

            $this->db->insert(db_prefix().'acc_account_history', $node);

            $insert_id = $this->db->insert_id();

            if ($insert_id) {
                $this->db->where('id', $data['transaction_bank_id']);
                $this->db->update(db_prefix().'acc_transaction_bankings', [
                    'adjusted' => 1,
                    'matched' => 1,
                    //'matched_with' => $insert_id,
                ]);

                return true;
            }
        }else{

            $this->db->where('id', $data['transaction']);
            $account_history = $this->db->get(db_prefix().'acc_account_history')->row();
            $withdrawal = str_replace(',', '', $data['withdrawal']);
            $deposit = str_replace(',', '', $data['deposit']);
            if($withdrawal > 0){
                $amount = $withdrawal;
            }else{
                $amount = $deposit;
            }

            if ($account_history) {
                $this->db->where('id', $data['transaction']);
                $this->db->update(db_prefix().'acc_account_history', [
                    'reconcile' => $data['reconcile'],
                    'cleared' => 1,
                    'date' => to_sql_date($data['date']),
                    'credit' => $withdrawal,
                    'debit' => $deposit,
                ]);
               
                if($this->db->affected_rows() > 0){
                    // if($account_history->debit != $deposit || $account_history->credit != $withdrawal){
                    //     switch ($account_history->rel_type) {
                    //         case 'payment':
                    //             $this->load->model('payments_model');
                    //             $this->payments_model->update(['amount' => $amount, 'date' => _d($data['date']), 'note' => ''], $account_history->rel_id);
                    //             break;
                    //         case 'invoice':
                    //             $this->load->model('payments_model');
                    //             $this->invoices_model->update(['amount' => $amount, 'date' => _d($data['date']), 'note' => ''], $account_history->rel_id);
                    //             break;
                    //         case 'bill':
                    //             // code...
                    //             break;
                    //         case 'pay_bill':
                    //             // code...
                    //             break;
                    //         case 'check':
                    //             // code...
                    //             break;
                            
                    //         default:
                    //             // code...
                    //             break;
                    //     }
                    // }

                    $this->db->where('id', $data['transaction_bank_id']);
                    $this->db->update(db_prefix().'acc_transaction_bankings', [
                        'adjusted' => 1,
                        'matched' => 1,
                        //'matched_with' => $data['transaction'],
                    ]);

                    return true;
                }
            }
        }

        return false;
    }

    public function leave_it_uncleared($transaction_bank_id){
        $this->db->where('id', $transaction_bank_id);
        $this->db->update(db_prefix().'acc_transaction_bankings', [
            'matched' => -2,
            'adjusted' => 1,
        ]);

        if($this->db->affected_rows() > 0){
            return true;
        }

        return false;

    }

    public function get_transaction_leave_uncleared($reconcile_id){

        $from_date = '';
        $to_date = '';

        $reconcile = $this->get_reconcile($reconcile_id);
        if($reconcile){
            $to_date = $reconcile->ending_date;
        }

        $recently_reconcile = $this->get_recently_reconcile_by_account($reconcile->account, $reconcile_id);
        if($recently_reconcile){
            $from_date = $recently_reconcile->ending_date;
        }

        $this->db->where('bank_id', $reconcile->account);
        $this->db->where('matched = -2');
        if ($from_date != '' && $to_date != '') {
            $this->db->where('(date > "' . $from_date . '" and date <= "' . $to_date . '")');
        } elseif ($to_date != '' && $from_date == '') {
            $this->db->where('(date <= "' . $to_date . '")');
        }

        $transaction_bankings = $this->db->get(db_prefix().'acc_transaction_bankings')->result_array();

        return $transaction_bankings;
    }

    public function get_bank_transaction_uncleared($reconcile_id){

        $from_date = '';
        $to_date = '';
        $bank_account = '';

        $reconcile = $this->get_reconcile($reconcile_id);
        if($reconcile){
            $to_date = $reconcile->ending_date;
            $bank_account = $reconcile->account;
        }

        $recently_reconcile = $this->get_recently_reconcile_by_account($reconcile->account, $reconcile_id);
        if($recently_reconcile){
            $from_date = $recently_reconcile->ending_date;
        }

        $this->db->where('account', $bank_account);
        $this->db->where('reconcile', 0);

        if ($from_date != '' && $to_date != '') {
            $this->db->where('(date > "' . $from_date . '" and date <= "' . $to_date . '")');
        } elseif ($to_date != '' && $from_date == '') {
            $this->db->where('(date <= "' . $to_date . '")');
        }

        $account_histories = $this->db->get(db_prefix().'acc_account_history')->result_array();

        return $account_histories;
    }

    /**
     * finish reconcile bank account
     * @param  array $data 
     * @return boolean       
     */
    public function finish_reconcile_bank_account($data){

        $this->db->where('id', $data['reconcile']);
        $this->db->update(db_prefix().'acc_reconciles', ['finish' => 1]);

        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
        }

        if ($affectedRows > 0) {
            return true;
        }

        return true;
    }


    /**
     * reconcile restored
     * @param  [type] $account 
     * @param  [type] $company 
     * @return [type]          
     */
    public function reconcile_bank_account_restored($account)
    {
        $affected_rows=0;
        
        $this->db->where('account', $account);
        $this->db->where('finish', 0);
        $this->db->where('opening_balance', 0);
        $this->db->order_by('ending_date', 'desc');

        $reconcile = $this->db->get(db_prefix() . 'acc_reconciles')->row();

        if($reconcile){
            $this->db->where('reconcile', $reconcile->id);
            $this->db->update(db_prefix() . 'acc_account_history', ['reconcile' => 0, 'cleared' => 0]);
    
            $this->db->where('reconcile', $reconcile->id);
            $this->db->update(db_prefix().'acc_transaction_bankings', [
                        'reconcile' => 0,
                        'matched' => 0,
                        //'matched_with' => 0,
                    ]);

            if ($this->db->affected_rows() > 0) {
                $affected_rows++;
            }

            $this->db->where('rel_type', 'banking');
            $this->db->where('reconcile', $reconcile->id);
            $this->db->delete(db_prefix().'acc_matched_transactions');
            
            $this->db->where('id', $reconcile->id);
            $this->db->delete(db_prefix().'acc_reconciles');

            if ($this->db->affected_rows() > 0) {
                $affected_rows++;
            }
        }else{
            //get reconcile
            $this->db->where('account', $account);
            $this->db->where('finish', 1);
            $this->db->where('opening_balance', 0);
            $this->db->order_by('ending_date', 'desc');

            $reconcile = $this->db->get(db_prefix() . 'acc_reconciles')->row();

            if($reconcile){
                $this->db->where('reconcile', $reconcile->id);
                $this->db->update(db_prefix() . 'acc_account_history', ['reconcile' => 0, 'cleared' => 0]);

                $this->db->where('reconcile', $reconcile->id);
                $this->db->update(db_prefix().'acc_transaction_bankings', [
                            'reconcile' => 0,
                            'matched' => 0,
                            //'matched_with' => 0,
                        ]);

                if ($this->db->affected_rows() > 0) {
                    $affected_rows++;
                }

                $this->db->where('rel_type', 'banking');
                $this->db->where('reconcile', $reconcile->id);
                $this->db->delete(db_prefix().'acc_matched_transactions');
                
                $this->db->where('id', $reconcile->id);
                $this->db->delete(db_prefix().'acc_reconciles');

                if ($this->db->affected_rows() > 0) {
                    $affected_rows++;
                }
            }
        }

        if($affected_rows > 0){
            return true;
        }
        return false;
    }

    public function get_data_bank_reconciliation_summary($data_filter){
        $accounts = $this->get_accounts();

        $account_name = [];

        foreach ($accounts as $key => $value) {
            $account_name[$value['id']] = $value['name'];
        }


        $data = [];
        $data['cleared_transactions'] = 0;
        $data['account_name'] = '';
        $data['beginning_balance'] = 0;
        $data['ending_balance'] = 0;
        $data['statement_ending_date'] = '';
        $data['checks_and_payments'] = 0;
        $data['checks_and_payments_items'] = 0;
        $data['deposits_and_credits_items'] = 0;
        $data['deposits_and_credits'] = 0;
        $data['new_checks_and_payments'] = 0;
        $data['new_checks_and_payments_items'] = 0;
        $data['new_deposits_and_credits_items'] = 0;
        $data['new_deposits_and_credits'] = 0;
        $data['new_transactions'] = 0;

        if(isset($data_filter['reconcile_account'])){
            $data['account_name'] = (isset($account_name[$data_filter['reconcile_account']]) ? $account_name[$data_filter['reconcile_account']] : '');
        }

        $reconcile_id = '';

        if(isset($data_filter['reconcile'])){
            $reconcile_id = $data_filter['reconcile'];
        }

        if($reconcile_id != ''){
            $reconcile = $this->get_reconcile($reconcile_id);
            $data['beginning_balance'] = $reconcile->beginning_balance;
            $data['ending_balance'] = $reconcile->ending_balance;
            $this->db->where('reconcile', $reconcile_id);
            $this->db->where('account', $data_filter['reconcile_account']);
            $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();

            foreach($account_history as $history){
                if($history['debit'] > 0){
                    $data['deposits_and_credits_items'] += 1;
                    $data['deposits_and_credits'] += $history['debit'];
                    $data['cleared_transactions'] += $history['debit'];

                }else{
                    $data['checks_and_payments_items'] += 1;
                    $data['checks_and_payments'] -= $history['credit'];
                    $data['cleared_transactions'] -= $history['credit'];
                }
            }

            if($data['checks_and_payments_items'] > 1){
                $data['checks_and_payments_items'] .= ' '._l('items');
            }elseif($data['checks_and_payments_items'] == 1){
                $data['checks_and_payments_items'] .= ' '._l('item');
            }

            if($data['deposits_and_credits_items'] > 1){
                $data['deposits_and_credits_items'] .= ' '._l('items');
            }elseif($data['deposits_and_credits_items'] == 1){
                $data['deposits_and_credits_items'] .= ' '._l('item');
            }

            $this->db->where('reconcile', 0);
            $this->db->where('(date <= "' . $reconcile->ending_date . '")');
            $this->db->where('account', $data_filter['reconcile_account']);
            $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();

            foreach($account_history as $history){
                if($history['debit'] > 0){
                    $data['new_deposits_and_credits_items'] += 1;
                    $data['new_deposits_and_credits'] += $history['debit'];
                    $data['new_transactions'] += $history['debit'];

                }else{
                    $data['new_checks_and_payments_items'] += 1;
                    $data['new_checks_and_payments'] -= $history['credit'];
                    $data['new_transactions'] -= $history['credit'];
                }
            }

            if($data['new_checks_and_payments_items'] > 1){
                $data['new_checks_and_payments_items'] .= ' '._l('items');
            }elseif($data['new_checks_and_payments_items'] == 1){
                $data['new_checks_and_payments_items'] .= ' '._l('item');
            }

            if($data['new_deposits_and_credits_items'] > 1){
                $data['new_deposits_and_credits_items'] .= ' '._l('items');
            }elseif($data['new_deposits_and_credits_items'] == 1){
                $data['new_deposits_and_credits_items'] .= ' '._l('item');
            }

            $data['statement_ending_date'] = $reconcile->ending_date;
        }

        return $data;
    }

    public function get_data_bank_reconciliation_detail($data_filter){
        $accounts = $this->get_accounts();

        $account_name = [];

        foreach ($accounts as $key => $value) {
            $account_name[$value['id']] = $value['name'];
        }


        $data = [];
        $data['cleared_transactions'] = 0;
        $data['account_name'] = '';
        $data['beginning_balance'] = 0;
        $data['ending_balance'] = 0;
        $data['statement_ending_date'] = '';
        $data['checks_and_payments'] = 0;
        $data['checks_and_payments_items'] = 0;
        $data['deposits_and_credits_items'] = 0;
        $data['deposits_and_credits'] = 0;
        $data['deposits_and_credits_details'] = [];
        $data['checks_and_payments_details'] = [];

        $data['new_checks_and_payments'] = 0;
        $data['new_checks_and_payments_items'] = 0;
        $data['new_deposits_and_credits_items'] = 0;
        $data['new_deposits_and_credits'] = 0;
        $data['new_deposits_and_credits_details'] = [];
        $data['new_checks_and_payments_details'] = [];
        $data['new_transactions'] = 0;

        if(isset($data_filter['reconcile_account'])){
            $data['account_name'] = (isset($account_name[$data_filter['reconcile_account']]) ? $account_name[$data_filter['reconcile_account']] : '');
        }

        $reconcile_id = '';

        if(isset($data_filter['reconcile'])){
            $reconcile_id = $data_filter['reconcile'];
        }

        if($reconcile_id != ''){
            $reconcile = $this->get_reconcile($reconcile_id);
            $data['beginning_balance'] = $reconcile->beginning_balance;
            $data['ending_balance'] = $reconcile->ending_balance;
            $this->db->where('reconcile', $reconcile_id);
            $this->db->where('account', $data_filter['reconcile_account']);
            $this->db->order_by('date', 'asc');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();

            $balance = 0;
            foreach($account_history as $history){
                $history['name'] = '';
                //$history['number'] = $history['number'];
                $history['description'] = $history['description'];
                $history['split'] = $history['split'] != 0 ? (isset($account_name[$history['split']]) ? $account_name[$history['split']] : '') : '-Split-';
                if($history['customer'] != 0){
                    $history['name'] = get_company_name($history['customer']);
                }elseif ($history['vendor'] != 0) {
                    $history['name'] = acc_get_vendor_name($history['vendor']);
                }

                if($history['debit'] > 0){
                    $data['deposits_and_credits_items'] += 1;
                    $data['deposits_and_credits'] += $history['debit'];
                    $data['cleared_transactions'] += $history['debit'];
                    $balance += $history['debit'];
                    $history['balance'] = $balance;
                    $history['amount'] = $history['debit'];

                    $data['deposits_and_credits_details'][] = $history;
                }else{
                    $data['checks_and_payments_items'] += 1;
                    $data['checks_and_payments'] -= $history['credit'];
                    $data['cleared_transactions'] -= $history['credit'];
                    $history['amount'] = -$history['credit'];

                    $balance -= $history['credit'];
                    $history['balance'] = $balance;
                    $data['checks_and_payments_details'][] = $history;
                }
            }

            if($data['checks_and_payments_items'] > 1){
                $data['checks_and_payments_items'] .= ' '._l('items');
            }elseif($data['checks_and_payments_items'] == 1){
                $data['checks_and_payments_items'] .= ' '._l('item');
            }

            if($data['deposits_and_credits_items'] > 1){
                $data['deposits_and_credits_items'] .= ' '._l('items');
            }elseif($data['deposits_and_credits_items'] == 1){
                $data['deposits_and_credits_items'] .= ' '._l('item');
            }

            $this->db->where('reconcile', 0);
            $this->db->where('account', $data_filter['reconcile_account']);
            $this->db->where('(date <= "' . $reconcile->ending_date . '")');
            $this->db->order_by('date', 'asc');
            $account_history = $this->db->get(db_prefix().'acc_account_history')->result_array();

            $balance = 0;
            foreach($account_history as $history){
                $history['name'] = '';

                //$history['number'] = $history['number'];
                $history['description'] = $history['description'];
                $history['split'] = $history['split'] != 0 ? (isset($account_name[$history['split']]) ? $account_name[$history['split']] : '') : '-Split-';

                if($history['customer'] != 0){
                    $history['name'] = get_company_name($history['customer']);
                }elseif ($history['vendor'] != 0) {
                    $history['name'] = acc_get_vendor_name($history['vendor']);
                }

                if($history['debit'] > 0){
                    $data['new_deposits_and_credits_items'] += 1;
                    $data['new_deposits_and_credits'] += $history['debit'];
                    $data['new_transactions'] += $history['debit'];
                    $balance += $history['debit'];
                    $history['balance'] = $balance;
                    $history['amount'] = $history['debit'];

                    $data['new_deposits_and_credits_details'][] = $history;
                }else{
                    $data['new_checks_and_payments_items'] += 1;
                    $data['new_checks_and_payments'] -= $history['credit'];
                    $data['new_transactions'] -= $history['credit'];
                    $history['amount'] = -$history['credit'];

                    $balance -= $history['credit'];
                    $history['balance'] = $balance;
                    $data['new_checks_and_payments_details'][] = $history;
                }
            }

            if($data['new_checks_and_payments_items'] > 1){
                $data['new_checks_and_payments_items'] .= ' '._l('items');
            }elseif($data['new_checks_and_payments_items'] == 1){
                $data['new_checks_and_payments_items'] .= ' '._l('item');
            }

            if($data['new_deposits_and_credits_items'] > 1){
                $data['new_deposits_and_credits_items'] .= ' '._l('items');
            }elseif($data['new_deposits_and_credits_items'] == 1){
                $data['new_deposits_and_credits_items'] .= ' '._l('item');
            }

            $data['statement_ending_date'] = $reconcile->ending_date;
        }

        return $data;
    }

    /**
     * ajax update reconcile
     * @param  [type] $data 
     * @param  [type] $id   
     * @return [type]       
     */
    public function ajax_update_reconcile($data, $id){
        if(isset($data['company_id'])){
            unset($data['company_id']);
        }
        if($data['ending_date'] != ''){
            $data['ending_date'] = to_sql_date($data['ending_date']);
        }

        $data['ending_balance'] = str_replace(',', '', $data['ending_balance']);
        $data['debits_for_period'] = str_replace(',', '', $data['debits_for_period']);
        $data['credits_for_period'] = str_replace(',', '', $data['credits_for_period']);
        $data['beginning_balance'] = str_replace(',', '', $data['beginning_balance']);

        $this->db->where('id', $id);
        $affectedRows = $this->db->update(db_prefix().'acc_reconciles', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    public function convert_excel_date($date_number){
        $UNIX_DATE = (44625 - 25569) * 86400;
        $d = gmdate("d/m/Y", $UNIX_DATE);

        return $d;
    }
}
