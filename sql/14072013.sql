ALTER TABLE `transaction`
	ADD COLUMN `storno_time` TIMESTAMP NULL DEFAULT NULL AFTER `note`;
ALTER TABLE `transaction`
	ADD COLUMN `linked_transaction_id` INT(10) NULL DEFAULT NULL AFTER `storno_time`;
ALTER TABLE `transaction`
	ADD CONSTRAINT `FK_transaction_transaction` FOREIGN KEY (`linked_transaction_id`) REFERENCES `transaction` (`id`);
