/*
DROP TABLE `a_branch1_a_groups`, `a_branch1_a_settings`, `a_branch1_entries`, `a_branch1_entryitems`, `a_branch1_entrytypes`, `a_branch1_groups`, `a_branch1_ledgers`, `a_branch1_logs`, `a_branch1_settings`, `a_branch1_tags`, `a_groups`, `a_login_attempts`, `a_permissions`, `a_settings`, `a_usera_accounts`, `a_users`, `a_users_a_groups`, `a_users_groups`;
*/

ALTER TABLE `trading_ticketing`.`qsell_saleinvoice_products` 
ADD COLUMN `purchaserate` VARCHAR(200) NULL DEFAULT 0 AFTER `unit`,
ADD COLUMN `purchaseamount` VARCHAR(200) NULL DEFAULT 0 AFTER `purchaserate`;


DROP TABLE `trading_ticketing`.`qbuy_purchase_soa`, `trading_ticketing`.`qbuy_purchase_pi`, `trading_ticketing`.`qbuy_purchase_orders`, `trading_ticketing`.`qbuy_purchase_order_products`, `trading_ticketing`.`qbuy_purchase_grn_products`, `trading_ticketing`.`qbuy_purchase_grn`, `trading_ticketing`.`qbuy_purchase`, `trading_ticketing`.`qbuy_products_costhead`, `trading_ticketing`.`qbuy_products`, `trading_ticketing`.`qbuy_po_vo_products`, `trading_ticketing`.`qbuy_po_vo`, `trading_ticketing`.`qbuy_pi_products`, `trading_ticketing`.`qbuy_debitnote_products`, `trading_ticketing`.`qbuy_debitnote_costhead`, `trading_ticketing`.`qbuy_debitnote`, `trading_ticketing`.`qbuy_creditnote_products`, `trading_ticketing`.`qbuy_creditnote_costhead`, `trading_ticketing`.`qbuy_creditnote`, `trading_ticketing`.`qbuy_advancepayment_payment_method`, `trading_ticketing`.`qbuy_advancepayment`;

ALTER TABLE `qsettings_company` 
ADD COLUMN `default_customer_ledger` INT(20) NULL DEFAULT NULL AFTER `paymentreceipt_sufix`,
ADD COLUMN `default_supplier_ledger` INT(20) NULL DEFAULT NULL AFTER `default_customer_ledger`,
ADD COLUMN `sales_invoice_ledger` INT(20) NULL DEFAULT NULL AFTER `default_supplier_ledger`,
ADD COLUMN `sales_invoice_vat_ledger` INT(20) NULL DEFAULT NULL AFTER `sales_invoice_ledger`,
ADD COLUMN `sales_return_ledger` INT(20) NULL DEFAULT NULL AFTER `sales_invoice_vat_ledger`,
ADD COLUMN `sales_return_vat_ledger` INT(20) NULL DEFAULT NULL AFTER `sales_return_ledger`,
ADD COLUMN `purchase_invoice_ledger` INT(20) NULL DEFAULT NULL AFTER `sales_return_vat_ledger`,
ADD COLUMN `purchase_invoice_vat_ledger` INT(20) NULL DEFAULT NULL AFTER `purchase_invoice_ledger`,
ADD COLUMN `purchase_return_ledger` INT(20) NULL DEFAULT NULL AFTER `purchase_invoice_vat_ledger`,
ADD COLUMN `purchase_return_vat_ledger` INT(20) NULL DEFAULT NULL AFTER `purchase_return_ledger`,
ADD COLUMN `sales_invoice_entry_type` INT(20) NULL DEFAULT NULL AFTER `purchase_return_vat_ledger`,
ADD COLUMN `sales_return_entry_type` INT(20) NULL DEFAULT NULL AFTER `sales_invoice_entry_type`,
ADD COLUMN `sales_billsettilement_entry_type` INT(20) NULL DEFAULT NULL AFTER `sales_return_entry_type`,
ADD COLUMN `sales_adwance_entry_type` INT(20) NULL DEFAULT NULL AFTER `sales_billsettilement_entry_type`,
ADD COLUMN `purchase_invoice_entry_type` INT(20) NULL DEFAULT NULL AFTER `sales_adwance_entry_type`,
ADD COLUMN `purchase_return_entry_type` INT(20) NULL DEFAULT NULL AFTER `purchase_invoice_entry_type`,
ADD COLUMN `purchase_billsettilement_entry_type` INT(20) NULL DEFAULT NULL AFTER `purchase_return_entry_type`,
ADD COLUMN `purchase_adwance_entry_type` INT(20) NULL DEFAULT NULL AFTER `purchase_billsettilement_entry_type`;


