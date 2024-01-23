<?php

class Migration_Setup_db extends CI_Migration{

    protected $db_config_name = 'default';

    protected $auto_increment_int_10 = array(
                               'type' => 'INT',
                               'constraint' => 10,
                               'unsigned' => true,
                               'auto_increment' => true,
                            );

    protected $int_10 = array(
                               'type' => 'INT',
                               'constraint' => 10,
                               'unsigned' => true,
                               'null' => true
                            );

    protected $unique_int_10 = array(
                               'type' => 'INT',
                               'constraint' => 10,
                               'unsigned' => true,
                               'unique' => true,
                               'null' => true
                            );

    protected $bigint_10 = array(
                               'type' => 'BIGINT',
                               'constraint' => 10,
                               'unsigned' => true,
                               'null' => true
                            );


    protected $unique_bigint_10 = array(
                               'type' => 'BIGINT',
                               'constraint' => 10,
                               'unsigned' => true,
                               'unique' => true,
                               'null' => true
                            );

    protected $text_255 = array(
                               'type' => 'VARCHAR',
                                'constraint' => '255'
                            );

    protected $unique_text_255 = array(
                               'type' => 'VARCHAR',
                               'constraint' => '255',
                               'unique' => true
                            );

    protected $text = array(
                               'type' => 'TEXT'
                            );


    protected $datetime = array(
                               'type' => 'DATETIME',
                               'null' => true
                             );

    protected $price  = array(
                              'type' => 'DECIMAL(9,2)',
                              'default' => 0
                        );

    protected $rating  = array(
                              'type' => 'DECIMAL(2,1)',
                              'default' => 0.0
                        );

    protected $total_rating  = array(
                              'type' => 'DECIMAL(8,1)',
                              'default' => 0.0
                        );

    protected $bool = array(
                            'type' => 'TINYINT(1)',
                            'default' => 0
                      );


