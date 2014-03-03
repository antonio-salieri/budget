ALTER TABLE `transaction_type`
	ADD COLUMN `is_tax_resolver` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'if > 0 then this type will be used for automatically generating transaction entries for Taxes' AFTER `is_11`;

ALTER TABLE `transaction_type`
	ADD COLUMN `auto_resolve_tax` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'if > 0 then for transactions of this type will be automaticall created Tax entries' AFTER `is_tax_resolver`;