ALTER TABLE `qsettings_company` 
ADD COLUMN `seal` VARCHAR(200) NULL DEFAULT NULL AFTER `storeavailable`,
ADD COLUMN `pdfheader` VARCHAR(200) NULL DEFAULT NULL AFTER `seal`,
ADD COLUMN `pdffooter` VARCHAR(200) NULL DEFAULT NULL AFTER `pdfheader`,
CHANGE COLUMN `branch` `branch` VARCHAR(200) NULL DEFAULT NULL AFTER `purchase_adwance_entry_type`;


ALTER TABLE `qsettings_company` 
ADD COLUMN `settings_completed` TINYINT(1) NULL DEFAULT 0 AFTER `branch`;

ALTER TABLE `qsettings_company` 
ADD COLUMN `building_no` VARCHAR(200) NULL AFTER `company_name`,
ADD COLUMN `street_name` VARCHAR(200) NULL AFTER `building_no`,
ADD COLUMN `district` VARCHAR(200) NULL AFTER `street_name`,
ADD COLUMN `province_state` VARCHAR(200) NULL AFTER `district`,
ADD COLUMN `city` VARCHAR(200) NULL AFTER `province_state`,
ADD COLUMN `country` INT NULL AFTER `city`,
ADD COLUMN `postal_code` VARCHAR(200) NULL AFTER `country`,
ADD COLUMN `phone_number` VARCHAR(200) NULL AFTER `postal_code`;

ALTER TABLE `qsettings_company` 
CHANGE COLUMN `branch` `branch` VARCHAR(200) NULL DEFAULT NULL AFTER `id`;


ALTER TABLE `qcrm_supplier` 
ADD COLUMN `sup_group` VARCHAR(45) NULL DEFAULT NULL AFTER `sup_code`;

-------------------------------------done at server--------------------------------------------------------

ALTER TABLE `qbuy_purchase_return` 
ADD COLUMN `supplier_given_amt` VARCHAR(200) NULL DEFAULT 0 AFTER `grandtotalamount`;

CREATE TABLE `qbuy_refund` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `qbuy_purchase_return_id` BIGINT NULL DEFAULT NULL,
  `qbuy_purchase_pi_id` BIGINT NULL DEFAULT NULL,
  `supplier_id` BIGINT NULL DEFAULT NULL,
  `date` DATE NULL DEFAULT NULL,
  `rec_by` BIGINT NULL DEFAULT NULL,
  `notes` TEXT NULL DEFAULT NULL,
  `terms_conditions` VARCHAR(45) NULL DEFAULT NULL,
  `tpreview` TEXT NULL DEFAULT NULL,
  `addtotal` VARCHAR(200) NULL DEFAULT NULL,
  `acc_entries_id` BIGINT NULL DEFAULT NULL,
  `status` VARCHAR(45) NULL DEFAULT NULL,
  `created_by` BIGINT NULL DEFAULT NULL,
  `branch` BIGINT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`));

   CREATE TABLE `qbuy_refund_items` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `qbuy_refund_id` BIGINT NULL DEFAULT NULL,
  `debitaccount` BIGINT NULL DEFAULT NULL,
  `reference` TEXT NULL DEFAULT NULL,
  `amount` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`));

  ALTER TABLE `qbuy_purchase_orders` 
  ADD COLUMN `discount_type` TINYINT(1) NULL DEFAULT NULL AFTER `preparedby`;

  ALTER TABLE `qbuy_purchase_pi` 
DROP COLUMN `paid_by_cash`,
DROP COLUMN `paid_by_card`,
DROP COLUMN `paid_by_bank`,
ADD COLUMN `mark_payments` INT(1) NULL DEFAULT NULL AFTER `grandtotalamount`,
CHANGE COLUMN `useadvance` `use_advance` INT(1) NULL DEFAULT NULL COMMENT '1=>Using Adwance\\n2=>Not using Adwance' AFTER `mark_payments`,
CHANGE COLUMN `paid_from_adwance` `advance_amt` VARCHAR(50) NULL DEFAULT NULL AFTER `use_advance`;

ALTER TABLE `qbuy_purchase_pi` 
ADD COLUMN `discount_type` INT(1) NULL DEFAULT NULL AFTER `mark_payments`;

ALTER TABLE `qbuy_purchase_pi_products` 
ADD COLUMN `save_as` VARCHAR(45) NULL DEFAULT NULL AFTER `totalamount`,
ADD COLUMN `new_product_id` VARCHAR(45) NULL DEFAULT NULL AFTER `save_as`,
ADD COLUMN `product_transaction_id` BIGINT NULL DEFAULT NULL AFTER `new_product_id`;


ALTER TABLE `qbuy_purchase_pi` 
ADD COLUMN `soa_id` BIGINT(18) NULL DEFAULT NULL AFTER `discount_type`;

ALTER TABLE `qbuy_purchase_return` 
ADD COLUMN `soa_id` BIGINT(18) NULL DEFAULT NULL AFTER `grandtotalamount`;

ALTER TABLE `qbuy_billsettlement` 
ADD COLUMN `soa_id` BIGINT(18) NULL DEFAULT NULL AFTER `addtotal`;