    public function up(){

        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'name' => $this->text_255,
              'parent_id' => $this->int_10,
              'order_by' => $this->int_10,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (parent_id) REFERENCES categories(id)");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('categories');



        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'name' => $this->text_255,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('product_statuses');



        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'sku' => $this->unique_text_255,
              'name' => $this->text_255,
              'short_description' => $this->text_255,
              'description' => $this->text,
              'product_status_id' => $this->int_10,
              'regular_price' => $this->price,
              'discount_price' => $this->price,
              'quantity' => $this->int_10,
              'taxable' => $this->bool,
              'total_rating' => $this->total_rating,
              'rating_user_count' => $this->int_10,
              'rating' => $this->rating,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (product_status_id) REFERENCES product_statuses(id)");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('products');


        /*product_categories start*/
        $this->dbforge->add_field(
           array(
              'category_id' => $this->int_10,
              'product_id' => $this->int_10,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (category_id) REFERENCES categories(id)");
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (product_id) REFERENCES products(id)");
        $this->dbforge->create_table('product_categories');
        /*product_categories end*/



        /*media start*/
        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'url' => $this->text_255,
              'thumbnail' => $this->text_255,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('media');
        /*media end*/


        /*product_media start*/
        $this->dbforge->add_field(
           array(
              'product_id' => $this->int_10,
              'media_id' => $this->int_10,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (media_id) REFERENCES media(id)");
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (product_id) REFERENCES products(id)");
        $this->dbforge->create_table('product_media');
        /*product_media end*/


        



        /*tags start*/
        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'name' => $this->text_255,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tags');
        /*tags end*/


        /*product_tags start*/
        $this->dbforge->add_field(
           array(
              'product_id' => $this->int_10,
              'tag_id' => $this->int_10,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (product_id) REFERENCES products(id)");
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (tag_id) REFERENCES tags(id)");
        $this->dbforge->create_table('product_tags');
        /*product_tags end*/

         /*users start*/
        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'username' => $this->unique_text_255,
              'password' => $this->text_255,
              'mobile' => $this->unique_bigint_10,
              'email' => $this->unique_text_255,
              'address' => $this->unique_text_255,
              'name' => $this->text_255,
              'active'  => $this->bool,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
         /*users start*/ 


        /*roles start*/
        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'name' => $this->text_255,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('roles');
        /*roles end*/


        /*user_roles start*/
        $this->dbforge->add_field(
           array(
              'user_id' => $this->int_10,
              'role_id' => $this->int_10,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)");
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (role_id) REFERENCES roles(id)");
        $this->dbforge->create_table('user_roles');
        /*user_roles end*/


        /*sessions start*/
        $this->dbforge->add_field(
           array(
              'id' => $this->text_255,
              'data' => $this->text,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('sessions');
        /*sessions end*/



        /*coupons start*/
        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'code' => $this->text_255,
              'description' => $this->text,
              'active' => $this->bool,
              'value' => $this->price,
              'multiple' => $this->bool,
              'start_datetime' => $this->datetime,
              'end_datetime' => $this->datetime,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('coupons');
        /*coupons end*/


        /*sales_orders start*/
        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'order_datetime' => $this->datetime,
              'total' => $this->price,
              'coupon_id' => $this->int_10,
              'session_id' => $this->text_255,
              'user_id' => $this->int_10,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (coupon_id) REFERENCES coupons(id)");
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (session_id) REFERENCES sessions(id)");
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('sales_orders');
        /*sales_orders end*/



        /*order_products start*/
        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'order_id' => $this->int_10,
              'sku' => $this->text_255,
              'name' => $this->text_255,
              'description' => $this->text,
              'price' => $this->price,
              'quantity' => $this->int_10,
              'subtotal' => $this->price,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (order_id) REFERENCES sales_orders(id)");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('order_products');
        /*order_products end*/


        /*cc_transactions start*/
        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'code' => $this->text_255,
              'order_id' => $this->int_10,
              'trans_datetime' => $this->datetime,
              'processor' => $this->text_255,
              'processor_trans_id' => $this->text_255,
              'amount' => $this->price,
              'cc_num' => $this->text_255,
              'cc_type' => $this->text_255,
              'response' => $this->text,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (order_id) REFERENCES sales_orders(id)");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('cc_transactions');
        /*cc_transactions end*/

        /*attributes_set start*/
        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'set_name' => $this->text_255,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('attributes_set');
        /*attributes_set end*/


         /*attributes_set_product start*/
        $this->dbforge->add_field(
           array(
              'product_id' => $this->int_10,
              'attributes_set_id' => $this->int_10,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (product_id) REFERENCES products(id)");
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (attributes_set_id) REFERENCES attributes_set(id)");
        $this->dbforge->create_table('attributes_set_product');
        /*attributes_set_product end*/




        /*attributes_name start*/
        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'name' => $this->text_255,
              'type' => $this->text_255,
              'visibility' => $this->bool,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('attributes_name');
        /*attributes_name end*/


        /*attributes_set_name start*/
        $this->dbforge->add_field(
           array(
              'attributes_set_id' => $this->int_10,
              'attributes_name_id' => $this->int_10,
              'required' => $this->bool,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (attributes_set_id) REFERENCES attributes_set(id)");
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (attributes_name_id) REFERENCES attributes_name(id)");
        $this->dbforge->create_table('attributes_set_name');
        /*attributes_set_name end*/



        /*attributes_values start*/
        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'value' => $this->text_255,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('attributes_values');
        /*attributes_values end*/


        /*attributes_name_values start*/
        $this->dbforge->add_field(
           array(
              'attributes_name_id' => $this->int_10,
              'attributes_value_id' => $this->int_10,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (attributes_name_id) REFERENCES attributes_name(id)");
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (attributes_value_id) REFERENCES attributes_values(id)");
        $this->dbforge->create_table('attributes_name_values');
        /*attributes_name_values end*/

         /*attributes_values_product start*/
        $this->dbforge->add_field(
           array(
              'attributes_value_id' => $this->int_10,
              'product_id' => $this->int_10,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (attributes_value_id) REFERENCES attributes_values(id)");
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (product_id) REFERENCES products(id)");
        $this->dbforge->create_table('attributes_values_product');
        /*attributes_values_product end*/


        /*user_review_product start*/
        $this->dbforge->add_field(
           array(
              'id' => $this->auto_increment_int_10,
              'user_id' => $this->int_10,
              'product_id' => $this->int_10,
              'rating' => $this->rating,
              'feedback' => $this->text,
              'inserted_at' => $this->datetime,
              'updated_at' => $this->datetime
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)");
        $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (product_id) REFERENCES products(id)");
        $this->dbforge->create_table('user_review_product');
        /*user_review_product end*/



    }


    public function down(){

        
    }

}