ALTER TABLE t_purchase_order ADD COLUMN purchase_total int AFTER purchase_order_date;
ALTER TABLE t_purchase_order ADD COLUMN purchase_discount int AFTER purchase_total;