ALTER TABLE `qbuy_advancepayment` 
ADD COLUMN `soa_id` BIGINT(18) NULL DEFAULT NULL AFTER `total_amount`;

CREATE TABLE `qbuy_purchase_pi_payments` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `qbuy_purchase_pi_id` BIGINT NULL DEFAULT NULL,
  `type` VARCHAR(50) NULL DEFAULT NULL,
  `debitaccount` INT NULL DEFAULT NULL,
  `reference` TEXT NULL DEFAULT NULL,
  `pay_amount` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`));

  ALTER TABLE `qbuy_advancepayment_payment_method` 
  CHANGE COLUMN `modeofpayment` `accountledger_debitaccount` VARCHAR(200) NULL DEFAULT NULL ;
  

ALTER TABLE `qbuy_purchase_pi` 
ADD COLUMN `acc_entries_id` BIGINT(18) NULL DEFAULT NULL AFTER `purchaser`;

ALTER TABLE `qbuy_purchase_return` 
ADD COLUMN `acc_entries_id` BIGINT(18) NULL DEFAULT NULL AFTER `grandtotalamount`;

ALTER TABLE `qbuy_billsettlement` 
ADD COLUMN `acc_entries_id` BIGINT(18) NULL DEFAULT NULL AFTER `addtotal`;

ALTER TABLE `qbuy_advancepayment` 
ADD COLUMN `acc_entries_id` BIGINT(18) NULL DEFAULT NULL AFTER `total_amount`;

ALTER TABLE `qbuy_billsettlement` 
ADD COLUMN `credit_from_another` INT(1) NULL DEFAULT NULL AFTER `transactiondate`,
ADD COLUMN `credit_from_ledjer` INT(20) NULL DEFAULT NULL AFTER `credit_from_another`,
CHANGE COLUMN `notes` `notes` TEXT NULL DEFAULT NULL ;

ALTER TABLE `qbuy_billsettlement` 
ADD COLUMN `use_advance` INT(1) NULL DEFAULT NULL AFTER `credit_from_ledjer`,
ADD COLUMN `advance_amt` VARCHAR(45) NULL DEFAULT 0 AFTER `use_advance`;

ALTER TABLE `qbuy_purchase_pi` 
CHANGE COLUMN `use_advance` `use_advance` INT(1) NULL DEFAULT NULL ;

ALTER TABLE `qbuy_billsettlement_payment_method` 
CHANGE COLUMN `modeofpayment` `debitaccount` VARCHAR(200) NULL DEFAULT NULL ;



 ALTER TABLE `qbuy_purchase_grn_products` 
  ADD COLUMN `save_as` VARCHAR(45) NULL DEFAULT NULL AFTER `quantity`,
  ADD COLUMN `new_product_id` VARCHAR(45) NULL DEFAULT NULL AFTER `save_as`,
  ADD COLUMN `product_transaction_id` VARCHAR(45) NULL DEFAULT NULL AFTER `new_product_id`;


ALTER TABLE `qbuy_purchase_return_products` 
ADD COLUMN `product_transaction_id` BIGINT NULL DEFAULT NULL AFTER `row_total`;

ALTER TABLE `qsettings_company` 
ADD COLUMN `sales_return_refund_entry_type` INT(20) NULL DEFAULT NULL AFTER `sales_adwance_entry_type`,
ADD COLUMN `purchase_return_refund_entry_type` INT(20) NULL DEFAULT NULL AFTER `purchase_adwance_entry_type`;

ALTER TABLE `qsell_saleinvoice` 
ADD COLUMN `mark_payments` INT(1) NULL DEFAULT NULL AFTER `entry_id`,
ADD COLUMN `use_advance` INT(1) NULL DEFAULT NULL AFTER `mark_payments`,
ADD COLUMN `advance_amt` VARCHAR(50) NULL DEFAULT NULL AFTER `use_advance`;


CREATE TABLE `qsell_saleinvoice_payments` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `qsell_saleinvoice` BIGINT NULL DEFAULT NULL,
  `type` VARCHAR(50) NULL DEFAULT NULL,
  `depositaccount` INT NULL DEFAULT NULL,
  `reference` TEXT NULL DEFAULT NULL,
  `pay_amount` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`));

  ALTER TABLE `qsell_saleinvoice_payments` 
CHANGE COLUMN `qsell_saleinvoice` `qsell_saleinvoice_id` BIGINT(20) NULL DEFAULT NULL ;

CREATE TABLE `qsell_saleinvoice_all_payments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `qsell_saleinvoice_id` bigint(20) DEFAULT NULL,
  `qsell_billsettlement_id` bigint(20) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL COMMENT 'from invoice / bill settile',
  `date` DATE DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `depositaccount` int(11) DEFAULT NULL,
  `pay_amount` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;


ALTER TABLE `qsell_saleinvoice_all_payments` 
ADD COLUMN `balance_amount` VARCHAR(100) NULL DEFAULT 0 AFTER `pay_amount`;
