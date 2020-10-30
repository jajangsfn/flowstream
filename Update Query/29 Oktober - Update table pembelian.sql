ALTER TABLE t_purchase_order_detail ADD cartons INTEGER DEFAULT 0 AFTER quantity;
ALTER TABLE t_receiving_detail ADD cartons INTEGER DEFAULT 0 AFTER quantity;
ALTER TABLE t_receiving ADD receiving_total INTEGER DEFAULT 0 AFTER receiving_no;
ALTER TABLE t_receiving ADD receiving_discount INTEGER DEFAULT 0 AFTER receiving_total;